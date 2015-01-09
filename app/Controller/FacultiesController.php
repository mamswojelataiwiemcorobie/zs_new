<?php
App::uses('Controller', 'Controller');

class FacultiesController extends AppController {	
	public function view($id, $nrzakladki=null) {
		$this->set('mapy', true);
		
		$university = $this->Faculty->find('first', array('conditions'=> array('Faculty.id'=>$id)));
		$university_id = $university['Faculty']['university_id'];
		$this->Faculty->CourseonUniversity->University->contain();
		$uczelnia = $this->Faculty->CourseonUniversity->University->find('first', array('conditions'=> array('University.id'=>$university_id)));
		//Debugger::dump($university);
		$zakladka_page = !empty($nrzakladki) ? (int)$nrzakladki : 0;
		$this->set('zakladka_page', $zakladka_page);
		
		$university['url'] = "/wydzial/". Inflector::slug($university['Faculty']['nazwa'],'-').'-'.  $university['Faculty']['id'];
		$base_url = substr($university['url'],0);
				
		$this->set('description_for_layout', 'Zostań studentem. Najlepsze szkoły wyższe.');
		$this->set('keywords_for_layout', 'uniwersytety, szkoły, ranking');
		
		if ($university['Faculty']['lokalizacja_x'] > 0 && $university['Faculty']['lokalizacja_y'] > 0) {
			$this->set('lokalizacja_poparawna',true);
		} else $this->set('lokalizacja_poparawna',false);

		$this->set('title_for_layout', $university['Faculty']['nazwa']);

		foreach ($university['CourseonUniversity'] as $kierunek) {
			$type= $kierunek['course_type_id'].$kierunek['course_mode_id'];
			$this->Faculty->CourseonUniversity->Course->id = $kierunek['course_id'];
			$nazwa_kierunku =  $this->Faculty->CourseonUniversity->Course->field('nazwa');
			$kierunki_full[$kierunek['course_id']]['nazwa'] = $nazwa_kierunku;

			$kierunki_full[$kierunek['course_id']][$type] = true;
			$kierunki_types[$type] = true;
		}
		$types = array('11','21','31','41','61','51','71','12','22','32','42','62','52','72','60','50','70');
		if (isset($kierunki_types)) {
			$ttypes = array();
			foreach ($types as $t) {
				if (isset($kierunki_types[$t])) $ttypes[] = $t;
			}
			$kierunki_types = $ttypes;
		}
		$this->set('kierunki_full', $kierunki_full);
		$this->set('kierunki_types', $kierunki_types);

		$this->Faculty->CourseonUniversity->Faculty->contain();
		$wydzialy = $this->Faculty->CourseonUniversity->Faculty->find('all', array('fields'=>array('Faculty.id', 'Faculty.nazwa', 'Faculty.university_id'),
																						'conditions'=>array('Faculty.university_id'=>$university_id)));
		$this->set('wydzialy', $wydzialy);
		$this->set('uczelnia', $uczelnia);

		$this->set('university', $university);
	}

	public function admin_add_faculties($university_id) {
    	if ($this->request->is('post')) {
			//Debugger::dump($this->request->data);	
			$faculty= $this->request->data['Faculty'];
			//$this->Faculty->create();
			if(!empty($faculty['nazwa'])) {
				$this->Faculty->create();
				if ($this->Faculty->save($faculty)) {
					$this->Session->setFlash(__('Wydział uczelni został utworzony'));
				} else {
					$this->Session->setFlash(__('Wydział nie mół zostać utworzony. Please, try again.'));
				}   
			} else $this->Session->setFlash(__('Wpisz nazwe wydziału'));
        }
    	$this->set('university', $university_id);
    }

