<?php
App::uses('AppModel', 'Model');

class Userid extends AppModel {
	//public $useTable = 'userids';
	public $useTable = false; // This model does not use a database table
/*
	public $name = 'userids';
	public $hasOne = 'Message';
	public $belongsTo = 'Message';
*/
}