<?php
class Track extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $useTable = 'tracks';
	public $name = 'tracks';
	//public $useTable = false; // This model does not use a database table
	
}