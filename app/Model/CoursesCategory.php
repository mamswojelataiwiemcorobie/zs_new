<?php
class CoursesCategory extends AppModel {
	public $hasMany = 'Courses';
	public $displayField = 'nazwa';
}