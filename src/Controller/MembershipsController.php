<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Memberships Controller
 *
 * @property \App\Model\Table\MembershipsTable $Memberships
 */
class MembershipsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Memberships->find();
        $memberships = $this->paginate($query);

        $this->set(compact('memberships'));
    }

    /**
     * Status method — shows the current user's membership status
     *
     * @return \Cake\Http\Response|null|void
     */
    public function status()
    {
        $this->viewBuilder()->disableAutoLayout();

        $user = $this->getRequest()->getSession()->read('Auth.User');
        if (!$user) {
            $this->Flash->error(__('Please log in to view your membership status.'));
            return $this->redirect('/users/login');
        }

        $userId = is_object($user) ? $user->UserID : ($user['UserID'] ?? null);

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
            // Fetch active membership first, falling back to latest membership record
            $membership = $this->Memberships->find()
                ->where([
                    'Memberships.UserID' => $userId,
                    'Memberships.Status IN' => ['Active', 'active']
                ])
                ->contain(['Packages'])
                ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                ->first();

            if (!$membership) {
                $membership = $this->Memberships->find()
                    ->where(['Memberships.UserID' => $userId])
                    ->contain(['Packages'])
                    ->orderBy(['Memberships.StartDate' => 'DESC', 'Memberships.MembershipID' => 'DESC'])
                    ->first();
            }
        }

        // Also fetch all bookings for this user with class details
        $bookings = $this->fetchTable('Bookings')->find()
            ->where(['Bookings.UserID' => $userId])
            ->contain(['Classes'])
            ->orderBy(['Classes.StartTime' => 'ASC'])
            ->all()
            ->toArray();

        $this->set(compact('user', 'membership', 'bookings'));
        // activeMembership is used by the shared navbar element to show the badge
        $activeMembership = $membership;
        $this->set(compact('activeMembership'));
    }

    /**
     * View method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membership = $this->Memberships->get($id, contain: []);
        $this->set(compact('membership'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $membership = $this->Memberships->newEmptyEntity();
        if ($this->request->is('post')) {
            $membership = $this->Memberships->patchEntity($membership, $this->request->getData());
            if ($this->Memberships->save($membership)) {
                $this->Flash->success(__('The membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membership could not be saved. Please, try again.'));
        }
        $this->set(compact('membership'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $membership = $this->Memberships->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membership = $this->Memberships->patchEntity($membership, $this->request->getData());
            if ($this->Memberships->save($membership)) {
                $this->Flash->success(__('The membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membership could not be saved. Please, try again.'));
        }
        $this->set(compact('membership'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membership = $this->Memberships->get($id);
        if ($this->Memberships->delete($membership)) {
            $this->Flash->success(__('The membership has been deleted.'));
        } else {
            $this->Flash->error(__('The membership could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
