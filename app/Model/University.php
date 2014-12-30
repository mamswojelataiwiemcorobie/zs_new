<?php
class University extends AppModel {
	public $actsAs = array(
		'Containable', 'Search.Searchable'
	);	

	public $belongsTo = array('UniversityType', 'District');
	public $hasOne = array('UniversitiesParameter');
	public $hasMany = array('UniversitiesPhoto' => array('className' => 'UniversitiesPhoto',
            											'foreignKey' => 'university_id'),
            				'CourseonUniversity'  => array('className' => 'CourseonUniversity',
            											'foreignKey' => 'university_id'),
            				'Faculty');
	//public $displayField = 'nazwa';

	public $filterArgs = array(
		        'keywords' => array(
				        'type' => 'like',
				        'encode' => true,
				        'before' => false,
				        'after' => false,
				        'field' => array('Course.nazwa', 'University.nazwa')
        ),
    );

	public function orConditions($data = array()) {
        $filter = $data['filter'];
        $condition = array(
            'OR' => array(
                $this->alias . '.nazwa LIKE' => '%' . $filter . '%',
                $this->alias . '.nazwa LIKE' => '%' . $filter . '%',
            )
        );
        return $condition;
    }

    public function saveFile($path, $university_id) {
    	//Debugger::dump($photo);
		$this->UniversitiesPhoto->create();
		if ($this->UniversitiesPhoto->save(
			    array('UniversitiesPhoto.typ' => "'logo'", 'UniversitiesPhoto.path' => "'".$path."'",'UniversitiesPhoto.university_id' => $university_id)
		)) Debugger::dump('aaa');
		else Debugger::dump($this->UniversitiesPhoto->validationErrors);Debugger::dump($this->UniversitiesPhoto->invalidFields());
		return true;
	}

	function szukajUczelniQuery($p) {
		global $db;
		
		$conds = array(
			"slowo"=>"CONCAT(University.nazwa,UniversitiesParameter.adres,UniversitiesParameter.opis,UniversitiesParameter.www,UniversitiesParameter.telefon,UniversitiesParameter.zakladka1,UniversitiesParameter.zakladka2,UniversitiesParameter.zakladka3,UniversitiesParameter.zakladka4,UniversitiesParameter.tagi) LIKE ",
			"jezyk"=>"Course.nazwa LIKE",
			"jezyk_id"=>"k.typ_uczelni = 3 AND uk.id_kierunek = ",
			"kierunek"=>"Course.nazwa LIKE",
			"kierunek_id"=>"CourseonUniversity.course_id = ",
			//"wydzial_id"=>"uk.id_wydzial= ",
			//"kierunek_kat"=>"k.id_kat = ",
			"id_wojewodztwo"=>"University.district_id = ",
			"miasto"=>"UniversitiesParameter.miasto = ",
			"id_typ"=>"CourseonUniversity.course_type_id",
			"id_tryb"=>"CourseonUniversity.course_mode_id",
			"rodzaj"=>"University.university_type_id",
			"id"=>"u.id = ",
			"ids"=>"u.id IN ",
		);
		$vq = $wq = array();
		foreach ($p as $par=>$val) {
			if (!empty($val)) {
				$wq[$conds[$par]] = $val;
			}
		}
		return $wq;
		//$vq= $this->find('all', array('conditions'=>$wq) );
		//public $components = array('Paginator');

		//$q = $this->sq($vq);
		//vdie($q);
		//vdie($q->faa(),$wq);
		$allc =  $this->find('count');
		
		$ids = array_keys($vq);
		$qc = count($ids);
		$r = array();
		
		/*if (isset($p['wydzial_id'])) {$fraza="AND uk.id_wydzial=".$p['wydzial_id']."";
		} else $fraza='';
		if ($qc > 0) {	
			$query = "
				SELECT u.id,uk.*, k.nazwa as 'nazwa_kierunku', w.nazwa as 'wydzial_nazwa'
				FROM uczelnie u 
				LEFT JOIN uczelnie_kierunki uk ON u.id = uk.id_uczelnia AND uk.id_jezyk = 1 
				LEFT JOIN kierunki k ON uk.id_kierunek = k.id AND k.id_jezyk = 1 
				LEFT JOIN wydzialy w ON uk.id_wydzial = w.id 
				WHERE u.id IN (".implode(',',$ids).") ".$fraza."
				ORDER BY w.nazwa, k.nazwa";
			$q = $db->q($query);
			$q = mergeUczelniaQueryHelp($q,$rows);
			foreach ($ids as $id) {
				$r[$id] = $q[$id];
			}
		}*/
		//vd($r,$c,$allc);
		//vdie($q);
		//$q = $db->q()->fk1vaa();
		if (isset($p['id']) && isset($r[$p['id']])) $r = $r[$p['id']];
		return array($r,$allc);
	}
		
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