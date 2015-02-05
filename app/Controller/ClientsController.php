<?php
// app/Controller/ClientUsersController.php
App::uses('AppController', 'Controller');

class ClientsController extends AppController {

    public function isAuthorized($user) {
        if ($this->action === 'check_log' || $this->action === 'login' || $this->action === 'rejestracja') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete', 'view'))) {
            if ($this->Client->findById($user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function beforeFilter() {
        parent::beforeFilter();
         // Allow users to register and logout.
        $this->Auth->allow('login', 'facebook_login', 'check_log');
    }

    public function index() {
        $this->ClientUser->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'order' => array('Client.login' => 'asc' )
        );
        $users = $this->paginate('Client');
        $this->set(compact('users'));
    }

    public function view($id = null) {
             
            $this->Client->id = $id;
            if (!$this->Client->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->set('user', $this->Client->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Client->create();
            //Debugger::dump($this->request->data);
            if ($this->ClientUser->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }


    public function rejestracja() {
        if ($this->request->is('post')) {
            $this->Client->create();
            //Debugger::dump($this->request->data);
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit() {
        $id = $this->Auth->user('id');
        $this->Client->id= $id;
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Client->read(null, $id);
            //unset($this->request->data['Client']['password']);
        }
    }

    public function delete($id = null) {
        //$this->request->onlyAllow('post');

        $this->Client->id = $id;
        if (!$this->ClientUser->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->ClientUser->delete()) {
            $this->Session->setFlash(__('ClientUser deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('ClientUser was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    
    var $helpers = array('Form');
    
    public function login() {
        $this->layout = 'login';
        
        if ($this->request->is('post')) {
            if ($_SERVER['REMOTE_ADDR'] == '192.162.147.207' || $_SERVER['REMOTE_ADDR'] == '192.162.147.193' || $_SERVER['REMOTE_ADDR'] == '89.66.128.54' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
                if ($this->Auth->login()) {
                    $this->Session->setFlash(__('Welcome, '. $this->Auth->user('login')));
                    $this->redirect($this->Auth->redirectUrl());
                }
                $this->Session->setFlash(__('Invalid login or password, try again'));
            }
        } else{
                $this -> Session -> Setflash('Error: Access Denied');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function check_log() {
        //$this->layout = 'login';
        //Debugger::dump(json_encode($_POST));
        
        if ($this->request->is('post')) {
            //$this->Session->setFlash($this->request->pass);
            if(isset($this->request->data['email'])) {
                $client = $this->Client-> findByLogin($this->request->data['email']);
                if (empty($client)) {
                    $this->request->data['login'] = $this->request->data['email'] ; 
                    $this->request->data['password'] = $this->request->data['fb_id'];
                     $this->request->data['ClientUsersData']['email'] = $this->request->data['email'];
                     $this->request->data['ClientUsersData']['facebook_id'] = $this->request->data['fb_id'];
                    $this->request->data['status'] = 1;
                    $this->Client->create();
                //Debugger::dump($this->request->data);
                    if ($this->Client->save($this->request->data)) {
                        $this->Auth->login($client['Client']);
                        //return $this->redirect(array('action' => 'index'));
                    }
                     $id = $this->Auth->user('id');
                    $r = $this->Client->findById($id);
                    
                } else {
                    $this->Auth->login($client['Client']);
                     $id = $this->Auth->user('id');
                    $r = $this->Client->findById($id);
                    //return $this->redirect(array('action' => 'index'));
                }
            } elseif (!$this->Auth->loggedIn()) {
               $r===false;
            } else  {
                $id = $this->Auth->user('id');
                $r = $this->Client->findById($id);
            }
            $this->output_json($r['Client']['login']);
           
           
           // $this->redirect($this->Auth->redirectUrl());
        } 
    }
}