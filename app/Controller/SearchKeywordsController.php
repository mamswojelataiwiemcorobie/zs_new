<?php
App::uses('AppController', 'Controller', 'SearchKeywordsController', 'UniversitiesController');

class SearchKeywordsController extends AppController {
	public $helpers = array('Cache');
	public $cacheAction = array(
	    'view' => 36000,
	    'index'  => 48000
	);

	public function najczesciej() {
		$najczesciej = $this->SearchKeyword->find('all',array('order' => 'SearchKeyword.counter', 'limit' =>10));
		return $najczesciej;
	}

	public function ostatnio() {
		$ostatnio = isset($_SESSION['ostatnio_odwiedzane']) ? $_SESSION['ostatnio_odwiedzane'] : array();
		Debugger::dump($ostatnio);
		Debugger::dump($_SESSION['ostatnio_odwiedzane']);
		return $ostatnio;
	}
}