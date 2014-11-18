<?php
class UniversityType extends AppModel {
	public $hasMany = 'University';
	public $displayField = 'nazwa';
}