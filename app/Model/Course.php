<?php
class Course extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = 'CoursesCategory';
	public $displayField = 'nazwa';
	public $hasMany = array( 'CourseonUniversity');
}