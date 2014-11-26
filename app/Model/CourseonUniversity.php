<?php
class CourseonUniversity extends AppModel {
	public $belongsTo = array('University', 'Course', 'CourseType', 'CourseMode');
	public $actsAs = array('Containable');
}