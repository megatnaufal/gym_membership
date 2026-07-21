<?php
declare(strict_types=1);

namespace App\Controller;

class ScheduleController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->disableAutoLayout();
        
        $classes = $this->fetchTable('Classes')->find()
            ->contain(['Users'])
            ->order(['StartTime' => 'ASC'])
            ->all();
            
        $bookingsTable = $this->fetchTable('Bookings');
        $classStats = [];
        foreach ($classes as $class) {
            $count = $bookingsTable->find()->where(['ClassID' => $class->ClassID])->count();
            $classStats[$class->ClassID] = $count;
        }

        $user = $this->getRequest()->getSession()->read('Auth.User');

        // Build a lookup of class IDs the current user has already booked
        $bookedClassIds = [];
        $membershipStatus = null;

        if ($user) {
            $userBookings = $bookingsTable->find()
                ->where(['Bookings.UserID' => $user->UserID])
                ->select(['ClassID'])
                ->all();
            foreach ($userBookings as $b) {
                $bookedClassIds[$b->ClassID] = true;
            }

            // Fetch membership status for the banner
            if (strtolower($user->Role ?? '') === 'trainer') {
                $membership = new \App\Model\Entity\Membership([
                    'Status' => 'Active',
                    'StartDate' => new \Cake\I18n\FrozenTime(),
                    'EndDate' => new \Cake\I18n\FrozenTime('+10 years'),
                    'package' => new \App\Model\Entity\Package([
                        'PackageName' => 'Staff Access',
                        'Price' => 0.00
                    ])
                ]);
            } else {
                $membership = $this->fetchTable('Memberships')->find()
                    ->where([
                        'Memberships.UserID' => $user->UserID,
                        'Memberships.Status IN' => ['Active', 'active']
                    ])
                    ->contain(['Packages'])
                    ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                    ->first();

                if (!$membership) {
                    $membership = $this->fetchTable('Memberships')->find()
                        ->where(['Memberships.UserID' => $user->UserID])
                        ->contain(['Packages'])
                        ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                        ->first();
                }
            }
            $membershipStatus = $membership;
        }

        $this->set(compact('classes', 'classStats', 'user', 'bookedClassIds', 'membershipStatus'));
    }

    public function book($classId = null)
    {
        $user = $this->getRequest()->getSession()->read('Auth.User');
        if (!$user) {
            $this->Flash->error(__('Please log in to book a class.'));
            return $this->redirect('/users/login');
        }

        $bookingsTable = $this->fetchTable('Bookings');
        
        // Check if already booked
        $existing = $bookingsTable->find()->where(['ClassID' => $classId, 'UserID' => $user->UserID])->first();
        if ($existing) {
            $this->Flash->error(__('You are already on the roster for this class!'));
            return $this->redirect(['action' => 'index']);
        }

        $class = $this->fetchTable('Classes')->get($classId);
        $currentCount = $bookingsTable->find()->where(['ClassID' => $classId])->count();
        
        $status = ($currentCount >= $class->Capacity) ? 'Waitlisted' : 'Booked';

        $booking = $bookingsTable->newEmptyEntity();
        $booking = $bookingsTable->patchEntity($booking, [
            'UserID' => $user->UserID,
            'ClassID' => $classId,
            'BookingDate' => date('Y-m-d'),
            'AttendanceStatus' => $status
        ]);

        if ($bookingsTable->save($booking)) {
            $msg = $status === 'Waitlisted' ? 'Class is full. You have been added to the Waitlist!' : 'Your spot has been secured!';
            $this->Flash->success(__($msg));
        } else {
            $this->Flash->error(__('Unable to process booking.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
