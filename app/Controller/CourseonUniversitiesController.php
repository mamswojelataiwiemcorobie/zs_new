<?php
App::uses('Controller', 'Controller');

class CourseonUniversitiesController extends AppController {	
	public $components = array('DataTable');

	public function index() {
		$this->set('title_for_layout', 'Ranking kierunków na poszczególnych uniwersytetach');
		$this->set('description_for_layout', 'Ranking kierunków na poszczególnych uniwersytetach.');
		$this->set('keywords_for_layout', 'kierunki na uczelniach, ranking');
		$this->set('tabele', true);

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('CourseonUniversity.srednia' => 'desc'),
				'contain' => array('University.nazwa', 'Course.nazwa', 'TypCourse', 'TrybCourse'),
				'fields' => array('University.nazwa','Course.nazwa','CourseonUniversity.cena','TypCourse.nazwa','TrybCourse.nazwa', 'CourseonUniversity.srednia','CourseonUniversity.id' ),
			);
			$this->DataTable->emptyElements = 1;
			$this->set('courses', $this->DataTable->getResponse());
			$this->set('_serialize','courses');
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$courseonuniversity = $this->CourseonUniversity->findById($id);
		if (!$courseonuniversity) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('courseonuniversity', $courseonuniversity);

		$this->set('title_for_slider2', 'Ranking kierunków na poszczególnych uniwersytetach');
	}

	public function srednia() {
		/*wartosci wspólczynników dla c-ceny, k-kierunków, u-uczelni*/
		$wc=3;
		$wk=5;
		$wu=4;
		$sum = $wc + $wk + $wu;
		$cities = $this->CourseonUniversity->find('all');	
		foreach ($cities as $courseonUniversity) {
			$srednias2= ($courseonUniversity['Course']['srednia']*$wk)+($courseonUniversity['University']['srednia']*$wu);
			if ($courseonUniversity['CourseonUniversity']['cena'] != 0){
				$srednias = ((1/$courseonUniversity['CourseonUniversity']['cena'])*$wc)+$srednias2;
			}
		
			$srednia = $srednias/ $sum;
			$this->CourseonUniversity->id = $courseonUniversity['CourseonUniversity']['id'];
			$this->CourseonUniversity->saveField('CourseonUniversity.srednia', $srednia);
		}
		$this->redirect(array('action' => 'index'));
	}
	public function rank_old() {
		$x = $this->CourseonUniversity->find('all',array ('fields' => array('CourseonUniversity.id', 'CourseonUniversity.srednia'),'order' => array('CourseonUniversity.srednia' => 'desc')));
		$i=0;
		foreach ($x as $CourseonUniversity) {
			echo $i=$i + 1;
			echo $CourseonUniversity['CourseonUniversity']['id'];
			echo $CourseonUniversity['CourseonUniversity']['srednia'].'<br>';
			$this->CourseonUniversity->updateAll( 
						array( 'CourseonUniversity.rank' => $i), 
						array( 'CourseonUniversity.id' => $CourseonUniversity['CourseonUniversity']['id']));
		}
	}
	public function zapis() {
		# Open the File.
		if (($handle = fopen("oplaty.csv", "r")) !== FALSE) {
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
		
		foreach ($csvarray as $course) {
			$id = $course[0];
			if (!empty($course[0])) {
				$this->CourseonUniversity->contain();
				$c = $this->CourseonUniversity->findAllByUniversityId($course[0]);
				/*echo '<pre>';
		print_r($c);
		echo "</pre>";*/
				foreach ($c as $c2) {		
					if (!empty($course[1]) && $c2['CourseonUniversity']['typ_course_id'] == 1 or $c2['CourseonUniversity']['typ_course_id'] == 2 && $c2['CourseonUniversity']['tryb_course_id'] == 1) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[1]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[2]) && $c2['CourseonUniversity']['typ_course_id'] == 3 && $c2['CourseonUniversity']['tryb_course_id'] == 1) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[2]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[3]) && $c2['CourseonUniversity']['typ_course_id'] == 1 or $c2['CourseonUniversity']['typ_course_id'] == 2 && $c2['CourseonUniversity']['tryb_course_id'] == 2) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[3]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[4]) && $c2['CourseonUniversity']['typ_course_id'] == 3 && $c2['CourseonUniversity']['tryb_course_id'] == 2) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[4]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					}
				}
			}
		}
		/*echo '<pre>';
		print_r($c2['typ_course_id']);
		echo "</pre>";*/
		
	}

	public function kierunki_naukraine() {
		$this->CourseonUniversity->contain('University.university_type_id');
		$courses = $this->CourseonUniversity->find('all', array('conditions'=>array('University.university_type_id'=>1), 'fields'=>array('university_id', 'faculty_id', 'course_id','course_type_id','course_mode_id'), 'order'=>array('University.id'=>'asc'), 'limit'=>11786/2));
		Debugger::dump($courses);
	}
	
	public function pokaz() {
		$this->CourseonUniversity->contain('University');
		$var = $this->CourseonUniversity->find('all');	
		foreach ($var as $v) {
			if ($v['University']['id'] == null) {
				$this->CourseonUniversity->delete($v['CourseonUniversity']['id'], false);
			 			Debugger::dump($v);
			}
		}
	}
	
	/***ADMIN***/
	public function admin_lista($university_id = null) {
		if (!$university_id) {
			throw new NotFoundException(__('Invalid post'));
		}			
		$this->CourseonUniversity->contain('Course');
		$db = $this->CourseonUniversity->find('all', array(
			'order' => array('Course.nazwa', 'CourseonUniversity.faculty_id'), 
			'conditions' => array('CourseonUniversity.university_id' => $university_id)));
		$this->CourseonUniversity->University->Faculty->contain();
		$wydzialy = $this->CourseonUniversity->University->Faculty->find('all', array('fields'=>array('id', 'nazwa'),
																						'conditions'=>array('Faculty.university_id'=>$university_id)));
		$wydzialy = Hash::combine($wydzialy, '{n}.Faculty.id', '{n}.Faculty.nazwa');
		//$kursy_nazwy = $this->CourseonUniversity->Course->find('all', array('conditions'=>array('university_id'=>$university_id)));
		foreach ($db as $d) {
			$nazwy_kursow[$d['Course']['id']] = $d['Course']['nazwa'];
			
			$kursy[$d['CourseonUniversity']['faculty_id']][$d['Course']['id']][$d['CourseonUniversity']['course_type_id']][$d['CourseonUniversity']['course_mode_id']]= 1;
		}
		
		if (!empty($kursy)) {		
			$this->set('kursy', $kursy);
			$this->set('wydzialy', $wydzialy);
			$this->set('nazwy_kursow', $nazwy_kursow);
		}
		$this->CourseonUniversity->University->contain();
		$university = $this->CourseonUniversity->University->findById($university_id);
		//Debugger::dump($kursy[0]);
		$this->set('university', $university);
	}
	
	public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$this->CourseonUniversity->contain('Course.id', 'Course.nazwa', 'University.id', 'University.nazwa');
		$courseonuniversity = $this->CourseonUniversity->findById($id);
		//Debugger::dump($courseonuniversity);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->CourseonUniversity->id = $id;
			if ($this->CourseonUniversity->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'lista', $courseonuniversity['CourseonUniversity']['university_id']));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $courseonuniversity;
		}
		$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
		$this->set('typCourses', $this->CourseonUniversity->TypCourse->find('list'));
		$this->set('trybCourses', $this->CourseonUniversity->TrybCourse->find('list'));
    }
	
	public function admin_update() {
		$faculties = $this->request->data['Faculties'];
		$university_id = $this->request->data['CourseonUniversity']['university_id'];
		//Debugger::dump($this->request->data['Faculties']);
		$alldata =array();
		//Debugger::dump($faculties);
		foreach ($faculties as $faculty_id => $faculty) {
			//Debugger::dump($faculty_id);
			foreach ($faculty as $course_id => $course) {
				foreach ($course as $course_type_id => $course_modes) {
					foreach($course_modes as $course_mode_id => $reszta) {
					
						$this->CourseonUniversity->deleteAll(array('CourseonUniversity.university_id' =>$university_id, 'faculty_id' => $faculty_id), false);
						
						if ($reszta != 0) {
							//$this->CourseonUniversity->create();
							$data[] = array('CourseonUniversity'=> array('university_id'=>$university_id,
																		'faculty_id' => $faculty_id,
																		'course_id' => $course_id,
																		'course_type_id' => $course_type_id,
																		'course_mode_id' => $course_mode_id));
							//$alldata = array_merge($alldata, $data);
						}
					}
				}
			}
		}	
		//Debugger::dump($data);
		if($this->CourseonUniversity->saveMany($data)) {
				$this->Session->setFlash(__('Kierunek uczelni zaktualizowany'));
		} else {
				$this->Session->setFlash(__('NIe można zaktualizować kierunku'));
		} //$this->CourseonUniversity->clear();
		//Debugger::dump($course);
		$this->redirect(array('action' => 'lista', $university_id));
    }
	

	public function admin_delete_faculty($faculty_id, $uni_id = null) {
         
         if (!$faculty_id) {
            $this->Session->setFlash('Proszę podać numer wydziału');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->CourseonUniversity->deleteAll(array('CourseonUniversity.university_id' => $uni_id, 'CourseonUniversity.faculty_id' => $faculty_id))) {
            $this->Session->setFlash(__('Wydział na uczelni usunięty'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	
	public function admin_delete_course($course_id, $uni_id = null, $faculty_id=null) {
         
        if (!$course_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }
         if (!$faculty_id) {
            $faculty_id = 0;
        }

        if ($this->CourseonUniversity->deleteAll(array('CourseonUniversity.university_id' => $uni_id, 'CourseonUniversity.faculty_id' => $faculty_id, 'CourseonUniversity.course_id' => $course_id))) {
            $this->Session->setFlash(__('Kierunek na uczelni usunięty'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	
	public function admin_add($university_id, $count=false) {
		if (isset($count)) {
			$this->set('count',$count);
		}
        if ($this->request->is('post')) {
			$this->CourseonUniversity->create();
            if ($this->CourseonUniversity->saveMany($this->request->data)) {
                $this->Session->setFlash(__('Kierunek uczelni został utworzony'));
                $this->redirect(array('action' => 'lista', $university_id));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        } 
		
			$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
			$this->set('typCourses', $this->CourseonUniversity->TypCourse->find('list'));
			$this->set('trybCourses', $this->CourseonUniversity->TrybCourse->find('list'));
			$this->set('university', $university_id);
		
    }


    /*Funkcja dodaje kierunki do uczelni*/
    public function admin_addm($university_id) {
        if ($this->request->is('post')) {
			$university_id = $this->request->data['CourseonUniversity']['university_id'];

			$kierunki = $this->request->data['CourseonUniversity']['course_id'];
			$nazwy = '';
			foreach ($kierunki as $kierunek) {
				$this->CourseonUniversity->create();
				if (!isset($this->request->data['CourseonUniversity']['faculty_id'])) $this->request->data['CourseonUniversity']['faculty_id'] = 0;
				if ($this->CourseonUniversity->save(array('CourseonUniversity'=> array(
																					'university_id' => $university_id, 
																					'faculty_id'=> $this->request->data['CourseonUniversity']['faculty_id'], 
																					'course_id'=>$kierunek,
																					'typ_course_id' => 0, 
																					'tryb_course_id' => 0,
												)))) {
					$nazwa = $this->CourseonUniversity->Course->find('first', array('conditions'=>array('Course.id'=>$kierunek)));
					$nazwy .= ', '. $nazwa['Course']['nazwa'];
					$this->Session->setFlash(__('Kierunek uczelni został utworzony'));
				} else {
					$this->Session->setFlash(__('The user could not be created. Please, try again.'));
				}  
				$this->CourseonUniversity->University->id = $university_id;
				$this->CourseonUniversity->University->savefield('all_courses', $nazwy);
			}
			$this->redirect(array('action' => 'lista', $university_id));
        } 
		
			$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
			$this->set('faculties', $this->CourseonUniversity->University->Faculty->find('list', array('fields'=>array('id', 'nazwa'),
																						'conditions'=>array('Faculty.university_id'=>$university_id))));
			$this->set('university', $university_id);
		
    }
}