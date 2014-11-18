<?php
class TrybCourse extends AppModel {
	public $hasMany = array('CourseonUniversity');
	public $displayField = 'nazwa';
}