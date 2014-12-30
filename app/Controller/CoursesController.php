<?php
App::uses('Controller', 'Controller');

class CoursesController extends AppController {	
	public $components = array('DataTable');
	
	public function index() {

		$this->set('title_for_layout', 'Kierunki studiów | Zostań Studentem');
		$this->set('description_for_layout', 'Wybierz kierunek studiów który najbardziej Cię interesuje. Nowe kierunki humanistyczne, artystyczne, ekonomiczne, techniczne, przyrodnicze');
		$this->set('keywords_for_layout', 'kierunki, studia, studiów');
		$this->set('title_for_slider2','Kierunki');

		$tid = $this->request->pass[0];
		$this->set('tid', $tid);
		
		$this->Course->CoursesCategory->contain();
		$kategorie = $this->Course->CoursesCategory->find('all');
		$this->set('kategorie',$kategorie);
		if ($tid) {
			$kierunki = $this->Course->find('all', array('conditions' => array('Course.courses_category_id' => $tid, 'Course.university_type_id' => 1)));
			$this->set('kategoria_set',1);
			$this->set('kierunki',$kierunki);
			$this->set('kategoria',$kategorie[$tid-1]);
		} else {
			$this->set('kategoria_set',0);
		}
	}
	
	public function view($id = null, $page = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$this->Course->CoursesCategory->contain();
		$kategorie = $this->Course->CoursesCategory->find('all');
		$this->set('kategorie',$kategorie);

		$this->Course->contain('CoursesCategory');
		$kierunek = $this->Course->find('first', array('conditions'=> array('Course.id'=> $id)));

		$this->set('title_for_layout', 'Kierunek '.$kierunek['Course']['nazwa'].' | Zostań Studentem');
		$this->set('description_for_layout', substr(html_entity_decode(strip_tags($kierunek['Course']['opis1']),ENT_COMPAT,'UTF-8'),0,160));
		$this->set('keywords_for_layout', $kierunek['Course']['nazwa'].' , kierunek , studia');
		$this->set('title_for_slider2',$kierunek['Course']['nazwa']);
		
		$this->set('kierunek',$kierunek);

		$this->Paginator->settings = array(
					'Course' => array(
						//'order' => array('University.abonament'=> 'desc', 'University.nazwa' => 'asc' ),				 
						'limit' => 5,
						'recursive' => -1,
						'fields' => array('DISTINCT CourseonUniversity.university_id'),
						'conditions' => array('Course.id'=>$id, 'University.abonament >' => 1),
						'order' => array('University.id', 'University.nazwa'),
						'joins' => array(
					        array(
					            'alias' => 'CourseonUniversity',
					            'table' => 'courseon_universities',
					            'type' => 'LEFT',
					            'conditions' => '`Course`.`id` = `CourseonUniversity`.`course_id`'
					        ), 
					         array(
					            'alias' => 'University',
					            'table' => 'universities',
					            'type' => 'LEFT',
					            'conditions' => '`CourseonUniversity`.`university_id` = `University`.`id`'
					        ), 
					    ),
					)
				);
		$uczelnie =  $this->Paginator->paginate();
		//Debugger::dump($uczelnie);

		if (count($uczelnie) > 0) {
			$uczelnie_promo = array();
			foreach ($uczelnie as $key => $uczelnia) {
				$this->Course->CourseonUniversity->University->contain('UniversitiesParameter.www', 'UniversitiesParameter.adres', 'UniversitiesParameter.email', 'UniversitiesParameter.telefon', 'UniversitiesParameter.opis', 'UniversityType', 'UniversitiesPhoto');
						
				$uczelnia_c = $this->Course->CourseonUniversity->University->find('first', array('conditions' => array('University.id'=> $uczelnia['CourseonUniversity']['university_id'], 
																														'University.abonament >' => '1')));
				if($uczelnia_c) {
					foreach ($uczelnia_c['UniversitiesPhoto'] as $photo) {
						if($photo['typ']=='logo') {
							$uczelnia_c['logo'] = $photo['path'];
						} 
					}
					
					$uczelnie_promo[] = $uczelnia_c;
				}
			}
			if (count($uczelnie_promo) > 0) {
				$this->set('uczelnie_wyniki',$uczelnie_promo);
			} else {
				$this->set('uczelnie_wyniki_brak',1);
			}
		} else {
				$this->set('uczelnie_nosearch',1);
			}
		/*
		$this->av('uczelnie_searchurl',$this->wyszukiwarka_cleanurl());*/
	}
	
