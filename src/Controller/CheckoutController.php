<?php
declare(strict_types=1);

namespace App\Controller;

class CheckoutController extends AppController
{
    public function package($id = null)
    {
        $this->viewBuilder()->disableAutoLayout();
        
        $packagesTable = $this->fetchTable('Packages');
        $package = $packagesTable->get($id);
        
        $user = $this->fetchTable('Users')->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Ensure role is member
            $data['Role'] = 'member';
            
            $user = $this->fetchTable('Users')->patchEntity($user, $data);
            
            // Basic transaction
            $connection = $this->fetchTable('Users')->getConnection();
            $connection->begin();
            
            $savedUser = $this->fetchTable('Users')->save($user);
            
            if ($savedUser) {
                // Create Membership based on BillingCycle
                $cycle = strtolower((string)$package->BillingCycle);
                $modifier = '+1 month';
                if ($cycle == 'yearly') $modifier = '+1 year';
                if ($cycle == 'quarterly') $modifier = '+3 months';

                $membership = $this->fetchTable('Memberships')->newEmptyEntity();
                $membershipData = [
                    'UserID' => $savedUser->UserID,
                    'PackageID' => $package->PackageID,
                    'StartDate' => date('Y-m-d'),
                    'EndDate' => date('Y-m-d', strtotime($modifier)),
                    'Status' => 'active'
                ];
                
                $membership = $this->fetchTable('Memberships')->patchEntity($membership, $membershipData);
                
                if ($this->fetchTable('Memberships')->save($membership)) {
                    $connection->commit();
                    return $this->redirect(['action' => 'thankYou']);
                }
            }
            
            $connection->rollback();
            $this->Flash->error(__('Transaction failed. Please check your details and try again.'));
        }
        
        $this->set(compact('package', 'user'));
    }

    public function thankYou()
    {
        $this->viewBuilder()->disableAutoLayout();
    }
}
