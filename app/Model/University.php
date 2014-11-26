<?php
class University extends AppModel {
	public $actsAs = array(
		'Containable',
	);
	public $belongsTo = array('UniversityType');
	public $hasOne = array('UniversitiesParameter');
	public $hasMany = array('UniversitiesPhoto' => array('className' => 'UniversitiesPhoto',
            'foreignKey' => 'university_id'), 'CourseonUniversity');
	//public $displayField = 'nazwa';
		
	public function resize_image($file, $w, $h, $crop=FALSE) {
		list($width, $height) = getimagesize($file['tmp_name']);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		
		if (in_array($file['type'], array('image/jpeg','image/pjpeg'))) {
			$src = imagecreatefromjpeg($file['tmp_name']);
		} else {
			$src = imagecreatefrompng($file['tmp_name']);
		}
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		return $dst;
	}
}