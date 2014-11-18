<?php
App::uses('Controller', 'Controller');

class ProfessionsCoursesController extends AppController {	
	public $components = array('DataTable');
	
	public function index() {

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('ProfessionsCourse.placa' => 'desc'),
				'fields' => array('ProfessionsCourse.id','ProfessionsCourse.nazwa','ProfessionsCourse.placa'),
			);
			$this->DataTable->emptyElements = 1;
			$this->set('professions_courses', $this->DataTable->getResponse());
			$this->set('_serialize','professions_courses');
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$course = $this->ProfessionsCourse->findById($id);
		if (!$course) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('professions_course', $professions_course);
	}
	
	public function top() {
		$courses = $this->ProfessionsCourse->find('all', array(
															'order' => array('ProfessionsCourse.placa' => 'desc'),
															'limit' => 5));
		if (!empty($this -> request -> params['requested'])) {
		   return $courses;
		}else {
            $this->set('professions_course', $professions_course);
        }
	}
	public function srednia() {
		/*wartosci wspólczynników dla c-ceny, k-kierunków, u-uczelni*/
		$wc=3;
		$wk=5;
		$wu=4;
		$sum = $wc + $wk + $wu;
		$cities = $this->CourseonUniversity->find('all');	
		foreach ($cities as $courseonUniversity) {
			$srednias= ($courseonUniversity['CourseonUniversity']['cena']*$wc)+($courseonUniversity['Course']['srednia']*$wk)+($courseonUniversity['University']['srednia']*$wu);
		
			$srednia = $srednias/ $sum;
			$this->CourseonUniversity->updateAll( 
						array( 'CourseonUniversity.srednia' => $srednia), 
						array( 'CourseonUniversity.id' => $courseonUniversity['CourseonUniversity']['id']));
		}
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_lista($course_id = null) {
		$this->paginate = array(
            'limit' => 30,
            'order' => array('Profession.nazwa' => 'asc' ),
			'conditions' => array('ProfessionsCourse.course_id' => $course_id)
        );
        $exchanges = $this->paginate('ProfessionsCourse');
		$kurs = $this->ProfessionsCourse->findById($course_id);
		//Debugger::dump($kurs);
        $this->set('zawody', $exchanges);
		$this->set('kurs', $kurs['Course']);
	}
	
	public function admin_add_pc($course_id=null) {
		$ms = '';
        if ($this->request->is('post')) {
			foreach ($this->request->data['ProfessionsCourse']['profession_id'] as $zawod)  {
				Debugger::dump($zawod);
				$this->ProfessionsCourse->create();
				$data = array('course_id' => $course_id, 'profession_id' => $zawod);
				if ($this->ProfessionsCourse->save($data)) {
					$ms .= 'Utworzono kierunek ';
				} else {
					$ms .= 'Nie utworzono kierunku ';
				}   
			}
			$this->Session->setFlash(__($ms));
			$this->redirect(array('action' => 'lista', $course_id));
        }
		$this->set('courses', $this->ProfessionsCourse->Profession->find('list'));
    }
	
	public function admin_delete($id, $kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->ProfessionsCourse->delete($id)) {
            $this->Session->setFlash(__('Kierunek usunięty'));
            $this->redirect(array('action' => 'lista', $kierunek_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $kierunek_id));
    }
}