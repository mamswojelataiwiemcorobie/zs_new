<?php
App::uses('AppController', 'Controller');

class StoragesController extends AppController {

     public function isAuthorized($user) {
        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete', 'view'))) {
            if ($this->Storage->findByClientId($user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

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
                $tr = array();
                $id = $_POST['id'];
                $this->Storage->University->contain();
                $u = $this->Storage->University->find('first', array('conditions' => array('University.id' => $id)));
                if (!empty($u)) {
                    $user = $this->Auth->user();
                    $check = $this->Storage->find('first', array('conditions' => array('Storage.client_id' => $user['id'], 'Storage.university_id' => $id)));
                    if(empty($check)) { 
                        $this->Storage->dodajDoSchowkaQuery($id);
                        $photo = $this->Storage->University->UniversitiesPhoto->find('first', array(
                                                                                            'conditions' => array('UniversitiesPhoto.typ' => 'logo', 'UniversitiesPhoto.university_id' => $id)));
                        $tr[] = array(
                            "id"=>$u['University']['id'],
                            "link"=>"/uczelnia/". Inflector::slug($u['University']['nazwa'],'-').'-'.  $id,
                            "name"=>$u['University']['nazwa'],
                            "image"=>$photo['UniversitiesPhoto']['path']?'/miniatura/160x125/uploads/'.$photo['UniversitiesPhoto']['path']:false,
                        );
                    } 
                }
                 $r[] = array(
                    "schowek"=>$tr,
                );
                break;
            case "6":
                $s = $this->Storage->wczytajSchowekQuery();
                $tr = array();
                foreach ($s as $ts) {
                    $photo = $this->Storage->University->UniversitiesPhoto->find('first', array(
                                                                                        'conditions' => array('UniversitiesPhoto.typ' => 'logo', 'UniversitiesPhoto.university_id' => $ts['University']['id'])));
                    $tr[] = array(
                        "id"=>$ts['University']['id'],
                        "link"=>"/uczelnia/". Inflector::slug($ts['University']['nazwa'],'-').'-'.  $ts['University']['id'],
                        "name"=>$ts['University']['nazwa'],
                        "image"=>$photo['UniversitiesPhoto']['path']?'/miniatura/160x125/uploads/'.$photo['UniversitiesPhoto']['path']:false,
                    );
                }
                $r[] = array(
                    "schowek"=>$tr,
                );
                break;
            case "7":
                $this->Storage->usunZeSchowkaQuery($_POST['id']);
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
