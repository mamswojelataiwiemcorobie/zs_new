<?php
App::uses('Controller', 'Controller');

class FacultiesController extends AppController {	
	public function admin_add_faculties($university_id) {
    	if ($this->request->is('post')) {
			//Debugger::dump($this->request->data);	
			$faculty= $this->request->data['Faculty'];
			//$this->University->create();
			if(!empty($faculty['nazwa'])) {
				$this->Faculty->create();
				if ($this->Faculty->save($faculty)) {
					$this->Session->setFlash(__('Wydział uczelni został utworzony'));
				} else {
					$this->Session->setFlash(__('Wydział nie mół zostać utworzony. Please, try again.'));
				}   
			} else $this->Session->setFlash(__('Wpisz nazwe wydziału'));
        }
    	$this->set('university', $university_id);
    }
}
