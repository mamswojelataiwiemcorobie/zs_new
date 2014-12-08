<?php
class District extends AppModel {
	public $hasMany = array('University');
	public $actsAs = array('Containable');
}