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

        $this->set(compact('classes', 'classStats', 'user'));
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
