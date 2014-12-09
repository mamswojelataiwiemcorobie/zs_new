<?php
App::uses('AppController', 'Controller');

class UniversitiesController extends AppController {
	public $helpers = array('Cache');
	public $components = array('Paginator');
	public $cacheAction = array(
	    'view' => 36000,
	    'index'  => 48000
	);
	//public $components = array('DataTable');

	public $paginate = array(
        'limit' => 5,
    );

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
            $keywords = mb_strtolower($this->request->query['keywords'], 'UTF-8');
            $keywords = explode(' ', $keywords);
			Debugger::dump($keywords);
			foreach ($keywords as $keyword) {
						$conditions['and'][] = array('University.university_type_id LIKE' => "%$keyword%");
					    $conditions['or'][] = array('Course.nazwa LIKE' => "%$keyword%");
					    $conditions['or'][] = array('University.nazwa LIKE' => "%$keyword%");
					    $conditions['or'][] = array('UniversitiesParameter.miasto LIKE' => "%$keyword%");
					}
			$this->Paginator->settings = array(
		        'conditions' => array(
		        	'University.university_type_id' => $tid,
		        	
		        	'Course.nazwa LIKE' => "%$keywords%",
		        	"OR" => array(
				        'LOWER(University.nazwa) LIKE' => "%$keywords%",
				        'LOWER(UniversitiesParameter.miasto) LIKE' => "%$keywords%",
				    )),
				'order' => array('University.abonament'=> 'desc', 'UniversityParameter.nazwa' => 'asc' ),
				'limit' => 5,
				'contain' => array('UniversitiesParameter', 'UniversitiesPhoto')
		    );
        } else { 
			$this->Paginator->settings = array(
		        'conditions' => array('University.university_type_id' => $tid),
				'order' => array('University.abonament'=> 'desc', 'UniversityParameter.nazwa' => 'asc' ),
				'limit' => 5,
				'contain' => array('UniversitiesParameter.miasto', 'UniversitiesParameter.www', 'UniversitiesParameter.adres', 'UniversitiesParameter.email', 'UniversitiesParameter.telefon', 'UniversitiesParameter.opis', 'UniversityType', 'UniversitiesPhoto')
		    );
		}
        $data = $this->paginate('University');
		//Debugger::dump($data);
        


		//$this->request->query['page'];


