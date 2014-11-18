<?php
class CourseonUniversity extends AppModel {
	public $belongsTo = array('University', 'Course', 'TypCourse', 'TrybCourse');
	public $actsAs = array('Containable');
}