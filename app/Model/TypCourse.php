<?php
class TypCourse extends AppModel {
	public $hasMany = array('CourseonUniversity');
	public $displayField = 'nazwa';
}