/*		$_req = isset($_GET) ? $_GET : array();
		if (isset($_req['slowo']) && $_req['slowo'] === 'SŁOWO KLUCZOWE') $_req['slowo'] = '';
		if (isset($_req['miasto']) && $_req['miasto'] === 'MIASTO') $_req['miasto'] = '';
		if (isset($_req['kierunek']) && $_req['kierunek'] === 'KIERUNEK') $_req['kierunek'] = '';
		if (isset($_req['jezyk']) && $_req['jezyk'] === 'JĘZYK') $_req['jezyk'] = '';

		$form_structure = array(
			array('slowo','.*',''),
			array('kierunek','(^[0-9]+$)|(^$)',''),
			array('kierunek_id','(^[0-9]+$)|(^$)',''),
			array('id_wojewodztwo','(^[0-9]+$)|(^$)',''),
			array('miasto','(^[0-9]+$)|(^$)',''),
			array('id_typ','(^[0-9]+$)|(^$)',''),
			array('id_tryb','(^[0-9]+$)|(^$)',''),
			array('jezyk','(^[0-9]+$)|(^$)',''),
			array('jezyk_id','(^[0-9]+$)|(^$)',''),
			array('rodzaj','.+',''),
		);
		
		$sf = $this->get_form_data($form_structure,$_req);
		if (!empty($sf) && $tid !== 4) $sf['rodzaj'] = $tid;
		if (!empty($sf['kierunek_id'])) { //$sf['kierunek'] = '';
		} else {$sf['kierunek_id']='';}

		//if (isset($_req['slowo'])) {
			$pp = $this->University->szukajUczelniQuery($sf);
			//Debugger::dump($pp);
			
			$this->Paginator->settings = array(
		        'conditions' => $pp,		        
		        'order' => array('University.abonament' => 'desc', 'University.nazwa' => 'asc'),
		        'limit' => 5,
		        'joins' => array(
		            array(
		                'table' => 'courseon_universities',
		                'alias' => 'CourseonUniversity',
		                'conditions'=> array('University.id = CourseonUniversity.university_id')
		            ),array(
		                'table' => 'courses',
		                'alias' => 'Course',
		                'conditions'=> array('CourseonUniversity.course_id = course.id')
		            )
		        ),
    			'group' => 'University.id'
		        //'contain' => array('UniversitiesParameter', 'UniversitiesPhoto', 'CourseonUniversity')
		    );
		    $data = $this->Paginator->paginate('University');

		   //Debugger::dump($data);*/


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

	public function srednia() {
		/*wartosci wspólczynników dla m-miasta r-ranking perspektyw*/
		$wm=3;
		$wr=6;
		
		$sum = $wm+$wr;
		$this->University->contain('City');
		$universities = $this->University->find('all');	
		foreach ($universities as $university) {
			if ($university['University']['ranking'] != 0) {
				$srednias= (($university['City']['srednia'])/100*$wm)+((1/$university['University']['ranking'])*$wr);
			} else $srednias= (($university['City']['srednia'])/100*$wm);
			
			$srednia = $srednias/ $sum;
			
			if ($university['University']['pakiet'] = 1) {
				$srednia = $srednia + 100 - $university['University']['waga_pakietu'];
				//$session->setFlash("message");
			}
			$this->University->updateAll( 
										array( 'University.srednia' => $srednia), 
										array( 'University.id' => $university['University']['id']));
			
		}
		$this->redirect(array('action' => 'index'));
	}
	public function order() {
		$x = $this->University->find('all',array ('fields' => array('University.nazwa', 'University.srednia'),'order' => array('University.srednia' => 'desc')));
		$i=0;
		foreach ($x as $University) {
			echo $i=$i + 1;
			echo $University['University']['nazwa'];
			echo $University['University']['srednia'].'<br>';

			

			$this->University->updateAll( 
						array( 'University.sortx' => $i), 
						array( 'University.id' => $University['University']['id']));
		}
	}
	public function srednia2() {
				
				
		$universities = $this->University->find('all');	
		//$session->setFlash("ddd");
		
		foreach ($universities as $university) {
		echo $university['University']['pakiet'];
		echo $university['University']['PAKIET'];
		echo $university['University']['Pakiet'];
		echo $university['University']['srednia']."<br>";
		/*	
				
			if ($university['University']['pakiet'] = 1 or $university['University']['pakiet'] =  "1") {
				$srednia = $university['University']['srednia'] - 2100 - $university['University']['waga_pakietu'];
			
			$this->University->updateAll( 
										array( 'University.srednia' => $srednia), 
										array( 'University.id' => $university['University']['id']));
			}
		}
		$this->redirect(array('action' => 'index'));
		*/}
	}
	public function q() {
		$w = 9;
		//$session->setFlash("message");
		//print $session->flash("flash", );
		//echo "ddd";
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

	public function promoxxx(){
		//$unv = $this->University->find('count');
		//$unv = $this->University->find('first', array('fields' => array('University.nazwa', 'University.srednia')));
		//$unv = $this->University->find('list', array('fields' => array('University.srednia','University.promonr', 'University.id' ),'order' => array('University.srednia' => 'desc','University.srednia' => 'asc')));
		
		//copy to ABONAMENT srednia
		$unv1 = $this->University->find('list', 
			array(
				'fields' => array('University.id','University.srednia','University.ABONAMENT'),
				'order' => array('University.srednia' => 'desc'), 
			)
		);

		foreach($unv1 as $abo => $unv2){
			foreach($unv2 as $id => $sr){

				$this->University->id = $id; 
				$this->University->saveField('ABONAMENT_srednia', $sr);
			}
		}

		//updating ABONAMENT srednia
		$unv1 = $this->University->find('list', 
			array(
				'fields' => array('University.id','University.srednia','University.ABONAMENT'),
				'order' => array('University.ABONAMENT' => 'desc'), 
				'conditions' => array('NOT' => array('University.ABONAMENT' => array(0, 4, 5)))
			)
		);

		foreach($unv1 as $abo => $unv2){
			foreach($unv2 as $id => $sr){

				$ABONAMENT_srednia = $abo * $sr/10;
				$this->University->id = $id; 
				$this->University->saveField('ABONAMENT_srednia', $ABONAMENT_srednia);
			}
		}
		
		$this->set('unv1',$unv1);

		//make ABONAMENT rank
		$unv3 = $this->University->find('list', 
			array(
				'fields' => array('University.id','University.ABONAMENT_srednia'),
				'order' => array('University.ABONAMENT_srednia' => 'desc'), 
			)
		);
		$this->set('unv3',$unv3);

		$i=0;
		foreach($unv3 as $id => $ABONAMENT_srednia){
				$i++;
				$this->University->id = $id; 
				$this->University->saveField('ABONAMENT_rank', $i);
		}
	}
	public function sredniauniversities() {
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 12;
				$this->Rank->saveField('weight_value', 0);
				$start =  date("d-m-Y h:i:s");
				$this->Rank->saveField('start', $start);
				$this->Rank->saveField('end', 'not ready');

				$wag_miasto = $wagi[8]['Rank']['weight_value'];
				$wag_kier = $wagi[9]['Rank']['weight_value'];
				$wag_il_kier = 5;	

		echo '<br><br><br><br><br><br><br><br>';

		$this->Course = ClassRegistry::init('Course');
		$this->CourseonUniversity = ClassRegistry::init('CourseonUniversity');
		$this->City = ClassRegistry::init('City');

		$LIST_IDs = $this->University->find('list', array( 'order' => array('id' => 'ASC'), 'fields'=>array('University.id', )));
		
		$MAX_il_kierunkow = 0;
		foreach ($LIST_IDs as $ID) {
			$university_id = $ID;
			//echo " | ";
			$LISTA_KIERUNKI = $this->CourseonUniversity->find('list', array('conditions' => array('CourseonUniversity.university_id' => $university_id ), 'fields' => array('CourseonUniversity.course_id')));
			$i = 0; 
			$suma = 0;
			foreach ($LISTA_KIERUNKI as $key => $kierunek) {
				$i = $i + 1;
				//echo $i." | ";
			}
			if ($MAX_il_kierunkow < $i ){
				$MAX_il_kierunkow = $i;
			}
			//echo "<br>";
			//echo "<br>";
		}
		echo 'MAX_il_kierunkow:  '.$MAX_il_kierunkow;
		echo "<br>";
		echo "<br>";

		$LIST_IDs = $this->University->find('list', array( 'order' => array('id' => 'ASC'), 'fields'=>array('University.id', )));
		foreach ($LIST_IDs as $ID) {
		$university_id = $ID;
			echo '{{{ '.$university_id. ' [ '; 


			$LISTA_KIERUNKI = $this->CourseonUniversity->find('list', array('conditions' => array('CourseonUniversity.university_id' => $university_id ), 'fields' => array('CourseonUniversity.course_id')));
			//pr($LISTA_KIERUNKI);
			$i = 0;
			$suma = 0;
			foreach ($LISTA_KIERUNKI as $key => $kierunek) {
				
				echo ' $';
				$i = $i + 1;
				echo $i." | ";
				$sr_placa = $this->Course->find('list', array('conditions' => array('Course.id' => $kierunek), 'fields' => array('Course.srednia')));
				//pr($sr_placa);
				foreach ($sr_placa as $key => $sr_new) {
					if (isset($sr_placa)){
						echo $sr_placa = $sr_new;
						$suma = $suma + $sr_placa;
					}else{
						//pr($placa);
						//echo $sr_placa = $sr_placa[0]['Course']['srednia'];
						echo 'nie ma tego kierunku';
					}
				}
			}
			echo '] ';
			if ($i==0){
				echo '!!!!!!!!!!!!!'.$suma;
				echo $sr_kier = 0;
				echo " | ";
				echo $sr_il_kier = 0;
			}else{
				echo $sr_kier = $suma/$i;
				echo " | ";
				echo $sr_il_kier = (($i/( $MAX_il_kierunkow - 1 )) * 10);

			}
			echo'}{';

			$CITY_OF_UNI = $this->University->find('first', array('conditions' => array('University.id' => $university_id ), 'fields'=>array('University.city_id', )));
			//pr($CITY_OF_UNI);
			echo  $city_id = $CITY_OF_UNI['University']['city_id'].' | ';

			$LIST_MIASTA = $this->City->find('list', array('conditions' => array('City.id' => $city_id ), 'fields' => array('City.srednia', 'City.nazwa')));
			//pr($LIST_MIASTA);
			foreach ($LIST_MIASTA as $sr_miasto => $miasto) {
				echo $miasto;
				echo $sr_miasto;
			}
			
			echo'}{';

			if (($wag_kier + $wag_miasto) == 0 ){
				echo $sr_uni = 0;
			}else{
				echo $sr_uni = ($sr_kier * $wag_kier + $sr_il_kier * $wag_il_kier + $sr_miasto * $wag_miasto) / ($wag_kier + $wag_miasto);
			}
			

			$this->University->id = $ID;
			$this->University->saveField('srednia', $sr_uni);
			$this->Rank->saveField('weight_value', 1);
			$end =  date("d-m-Y h:i:s");  
			$this->Rank->saveField('end', $end);
			$duration = (strtotime($end) - strtotime($start));
			$this->Rank->saveField('duration', $duration);

			//abo
		}
		$this->Rank->id = 12;
		$this->Rank->saveField('weight_value', 1);
	}
	public function abonament() {
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 13;
				$this->Rank->saveField('weight_value', 0);
				$start =  date("d-m-Y h:i:s");
				$this->Rank->saveField('start', $start);

		$LIST_IDs = $this->University->find('list', array ('order' => array('id' => 'ASC'), 'fields'=>array('University.id', )));
		foreach ($LIST_IDs as $ID) {
			$university_id = $ID;

			$SREDNIA = $this->University->find('first', array('conditions' => array('University.id' => $university_id ), 'fields'=>array('University.srednia', )));
			echo $sr_uni = $SREDNIA['University']['srednia'];

			$ABONAMENT = $this->University->find('first', array('conditions' => array('University.id' => $university_id ), 'fields'=>array('University.ABONAMENT', )));
			echo $abo = $ABONAMENT['University']['ABONAMENT'];
			switch ($abo) {
			   case "standard":
				 $sr_uni = ($sr_uni + 100);
				 break;
			   case "premium":
				 $sr_uni = ($sr_uni + 200);
				 break;
			   case "gold":
				 $sr_uni = ($sr_uni + 300);
				 break;
			   default:
				 $sr_uni = $sr_uni;
			}
			$this->University->id = $ID;
			$this->University->saveField('ABONAMENT_srednia', $sr_uni );

		}
		$this->Rank->id = 13;
		$this->Rank->saveField('weight_value', 1);
		$end =  date("d-m-Y h:i:s");  
		$this->Rank->saveField('end', $end);
		$duration = (strtotime($end) - strtotime($start));
		$this->Rank->saveField('duration', $duration);

	}
	public function rank() {
		///$this->Rank = ClassRegistry::init('Rank');
		//	$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
		//		$this->Rank->id = 14;
		//        $this->Rank->saveField('weight_value', 0);

		$Model = 'University';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'id | srednia | rank<br>';
		$PartArray = $this->$Model->find('list', array ('fields' => array($Model.'.id',$Model.'.srednia'),'order' => array($Model.'.srednia' => 'desc')));
		pr($PartArray);
		//$this->Rank->id = 14;
		//$this->Rank->saveField('weight_value', 1);    
	}
	public function rank_with_abo() {
		$Model = 'University';
		$PartArray = $this->$Model->find('list', array(
			'fields' => array($Model.'.id',$Model.'.ABONAMENT_srednia'),
			'order' => array($Model.'.ABONAMENT_srednia' => 'desc')));
		$i = 0;
		foreach ($PartArray as $id => $ABONAMENT_srednia) {
			$i = $i + 1;
			echo $id.' | '.$ABONAMENT_srednia.'<br>';

			$this->$Model->id = $id;
			$this->$Model->saveField('rank', $i);

		}

	}
		public function rank_rank() {
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 14;
				$this->Rank->saveField('weight_value', 0);
				$start = date("d-m-Y h:i:s");
				$this->Rank->saveField('start', $start);

		$Model = 'University';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'nr | id | srednia | rank<br>';
		$PartArray1 = $this->$Model->find('list', array ('fields' => array($Model.'.id',$Model.'.srednia'),'order' => array($Model.'.srednia' => 'desc')));
		foreach ($PartArray1 as $id1 => $srednia1) {

			$this->$Model->id = $id1;
			$this->$Model->saveField('rank', $id1/1100);
		}
		$PartArray = $this->$Model->find('list', array ('fields' => array($Model.'.id',$Model.'.srednia'),'order' => array($Model.'.srednia' => 'desc')));
		$i=0;
		foreach ($PartArray as $id => $srednia) {
		
			echo $i = ($i + 1).' | ';
			echo $id.' | ';
			echo $srednia.' | ';
			echo $i . '<br>';
			$this->$Model->id = $id;
			$this->$Model->saveField('rank', $i);
		} 
				$this->Rank->id = 14;
				$this->Rank->saveField('weight_value', 1);
				$end =  date("d-m-Y h:i:s");  
				$this->Rank->saveField('end', $end);
				$duration = (strtotime($end) - strtotime($start));
				$this->Rank->saveField('duration', $duration);
	}

	public function rank_abo() {
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 14;
				$this->Rank->saveField('weight_value', 0);
				$start = date("d-m-Y h:i:s");
				$this->Rank->saveField('start', $start);

		$Model = 'University';

		echo '<br><br><br><br><br><br><br><br>';
		echo 'nr | id | ABONAMENT_srednia | rank<br>';
		$PartArray1 = $this->$Model->find('list', array ('fields' => array($Model.'.id',$Model.'.ABONAMENT_srednia'),'order' => array($Model.'.ABONAMENT_srednia' => 'desc')));
		foreach ($PartArray1 as $id1 => $ABONAMENT_srednia1) {

			$this->$Model->id = $id1;
			$this->$Model->saveField('rank', $id1/1100);
		}
		$PartArray = $this->$Model->find('list', array ('fields' => array($Model.'.id',$Model.'.ABONAMENT_srednia'),'order' => array($Model.'.ABONAMENT_srednia' => 'desc')));
		$i=0;
		foreach ($PartArray as $id => $ABONAMENT_srednia) {
		
			echo $i = ($i + 1).' | ';
			echo $id.' | ';
			echo $ABONAMENT_srednia.' | ';
			echo $i . '<br>';
			$this->$Model->id = $id;
			$this->$Model->saveField('rank', $i);
		} 
				$this->Rank->id = 14;
				$this->Rank->saveField('weight_value', 1);
				$end =  date("d-m-Y h:i:s");  
				$this->Rank->saveField('end', $end);
				$duration = (strtotime($end) - strtotime($start));
				$this->Rank->saveField('duration', $duration);
	}
	public function time() {
		echo '<br><br><br><br><br><br><br><br>';
		echo date("d-m-Y h:i:s");echo '<br>';
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 19;
				$this->Rank->saveField('weight_value', 202);
				$this->Rank->id = 19;
				$this->Rank->saveField('start', date("d-m-Y h:i:s"));

		$this->requestAction('cities/time');
		echo date("d-m-Y h:i:s");echo '<br>';
		$this->requestAction('cities/time2');
		echo date("d-m-Y h:i:s");echo '<br>';

		/*
		echo $ready1 = $wagi[15]['Rank']['weight_value'];
		echo '<br>';
		echo $ready2 = $wagi[16]['Rank']['weight_value'];
		

		do {

		   echo $ready1 = $wagi[15]['Rank']['weight_value'];
		   echo ' | ';
		   echo date("d-m-Y h:i:s");
		   echo '<br>';
		   sleep(1);
		} while ($ready1 = 1);
	
		*/

				$this->Rank->id = 19;
				$this->Rank->saveField('weight_value', 1);
				$this->Rank->id = 19;
				$this->Rank->saveField('end', date("d-m-Y h:i:s"));
				

	}
	public function auctualisation(){
		$this->Rank = ClassRegistry::init('Rank');
			$wagi = $this->Rank->find('all', array('fields'=>array('Rank.weight_value')));
				$this->Rank->id = 20;
				$this->Rank->saveField('weight_value', 0);
				$start = date("d-m-Y h:i:s");
				$this->Rank->saveField('start', $start);

				for ($i=11; $i <= 15; $i++) { 
					$nr = 'not ready';
					$this->Rank->id = $i;
					$this->Rank->saveField('weight_value', $nr);
					$this->Rank->saveField('start', $nr);
					$this->Rank->saveField('end', $nr);
					$this->Rank->saveField('duration', $nr);
				}
					$this->Rank->id = 20;
					$this->Rank->saveField('end', $nr);
					$this->Rank->saveField('duration', $nr);

				
				$this->Rank->id = 12;
				$this->Rank->id = 13;
				$this->Rank->id = 14;
				$this->Rank->id = 15;


			$this->requestAction('cities/sredniacities');
			$this->requestAction('universities/sredniauniversities');
			$this->requestAction('universities/abonament');
			//$this->requestAction('universities/rank');
			$this->requestAction('universities/rank_abo');
			$this->requestAction('cities/rank');
		
				$this->Rank->id = 20;
				$this->Rank->saveField('weight_value', 1);
				$end =  date("d-m-Y h:i:s");  
				$this->Rank->saveField('end', $end);
				$duration = (strtotime($end) - strtotime($start));
				$this->Rank->saveField('duration', $duration);
	}
	public function update_all_courses_name(){
				echo '<br><br><br><br><br><br><br><br>';
		$this->Course = ClassRegistry::init('Course');
		$this->CourseonUniversity = ClassRegistry::init('CourseonUniversity');
		$this->City = ClassRegistry::init('City');

		$LIST_IDs = $this->University->find('list', array( 'order' => array('id' => 'ASC'), 'fields'=>array('University.id', )));
		
		$MAX_il_kierunkow = 0;
		foreach ($LIST_IDs as $ID) {
			echo $university_id = $ID;
			echo " | ";
			$LISTA_KIERUNKI = $this->CourseonUniversity->find('list', array('conditions' => array('CourseonUniversity.university_id' => $university_id ), 'fields' => array('CourseonUniversity.course_id')));
			$i = 0; 
			$suma = 0;
			$kier = array();
			$lista_kier = "";
			foreach ($LISTA_KIERUNKI as $key => $kierunek) {
				$i = $i + 1;
				//echo $kierunek." | ";
				if (in_array($kierunek, $kier)){
				}else{
					array_push($kier, $kierunek);
					

					$nazwy_kier = $this->Course->find('list', array(
						'conditions' => array('Course.id' => $kierunek ), 
						'fields' => array('Course.nazwa')));
					echo pr($nazwy_kier);
					echo " |k ";
					echo  $kierunek;
					echo " | ";
					echo $nazwy_kier[$kierunek];
					echo " | ";
					echo $lista_kier = $lista_kier.$nazwy_kier[$kierunek].', ';
					//echo '<br>'.$nazwy_kier[$kierunek].', ';
				}
				
			
			}
			echo 'v'.$lista_kier;
			$this->University->id = $university_id;
			$this->University->saveField('all_courses_names', $lista_kier);
			//pr($kier);
				echo "<br>";
				echo "<br>";
		}
	}
	public function nazwy(){
		$this->University->contain('UniversitiesParameter.nazwa');
		$universities = $this->University->find('all');
		//Debugger::dump($universities);
		foreach($universities as $uni) {
			if ($uni['University']['nazwa'] == $uni['UniversitiesParameter']['nazwa']) {

			} else {
				$this->University->id = $uni['University']['id'];
				$this->University->saveField('nazwa', $uni['UniversitiesParameter']['nazwa']);
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