    public function admin_lista($university_id = null) {
		if (!$university_id) {
			throw new NotFoundException(__('Invalid post'));
		}			
		$this->Faculty->contain();
		$wydzialy = $this->Faculty->find('all', array('order' => array('Faculty.nazwa'), 
												'conditions' => array('Faculty.university_id' => $university_id)));
		foreach ($wydzialy as $wydzial) {
			//$nazwy_kursow[$d['Course']['id']] = $d['Course']['nazwa'];
			$this->Faculty->CourseonUniversity->contain('Course');
			$kursy[$wydzial['Faculty']['id']] = $this->Faculty->CourseonUniversity->find('all', array('fields' => array('DISTINCT Course.nazwa'),
																		'conditions'=>array('CourseonUniversity.faculty_id'=>$wydzial['Faculty']['id'])));

			//$kursy[$d['CourseonUniversity']['faculty_id']][$d['CourseonUniversity']['course_id']][$d['CourseonUniversity']['course_type_id']][$d['CourseonUniversity']['course_mode_id']]= 1;
		}
		
		//Debugger::dump($kursy);
		if(isset($kursy))	$this->set('kursy', $kursy);

		$this->set('wydzialy', $wydzialy);
		//$this->set('nazwy_kursow', $nazwy_kursow);
		$this->set('university_id', $university_id);
	}

	public function admin_edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'lista', ));
            }
			$this->Faculty->contain();
            $wydzial = $this->Faculty->findById($id);
            $courses = $this->Faculty->CourseonUniversity->find('all', array('fields' => array('DISTINCT Course.nazwa', 'Course.id'),
																			'conditions'=>array('CourseonUniversity.faculty_id'=>$wydzial['Faculty']['id'])));

			//Debugger::dump($university);
			
            if ($this->request->is('post') || $this->request->is('put')) {
				
                if ($this->Faculty->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'edit', $id));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            } 
           
            $this->request->data = $wydzial;
            $this->set('courses', $courses);
            //Debugger::dump( $this->request->data);
    }

    public function admin_delete($id = null) {
    	if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->Faculty->deleteAll(array('Faculty.id' => $id), true)) {
            $this->Session->setFlash(__('Wydział usunięty'));
            $this->redirect(array('action' => 'edit', $id));
        }
        $this->Session->setFlash(__('Wydział nie mógł być usunięty'));
        $this->redirect(array('action' => 'edit', $id));
    }

    public function admin_delete_kurs($faculty_id, $course_id = null) {
    	if ($this->Faculty->CourseonUniversity->deleteAll(array('CourseonUniversity.faculty_id'=>$faculty_id, 'CourseonUniversity.course_id' => $course_id), false)) {
            $this->Session->setFlash(__('Kierunek wydziału usunięty'));
            $this->redirect(array('action' => 'edit', $faculty_id));
        }
        $this->Session->setFlash(__('Wydział nie mógł być usunięty'));
        $this->redirect(array('action' => 'edit', $faculty_id));
    }

    public function admin_add_courses($faculty_id) {
    	$this->Faculty->contain();
        $faculty = $this->Faculty->findById($faculty_id);

    	if ($this->request->is('post')) {
    		$kierunki = $this->request->data['CourseonUniversity']['course_id'];
			foreach ($kierunki as $kierunek) {
				$this->Faculty->CourseonUniversity->create();
				if ($this->Faculty->CourseonUniversity->save(array('CourseonUniversity'=> array('university_id' => $faculty['Faculty']['university_id'], 'faculty_id' => $faculty_id, 'course_id'=>$kierunek,
																'typ_course_id' => 0, 
												'tryb_course_id' => 0,
												)))) {
					$this->Session->setFlash(__('Kierunek uczelni został utworzony'));
					 $this->redirect(array('controller'=>'courseon_universities', 'action' => 'lista', $faculty['Faculty']['university_id']));
				} else {
					$this->Session->setFlash(__('The user could not be created. Please, try again.'));
				}   
			}
        } 
		
		$this->set('faculty', $faculty);
		$this->set('courses', $this->Faculty->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
    }
}
