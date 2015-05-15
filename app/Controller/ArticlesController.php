<?php
App::uses('AppController', 'Controller');

class ArticlesController extends AppController {

    public function index() {
        //$articles = $this->Article->find('all');
        $this->Paginator->settings = array(
            'order' => array('Article.created'=> 'desc' ),
            'limit' => 5
        );

        $articles =  $this->Paginator->paginate();

        //Debugger::dump($articles);
        $this->set('articles', $articles);
        $this->set('title_for_layout', 'Artykuły');
        $this->set('description_for_layout', 'Ciekawe artykuły i wiadomości na temat studiów, życia studenckiego');
        $this->set('keywords_for_layout', 'wiadomości, artykuły, studia, wydarzenia, kierunki');
    }

	public function view($tid) {
		$article = $this->Article->findById($tid);
		//Debugger::dump($site);
		$this->set('article', $article['Article']);
		$this->set('title_for_layout', $article['Article']['meta_title']);
		$this->set('description_for_layout', $article['Article']['meta_description']);
		$this->set('keywords_for_layout', $article['Article']['meta_keywords']);
	}

	/***ADMIN***/
	public function admin_index() {
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
            $this->paginate = array(
            	'limit' =>10,
                'conditions' => array(
                    'LOWER(Article.tytul) LIKE' => "%$keywords%",
                )
            );
        } else { 
			$this->paginate = array(
				'limit' => 15,
				'order' => array('Article.created' => 'desc' ),
			);
		}
        $universities = $this->paginate('Article');
		//Debugger::dump($universities);
        $this->set('articles', $universities);
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

            if ($this->Article->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('Artykuł został zaktualizowany.'));
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->setFlash(__('Unable to update your user.'));
            }
        } 
       
        $subsite = $this->Article->findById($id);

		//Debugger::dump( $university);
        $this->request->data = $subsite;
        //Debugger::dump( $this->request->data);
    }
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
		
        if ($this->request->is('post')) {
			
			$this->Article->create();
            if ($this->Article->saveAssociated($this->request->data, array('validate' => 'only'))) {
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

        if ($this->Article->deleteAll(array('Article.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Podstrona usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Podstrona nie mogła być usunięta'));
        $this->redirect(array('action' => 'index'));
    }
}
