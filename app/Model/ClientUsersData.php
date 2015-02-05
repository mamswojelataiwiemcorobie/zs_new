<?php
class ClientUsersData extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = array('Client');	
}