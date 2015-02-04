<?php
class Storage extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = array('Client',  'University');	

	public function wczytajSchowekQuery() {
		//$id= $this->Auth->user('id');
		$user = $this->getCurrentUser();
		$id = $user['id'];
		$schowek = $this->find('all', array('conditions'=> array('client_id' => $id)));
		//Debugger::dump($schowek);
		return $schowek;
	}
	public function dodajDoSchowkaQuery($id) {
		$user = $this->getCurrentUser();

		$data = array('client_id' => $user['id'], 'university_id' => $id);

		$this->create();
        if ($this->save($data, array('validate' => 'only'))) {
            return true;
            //$this->redirect(array('action' => 'index'));
        } else {
            return false;
        }   
	}
	public function usunZeSchowkaQuery($id) {
		$user = $this->getCurrentUser();
		$user_id = $user['id'];
        if ($this->deleteAll(array('Storage.client_id'=>$user_id, 'Storage.university_id' => $id, ), false)) {
        	echo "sda";
            return true;
            //$this->redirect(array('action' => 'index'));
        } else {
        	echo "kjdkf";
            return false;
        }   
	}
	
}