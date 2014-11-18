<?php
App::uses('Controller', 'Controller');

class ProfessionsController extends AppController {	
	public $components = array('DataTable');
	
	public function index() {
		$this->set('title_for_layout', 'Ranking zawodów');
		$this->set('description_for_layout', 'Ranking zawodów. Najlepsze zawody na rynku.');
		$this->set('keywords_for_layout', 'zawody, praca, ranking');
		$this->set('tabele', true);

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('Profession.placa' => 'desc'),
				'fields' => array('Profession.id', 'Profession.nazwa','Profession.placa'),
			);
			$this->DataTable->emptyElements = 1;
			$this->set('professions', $this->DataTable->getResponse());
			$this->set('_serialize','professions');
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$profession = $this->Profession->findById($id);
		if (!$profession) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('profession', $profession);
		
		$this->set('title_for_layout', $profession['Profession']['nazwa']);
		$this->set('title_for_slider2', 'Ranking zawodów');
	}
	
	public function top() {
		$professions = $this->Profession->find('all', array(
															'order' => array('Profession.placa' => 'desc'),
															'limit' => 5));
		if (!empty($this -> request -> params['requested'])) {
		   return $professions;
		}else {
            $this->set('profession', $profession);
        }
	}
	
	/***ADMIN***/
	
	function admin_search() {
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
                'conditions' => array(
                    'LOWER(Profession.nazwa) LIKE' => "%$keywords%",
                )
			);
		} else { 
			$this->paginate = array(
				'limit' => 30,
				'order' => array('Profession.nazwa' => 'asc' ),
				'contain' => array('Profession')
			);
		}
        $courses = $this->paginate('Profession');
		//Debugger::dump($courses);
        $this->set('courses', $courses);
	}
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$this->Profession->create();
            if ($this->Profession->save($this->request->data)) {
                $this->Session->setFlash(__('Utworzono kierunek'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
    }
	
	public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$course = $this->Profession->findById($id);
		//Debugger::dump($course);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Profession->id = $id;
			if ($this->Profession->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $course;
		}
    }
	
	public function admin_delete($kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->Profession->deleteAll(array('Profession.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Kierunek usunięty'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
}