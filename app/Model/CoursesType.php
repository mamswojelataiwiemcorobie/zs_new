<?php
class CoursesType extends AppModel {
	public $hasMany = 'Courses';
	public $displayField = 'nazwa';
}