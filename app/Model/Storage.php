<?php
class Storage extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = array('Client',  'University');	
	public $components = array('Auth');

	public function wczytajSchowekQuery($id) {
		//$id= $this->Auth->user('id');
		$user = $this->getCurrentUser();
		$id = $user['id'];
		$username = $user['username'];
		$schowek = $this->findByClientId($id);
		return $schowek;
	}
}