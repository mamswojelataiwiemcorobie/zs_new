<?php
App::uses('AppController', 'Controller');

class StoragesController extends AppController {

    public function index() {
        //$articles = $this->Storage->find('all');
        $this->Paginator->settings = array(
            'limit' => 5
        );

        $articles =  $this->Paginator->paginate();
        $id = $this->Auth->user('id');
        $schowek = $this->Storage->find('all', array('conditions' => array('client_id' => $id)));
        Debugger::dump($schowek);
        $this->set('articles', $articles);
        $this->set('title_for_layout', 'Schowek');
        $this->set('description_for_layout', 'Ciekawe artykuły i wiadomości na temat studiów, życia studenckiego');
        $this->set('keywords_for_layout', 'wiadomości , artykuły , studia, w, anglii');
    }

	public function view($tid) {
		$article = $this->Storage->findById($tid);
		//Debugger::dump($site);
		$this->set('article', $article['Storage']);
		$this->set('title_for_layout', $article['Storage']['meta_title']);
		$this->set('description_for_layout', $article['Storage']['meta_description']);
		$this->set('keywords_for_layout', $article['Storage']['meta_keywords']);
	}

    function ajax($tid) {
        $tid = $this->request->pass[0];
        $r = array();
        switch ($tid) {
            case "5":
                $id = $_POST['id'];
                list($u) = szukajUczelniQuery(array("id"=>$id));
                if (!empty($u)) {
                    dodajDoSchowkaQuery($id);
                    $r[] = array(
                        "id"=>$u['id'],
                        "link"=>$u['url'],
                        "name"=>$u['nazwa'],
                        "image"=>$u['logo']?'/miniatura/160x125/uploads/'.$u['logo']:false,
                    );
                }
                break;
            case "6":
                $s = wczytajSchowekQuery();
                $tr = array();
                foreach ($s as $ts) {
                    $tr[] = array(
                        "id"=>$ts['id'],
                        "link"=>$ts['url'],
                        "name"=>$ts['nazwa'],
                        "image"=>$ts['logo']?'/miniatura/160x125/uploads/'.$ts['logo']:false,
                    );
                }
                $r[] = array(
                    "schowek"=>$tr,
                );
                break;
            case "7":
                usunZeSchowkaQuery($_POST['id']);
                break;
        }
        
        $this->output_json($r);
    }

	/***ADMIN***/
	public function admin_index() {
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
            $this->paginate = array(
            	'limit' =>10,
                'conditions' => array(
                    'LOWER(Storage.tytul) LIKE' => "%$keywords%",
                )
            );
        } else { 
			$this->paginate = array(
				'limit' => 15,
				'order' => array('Storage.created' => 'asc' ),
			);
		}
        $universities = $this->paginate('Storage');
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

            if ($this->Storage->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('Podstrona została uaktualniona'));
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->setFlash(__('Unable to update your user.'));
            }
        } 
       
        $subsite = $this->Storage->findById($id);

		//Debugger::dump( $university);
        $this->request->data = $subsite;
        //Debugger::dump( $this->request->data);
    }
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
		
        if ($this->request->is('post')) {
			
			$this->Storage->create();
            if ($this->Storage->saveAssociated($this->request->data, array('validate' => 'only'))) {
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

        if ($this->Storage->deleteAll(array('Storage.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Podstrona usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Podstrona nie mogła być usunięta'));
        $this->redirect(array('action' => 'index'));
    }
}