	public function topKierunki() {
		$courses = Cache::read('top_courses', 'long');
        if (!$courses) {
            $courses = $this->Course-> query("SELECT DISTINCT uk.course_id, COUNT(*) FROM universities u LEFT JOIN courseon_universities uk ON uk.university_id = u.id WHERE u.university_type_id = 1 GROUP BY uk.course_id ORDER BY 2 DESC LIMIT 0,15");
            Cache::write('top_courses', $courses, 'long');
        }

		$kierunki = array();
		$i=0;
		foreach ($courses as $kierunek) {
			$this->Course->contain();
			$course = $this->Course-> findById($kierunek['uk']['course_id']);
			$kierunki[$i]['id'] = $course['Course']['id'];
			$kierunki[$i]['nazwa'] = $course['Course']['nazwa'];
			$i++;
		}
		if (!empty($this -> request -> params['requested'])) {
		   return $kierunki;
		} else {
			$this->set('kierunki', $kierunki);
		}
	}

	public function losowyKierunek() {
		$this->Course->contain();
		$losowe = $this->Course->find('all', array('conditions' => array('Course.opis1 !='=> ''), 
													'order'=>'rand()',
             										'limit' => 3,));
		if (!empty($this -> request -> params['requested'])) {
		   return $losowe;
		} else {
			$this->set('losowe', $losowe);
		}
	}
	
	public function srednia() {
		/*wartosci wspólczynników wp-placa*/
		$wp=5;
		$sum = $wp;
		$courses = $this->Course->find('all');	
		foreach ($courses as $course) {
			unset($c);
			$c=array();
			$srednias=0;
			foreach ($course['Profession'] as $profession) array_push($c,$profession['placa']);
			if (count($c)>0) {
				$srednias= array_sum($c)/count(array_filter($c));
				$sr=$srednias*$wp;
				$srednia= $sr/ $sum;
				$this->Course->updateAll(array('Course.srednia'=>$srednia), array('Course.id'=> $course['Course']['id']));
			}
		}
		$this->redirect(array('controller' => 'courses','action' => 'index'));
	}
	public function rank_old() {
		
		$cities = $this->Course->find('all',array ('fields' => array('Course.nazwa', 'Course.srednia'),'order' => array('Course.srednia' => 'desc')));
		$i=0;
		foreach ($cities as $city) {
			echo $i=$i + 1;
			echo $city['Course']['nazwa'];
			echo $city['Course']['srednia'].'<br>';
			$this->Course->updateAll( 
						array( 'Course.rank' => $i), 
						array( 'Course.id' => $city['Course']['id']));
		}
	}
	
	public function zapis() {
		# Open the File.
		if (($handle = fopen("k.csv", "r")) !== FALSE) {
			# Set the parent multidimensional array key to 0.
			$nn = 0;
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				# Count the total keys in the row.
				$c = count($data);
				# Populate the multidimensional array.
				for ($x=0;$x<$c;$x++)
				{
					$csvarray[$nn][$x] = $data[$x];
				}
				$nn++;
			}
			# Close the File.
			fclose($handle);
		}
		Debugger::dump($csvarray);


