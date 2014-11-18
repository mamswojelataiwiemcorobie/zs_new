<?php
class Course extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = 'CoursesType';
	public $displayField = 'nazwa';
	public $hasAndBelongsToMany = array(
        'Profession' =>
            array(
                'className' => 'Profession',
                'joinTable' => 'professions_courses',
                'foreignKey' => 'course_id',
                'associationForeignKey' => 'profession_id',
                'unique' => true,
            )
    );
	public $hasMany = array( 'CourseonUniversity');
}