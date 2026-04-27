<?php
declare(strict_types=1);

namespace App\Controller;

class TrainerController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->disableAutoLayout();
        
        $user = $this->getRequest()->getSession()->read('Auth.User');
        if (!$user || strtolower($user->Role) !== 'trainer') {
            $this->Flash->error(__('Unauthorized access. Trainer portal only.'));
            return $this->redirect('/users/login');
        }

        $classes = $this->fetchTable('Classes')->find()
            ->where(['TrainerUserID' => $user->UserID])
            ->contain(['Bookings' => ['Users']])
            ->order(['StartTime' => 'ASC'])
            ->all();

        $this->set(compact('classes', 'user'));
    }
}
