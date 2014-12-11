<?php
App::uses('AppController', 'Controller', 'UniversitiesController', 'CourseonUniversity');

class UniversitiesController extends AppController {
	public $helpers = array('Cache');
	public $components = array('Paginator',  'Search.Prg');
	public $cacheAction = array(
	    'view' => 36000,
	    'index'  => 48000
	);
	//public $components = array('DataTable');

	public function index() {
	
		$this->set('title_for_layout', 'Zostań studentem');
		$this->set('description_for_layout', 'Zostań studentem. Najlepsze szkoły wyższe.');
		$this->set('keywords_for_layout', 'uniwersytety, szkoły, ranking');
		$this->set('tabele', true);

		$this->University->recursive = 3; 
		$universities = $this->University->find('all', array('limit'=> 1));
		Debugger::dump($universities);
		
		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('University.rank' => 'asc'),//'order' => array('University.srednia' => 'desc'),
				'contain' => array('City', 'UniversityType'),
				'fields' => array(  'University.rank',
									'University.photo',
									'University.nazwa',
									'University.publiczna',
									'City.nazwa',
									'UniversityType.nazwa',
									'University.srednia',
									'University.id',
									'University.all_courses_names'),
			);
			$this->DataTable->emptyElements = 1;
			$this->set('universities', $this->DataTable->getResponse());
			$this->set('_serialize','universities');
		}
	}
	
	public function view($id, $nrzakladki=null) {
		$this->set('mapy', true);
		
		$university = $this->University->find('first', array('conditions'=> array('University.id'=>$id)));
		$zakladka_page = !empty($nrzakladki) ? (int)$nrzakladki : 0;
		$this->set('zakladka_page', $zakladka_page);
		
		$university['url'] = "/uczelnia/". Inflector::slug($university['University']['nazwa'],'-').'-'.  $university['University']['id'];
		$base_url = substr($university['url'],0);
		$university['zakladka1url'] = $base_url.'/'.Inflector::slug($university['UniversitiesParameter']['nzakladki1'], '-').'-1';
		$university['zakladka2url'] = $base_url.'/'.Inflector::slug($university['UniversitiesParameter']['nzakladki2'], '-').'-2';
		$university['zakladka3url'] = $base_url.'/'.Inflector::slug($university['UniversitiesParameter']['nzakladki3'], '-').'-3';
		$university['zakladka4url'] = $base_url.'/'.Inflector::slug($university['UniversitiesParameter']['nzakladki4'], '-').'-4';
				
		$this->set('description_for_layout', 'Zostań studentem. Najlepsze szkoły wyższe.');
		$this->set('keywords_for_layout', 'uniwersytety, szkoły, ranking');
		
		$university['galeria'] = array();
		foreach ($university['UniversitiesPhoto'] as $photo) {
			if($photo['typ']=='logo') {
				$university['logo'] = $photo['path'];
			} elseif($photo['typ']=='galeria') {
				array_push($university['galeria'], $photo['path']);
			}
		}
		$university = Set::remove($university, 'UniversitiesPhoto');
		if ($university['University']['abonament'] < 2) {
			$university['logo'] = 'no-photo.jpg';
			//$u['kierunki'] = $u['kierunki_full'] = array();
			$uuniversity['zakladka1'] = $university['zakladka2'] = $university['zakladka3'] = $university['zakladka4'] = '';
		}
		if ($university['UniversitiesParameter']['lokalizacja_x'] > 0 && $university['UniversitiesParameter']['lokalizacja_y'] > 0) {
			$this->set('lokalizacja_poparawna',true);
		} else $this->set('lokalizacja_poparawna',false);

		$this->set('title_for_layout', $university['University']['nazwa']);

		if ($university['University']['abonament'] < 2) {
			$this->University->CourseonUniversity->contain('Course.id', 'Course.nazwa');
			$kierunki = $this->University->CourseonUniversity->find('all', array('conditions'=>array('CourseonUniversity.university_id'=>$id), 																
																				'order'=>array('Course.nazwa')));
			$this->set('kierunki', $kierunki);
			$this->set('university', $university);
			$this->render('view_simple');
		} else {
			$this->University->CourseonUniversity->contain('Course.id', 'Course.nazwa', 'Faculty.nazwa', 'Faculty.id');
			$kierunki = $this->University->CourseonUniversity->find('all', array('conditions'=>array('CourseonUniversity.university_id'=>$id), 																
																				'order'=>array('Course.nazwa')));
			foreach ($kierunki as $kierunek) {
				$type= $kierunek['CourseonUniversity']['course_type_id'].$kierunek['CourseonUniversity']['course_mode_id'];
				$kierunki_full[$kierunek['CourseonUniversity']['faculty_id']][$kierunek['Course']['id']]['nazwa'] = $kierunek['Course']['nazwa'];
				if (isset($kierunek['Faculty']['nazwa'])) {
					$kierunki_full[$kierunek['CourseonUniversity']['faculty_id']][$kierunek['Course']['id']]['wydzial_id'] = $kierunek['Faculty']['id'];
					$kierunki_full[$kierunek['CourseonUniversity']['faculty_id']][$kierunek['Course']['id']]['wydzialnazwa'] = $kierunek['Faculty']['nazwa'];
				}
				$kierunki_full[$kierunek['CourseonUniversity']['faculty_id']][$kierunek['Course']['id']][$type] = true;
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

			$this->University->CourseonUniversity->Faculty->contain();
			$wydzialy = $this->University->CourseonUniversity->Faculty->find('all', array('fields'=>array('Faculty.id', 'Faculty.nazwa', 'Faculty.university_id'),
																							'conditions'=>array('Faculty.university_id'=>$id)));
			$this->set('wydzialy', $wydzialy);

			$this->set('university', $university);
		}
	}

	function search_all() {
        // the page we will redirect to
        $url['action'] = 'search';
         
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

	public function search($tid) {
		$this->set('tid',$tid);

		if(isset($this->request->query['keywords'])) {
            $keywords = mysql_escape_string(mb_strtolower($this->request->query['keywords'], 'UTF-8'));
            $keywords = explode(' ', $keywords);
			if (isset($keywords[1])) {
						$conditions = array(
						    'OR' => array(
						        array('University.all_courses LIKE' => "%$keywords[0]%"),
						        array('University.nazwa LIKE' => "%$keywords[0]%"),
						        array('University.miasto LIKE' => "%$keywords[0]%"),
						         array('UniversitiesParameter.tagi LIKE' => "%$keywords[0]%"),
						    ),
						    'AND' => array(
						    	array('University.university_type_id' => $tid),
						    		'OR' => array(
						                 array('University.all_courses LIKE' => "%$keywords[1]%"),
									    array('University.nazwa LIKE' => "%$keywords[1]%"),
									    array('University.miasto LIKE' => "%$keywords[1]%"),
									     array('UniversitiesParameter.tagi LIKE' => "%$keywords[1]%"),
								)
						    ),
						    
						);
			} else {
				$conditions = array(
						    'OR' => array(
						        array('University.all_courses LIKE' => "%$keywords[0]%"),
						        array('University.nazwa LIKE' => "%$keywords[0]%"),
						        array('University.miasto LIKE' => "%$keywords[0]%"),
						         array('UniversitiesParameter.tagi LIKE' => "%$keywords[0]%"),
						    ),
						    'AND' => array(
						    	array('University.university_type_id' => $tid),
						    		
						    ),
						    
						);
			}		
			
				//$this->University->contain('CourseonUniversity');
				$this->paginate = array(
					'University' => array(
						'order' => array('University.abonament'=> 'desc', 'University.nazwa' => 'asc' ),				 
						'limit' => 5,
						'recursive' => 0,
						'conditions' => 
		        			$conditions
,						//'joins' => $joins,
						'group' => 'University.id',
						'contain' => array('UniversitiesParameter.www', 'UniversitiesParameter.adres', 'UniversitiesParameter.email', 'UniversitiesParameter.telefon', 'UniversitiesParameter.opis', 'UniversityType', 'UniversitiesPhoto')
						
					)
				);

        } else { 
			$this->Paginator->settings = array(
		        'conditions' => array('University.university_type_id' => $tid),
				'order' => array('University.abonament'=> 'desc', 'UniversityParameter.nazwa' => 'asc' ),
				'limit' => 5,
				'contain' => array('UniversitiesParameter.www', 'UniversitiesParameter.adres', 'UniversitiesParameter.email', 'UniversitiesParameter.telefon', 'UniversitiesParameter.opis', 'UniversityType', 'UniversitiesPhoto')
		    );
		}
        $data =  $this->Paginator->paginate();

			if (count($data)>0) {
				if (!empty($_req['slowo'])) countSearchKeywords($_req['slowo']);
				$uczelnie_promo = array();
				$uczelnie = array();
				foreach ($data as $uczelnia) {
					if ($uczelnia['University']['abonament'] > 1) {
						foreach ($uczelnia['UniversitiesPhoto'] as $photo) {
							if($photo['typ']=='logo') {
								$uczelnia['logo'] = $photo['path'];
							} 
						}
						$uczelnia = Set::remove($uczelnia, 'UniversitiesPhoto');
						$uczelnie_promo[] = $uczelnia;
					} else {
						$uczelnie[] = $uczelnia;
					}
				}
				//Debugger::dump($uczelnie_promo);
				$this->set('uczelnie_wyniki',$uczelnie_promo);
				$this->set('uczelnie_wyniki_demo',$uczelnie);
			} else {
				$this->set('uczelnie_wyniki_brak',1);
			}
			
		//} else {
			//$this->av('uczelnie_nosearch',1);
		//}
		//$this->av('uczelnie_searchurl',$this->wyszukiwarka_cleanurl());
		/*$this->set('sf',$sf);
		
		if (isset($_req['rodzaj'])) {
			switch ($_req['rodzaj']) {
			case 1:
				$r = 'Szkoła wyższa, uniwersytet'; break;
			case 2:
				$r = 'Szkoła policealna'; break;
			case 3:
				$r = 'Szkoła językowa'; break;
			}
		}
		if (!empty($_req['miasto'])) {$this->set('title_for_layout', $_req['miasto']. ' - ' .$r. ' | Zostań Studentem');
			if (!empty($_req['kierunek'])) $this->set('title_for_layout',  $_req['kierunek']. ' - ' .$_req['miasto']. ' - ' .$r. ' | Zostań Studentem');
		} elseif (!empty($_req['kierunek'])) $this->set('title_for_layout', $_req['kierunek']. ' - ' .$r. ' | Zostań Studentem');*/
		$this->set('title_for_layout', 'Wyszukiwarka - Szkoły wyższe - policelane - językowe | Zostań Studentem');

		$this->set('title_for_slider2','Znajdź uczelnie');

		$this->set('description_for_layout', 'Znajdź szkołę, uczelnie, uniwersytet i kierunek studiów który Cię interesuje');
		$this->set('keywords_for_layout', 'szkoła, wyższa, policealna, językowa, uczelnia, kierunek, studia');

	}	

	function ajax() {
		$tid = $this->request->pass[0];
		$r = array();
		switch ($tid) {
			case "1":
				$txt = $_POST['txt'];
				$rq = $this->University->District->find('all', array('conditions'=> array('District.nazwa LIKE ' => '%'.$txt.'%'),
															'fields' => array('District.id', 'District.nazwa'),
															'order'=> array('District.nazwa'),
															'limit'=> 8));
				foreach ($rq as $ri) {
					$r[] = array(
						'label'=>$ri['District']['nazwa'],
						'value'=>$ri['District']['id'],
					);
				}
				break;
			case "2":
				if(isset($_POST['wid'])) $rel_woj = $_POST['wid'];
				$txt = $_POST['txt'];
				$conditions = array('UniversitiesParameter.miasto LIKE ' => '%%%'.$txt.'%%');
				if(!empty($rel_woj)) {
					$condition2 = array('University.district_id' => $rel_woj);
					$conditions = array_merge($conditions, $condition2);
				}
				$this->University->contain('UniversitiesParameter.miasto');
				$rq = $this->University-> find('all', array('conditions'=> $conditions, 
															'fields' => array('DISTINCT UniversitiesParameter.miasto'),
															'order' => array('UniversitiesParameter.miasto'),
															'limit'=> 8));
				//Debugger::dump($r);
				foreach ($rq as $ri) {
					$r[] = array(
						'label'=>$ri['UniversitiesParameter']['miasto'],
						'value'=>$ri['UniversitiesParameter']['miasto'],
					);
				}
				break;
			case "3":
				if (!preg_match('/\/(kierunek)|(kierunki)\//',$_SERVER['HTTP_REFERER'])) {
					preg_match('/([0-9]+)\.html/',$_SERVER['HTTP_REFERER'],$ref);
					$ref = $ref[1];
				} else {
					$ref = 1;
				}
				$txt = $_POST['txt'];
				//$this->University->CourseonUniversity->contain('Course');
				$rq = $this->University->CourseonUniversity->find('all', array('conditions'=> array('University.university_type_id'=>$ref, 'Course.nazwa LIKE ' => '%'.$txt.'%%'),
																				'fields' => array('DISTINCT Course.nazwa', 'Course.id'), 
																				'limit' => 8));
				Debugger::dump($rq);
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
	
	public function ranking() {
		$this->University->contain();
		$universities = $this->University->find('all');

		//$ranking = $this->University->query("SELECT Ranking.miejsce, Ranking.nazwa, Ranking.typ FROM ranking AS Ranking");
		foreach ($universities as $university) {
			//foreach ($ranking as $r) {
				if(!empty($university['University']['photo'])) {
					$file= $university['University']['photo'];
					$src ='C:\Users\Administrator\Documents\klu\cakephp-2.3.8\app\webroot\img\uploads/'.$file;
					$dest='C:\Users\Administrator\Documents\klu\cakephp-2.3.8\app\webroot\img\uczelnie/'.$file;
					if (!copy($src,$dest)) {
						echo "failed to copy $file...\n";
					} 
					/*if($university['University']['ranking'] == 0) {
						$this->University->updateAll( 
							array( //'University.ranking' => $r['Ranking']['miejsce'],
									'University.university_type_id' => 32), 
							array( 'University.id' => $university['University']['id']));
					} else $this->University->updateAll( 
							array('University.university_type_id' => 32), 
							array( 'University.id' => $university['University']['id']));*/
				}
			//}
		}
	}
	
	public function home_slider() {
		//$this->University->contain();
		$universities = $this->University->UniversitiesPhoto->find('all', array('conditions' => array('UniversitiesPhoto.typ' => 'logo', 'University.university_type_id' => 1, 'University.abonament >=' => 2), 'limit'=> 5));
		//Debugger::dump($universities);
		if (!empty($this -> request -> params['requested'])) {
		   return $universities;
		} else {
			$this->set('universities', $universities);
		}
	}

	public function home_slider_poli() {
		//$this->University->contain();
		$universities = $this->University->UniversitiesPhoto->find('all', array('conditions' => array('UniversitiesPhoto.typ' => 'logo', 'University.university_type_id' => 2, 'University.abonament >=' => 2), 'limit'=> 5));
		//Debugger::dump($universities);
		if (!empty($this -> request -> params['requested'])) {
		   return $universities;
		} else {
			$this->set('universities', $universities);
		}
	}

	public function topCity() {
		$topCity = $this->University-> query("SELECT miasto, COUNT(*) FROM universities_parameters GROUP BY miasto ORDER BY 2 DESC LIMIT 0,20");
		if (!empty($this -> request -> params['requested'])) {
		   return $topCity;
		} else {
			$this->set('topCity', $topCity);
		}
	}

	public function topPolicealne() {
		$topCity = $this->University-> query("SELECT DISTINCT up.miasto, COUNT(up.miasto) FROM universities u LEFT JOIN universities_parameters up ON up.university_id = u.id WHERE u.university_type_id = 2 GROUP BY up.miasto ORDER BY 2 DESC LIMIT 0,20");
		if (!empty($this -> request -> params['requested'])) {
		   return $topCity;
		} else {
			$this->set('topCity', $topCity);
		}
	}

	public function slider_2() {
	return $this->ff;
	}

	
	
	public function delateSzkoly() {
		$this->University->deleteAll(array('University.university_type_id' => 20), true);
		$this->redirect(array('action' => 'index'));
	}
	public function fotoSmAll2() {
		$this->University->contain();
		$universities = $this->University->find('all');
		if (!empty($this -> request -> params['requested'])) {
		   return $universities;
		} else {
			$this->set('universities', $universities);
		}
		$dt_recs = $this->University->find('all');

	} 
	
	public function zapis() {
		# Open the File.
		if (($handle = fopen("uczelnie_foto.csv", "r")) !== FALSE) {
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

		foreach ($csvarray as $uni) {
			$this->University->contain();
			$c = $this->University->find('all');
			foreach ($c as $c2) {		
				if ($c2['University']['id'] == $uni[1]) {
					if($uni[2]=='logo') {
						Debugger::dump($uni);
						$this->University->updateAll(	array('University.photo' => "'".$uni[3]."'"),  													array('University.id' => $c2['University']['id']));
					}
				}
			}
		}
	}

	
	
	public function update_all_courses_name(){
		$this->University->contain();
		$universities = $this->University->find('all', array('fields' => array('University.id'), 'order' => array('University.abonament' => 'DESC')));	
		foreach ($universities as $university) {
			$this->University->CourseonUniversity->contain('Course.nazwa');
			$courses = $this->University->CourseonUniversity->find('list', 
																					array(
																						'conditions'=>array(
																							'CourseonUniversity.university_id'=>$university['University']['id']), 
																						'fields' => array('Course.nazwa'),
																						'group' => 'Course.nazwa',
																						//'limit' => 8,
																						'order'=>'Course.nazwa'));	
			$courses_names = implode(',', $courses);
			//Debugger::dump($courses_names);
			$this->University->id = $university['University']['id'];
			$this->University->saveField('all_courses', $courses_names);		
		}
		
		
		
	}
	public function nazwy(){
		$this->University->contain('UniversitiesParameter.miasto');
		$universities = $this->University->find('all');
		//Debugger::dump($universities);
		foreach($universities as $uni) {
			if ($uni['University']['miasto'] == $uni['UniversitiesParameter']['miasto']) {

			} else {
				$this->University->id = $uni['University']['id'];
				$this->University->saveField('miasto', $uni['UniversitiesParameter']['miasto']);
			}
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
		if(isset($this->passedArgs['Search.keywords'])) {
            $keywords = mb_strtolower($this->passedArgs['Search.keywords'], 'UTF-8');
			//Debugger::dump($keywords);
            $this->paginate = array(
                'conditions' => array(
                    'LOWER(University.nazwa) LIKE' => "%$keywords%",
                )
            );
        } else { 
			$this->paginate = array(
				'limit' => 30,
				'order' => array('University.nazwa' => 'asc' ),
				'contain' => array('City.nazwa', 'UniversitiesParameter', 'UniversityType')
			);
		}
        $universities = $this->paginate('University');
		//Debugger::dump($universities);
        $this->set('universities', $universities);
	}
	
	public function admin_edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }
			$this->University->contain('UniversitiesParameter' , 'City.id', 'City.nazwa', 'UniversityType','Promo');
            $university = $this->University->findById($id);
			$this->set('cities', $this->University->City->find('list'));
			$this->set('type', $this->University->UniversityType->find('list'));

			//Debugger::dump($university);
			
            if ($this->request->is('post') || $this->request->is('put')) {
				//Debugger::dump($this->request->data);
                $filename = strtotime('now');
				$photo = $this->request->data['University']['photo'];
				
				
				$path = "/img/uczelnie_min/";
				$dir = getcwd().$path;
				
				if(!empty($photo['name'])) {
					if (in_array($photo['type'], array('image/jpeg','image/pjpeg','image/png'))) {
					
						$img = $this->University->resize_image($photo, 400, 400);
						$photoFile = "$dir$id.png";
						imagepng($img, $photoFile);	
						$this->request->data['University']['photo'] = $id.'.png';				
					} else {
						$this->Session->setFlash(__('Proszę przesłać plik w formacie JPG albo PNG'));
					}
				} else { 
					$this->request->data['University']['photo'] = $university['University']['photo'];
				}
				//unlink($photo['tmp_name']); 

                if ($this->University->saveAssociated($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'edit', $id));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            } 
           
            $this->request->data = $university;
    }
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$filename = strtotime('now');
			$photo = $this->request->data['University']['photo'];
			
			$path = "/img/uczelnie_min/";
				$dir = getcwd().$path;
			if (in_array($photo['type'], array('image/jpeg','image/pjpeg','image/png'))) {

				$img = $this->University->resize_image($photo['tmp_name'], 400, 400);
				$photoFile = "$dir$id.png";
				imagepng($img, $photoFile);	
				$this->request->data['University']['photo'] = $id.'.png';			
			
			} else {
				$this->University->invalidate('photo', __("Only JPG or PNG accepted.",true));
			}
			
			$this->University->create();
            if ($this->University->save($this->request->data, array('validate' => 'only'))) {
                $this->Session->setFlash(__('Utworzono kierunek'));
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

        if ($this->University->deleteAll(array('University.id' => $kierunek_id), true)) {
            $this->Session->setFlash(__('Uczelnia usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
 
}