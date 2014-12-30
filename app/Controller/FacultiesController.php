<?php
App::uses('Controller', 'Controller');

class FacultiesController extends AppController {	
	public function admin_add_faculties($university_id) {
    	if ($this->request->is('post')) {
			//Debugger::dump($this->request->data);	
			$faculty= $this->request->data['Faculty'];
			//$this->University->create();
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

        if ($this->University->deleteAll(array('Faculty.id' => $id), true)) {
            $this->Session->setFlash(__('Wydział usunięty'));
            $this->redirect(array('action' => 'lista'));
        }
        $this->Session->setFlash(__('Wydział nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista'));
    }

    public function admin_delete_kurs($course_id = null) {

    }

    public function admin_add_course($course_id = null) {

    }
}
