<?php
App::uses('Controller', 'Controller');

class CoursesCategoriesController extends AppController {	
	
	
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
		$conditions =array();
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
			$conditions[] = array('OR' => array(
                					'CoursesCategory.id' => $keywords,
                	               'LOWER(CoursesCategory.nazwa) LIKE' => "%$keywords%",
                	));
        }  
		$this->paginate = array(
            'limit' => 20,
            'conditions' => $conditions,
            'order' => array('nazwa' => 'asc' )
	        );
	    
        $courses = $this->paginate('CoursesCategory');
		//Debugger::dump($courses);
        $this->set('courses', $courses);
	}
	
	public function admin_add() {
        if ($this->request->is('post')) {
			$this->CoursesCategory->create();
            if ($this->CoursesCategory->save($this->request->data)) {
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
		$this->CoursesCategory->contain();
		$course = $this->CoursesCategory->findById($id);
		//Debugger::dump($course);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->CoursesCategory->id = $id;
			if ($this->CoursesCategory->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'index'));
			} else {
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

        if ($this->CoursesCategory->deleteAll(array('CoursesCategory.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Kierunek usunięty'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
}