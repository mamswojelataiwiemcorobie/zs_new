<?php
class Course extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = array('CoursesCategory', 'UniversityType');
	public $displayField = 'nazwa';
	public $hasMany = array( 'CourseonUniversity');
}