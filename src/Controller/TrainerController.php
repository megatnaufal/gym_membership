<?php
declare(strict_types=1);

namespace App\Controller;

class TrainerController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $user = $this->getRequest()->getSession()->read('Auth.User');
        if (!$user || strtolower($user->Role ?? '') !== 'trainer') {
            $this->Flash->error(__('Unauthorized access. Trainer portal only.'));
            return $this->redirect('/users/login');
        }
        
        $this->viewBuilder()->disableAutoLayout();
        $this->set('user', $user);
    }

    // ─────────────────────────────────────────────────────────────────
    //  DASHBOARD
    // ─────────────────────────────────────────────────────────────────
    public function index()
    {
        $user = $this->getRequest()->getSession()->read('Auth.User');
        $classes = $this->fetchTable('Classes')->find()
            ->where(['TrainerUserID' => $user->UserID])
            ->contain(['Bookings' => ['Users']])
            ->order(['StartTime' => 'ASC'])
            ->all();

        $this->set(compact('classes'));
    }

    // ─────────────────────────────────────────────────────────────────
    //  CLASSES CRUD
    // ─────────────────────────────────────────────────────────────────
    public function classes()
    {
        $user = $this->getRequest()->getSession()->read('Auth.User');
        $classes = $this->fetchTable('Classes')->find()
            ->where(['TrainerUserID' => $user->UserID])
            ->contain(['Users', 'Bookings'])
            ->order(['StartTime' => 'ASC'])
            ->all();
        $this->set(compact('classes'));
    }

    public function coaching()
    {
        $lessons = $this->fetchTable('PrivateLessons')->find()
            ->contain(['Users', 'Trainers'])
            ->order(['LessonDateTime' => 'ASC'])
            ->all();
        $this->set(compact('lessons'));
    }

    public function addClass()
    {
        $classesTable = $this->fetchTable('Classes');
        $gymClass = $classesTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $gymClass = $classesTable->patchEntity($gymClass, $this->request->getData());
            if ($classesTable->save($gymClass)) {
                $this->Flash->success(__('The class has been saved.'));
                return $this->redirect(['action' => 'classes']);
            }
            $this->Flash->error(__('The class could not be saved. Please, try again.'));
        }

        $trainers = $this->fetchTable('Users')->find('list', [
            'keyField' => 'UserID',
            'valueField' => 'FullName'
        ])->where(['Role' => 'trainer'])->toArray();

        $this->set(compact('gymClass', 'trainers'));
    }

    public function editClass($id = null)
    {
        $classesTable = $this->fetchTable('Classes');
        $gymClass = $classesTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $gymClass = $classesTable->patchEntity($gymClass, $this->request->getData());
            if ($classesTable->save($gymClass)) {
                $this->Flash->success(__('The class has been updated.'));
                return $this->redirect(['action' => 'classes']);
            }
            $this->Flash->error(__('The class could not be updated. Please, try again.'));
        }

        $trainers = $this->fetchTable('Users')->find('list', [
            'keyField' => 'UserID',
            'valueField' => 'FullName'
        ])->where(['Role' => 'trainer'])->toArray();

        $this->set(compact('gymClass', 'trainers'));
    }

    public function deleteClass($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classesTable = $this->fetchTable('Classes');
        $gymClass = $classesTable->get($id);
        
        if ($classesTable->delete($gymClass)) {
            $this->Flash->success(__('The class has been deleted.'));
        } else {
            $this->Flash->error(__('The class could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'classes']);
    }

    // ─────────────────────────────────────────────────────────────────
    //  TRAINERS CRUD
    // ─────────────────────────────────────────────────────────────────
    public function trainers()
    {
        $trainers = $this->fetchTable('Users')->find()
            ->where(['Role' => 'trainer'])
            ->order(['FullName' => 'ASC'])
            ->all();
        $this->set(compact('trainers'));
    }

    public function addTrainer()
    {
        $usersTable = $this->fetchTable('Users');
        $trainer = $usersTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['Role'] = 'trainer'; // Force role to trainer
            
            $trainer = $usersTable->patchEntity($trainer, $data);
            if ($usersTable->save($trainer)) {
                $trainersTable = $this->fetchTable('Trainers');
                $newTrainer = $trainersTable->newEntity([
                    'UserID' => $trainer->UserID,
                    'Specialty' => 'General',
                    'Rating' => 0.0
                ]);
                $trainersTable->save($newTrainer);
                
                $this->Flash->success(__('The trainer has been saved.'));
                return $this->redirect(['action' => 'trainers']);
            }
            $this->Flash->error(__('The trainer could not be saved. Please, try again.'));
        }
        $this->set(compact('trainer'));
    }

    public function editTrainer($id = null)
    {
        $usersTable = $this->fetchTable('Users');
        $trainer = $usersTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Unset password if it's empty so it doesn't overwrite with empty string
            $data = $this->request->getData();
            if (empty($data['Password'])) {
                unset($data['Password']);
            }
            
            // Allow bypassing Username validation on update if necessary, but standard save should work.
            $trainer = $usersTable->patchEntity($trainer, $data);
            if ($usersTable->save($trainer)) {
                $this->Flash->success(__('The trainer has been updated.'));
                return $this->redirect(['action' => 'trainers']);
            }
            $this->Flash->error(__('The trainer could not be updated. Please, try again.'));
        }
        $this->set(compact('trainer'));
    }

    public function deleteTrainer($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersTable = $this->fetchTable('Users');
        $trainer = $usersTable->get($id);
        
        if ($usersTable->delete($trainer)) {
            $this->Flash->success(__('The trainer has been deleted.'));
        } else {
            $this->Flash->error(__('The trainer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'trainers']);
    }

    // ─────────────────────────────────────────────────────────────────
    //  MEMBERS CRUD
    // ─────────────────────────────────────────────────────────────────
    public function members()
    {
        $members = $this->fetchTable('Users')->find()
            ->where(['Role' => 'member'])
            ->order(['FullName' => 'ASC'])
            ->all();
        $this->set(compact('members'));
    }

    public function addMember()
    {
        $usersTable = $this->fetchTable('Users');
        $member = $usersTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['Role'] = 'member'; // Force role to member
            
            $member = $usersTable->patchEntity($member, $data);
            if ($usersTable->save($member)) {
                $this->Flash->success(__('The member has been saved.'));
                return $this->redirect(['action' => 'members']);
            }
            $this->Flash->error(__('The member could not be saved. Please, try again.'));
        }
        $this->set(compact('member'));
    }

    public function editMember($id = null)
    {
        $usersTable = $this->fetchTable('Users');
        $member = $usersTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (empty($data['Password'])) {
                unset($data['Password']);
            }
            
            $member = $usersTable->patchEntity($member, $data);
            if ($usersTable->save($member)) {
                $this->Flash->success(__('The member has been updated.'));
                return $this->redirect(['action' => 'members']);
            }
            $this->Flash->error(__('The member could not be updated. Please, try again.'));
        }
        $this->set(compact('member'));
    }

    public function deleteMember($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersTable = $this->fetchTable('Users');
        $member = $usersTable->get($id);
        
        if ($usersTable->delete($member)) {
            $this->Flash->success(__('The member has been deleted.'));
        } else {
            $this->Flash->error(__('The member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'members']);
    }
}
