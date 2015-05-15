<?php
App::uses('Controller', 'Controller');

class CoursesController extends AppController {	
	public $components = array('DataTable');
	
	public function index() {

		$this->set('title_for_layout', 'Kierunki studiów');
		$this->set('description_for_layout', 'Wybierz kierunek studiów który najbardziej Cię interesuje. Nowe kierunki humanistyczne, artystyczne, ekonomiczne, techniczne, przyrodnicze');
		$this->set('keywords_for_layout', 'kierunki, studia, studiów');
		$this->set('title_for_slider2','Kierunki');

		$tid = $this->request->pass[0];
		$this->set('tid', $tid);
		
		$this->Course->CoursesCategory->contain();
		$kategorie = $this->Course->CoursesCategory->find('all');
		$this->set('kategorie',$kategorie);
		if ($tid) {
			$this->Course->contain();
			$kierunki = $this->Course->find('all', array('conditions' => array('Course.courses_category_id' => $tid, 'Course.university_type_id' => 1), 'order'=>array('Course.nazwa'=>'asc')));
			$this->set('kategoria_set',1);
			$this->set('kierunki',$kierunki);
			$this->set('kategoria',$kategorie[$tid-1]);
		} else {
			$this->set('kategoria_set',0);
		}
	}
	
	public function view($id = null, $page = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$this->Course->CoursesCategory->contain();
		$kategorie = $this->Course->CoursesCategory->find('all');
		$this->set('kategorie',$kategorie);

		$this->Course->contain('CoursesCategory');
		$kierunek = $this->Course->find('first', array('conditions'=> array('Course.id'=> $id)));

		$this->set('title_for_layout', 'Kierunek '.$kierunek['Course']['nazwa']);
		$this->set('description_for_layout', substr(html_entity_decode(strip_tags($kierunek['Course']['opis1']),ENT_COMPAT,'UTF-8'),0,160));
		$this->set('keywords_for_layout', $kierunek['Course']['nazwa'].' , kierunek , studia');
		$this->set('title_for_slider2',$kierunek['Course']['nazwa']);
		
		$this->set('kierunek',$kierunek);

		$this->Paginator->settings = array(
					'Course' => array(
						//'order' => array('University.abonament'=> 'desc', 'University.nazwa' => 'asc' ),				 
						'limit' => 5,
						'recursive' => -1,
						'fields' => array('DISTINCT CourseonUniversity.university_id'),
						'conditions' => array('Course.id'=>$id, 'University.abonament_id >' => 1),
						'order' => array('University.id', 'University.nazwa'),
						'joins' => array(
					        array(
					            'alias' => 'CourseonUniversity',
					            'table' => 'courseon_universities',
					            'type' => 'LEFT',
					            'conditions' => '`Course`.`id` = `CourseonUniversity`.`course_id`'
					        ), 
					         array(
					            'alias' => 'University',
					            'table' => 'universities',
					            'type' => 'LEFT',
					            'conditions' => '`CourseonUniversity`.`university_id` = `University`.`id`'
					        ), 
					    ),
					)
				);
		$uczelnie =  $this->Paginator->paginate();
		//Debugger::dump($uczelnie);

		if (count($uczelnie) > 0) {
			$uczelnie_promo = array();
			foreach ($uczelnie as $key => $uczelnia) {
				$this->Course->CourseonUniversity->University->contain('UniversitiesParameter.www', 'UniversitiesParameter.adres', 'UniversitiesParameter.email', 'UniversitiesParameter.telefon', 'UniversitiesParameter.opis', 'UniversityType', 'UniversitiesPhoto');
						
				$uczelnia_c = $this->Course->CourseonUniversity->University->find('first', array('conditions' => array('University.id'=> $uczelnia['CourseonUniversity']['university_id'], 
																														'University.abonament_id >' => '1')));
				if($uczelnia_c) {
					foreach ($uczelnia_c['UniversitiesPhoto'] as $photo) {
						if($photo['typ']=='logo') {
							$uczelnia_c['logo'] = $photo['path'];
						} 
					}
					
					$uczelnie_promo[] = $uczelnia_c;
				}
			}
			if (count($uczelnie_promo) > 0) {
				$this->set('uczelnie_wyniki',$uczelnie_promo);
			} else {
				$this->set('uczelnie_wyniki_brak',1);
			}
		} else {
				$this->set('uczelnie_nosearch',1);
			}
		/*
		$this->av('uczelnie_searchurl',$this->wyszukiwarka_cleanurl());*/
	}

