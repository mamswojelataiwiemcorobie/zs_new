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
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'dashboard'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            )
        ),
        'RequestHandler',
		'Paginator',
		'Cookie',
    );

	function beforeFilter() {
        parent::beforeFilter();
		if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin')) || ($this->params['controller'] == 'users')) {
			$this->layout = 'admin';
			$this->Auth->allow('login');
		} else {
			$this->Auth->allow();
		}
		
        //$this->set('tracks', ClassRegistry::init('Track')->find('first');
		$this->set('init', false);
		$this->set('tabele', false);
		$this->set('mapy', false);
    }

	public function beforeRender(){
        parent::beforeFilter();
        if($this->RequestHandler->responseType() == 'json'){
            $this->RequestHandler->setContent('json', 'application/json' );
        }
		//$this->Cookie->httpOnly = true;
		//$cookie = $this->Cookie->read('rememberMe');
		
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
}
