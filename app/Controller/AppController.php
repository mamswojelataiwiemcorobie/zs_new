<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Js', 'Html', 'Form', 'Captcha');
	public $components = array(
		'Session',
        'Auth',
        'RequestHandler',
		'Paginator',
		'Cookie',
    );

	public function beforeFilter() {
        parent::beforeFilter();
		//session_start();

		 if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin')) || ($this->params['controller'] == 'users') || ($this->params['controller'] == 'clients' && $this->params['action'] == 'index')) {
		  
		    //$this->Auth->userModel = 'User';
		    $this->layout = 'admin';
		    AuthComponent::$sessionKey = 'Auth.Admin';
		    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		    $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');
		    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		     $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'User',
                )
            );
		    $this->Auth->allow('login');
		    //$this->Auth->authorize = array('Controller');
		    $this->Auth->userScope = array('User.is_active' => 1);
		   
		    //$this->Session->write('Auth.redirect','/users/dashboard');
		    
		} elseif(($this->params['controller'] == 'clients') or ($this->params['controller'] == 'storages')) {
		  	
		    AuthComponent::$sessionKey = 'Auth.Client';
		    $this->Auth->loginAction = array('controller' => 'clients', 'action' => 'login');
		    //$this->Auth->loginRedirect = array('controller' => 'client_users', 'action' => 'index');
		    //$this->Auth->logoutRedirect = array('controller' => 'client_users', 'action' => 'logout');
		    $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'Client',
                 	'fields' => array(
	                    'username' => 'login',
	                    'password' => 'password'
	                )
                )
            );
		    $this->Auth->allow('login', 'facebook_login');
		    //$this->Auth->authorize = array('Controller');
		    
		} else {
			$this->Auth->allow();
		}
        //$this->set('tracks', ClassRegistry::init('Track')->find('first');
		$this->set('init', false);
		$this->set('tabele', false);
		$this->set('mapy', false);
    }

   function isAuthorized() {
	    return true;
	}


	public function beforeRender(){
        parent::beforeFilter();
        if($this->RequestHandler->responseType() == 'json'){
            $this->RequestHandler->setContent('json', 'application/json' );
        }
		//$this->Cookie->httpOnly = true;
		//$cookie = $this->Cookie->read('rememberMe');
		//session_start();
		$this->Cookie->httpOnly = true;
		$cookie = $this->Cookie->read('New'); 		
	}

	public function get_form_data($structure,$req) {
		$r = array();
		$ip = !empty($req);
		foreach ($structure as $data) {
			$r[$data[0]] = $ip && isset($req[$data[0]]) ? $req[$data[0]] : null;
		}
		return $r;
	}
	public function output_json($r) {
		ob_end_clean();
		echo json_encode($r);
		exit();
	}
}