	public function znajdz_kierunki($tid) {
		$this->set('tid',$tid);
		$_req = isset($_GET) ? $_GET : array();
		if (isset($_req['kierunek']) && $_req['kierunek'] === 'KIERUNEK') $_req['kierunek'] = '';
		
		$kierunki = $this->Course->szukajUczelniQuery($_req);
		//Debugger::dump($kierunki);
			
		$this->set('kierunki',$kierunki);

		$this->set('title_for_slider2', 'Szukaj '. $_req['kierunek']);
		$this->set('title_for_layout', 'Szukaj:'. $_req['kierunek'] .' | Zostań Studentem');
		$this->set('description_for_layout', 'Wybierz kierunek studiów który najbardziej Cię interesuje. Nowe kierunki humanistyczne, artystyczne, ekonomiczne, techniczne, przyrodnicze');
		$this->set('keywords_for_layout', 'kierunki, studia, studiów, '.$_req['kierunek']);
	}

	public function ajax() {
		$tid = $this->request->pass[0];
		$r = array();
		switch ($tid) {			
			case "3":
				if (!preg_match('/\/(kierunek)|(kierunki)\//',$_SERVER['HTTP_REFERER'])) {
					preg_match('/([0-9]+)/',$_SERVER['HTTP_REFERER'],$ref);
					$ref = $ref[1];
				} else {
					$ref = 1;
				}
				$txt =  htmlentities(trim(strip_tags(stripslashes(mb_strtolower($_POST['txt'])))));
				$this->Course->contain();
				$rq = $this->Course->find('all', array('conditions'=> array('OR'=>array(
																						array('LOWER(Course.nazwa) LIKE ' => '%'.$txt.'%')),
																			'AND' => array(array('Course.university_type_id' => $ref))
																				),
														'order' => array('Course.nazwa'),
														'fields' => array('Course.nazwa', 'Course.id'), 
														'limit' => 8));
				//Debugger::dump($rq);
				foreach ($rq as $ri) {
					$r[] = array(
						'label'=>$ri['Course']['nazwa'],
						'value'=>$ri['Course']['id'],
					);
				}
				break;
		}
		
		$this->output_json($r);
	}
	
	public function topKierunki() {
		$courses = Cache::read('top_courses', 'long');
        if (!$courses) {
            $courses = $this->Course-> query("SELECT DISTINCT uk.course_id, COUNT(*) FROM universities u LEFT JOIN courseon_universities uk ON uk.university_id = u.id WHERE u.university_type_id = 1 GROUP BY uk.course_id ORDER BY 2 DESC LIMIT 0,15");
            Cache::write('top_courses', $courses, 'long');
        }

		$kierunki = array();
		$i=0;
		foreach ($courses as $kierunek) {
			$this->Course->contain();
			$course = $this->Course-> findById($kierunek['uk']['course_id']);
			$kierunki[$i]['id'] = $course['Course']['id'];
			$kierunki[$i]['nazwa'] = $course['Course']['nazwa'];
			$i++;
		}
		if (!empty($this -> request -> params['requested'])) {
		   return $kierunki;
		} else {
			$this->set('kierunki', $kierunki);
		}
	}

	public function losowyKierunek() {
		$this->Course->contain();
		$losowe = $this->Course->find('all', array('conditions' => array('Course.opis1 !='=> ''), 
													'order'=>'rand()',
             										'limit' => 3,));
		if (!empty($this -> request -> params['requested'])) {
		   return $losowe;
		} else {
			$this->set('losowe', $losowe);
		}
	}
	
	public function usunOrange() {
		$this->Course->contain();
		$courses = $this->Course->find('all', array('fields'=> array('opis2', 'id'),
													'conditions' => array('Course.opis2 !='=> '')));
		foreach ($courses as $key =>$course) {
			$courses[$key]['Course']['opis2'] = str_replace('style="list-style: square inside url(\'http://www.orange-business.com/content/bridging-ships/Images/orange_square.gif\');"', '', $course['Course']['opis2']);
			//echo $courses[$key]['Course']['opis1'];
			$this->Course->id = $course['Course']['id'];
			$this->Course->saveField('opis2', $courses[$key]['Course']['opis2']);
		}

	}

