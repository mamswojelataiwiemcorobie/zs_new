<?php
class Course extends AppModel {
	public $actsAs = array('Linkable','Containable');
	public $belongsTo = array('CoursesCategory', 'UniversityType');
	public $displayField = 'nazwa';
	public $hasMany = array( 'CourseonUniversity');

	function szukajUczelniQuery($p) {
		$p['kierunek'] = mysql_escape_string(mb_strtolower($p['kierunek']));
		$this->contain();
		$kierunki = $this->find('all', array('conditions' => array(//
																	'OR'=>array(
																				array('LOWER(Course.nazwa) LIKE ' => '%'.$p['kierunek'].'%'),
																				array('Course.course_id' => $p['kierunek_id'])),
																	 ), 
													'fields' => array('id', 'nazwa'),
													'order' => array('Course.nazwa')));
		return $kierunki;
	}
}