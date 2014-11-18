<?php
App::uses('Controller', 'Controller');

class UseridsController extends AppController {	
	//public $actsAs = array('Containable');

	
	public function index() {
	
	//GETTING FROM DATABASE
	///*
		$this->Userid->contain();
		$Userid = $this->Userid->find('all');
		$this->set('Userid', $Userid);
	//*/
	}
}