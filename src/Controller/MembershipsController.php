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
