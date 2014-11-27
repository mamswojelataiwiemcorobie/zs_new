<?php
class CourseonUniversity extends AppModel {
	public $belongsTo = array('University', 'Course', 'CourseType', 'CourseMode', 'Faculty');
	public $actsAs = array('Containable');
}