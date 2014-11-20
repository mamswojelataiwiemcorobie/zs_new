<?php
App::uses('Controller', 'Controller');

class CoursesController extends AppController {	
	public $components = array('DataTable', 'Wordpress');
	
	public function index() {

		$this->set('title_for_layout', 'Ranking kierunków');
		$this->set('description_for_layout', 'Ranking kierunków. Najlepsze kierunki.');
		$this->set('keywords_for_layout', 'Kierunki, wydziały, specjalizacje, ranking');
		
		$this->set('tabele', true);

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('Course.srednia' => 'desc'),
				'contain' => array('CoursesType'),
				'fields' => array('Course.rank','Course.nazwa','CoursesType.nazwa', 'Course.zawod', 'Course.placa', 'Course.srednia', 'Course.id'),
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
		
		$this->Course->contain('CoursesType.nazwa', 'Profession.nazwa', 'Profession.placa');
		$course = $this->Course->findById($id);
		
		if (!$course) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('title_for_layout', $course['Course']['nazwa']);
		$this->set('title_for_slider2', 'Ranking kierunków');
		
		$db = $this->Course->query("SELECT DISTINCT University.id, University.nazwa, University.photo FROM universities AS University JOIN courseon_universities AS CourseonUniversity ON (CourseonUniversity.course_id = " .$id. " AND CourseonUniversity.university_id = University.id);");
		
		$this->set('course', $course);
		$this->set('u', $db);
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
		$wordpress_posts = Cache::read( 'wordpress_posts', 'long' );
			if ( $wordpress_posts === false ) {
				$this->Wordpress->limit = 1;
				$this->Wordpress->niceurls = true;
				$this->Wordpress->thumbnails = true;
				$wordpress_posts = $this->Wordpress->getLatest();
				Cache::write('wordpress_posts', $wordpress_posts, 'long');
			}
		$this->set('wordpress_posts', $wordpress_posts);
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
	
	public function srednia() {
		/*wartosci wspólczynników wp-placa*/
		$wp=5;
		$sum = $wp;
		$courses = $this->Course->find('all');	
		foreach ($courses as $course) {
			unset($c);
			$c=array();
			$srednias=0;
			foreach ($course['Profession'] as $profession) array_push($c,$profession['placa']);
			if (count($c)>0) {
				$srednias= array_sum($c)/count(array_filter($c));
				$sr=$srednias*$wp;
				$srednia= $sr/ $sum;
				$this->Course->updateAll(array('Course.srednia'=>$srednia), array('Course.id'=> $course['Course']['id']));
			}
		}
		$this->redirect(array('controller' => 'courses','action' => 'index'));
	}
	public function rank_old() {
		
		$cities = $this->Course->find('all',array ('fields' => array('Course.nazwa', 'Course.srednia'),'order' => array('Course.srednia' => 'desc')));
		$i=0;
		foreach ($cities as $city) {
			echo $i=$i + 1;
			echo $city['Course']['nazwa'];
			echo $city['Course']['srednia'].'<br>';
			$this->Course->updateAll( 
						array( 'Course.rank' => $i), 
						array( 'Course.id' => $city['Course']['id']));
		}
	}
	public function sxc() {
		$this->Profession = ClassRegistry::init('Profession');
		$this->ProfessionsCourse = ClassRegistry::init('ProfessionsCourse');

		$cities = $this->Course->find('list',array (
			'fields' => array('Course.nazwa', 'Course.id'),
			'conditions' => array('Course.rank > '=>'342'),
			'order' => array('Course.rank' => 'desc')));

		
		foreach ($cities as $key => $c_id) {
			$prof_ids = $this->ProfessionsCourse->find('list',array (
				'fields' => array('ProfessionsCourse.profession_id','ProfessionsCourse.course_id'),
				'conditions' => array('ProfessionsCourse.course_id' => $c_id)
				//'order' => array('ProfessionsCourse.profession_c_id' => 'asc')
			));
			$max_placa = 0;
			foreach ($prof_ids as $p_id => $cc_id) {
				$prof_n_p = $this->Profession->find('list',array (
					'fields' => array('Profession.nazwa','Profession.placa'),
					'conditions' => array('Profession.id' => $p_id)
					//'order' => array('ProfessionsCourse.profession_c_id' => 'asc')
				));
				$placa = reset($prof_n_p);
				if ($placa > $max_placa ) {
					$max_placa = $placa ;
					$max_placa_id = $p_id ;
				} 
				echo '<br>';
			}
				
			echo $max_placa;
			$max_prof_n_p = $this->Profession->find('list',array (
					'fields' => array('Profession.nazwa','Profession.placa'),
					'conditions' => array('Profession.id' => $max_placa_id)
					//'order' => array('ProfessionsCourse.profession_c_id' => 'asc')
				));
			pr($max_prof_n_p);
			echo '<br>';
			
			echo 'zawod:'. $z = key($max_prof_n_p) ;
			echo ' placa:'. $p = reset($max_prof_n_p);
			echo '<br>';

			$this->Course->id = $c_id;
			//$this->Course->saveField('courses_type_c_id', 'zawód' );
			$this->Course->saveField('zawod', $z);
			$this->Course->saveField('placa', $p );
			
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
	public function sredniacourses() {
		echo '<br><br><br><br><br><br><br><br>';
		$this->ProfessionsCourse = ClassRegistry::init('ProfessionsCourse');
		//$prof_ids = $this->ProfessionsCourse->find('list',array('fields'=>array('ProfessionsCourse.profession_id')));
		//pr($prof_ids);

		$list_ids = $this->Course->find('list', array ('order' => array('id' => 'ASC'), 'fields'=>array('Course.id')));
		
		$course_min = $this->Course->find('first' ,array ('fields' => array('MIN(Course.placa) as min_size'  )));//minimalna średnia płaca po kierunku
		$course_max = $this->Course->find('first' ,array ('fields' => array('MAX(Course.placa) as max_size'  )));//maksymalna średnia płaca po kierunku

		$MAX_il_prof = 0;
		foreach ($list_ids as $courses_id) {
			$il_prof = $this->ProfessionsCourse->find('count', array (
											'order' => array('ProfessionsCourse.course_id' => 'ASC'),
											'conditions' => array('ProfessionsCourse.course_id' => $courses_id), 
											'fields'=>array('ProfessionsCourse.profession_id')));
			if ($il_prof > $MAX_il_prof){
				$MAX_il_prof = $il_prof;//max ilość zawodów po kierunku
			}
		}
		echo '<br> maX:'.$MAX_il_prof.' : Max<br>'; 

		foreach ($list_ids as $courses_id) {

			echo '<br>'.$courses_id.' :: ';

			$il_prof = $this->ProfessionsCourse->find('count', array (
											'order' => array('ProfessionsCourse.course_id' => 'ASC'),
											'conditions' => array('ProfessionsCourse.course_id' => $courses_id), 
											'fields'=>array('ProfessionsCourse.profession_id')));
			//pr($prof_ids);
			echo ' | ';

			$course_czesne = $this->Course->find('first', array ('conditions' => array('Course.id' => $courses_id)));
			echo $course_czesne = $course_czesne['Course']['placa'].' | ';

			if ( (($course_max - $course_min) == 0) && (($MAX_il_prof) == 0)) {
				$srednia_kierunku = 0;
			}else{
				 $srednia_pensji_zawodow = (($course_czesne - $course_min) / ($course_max - $course_min)) * 10 ;
				
				echo $srednia_il_kierunków = ((($il_prof) / ($MAX_il_prof)) * 10 ) ;
				echo $waga_pensji_zawodow = 1;
				echo $waga_il_kierunków = 1;
				
				echo $srednia_kierunku = (( ($srednia_pensji_zawodow * $waga_pensji_zawodow) + ($srednia_il_kierunków * $waga_il_kierunków) )/($waga_pensji_zawodow + $waga_il_kierunków));
				echo ' ||';
			}

			$this->Course->id = $courses_id;
			$this->Course->saveField('srednia', $srednia_kierunku );

		}

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->Course->find('list', array (
										'fields' => array('Course.id','Course.srednia'),
										'order' => array('Course.srednia' => 'desc')));
		$i=0;
		//pr($PartArray);

		foreach ($PartArray as $id => $sr) {
			$i = $i + 1;
			echo $i . '<br>';
			$this->Course ->id = $id;
			$this->Course ->saveField('rank', $i);
		} 
	}
	public function rank_old1() {
		$Model = 'Course';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->$Model->find('all', array ('fields' => array($Model.'.id',$Model.'.srednia'),'order' => array($Model.'.srednia' => 'desc')));
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
	public function rank() {
		$Model = 'Course';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->$Model->find('list', array (
										'fields' => array($Model.'.id',$Model.'.srednia'),
										'order' => array($Model.'.srednia' => 'desc')));
		$i=0;
		//pr($PartArray);

		foreach ($PartArray as $id => $sr) {
			echo $i = $i + 1;
			echo $i . '<br>';
			$this->$Model ->id = $id;
			$this->$Model ->saveField('rank', $i);
		}    
	}
	public function prof_placa_check(){
		$this->Profession = ClassRegistry::init('Profession');
			$placa_prof = $this->Profession->find('list', array('fields'=>array('Profession.placa', 'Profession.nazwa')));
			pr($placa_prof);
			$placa_Course = $this->Course->find('list', array('fields'=>array('Course.placa', 'Course.zawod')));
			pr($placa_Course);

			$this-> set ('placa_prof', $placa_prof);
			$this-> set ('placa_Course', $placa_Course);
	}
	public function prof_cours(){
		$this->ProfessionsCourse = ClassRegistry::init('ProfessionsCourse');
		$this->Profession = ClassRegistry::init('Profession');
		/*
		$placa_prof = $this->ProfessionsCourse->find('list', array('fields'=>array('ProfessionsCourse.profession_id', 'ProfessionsCourse.course_id',  'ProfessionsCourse.id' )));
		foreach ($placa_prof as $id => $prof_cours) {
			echo 'id:';
			echo $id;
			echo ' | ';
			//pr($id);
			echo 'prof_cours:';
		
			//pr($prof_cours);
			echo $prof_id = key($prof_cours);
			echo ' | ';
			echo $cours_id = reset($prof_cours);
			echo '<br>';
		}
		*/
		$a = $this->ProfessionsCourse->find('list', array('order' => array('ProfessionsCourse.course_id' => 'asc'), 'fields'=>array(  'ProfessionsCourse.id', 'ProfessionsCourse.profession_id', 'ProfessionsCourse.course_id')));
		//pr($a);
		foreach ($a as $cours => $prof_id) {
			$pensja = 0;
			$pensjaA = 0;
			$i = 0;
			foreach($prof_id as $id => $prof) {
				echo 'cours:';
				echo $cours;
				echo ' | ';
				//pr($id);
				echo 'id:';
			
				//pr($prof_cours);
				echo $id ;
				echo ' | prof:';
				echo $prof ;
				echo ' | ';
				$proff = $this->Profession->find('list', array(
					'order' => array('Profession.id' => 'asc'), 
					'fields'=>array( 'Profession.placa'),
					'conditions' => array('Profession.id' => $prof)
				));
				//pr($proff);
				echo $pensja = reset($proff);
				echo '<br>';
				//pr($proff);
				$pensjaA = $pensjaA + $pensja;
				$i = $i + 1;
			}
			echo round($pensjaA/$i, -1);
			echo '<br>';
		}
	}
	
	public function admin_index() {
		$this->paginate = array(
            'limit' => 60,
            'order' => array('Course.nazwa' => 'asc' ),
			'contain' => array('CoursesType')
        );
        $courses = $this->paginate('Course');
		//Debugger::dump($courses);
        $this->set('courses', $courses);
	}
	
	public function admin_add() {
		Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('Utworzono kierunek'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
		$this->set('coursesTypes', $this->Course->CoursesType->find('list'));
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
			if(empty($this->request->data['Course']['srednia'])) {
				$this->request->data['Course']['srednia'] = $this->Course->srednia($id);
			}
			$this->Course->id = $id;
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $course;
		}
		
		$this->set('coursesTypes', $this->Course->CoursesType->find('list'));
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