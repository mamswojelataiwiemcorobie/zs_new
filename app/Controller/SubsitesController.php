<?php
App::uses('AppController', 'Controller');

class SubsitesController extends AppController {
	public function info($tid) {
		$site = $this->Subsite->findById($tid);
		//Debugger::dump($site);
		$this->set('site', $site['Subsite']);
		$this->set('title_for_layout', $site['Subsite']['meta_title']);
		$this->set('description_for_layout', $site['Subsite']['meta_description']);
		$this->set('keywords_for_layout', $site['Subsite']['meta_keywords']);
	}

	/***ADMIN***/
	public function admin_index() {
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
            $this->paginate = array(
            	'limit' =>10,
                'conditions' => array(
                    'LOWER(Subsite.nazwa) LIKE' => "%$keywords%",
                )
            );
        } else { 
			$this->paginate = array(
				'limit' => 15,
				'order' => array('Subsite.tytul' => 'asc' ),
			);
		}
        $universities = $this->paginate('Subsite');
		//Debugger::dump($universities);
        $this->set('subsites', $universities);
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
	
	public function admin_edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }
			
            if ($this->request->is('post') || $this->request->is('put')) {
				//Debugger::dump($this->request->data);

                if ($this->Subsite->saveAssociated($this->request->data)) {
                    $this->Session->setFlash(__('Podstrona została uaktualniona'));
                    $this->redirect(array('action' => 'edit', $id));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            } 
           
            $subsite = $this->Subsite->findById($id);

			//Debugger::dump( $university);
            $this->request->data = $subsite;
            //Debugger::dump( $this->request->data);
    }
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
		
        if ($this->request->is('post')) {
			
			$this->Subsite->create();
            if ($this->Subsite->saveAssociated($this->request->data, array('validate' => 'only'))) {
                $this->Session->setFlash(__('Utworzono nową podstronę'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
		//$this->set('coursesTypes', $this->Course->CoursesType->find('list'));
    }
	
	public function admin_delete($kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->Subsite->deleteAll(array('Subsite.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Podstrona usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Podstrona nie mogła być usunięta'));
        $this->redirect(array('action' => 'index'));
    }
}
