<?php
class Profession extends AppModel {
	public $hasAndBelongsToMany = array(
        'Course' =>
            array(
                'className' => 'Course',
                'joinTable' => 'professions_courses',
                'foreignKey' => 'profession_id',
                'associationForeignKey' => 'course_id',
                'unique' => true
            )
    );
	public $displayField = 'nazwa';
	var $displayFieldTypes = array(
		'opis' => 'wysihtml',
        );
}