<?php
declare(strict_types=1);

namespace App\Controller;

class CheckoutController extends AppController
{
    // ─────────────────────────────────────────────────────────────────
    //  PACKAGE — Checkout form + purchase handler
    // ─────────────────────────────────────────────────────────────────
    public function package($id = null)
    {
        $this->viewBuilder()->disableAutoLayout();

        if (!$id) {
            return $this->redirect('/private-coaching');
        }

        // Load package
        try {
            $package = $this->fetchTable('Packages')->get($id);
        } catch (\Exception $e) {
            $this->Flash->error('Package not found.');
            return $this->redirect('/private-coaching');
        }

        // Read session user
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
        $isLoggedIn  = !empty($sessionUser);
        $userId      = null;

        if ($isLoggedIn) {
            $userId = is_object($sessionUser) ? $sessionUser->UserID : ($sessionUser['UserID'] ?? null);
        } else {
            // Require login
            $this->getRequest()->getSession()->write('Auth.redirect', '/checkout/package/' . $id);
            $this->Flash->error('You must sign in or sign up before purchasing a package.', ['key' => 'login']);
            return $this->redirect('/?login=1');
        }

        // ── POST: process payment ─────────────────────────────────────
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Clean phone (digits only, max 11)
            $phone = isset($data['phone']) ? substr(preg_replace('/[^0-9]/', '', $data['phone']), 0, 11) : '';

            // Get raw DB connection — bypasses ALL ORM validation
            $db = $this->fetchTable('Users')->getConnection();

            try {
                $db->begin();

                // ── Resolve the user ──────────────────────────────────
                if ($isLoggedIn && $userId) {
                    // Update name & phone only — no validation headaches
                    $db->execute(
                        'UPDATE users SET FullName = ?, Phone = ? WHERE UserID = ?',
                        [trim($data['full_name'] ?? ''), $phone, $userId]
                    );
                    $savedUserId = $userId;

                    // Refresh session user data
                    $freshUser = $this->fetchTable('Users')->get($userId);
                    $this->getRequest()->getSession()->write('Auth.User', $freshUser);

                } else {
                    // Guest checkout: check if email already exists
                    $email    = trim($data['email'] ?? '');
                    $username = trim($data['username'] ?? '');
                    $password = trim($data['password'] ?? '');
                    $fullName = trim($data['full_name'] ?? '');

                    if (!$email || !$username || !$password || !$fullName) {
                        throw new \RuntimeException('All fields are required for new accounts.');
                    }

                    // Check existing
                    $existing = $db->execute(
                        'SELECT UserID FROM users WHERE Email = ? OR Username = ? LIMIT 1',
                        [$email, $username]
                    )->fetch('assoc');

                    if ($existing) {
                        $savedUserId = (int)$existing['UserID'];
                        // Update their profile
                        $db->execute(
                            'UPDATE users SET FullName = ?, Phone = ? WHERE UserID = ?',
                            [$fullName, $phone, $savedUserId]
                        );
                    } else {
                        // Create new member
                        $db->execute(
                            'INSERT INTO users (Username, Password, FullName, Email, Phone, Role) VALUES (?, ?, ?, ?, ?, ?)',
                            [$username, $password, $fullName, $email, $phone, 'member']
                        );
                        $savedUserId = (int)$db->execute('SELECT LAST_INSERT_ID() as id')->fetch('assoc')['id'];
                    }

                    // Log in the new/existing user
                    $freshUser = $this->fetchTable('Users')->get($savedUserId);
                    $this->getRequest()->getSession()->write('Auth.User', $freshUser);
                }

                // ── Expire old memberships ────────────────────────────
                $db->execute(
                    "UPDATE memberships SET Status = 'Expired' WHERE UserID = ?",
                    [$savedUserId]
                );

                // ── Calculate membership period ───────────────────────
                $cycle    = strtolower((string)($package->BillingCycle ?? 'monthly'));
                $modifier = '+1 month';
                if ($cycle === 'yearly' || $cycle === '12 months') $modifier = '+365 days';
                if ($cycle === 'quarterly') $modifier = '+3 months';

                $startDate = date('Y-m-d');
                $endDate   = date('Y-m-d', strtotime($modifier));

                // ── Create Active membership ──────────────────────────
                $db->execute(
                    "INSERT INTO memberships (UserID, PackageID, StartDate, EndDate, Status) VALUES (?, ?, ?, ?, 'Active')",
                    [$savedUserId, $package->PackageID, $startDate, $endDate]
                );
                $newMembershipId = (int)$db->execute('SELECT LAST_INSERT_ID() as id')->fetch('assoc')['id'];

                $db->commit();

                // ── Build receipt ─────────────────────────────────────
                $paymentMethod = $data['payment_method'] ?? 'stripe';
                $last4 = !empty($data['card_number'])
                    ? substr(preg_replace('/\D/', '', $data['card_number']), -4)
                    : '0000';

                $transactionId = 'TXN-' . date('Ymd') . '-' . strtoupper(
                    substr(md5(uniqid((string)mt_rand(), true)), 0, 8)
                );

                $receiptData = [
                    'transactionId' => $transactionId,
                    'membershipId'  => $newMembershipId,
                    'fullName'      => $freshUser->FullName,
                    'email'         => $freshUser->Email,
                    'phone'         => $freshUser->Phone ?? 'N/A',
                    'packageName'   => $package->PackageName,
                    'price'         => $package->Price,
                    'billing'       => $package->BillingCycle,
                    'startDate'     => $startDate,
                    'endDate'       => $endDate,
                    'paymentMethod' => $paymentMethod === 'fpx'
                        ? 'FPX Online Banking — ' . ($data['fpx_bank'] ?? '')
                        : 'Stripe Card (**** ' . $last4 . ')',
                    'paymentStatus' => 'PAID',
                    'created'       => date('d M Y, h:i A'),
                ];

                $this->getRequest()->getSession()->write('Receipt', $receiptData);
                $this->getRequest()->getSession()->write('LastInvoice', $receiptData);

                return $this->redirect(['controller' => 'Checkout', 'action' => 'thankYou']);

            } catch (\RuntimeException $e) {
                $db->rollback();
                $this->Flash->error('Payment failed: ' . $e->getMessage());
            } catch (\Exception $e) {
                $db->rollback();
                $this->Flash->error('An unexpected error occurred. Please try again. (' . $e->getMessage() . ')');
            }
        }

        $this->set(compact('package', 'isLoggedIn', 'userId', 'sessionUser'));
    }

    // ─────────────────────────────────────────────────────────────────
    //  THANK YOU — Success + receipt
    // ─────────────────────────────────────────────────────────────────
    public function thankYou()
    {
        $this->viewBuilder()->disableAutoLayout();

        $receipt = $this->getRequest()->getSession()->read('Receipt');

        if (empty($receipt)) {
            $this->Flash->error('No recent purchase found.');
            return $this->redirect('/');
        }

        $this->set(compact('receipt'));
    }

    // ─────────────────────────────────────────────────────────────────
    //  INVOICE — PDF-printable receipt
    // ─────────────────────────────────────────────────────────────────
    public function invoice()
    {
        $this->viewBuilder()->disableAutoLayout();

        $receipt = $this->getRequest()->getSession()->read('Receipt')
            ?? $this->getRequest()->getSession()->read('LastInvoice');

        if (empty($receipt)) {
            $this->Flash->error('Invoice not found or session expired.');
            return $this->redirect('/');
        }

        $this->set(compact('receipt'));
    }
}
