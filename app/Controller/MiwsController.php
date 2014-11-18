<?php

class MiwsController extends AppController {

		
	
	public function index() {
		

	//GETTING FROM DATABASE
	
		$this->Miw->contain();
		$Miw = $this->Miw-> find('all');
		$this-> set('Miw', $Miw);
	
		debug($this->Miw);
	//print_r(debug($this->Miw);
	}	
}
