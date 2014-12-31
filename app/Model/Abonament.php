<?php
class Abonament extends AppModel {
	public $hasMany = 'University';
	public $displayField = 'nazwa';
}