	public function zapis() {
		# Open the File.
		if (($handle = fopen("k.csv", "r")) !== FALSE) {
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
		Debugger::dump($csvarray);


		foreach ($csvarray as $uni) {
			$this->Course->contain();
			$c = $this->Course->find('all');
			foreach ($c as $c2) {		
				if ($c2['Course']['id'] == $uni[2]) {
					//Debugger::dump($c2);
					$this->Course->id = $c2['Course']['id'];
					$data = array('opis' => $uni[6]);
					$this->Course->save($data);
					Debugger::dump($data);
					//$this->University->updateAll(	array('University.kategoria' => $uni[2]),  									array('University.id' => $c2['University']['id']));
				}
			}
		}
	}

	public function zapisz_kierunki() {
		
		//Debugger::dump($courses);
		$filename = 'kierunki';
		if ($fh = fopen($filename, "r")) {
			$lista2= '';
			while (!feof($fh)) {
			  	$line = trim(fgets($fh));
				$line1 = mb_strtolower($line, 'UTF-8');
			  	$this->Course->contain();
			  	$course = $this->Course->find('all', array('fields'=>array('nazwa'), 'conditions' => array(
                    'LOWER(TRIM(nazwa)) LIKE' => "$line1",
                )));
                if(!empty($course)) {
					//echo 'dobry - '. $line .'-'.$course.'<br/>'; 
				} else { 
					$lista[] = $line;
					$lista2 .= $line."\r\n";
				}
			  	/*$good = false; 
			  	foreach($courses as $course) {
			  		if(strcmp(mb_strtoupper($line,'UTF-8'),mb_strtoupper($course,'UTF-8')) == 0) {
			  			echo 'dobry - '. $line .'-'.$course; 
			  			$good = true; break;
			  		} //else  echo 'zły - '. $line .'-'.$course1;
			  	}
			  	if (!$good) {
			  		echo 'źle - '.$line;
			  	}*/
			}
			fclose($fh);
			file_put_contents('nowe.txt', $lista2);
			Debugger::dump($lista);
		}
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
	
	public function admin_index() {
		$conditions =array();
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
			$conditions[] = array('OR' => array(
                					'Course.id' => $keywords,
                	               'LOWER(Course.nazwa) LIKE' => "%$keywords%",
                	));
        }  
        if (!empty($this->passedArgs['Search.university_type_id'])) {
        	$type = $this->passedArgs['Search.university_type_id'];
        	//$this->paginate['conditions'][]['University.university_type_id'] = $type;
        	$conditions[] = array('Course.university_type_id' => $type);
        	
           	$this->request->data['Search']['university_type_id'] = $this->passedArgs['Search.university_type_id'];
        }

         if (!empty($this->passedArgs['Search.courses_category_id'])) {
        	$abonament = $this->passedArgs['Search.courses_category_id'];
        	$conditions[] = array('Course.courses_category_id' => $abonament);
        	
           	$this->request->data['Search']['courses_category_id'] = $this->passedArgs['courses_category_id'];
        
        } 
		$this->paginate = array(
            'limit' => 20,
            'conditions' => $conditions,
            'order' => array('Course.nazwa' => 'asc' ),
			'contain' => array('CoursesCategory', 'UniversityType')
	        );
	    
        $courses = $this->paginate('Course');
		//Debugger::dump($courses);
		$this->set('coursesCategories', $this->Course->CoursesCategory->find('list'));
		$this->set('universityTypes', $this->Course->UniversityType->find('list'));
        $this->set('courses', $courses);
	}
	
	public function admin_add() {
        if ($this->request->is('post')) {
			$this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('Utworzono kierunek'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
		$this->set('coursesCategories', $this->Course->CoursesCategory->find('list'));
		$this->set('universityTypes', $this->Course->UniversityType->find('list'));
    }
	
	public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$this->Course->contain();
		$course = $this->Course->findById($id);
		//Debugger::dump($course);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Course->id = $id;
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $course;
		}
		
		$this->set('coursesCategories', $this->Course->CoursesCategory->find('list'));
		$this->set('universityTypes', $this->Course->UniversityType->find('list'));
    }
	
	public function admin_delete($kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->Course->deleteAll(array('Course.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Kierunek usunięty'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
}