<?php
App::uses('Controller', 'Controller');

class CourseonUniversitiesController extends AppController {	
	public $components = array('DataTable');

	public function index() {
		$this->set('title_for_layout', 'Ranking kierunków na poszczególnych uniwersytetach');
		$this->set('description_for_layout', 'Ranking kierunków na poszczególnych uniwersytetach.');
		$this->set('keywords_for_layout', 'kierunki na uczelniach, ranking');
		$this->set('tabele', true);

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('CourseonUniversity.srednia' => 'desc'),
				'contain' => array('University.nazwa', 'Course.nazwa', 'TypCourse', 'TrybCourse'),
				'fields' => array('University.nazwa','Course.nazwa','CourseonUniversity.cena','TypCourse.nazwa','TrybCourse.nazwa', 'CourseonUniversity.srednia','CourseonUniversity.id' ),
			);
			$this->DataTable->emptyElements = 1;
			$this->set('courses', $this->DataTable->getResponse());
			$this->set('_serialize','courses');
		}
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$courseonuniversity = $this->CourseonUniversity->findById($id);
		if (!$courseonuniversity) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('courseonuniversity', $courseonuniversity);

		$this->set('title_for_slider2', 'Ranking kierunków na poszczególnych uniwersytetach');
	}

	public function srednia() {
		/*wartosci wspólczynników dla c-ceny, k-kierunków, u-uczelni*/
		$wc=3;
		$wk=5;
		$wu=4;
		$sum = $wc + $wk + $wu;
		$cities = $this->CourseonUniversity->find('all');	
		foreach ($cities as $courseonUniversity) {
			$srednias2= ($courseonUniversity['Course']['srednia']*$wk)+($courseonUniversity['University']['srednia']*$wu);
			if ($courseonUniversity['CourseonUniversity']['cena'] != 0){
				$srednias = ((1/$courseonUniversity['CourseonUniversity']['cena'])*$wc)+$srednias2;
			}
		
			$srednia = $srednias/ $sum;
			$this->CourseonUniversity->id = $courseonUniversity['CourseonUniversity']['id'];
			$this->CourseonUniversity->saveField('CourseonUniversity.srednia', $srednia);
		}
		$this->redirect(array('action' => 'index'));
	}
	public function rank_old() {
		$x = $this->CourseonUniversity->find('all',array ('fields' => array('CourseonUniversity.id', 'CourseonUniversity.srednia'),'order' => array('CourseonUniversity.srednia' => 'desc')));
		$i=0;
		foreach ($x as $CourseonUniversity) {
			echo $i=$i + 1;
			echo $CourseonUniversity['CourseonUniversity']['id'];
			echo $CourseonUniversity['CourseonUniversity']['srednia'].'<br>';
			$this->CourseonUniversity->updateAll( 
						array( 'CourseonUniversity.rank' => $i), 
						array( 'CourseonUniversity.id' => $CourseonUniversity['CourseonUniversity']['id']));
		}
	}
	public function zapis() {
		# Open the File.
		if (($handle = fopen("oplaty.csv", "r")) !== FALSE) {
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
		
		foreach ($csvarray as $course) {
			$id = $course[0];
			if (!empty($course[0])) {
				$this->CourseonUniversity->contain();
				$c = $this->CourseonUniversity->findAllByUniversityId($course[0]);
				/*echo '<pre>';
		print_r($c);
		echo "</pre>";*/
				foreach ($c as $c2) {		
					if (!empty($course[1]) && $c2['CourseonUniversity']['typ_course_id'] == 1 or $c2['CourseonUniversity']['typ_course_id'] == 2 && $c2['CourseonUniversity']['tryb_course_id'] == 1) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[1]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[2]) && $c2['CourseonUniversity']['typ_course_id'] == 3 && $c2['CourseonUniversity']['tryb_course_id'] == 1) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[2]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[3]) && $c2['CourseonUniversity']['typ_course_id'] == 1 or $c2['CourseonUniversity']['typ_course_id'] == 2 && $c2['CourseonUniversity']['tryb_course_id'] == 2) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[3]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					} elseif (!empty($course[4]) && $c2['CourseonUniversity']['typ_course_id'] == 3 && $c2['CourseonUniversity']['tryb_course_id'] == 2) {
						$this->CourseonUniversity->updateAll(array('CourseonUniversity.cena' => $course[4]),  array( 'CourseonUniversity.id' => $c2['CourseonUniversity']['id']));
					}
				}
			}
		}
		/*echo '<pre>';
		print_r($c2['typ_course_id']);
		echo "</pre>";*/
		
	}
	
	public function pokaz() {
		$this->CourseonUniversity->contain('University');
		$var = $this->CourseonUniversity->find('all');	
		foreach ($var as $v) {
			if ($v['University']['id'] == null) {
				$this->CourseonUniversity->delete($v['CourseonUniversity']['id'], false);
			 			Debugger::dump($v);
			}
		}
	}
	public function sredniacourseonuniversities() {
		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | kierunek | MIN | MAX | cena | srednia<br>';

		$LIST_IDs = $this->CourseonUniversity->find('list', array ('order' => array('id' => 'ASC'), 'fields'=>array('CourseonUniversity.id')));
    	foreach ($LIST_IDs as $ID) {
			//$ID = 4;
	    	echo $ID.' | ';

	//  /*
	    	$kierunek  = $this->CourseonUniversity->find('list', array ('conditions' => array('CourseonUniversity.id' => $ID), 'fields'=>array('CourseonUniversity.course_id')));
	    	echo $kierunek  = $kierunek[$ID].' | ';
	    	$kierunek_MIN = $this->CourseonUniversity->find('first' ,array ('conditions' => array('CourseonUniversity.course_id' => $kierunek ), 'fields' => array('MIN(CourseonUniversity.cena) as min_size'  )));
	    	echo $kierunek_MIN = $kierunek_MIN[0]['min_size'].' | ';
	    	$kierunek_MAX = $this->CourseonUniversity->find('first' ,array ('conditions' => array('CourseonUniversity.course_id' => $kierunek ), 'fields' => array('MAX(CourseonUniversity.cena) as max_size'  )));
	    	echo $kierunek_MAX = $kierunek_MAX[0]['max_size'].' | ';
	    	$kierunekczesne = $this->CourseonUniversity->find('first', array ('conditions' => array('CourseonUniversity.id' => $ID)));
	    	echo $kierunekczesne = $kierunekczesne['CourseonUniversity']['cena'].' | ';
	// */

	    	if ( ($kierunek_MAX - $kierunek_MIN) == 0 ){
		    	echo $srednia_kierunku = 0;
		    }else{
		    	echo $srednia_kierunku = (($kierunekczesne - $kierunek_MIN) / ($kierunek_MAX - $kierunek_MIN)) * 10 ;
		    }
		    echo '<br>';

	    	$this->CourseonUniversity->id = $ID;
		    $this->CourseonUniversity->saveField('srednia', $srednia_kierunku );
    	
    	}
    }
    public function rank() {
        $Model = 'CourseonUniversity';

        echo '<br><br><br><br><br><br><br><br>';
        echo 'id | srednia | rank<br>';
        $PartArray = $this->$Model->find('all', array ('fields' => array($Model.'.id',$Model.'.srednia', $Model.'.placa'),'order' => array($Model.'.srednia' => 'desc')));
        $i=0;
        foreach ($PartArray as $Record) {
            echo $i = $i + 1;
            echo $id = $Record[$Model ]['id'].' | ';
            echo $Record[$Model ]['srednia'].' | ';
            echo $i . '<br>';
            $this->$Model ->id = $id;
            $this->$Model ->saveField('rank', $i);
        }    
    }
	/***ADMIN***/
	public function admin_lista($university_id = null) {
		if (!$university_id) {
			throw new NotFoundException(__('Invalid post'));
		}			
		$this->CourseonUniversity->contain('Course');
				$db = $this->CourseonUniversity->find('all', array(
				'order' => array('Course.nazwa', 'CourseonUniversity.typ_course_id'), 
				'conditions' => array('CourseonUniversity.university_id' => $university_id)));
				foreach ($db as $d) {
					switch ($d['Course']['courses_type_id']) {
						case 1:
							$typ='Artystyczne'; break;
						case 2:
							$typ='Ekonomiczne'; break;
						case 3:
							$typ='Humanistyczne'; break;
						case 4:
							$typ='Przyrodnicze'; break;
						case 5:
							$typ='Techniczne'; break;
						case 6:
							$typ='Inne'; break;
						default:
							$typ = ''; break;
					}
					//$kursy[$d['Course']['courses_type_id']]['nazwa_typ']= $typ;
					$kursy[$d['Course']['id']]['course_id']['course_id']= $d['Course']['id'];
					$kursy[$d['Course']['id']]['nazwa']['nazwa']= $d['Course']['nazwa'];
					
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['id']= $d['CourseonUniversity']['id'];
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['typ_course_id']= $d['CourseonUniversity']['typ_course_id'];
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['tryb_course_id']= $d['CourseonUniversity']['tryb_course_id'];
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['cena']= $d['CourseonUniversity']['cena'];
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['pakiet']= $d['CourseonUniversity']['pakiet'];
					$kursy[$d['Course']['id']][$d['CourseonUniversity']['id']]['srednia']= $d['CourseonUniversity']['srednia'];
				}
				
		$this->set('kursy', $kursy);
		$this->set('university', $university_id);
	}
	
	 public function admin_edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$this->CourseonUniversity->contain('Course.id', 'Course.nazwa', 'University.id', 'University.nazwa');
		$courseonuniversity = $this->CourseonUniversity->findById($id);
		//Debugger::dump($courseonuniversity);

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->CourseonUniversity->id = $id;
			if ($this->CourseonUniversity->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'lista', $courseonuniversity['CourseonUniversity']['university_id']));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $courseonuniversity;
		}
		$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
		$this->set('typCourses', $this->CourseonUniversity->TypCourse->find('list'));
		$this->set('trybCourses', $this->CourseonUniversity->TrybCourse->find('list'));
    }
	
	public function admin_update() {
		$course = $this->request->data['c'];
		$university_id = $this->request->data['course']['university_id'];
		$course_id = $this->request->data['course']['course_id'];

		foreach ($course as $conu_id => $cc) {
			$i=0;
			foreach ($cc as $c) {
				if(($c['tryb_course_id'] == 0) or  ($c['typ_course_id'] == 0)) {
				}else {
					$i++;
					$this->CourseonUniversity->contain();
					$tenc =  $this->CourseonUniversity->findById($conu_id);
					//Debugger::dump($tenc);
					if ($i==1) {
						if ($c['typ_course_id']==$tenc['CourseonUniversity']['typ_course_id'] && $c['tryb_course_id']==$tenc['CourseonUniversity']['tryb_course_id']) {
							
						} else {
							$this->CourseonUniversity->id = $tenc['CourseonUniversity']['id'];
							if($this->CourseonUniversity->save(
								array('CourseonUniversity' => array('typ_course_id' => $c['typ_course_id'], 
									'tryb_course_id' => $c['tryb_course_id']))
							)) {
								$this->Session->setFlash(__('Kierunek uczelni zaktualizowany'));
							} else {
								$this->Session->setFlash(__('NIe można zaktualizować kierunku'));
							}
						}
					} else {
						//Debugger::dump(array($c['typ_course_id'], $c['tryb_course_id']));
						$this->CourseonUniversity->create();
						$data = array('CourseonUniversity' => array(
												'university_id' => $university_id, 
												'course_id' => $course_id, 
												'typ_course_id' => $c['typ_course_id'], 
												'tryb_course_id' => $c['tryb_course_id'],
												'cena' => 0,
												'srednia' => 0));
						if ($this->CourseonUniversity->save($data)) {
							$this->Session->setFlash(__('Kierunek uczelni został utworzony'));
						} else {
							$this->Session->setFlash(__('The user could not be created. Please, try again.'));
						}   
					}
				}
			}
		}	
		//Debugger::dump($course);
		$this->redirect(array('action' => 'lista', $university_id));
    }
	

	public function admin_delete($courseonuniversity_id, $uni_id = null) {
         
        if (!$courseonuniversity_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->CourseonUniversity->delete(array('CourseonUniversity.courseonuniversity_id' => $courseonuniversity_id))) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek został usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	
	public function admin_deletem($course_id, $uni_id = null) {
         
        if (!$course_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->CourseonUniversity->deleteAll(array('CourseonUniversity.university_id' => $uni_id, 'CourseonUniversity.course_id' => $course_id))) {
            $this->Session->setFlash(__('Kierunek na uczelni usunięty'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	
	public function admin_add($university_id, $count=false) {
		if (isset($count)) {
			$this->set('count',$count);
		}
        if ($this->request->is('post')) {
			$this->CourseonUniversity->create();
            if ($this->CourseonUniversity->saveMany($this->request->data)) {
                $this->Session->setFlash(__('Kierunek uczelni został utworzony'));
                $this->redirect(array('action' => 'lista', $university_id));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        } 
		
			$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
			$this->set('typCourses', $this->CourseonUniversity->TypCourse->find('list'));
			$this->set('trybCourses', $this->CourseonUniversity->TrybCourse->find('list'));
			$this->set('university', $university_id);
		
    }

    public function admin_addm($university_id) {
        if ($this->request->is('post')) {
			$university_id = $this->request->data['CourseonUniversity']['university_id'];
			$kierunki = $this->request->data['CourseonUniversity']['course_id'];
			foreach ($kierunki as $kierunek) {
				$this->CourseonUniversity->create();
				if ($this->CourseonUniversity->save(array('CourseonUniversity'=> array('university_id' => $university_id, 'course_id'=>$kierunek,
																'typ_course_id' => 0, 
												'tryb_course_id' => 0,
												'cena' => 0,
												'srednia' => 0)))) {
					$this->Session->setFlash(__('Kierunek uczelni został utworzony'));
				} else {
					$this->Session->setFlash(__('The user could not be created. Please, try again.'));
				}   
			}
			$this->redirect(array('action' => 'lista', $university_id));
        } 
		
			$this->set('courses', $this->CourseonUniversity->Course->find('list', array(
					'order' => array('nazwa'))));
			$this->set('university', $university_id);
		
    }
}