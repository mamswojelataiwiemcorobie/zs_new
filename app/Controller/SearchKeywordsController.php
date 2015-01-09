<?php
App::uses('AppController', 'Controller', 'SearchKeywordsController', 'UniversitiesController');

class SearchKeywordsController extends AppController {
	public $helpers = array('Cache');
	public $cacheAction = array(
	    'view' => 36000,
	    'index'  => 48000
	);

	public function najczesciej() {
		$najczesciej = $this->SearchKeyword->find('all',array('order' => array('SearchKeyword.counter'=> 'desc'), 'limit' =>10));
		foreach ($najczesciej as $key => $value) {
			$najczesciej[$key]['SearchKeyword']['rank'] = $key+1;
		}
		shuffle($najczesciej);
		return $najczesciej;
	}

	public function ostatnio() {
		$ostatnio = isset($_SESSION['ostatnio_odwiedzane']) ? $_SESSION['ostatnio_odwiedzane'] : array();
		return $ostatnio;
	}
}