		foreach ($csvarray as $uni) {
			$this->Course->contain();
			$c = $this->Course->find('all');
			foreach ($c as $c2) {		
				if ($c2['Course']['id'] == $uni[2]) {
					//Debugger::dump($c2);
					$this->Course->id = $c2['Course']['id'];
					$data = array('opis' => $uni[6]);
					$this->Course->save($data);
					Debugger::dump($data);
					//$this->University->updateAll(	array('University.kategoria' => $uni[2]),  									array('University.id' => $c2['University']['id']));
				}
			}
		}
	}
	public function sredniacourses() {
		echo '<br><br><br><br><br><br><br><br>';
		$this->ProfessionsCourse = ClassRegistry::init('ProfessionsCourse');
		//$prof_ids = $this->ProfessionsCourse->find('list',array('fields'=>array('ProfessionsCourse.profession_id')));
		//pr($prof_ids);

		$list_ids = $this->Course->find('list', array ('order' => array('id' => 'ASC'), 'fields'=>array('Course.id')));
		
		$course_min = $this->Course->find('first' ,array ('fields' => array('MIN(Course.placa) as min_size'  )));//minimalna średnia płaca po kierunku
		$course_max = $this->Course->find('first' ,array ('fields' => array('MAX(Course.placa) as max_size'  )));//maksymalna średnia płaca po kierunku

		$MAX_il_prof = 0;
		foreach ($list_ids as $courses_id) {
			$il_prof = $this->ProfessionsCourse->find('count', array (
											'order' => array('ProfessionsCourse.course_id' => 'ASC'),
											'conditions' => array('ProfessionsCourse.course_id' => $courses_id), 
											'fields'=>array('ProfessionsCourse.profession_id')));
			if ($il_prof > $MAX_il_prof){
				$MAX_il_prof = $il_prof;//max ilość zawodów po kierunku
			}
		}
		echo '<br> maX:'.$MAX_il_prof.' : Max<br>'; 

		foreach ($list_ids as $courses_id) {

			echo '<br>'.$courses_id.' :: ';

			$il_prof = $this->ProfessionsCourse->find('count', array (
											'order' => array('ProfessionsCourse.course_id' => 'ASC'),
											'conditions' => array('ProfessionsCourse.course_id' => $courses_id), 
											'fields'=>array('ProfessionsCourse.profession_id')));
			//pr($prof_ids);
			echo ' | ';

			$course_czesne = $this->Course->find('first', array ('conditions' => array('Course.id' => $courses_id)));
			echo $course_czesne = $course_czesne['Course']['placa'].' | ';

			if ( (($course_max - $course_min) == 0) && (($MAX_il_prof) == 0)) {
				$srednia_kierunku = 0;
			}else{
				 $srednia_pensji_zawodow = (($course_czesne - $course_min) / ($course_max - $course_min)) * 10 ;
				
				echo $srednia_il_kierunków = ((($il_prof) / ($MAX_il_prof)) * 10 ) ;
				echo $waga_pensji_zawodow = 1;
				echo $waga_il_kierunków = 1;
				
				echo $srednia_kierunku = (( ($srednia_pensji_zawodow * $waga_pensji_zawodow) + ($srednia_il_kierunków * $waga_il_kierunków) )/($waga_pensji_zawodow + $waga_il_kierunków));
				echo ' ||';
			}

			$this->Course->id = $courses_id;
			$this->Course->saveField('srednia', $srednia_kierunku );

		}

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->Course->find('list', array (
										'fields' => array('Course.id','Course.srednia'),
										'order' => array('Course.srednia' => 'desc')));
		$i=0;
		//pr($PartArray);

		foreach ($PartArray as $id => $sr) {
			$i = $i + 1;
			echo $i . '<br>';
			$this->Course ->id = $id;
			$this->Course ->saveField('rank', $i);
		} 
	}
	
	public function rank() {
		$Model = 'Course';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->$Model->find('list', array (
										'fields' => array($Model.'.id',$Model.'.srednia'),
										'order' => array($Model.'.srednia' => 'desc')));
		$i=0;
		//pr($PartArray);

		foreach ($PartArray as $id => $sr) {
			echo $i = $i + 1;
			echo $i . '<br>';
			$this->$Model ->id = $id;
			$this->$Model ->saveField('rank', $i);
		}    
	}
	public function prof_placa_check(){
		$this->Profession = ClassRegistry::init('Profession');
			$placa_prof = $this->Profession->find('list', array('fields'=>array('Profession.placa', 'Profession.nazwa')));
			pr($placa_prof);
			$placa_Course = $this->Course->find('list', array('fields'=>array('Course.placa', 'Course.zawod')));
			pr($placa_Course);

			$this-> set ('placa_prof', $placa_prof);
			$this-> set ('placa_Course', $placa_Course);
	}


	public function admin_search() {
        // the page we will redirect to
        $url['action'] = 'index';
         
        // build a URL will all the search elements in it
        // the resulting URL will be
        // example.com/cake/posts/index/Search.keywords:mykeyword/Search.tag_id:3
        foreach ($this->data as $k=>$v){
            foreach ($v as $kk=>$vv){
                $url[$k.'.'.$kk]=$vv;
            }
        }
 
        // redirect the user to the url
        $this->redirect($url, null, true);
    }
	
	public function admin_index() {
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
            $this->paginate = array(
            	'limit' =>10,
                'conditions' => array(
                    'LOWER(Course.nazwa) LIKE' => "%$keywords%",
                )
            );
        } else { $this->paginate = array(
            'limit' => 20,
            'order' => array('Course.nazwa' => 'asc' ),
			'contain' => array('CoursesCategory', 'UniversityType')
	        );
	    }
        $courses = $this->paginate('Course');
		//Debugger::dump($courses);
        $this->set('courses', $courses);
	}
	
	public function admin_add() {
		Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('Utworzono kierunek'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
		$this->set('courses_categories', $this->Course->CoursesCategory->find('list'));
    }
	
	public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$this->Course->contain();
		$course = $this->Course->findById($id);
		//Debugger::dump($course);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Course->id = $id;
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $course;
		}
		
		$this->set('coursesCategories', $this->Course->CoursesCategory->find('list'));
		$this->set('universityTypes', $this->Course->UniversityType->find('list'));
    }
	
	public function admin_delete($kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->Course->deleteAll(array('Course.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Kierunek usunięty'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
}