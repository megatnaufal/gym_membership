<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 */
class PackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Packages->find();
        $packages = $this->paginate($query);

        $this->set(compact('packages'));
    }

    /**
     * Coaching method (Public marketing page)
     */
    public function coaching()
    {
        $this->viewBuilder()->disableAutoLayout();
        
        $user = $this->getRequest()->getSession()->read('Auth.User');

        if ($this->request->is('post')) {
            if (!$user) {
                $this->Flash->error(__('Please log in to book a private session.'));
                return $this->redirect('/?login=1');
            }
            
            $data = $this->request->getData();
            $privateLessonsTable = $this->fetchTable('PrivateLessons');
            $lesson = $privateLessonsTable->newEmptyEntity();
            
            $lessonDateTime = $data['date'] . ' ' . $data['time'] . ':00';
            
            $lesson = $privateLessonsTable->patchEntity($lesson, [
                'MemberUserID' => $user->UserID,
                'TrainerUserID' => $data['trainer_id'],
                'LessonDateTime' => $lessonDateTime,
                'Status' => 'Confirmed'
            ]);
            
            if ($privateLessonsTable->save($lesson)) {
                $this->Flash->success(__('Private session booked successfully!'));
                return $this->redirect(['action' => 'coaching']);
            }
            $this->Flash->error(__('Could not book the session. Please try again.'));
        }

        $trainers = $this->fetchTable('Trainers')->find()
            ->contain(['Users'])
            ->all();
            
        $today = new \DateTime();
        $dateRange = [];
        for ($i = 1; $i <= 14; $i++) {
            $d = clone $today;
            $d->modify("+$i days");
            $dateRange[] = $d->format('Y-m-d');
        }
        
        $classesTable = $this->fetchTable('Classes');
        $trainerAvailability = [];
        
        foreach ($trainers as $trainer) {
            $trainerAvailability[$trainer->UserID] = [];
            foreach ($dateRange as $date) {
                $startDate = new \DateTime($date . ' 00:00:00');
                $endDate = clone $startDate;
                $endDate->modify('+23 hours 59 minutes 59 seconds');
                
                $hasClass = $classesTable->find()
                    ->where([
                        'TrainerUserID' => $trainer->UserID,
                        'StartTime >=' => $startDate,
                        'StartTime <=' => $endDate
                    ])->count() > 0;
                    
                if (!$hasClass) {
                    $trainerAvailability[$trainer->UserID][] = $date;
                }
            }
        }

        $this->set(compact('trainers', 'trainerAvailability', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $package = $this->Packages->get($id, contain: []);
        $this->set(compact('package'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $package = $this->Packages->newEmptyEntity();
        if ($this->request->is('post')) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $package = $this->Packages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
        $this->set(compact('package'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
