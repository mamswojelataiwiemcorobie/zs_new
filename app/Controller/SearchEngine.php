<?php
App::uses('AppController', 'Controller');

class SearchEngineController extends AppController {
	public $helpers = array('Cache');
	public $cacheAction = array(
	    'view' => 36000,
	    'index'  => 48000
	);

	public function($id_typ_szkoly) {

	}
}