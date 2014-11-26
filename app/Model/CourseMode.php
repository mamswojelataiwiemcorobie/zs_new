<?php
class CourseMode extends AppModel {
	public $hasMany = array('CourseonUniversity');
	public $displayField = 'nazwa';
}