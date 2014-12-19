<?php
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
         // Allow users to register and logout.
		$this->Auth->allow('login');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
			//Debugger::dump($this->request->data);
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        //$this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

	public function admin_dashboard() {
        $title_for_layout = 'Dashbord';
        $this->set(compact('title_for_layout'));
    }
	
    var $helpers = array('Form');
	
	public function login() {
		$this->layout = 'login';
		
		if ($this->request->is('post')) {
			if ($_SERVER['REMOTE_ADDR'] == '192.162.147.207' || $_SERVER['REMOTE_ADDR'] == '192.162.147.193' || $_SERVER['REMOTE_ADDR'] == '89.66.128.54' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
				if ($this->Auth->login()) {
					$this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
					$this->redirect($this->Auth->redirectUrl());
				}
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}else{
                $this -> Session -> Setflash('Error: Access Denied');
        }
    }
	
    function admin_login() {
		$this->layout = 'login';

        /*$this->Accessadmin = ClassRegistry::init('Accessadmin');
        //$this->Accessadmin->id = 1;
        
        $date = date_create();
        $date = date_format($date, 'd/m/Y H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->Accessadmin->saveField('ip', $ip);

        $ip_name = '';
        if ($ip = '192.162.147.207') {
            $ip_name = 'zs_';
        }
        $this->Accessadmin->saveField('data_time', $date);


        if(!isset($_COOKIE['vnda'])){ 
            $vn_nr = sha1(microtime());
            $expire = time()+60*60*24*356;
            setcookie("vnda", $vn_nr, $expire);
        }else{
            $vn_nr = $_COOKIE['vnda'];
        }
        $this->Accessadmin->saveField('cookie', $vn_nr); 
        $cookie_name = '';
        if ($vn_nr == 'ba11a302ee64ef6c7c54aeb961aed7b08478f127') {
            $cookie_name = 'lwzspcch';
            $this->Accessadmin->saveField('who', $cookie_name);
        }
        if ($vn_nr == 'a5b5e6adccf604aa7c0ef61d5dc91cbb1a5a23e5') {
            $cookie_name = 'lwlwspnt';
            $this->Accessadmin->saveField('who', $cookie_name);
        }
        $who = $ip_name + $cookie_name;
        $this->Accessadmin->saveField('who', $who);*/
		if ($this->request->is('post')) {
			if ($_SERVER['REMOTE_ADDR'] == '192.162.147.207' || $_SERVER['REMOTE_ADDR'] == '192.162.147.193' || $_SERVER['REMOTE_ADDR'] == '89.66.128.54' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
				if ($this->Auth->login()) {
					$this->Session->setFlash(__('Witaj, '. $this->Auth->user('username')));
					$this->redirect($this->Auth->redirectUrl());
				}
				$this->Session->setFlash(__('Invalid username or password, try again'));
			} else{
                $this -> Session -> Setflash('Error: Access Denied');
			}
		}
    }
	public function admin_logout() {
		return $this->redirect($this->Auth->logout());
	}
}