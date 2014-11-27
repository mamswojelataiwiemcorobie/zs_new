<?php
class Faculty extends AppModel {
	public $hasMany = array('CourseonUniversity');
	public $actsAs = array('Containable');
}