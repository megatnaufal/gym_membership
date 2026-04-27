<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Classes Controller
 *
 * @property \App\Model\Table\ClassesTable $Classes
 */
class ClassesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Classes->find();
        $classes = $this->paginate($query);

        $this->set(compact('classes'));
    }

    /**
     * View method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $class = $this->Classes->get($id, contain: []);
        $this->set(compact('class'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $class = $this->Classes->newEmptyEntity();
        if ($this->request->is('post')) {
            $class = $this->Classes->patchEntity($class, $this->request->getData());
            if ($this->Classes->save($class)) {
                $this->Flash->success(__('The class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class could not be saved. Please, try again.'));
        }
        $this->set(compact('class'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $class = $this->Classes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $class = $this->Classes->patchEntity($class, $this->request->getData());
            if ($this->Classes->save($class)) {
                $this->Flash->success(__('The class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class could not be saved. Please, try again.'));
        }
        $this->set(compact('class'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $class = $this->Classes->get($id);
        if ($this->Classes->delete($class)) {
            $this->Flash->success(__('The class has been deleted.'));
        } else {
            $this->Flash->error(__('The class could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
