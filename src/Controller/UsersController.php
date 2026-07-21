<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function login()
    {
        // GET: redirect to home page — the modal will open via ?login=1
        if ($this->request->is('get')) {
            return $this->redirect('/?login=1');
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->find()
                ->where(['Username' => $data['Username'], 'Password' => $data['Password']])
                ->first();

            if ($user) {
                $this->getRequest()->getSession()->write('Auth.User', $user);

                $role = strtolower($user->Role);
                if ($role === 'admin') {
                    return $this->redirect('/admin');
                } elseif ($role === 'trainer') {
                    return $this->redirect('/trainer');
                } else {
                    return $this->redirect('/schedule');
                }
            }

            // Failed login — flash error with 'login' key so it renders inside the modal
            $this->Flash->error(__('Invalid username or password. Please try again.'), ['key' => 'login']);
            return $this->redirect('/?login=1');
        }
    }

    public function register()
    {
        $this->viewBuilder()->disableAutoLayout();
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // Force role to Member to prevent access to Trainer portal
            $data['Role'] = 'Member';
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->getRequest()->getSession()->write('Auth.User', $user);
                $this->Flash->success(__('Account created successfully. Welcome!'));
                return $this->redirect('/schedule');
            }
            $this->Flash->error(__('Could not create account. Please ensure your username and email are unique.'));
        }
        $this->set(compact('user'));
    }

    public function logout()
    {
        $this->getRequest()->getSession()->delete('Auth.User');
        return $this->redirect('/');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Change Password method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     */
    public function changePassword()
    {
        $this->viewBuilder()->disableAutoLayout();
        $userSession = $this->getRequest()->getSession()->read('Auth.User');
        
        if (!$userSession) {
            $this->Flash->error(__('Please log in to change your password.'));
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($userSession->UserID);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Simple password check without hashing for this example (based on the login method)
            if ($user->Password === $data['current_password']) {
                if ($data['new_password'] === $data['confirm_password']) {
                    $user->Password = $data['new_password'];
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Password changed successfully.'));
                        $this->getRequest()->getSession()->write('Auth.User', $user);
                    } else {
                        $this->Flash->error(__('Could not save new password.'));
                    }
                } else {
                    $this->Flash->error(__('New passwords do not match.'));
                }
            } else {
                $this->Flash->error(__('Current password is incorrect.'));
            }
        }
        
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
