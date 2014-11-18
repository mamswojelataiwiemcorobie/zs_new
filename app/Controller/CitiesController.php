<?php
App::uses('Controller', 'Controller');

class CitiesController extends AppController {  
	public $actsAs = array('Containable');
	public $components = array('DataTable');
	
	public function index() {
	
		$this->set('title_for_layout', 'Ranking miast');
		$this->set('description_for_layout', 'Ranking miast. Najlepsze miasta do studiowania.');
		$this->set('keywords_for_layout', 'miasta, miejscowości, ranking');
		$this->set('tabele', true);

		if($this->RequestHandler->responseType() == 'json') {
			$this->paginate = array(
				'order' => array('City.rank' => 'asc'),
				'contain' => false,
				'fields' => array('City.rank','City.photo','City.nazwa', 'City.pokoj_miejsce','City.pokoj', 'City.bilet', 'City.bilet_m', 'City.bilet_m', 'City.obiad', 'City.bezrobocie', 'City.studenci', 'City.placa', 'City.srednia','City.id'),
				'conditions' => array('City.srednia >'=>0)
			);
			$this->DataTable->emptyElements = 1;
			$this->set('cities', $this->DataTable->getResponse());
			$this->set('_serialize','cities');
		}
	}
	
	public function view($id = null) {
		$this->set('mapy', true);
		
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$city = $this->City->findById($id);
		$this->set('title_for_layout', $city['City']['nazwa'].'Porównywarka uczelni');
		$this->set('description_for_layout', $city['City']['nazwa'].' - Najlepsze miasto do studiowania.');
		$this->set('keywords_for_layout', $city['City']['nazwa'].', miasta, miejscowości, ranking');
		//Debugger::dump($city);
		if (!$city) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('city', $city);

		$this->set('title_for_slider2', 'Ranking miast');
	}
	public function getll(){


		function getCoordinates($address){
		    $address = urlencode($address);
		    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
		    $response = file_get_contents($url);
		    $json = json_decode($response,true);
		 
		    $lat = $json['results'][0]['geometry']['location']['lat'];
		    $lng = $json['results'][0]['geometry']['location']['lng'];
		 
		    return array($lat, $lng);
		}
		//$coords = getCoordinates("kraków");
		//print_r($coords);

		echo '<br><br><br><br><br><br><br><br>';

		$cities = array('Warszawa', 'Kraków', 'Kielce');
		foreach ($cities as $key => $value) {
			$coords = getCoordinates($value);
			echo '<br>';
			print_r($coords);
			echo $lat = $coords[0];
			echo $lng = $coords[1];

			$this->City->id = 1;
			$this->City->saveField('lat', $lat);
			$this->City->saveField('lng', $lng);
		}

		$city_ids = $this->City->find('list', array('conditions' => array('NOT' => array('City.srednia' => 0)), 'order' => array('id' => 'ASC'), 'fields'=>array('City.id', 'City.nazwa')));
			pr($city_ids);
			foreach ($city_ids as $city_id => $city) {
				$coords = getCoordinates($city);
				echo $city;
				echo ' | ';
				echo $lat = $coords[0];
				echo ' | ';
				echo $lng = $coords[1];
				echo '<br>';

				$this->City->id = $city_id;
				$this->City->saveField('lat', $lat);
				$this->City->saveField('lng', $lng);
			}
	}

	public function top() {
		$cities = $this->City->find('all', array(
												'order' => array('City.srednia' => 'desc'),
												'limit' => 5));
		if (!empty($this -> request -> params['requested'])) {
		   return $cities;
		}else {
			$this->set('cities', $cities);
		}
	}
	
	/*public function srednia() {
		//wartosci wspólczynników wagi:
		//wpom- ceny miejsca w pokoju, wbm - ceny biletu misięcznego, ws-liczby studentów
		$wpom=4;
		$wpo=3;
		$wb=2;
		$wbm=2;
		$wo=2;
		$wbe=4;
		$ws=2;
		$wp=5;
		$sum = $wpom + $wpo + $wb + $wbm + $wo + $wbe + $ws + $wp;
		$cities = $this->City->find('all'); 
		foreach ($cities as $city) {
		if ($city['City']['bilet_m'] != 0 && $city['City']['bilet_m'] != "0" ){
			echo $city['City']['nazwa'];
			$srednias= ((1/$city['City']['bilet_m'])*$wpom)+((1/$city['City']['pokoj'])*$wpo)+((1/$city['City']['bilet'])*$wb)+((1/$city['City']['bilet_m'])*$wbm)+((1/$city['City']['obiad'])*$wo)+((1/$city['City']['bezrobocie'])*$wbe)+(($city['City']['studenci']/10000)*$ws)+($city['City']['placa']*$wp);
			
			$srednia= $srednias/ $sum;
			$this->City->updateAll( 
						array( 'City.srednia' => $srednia), 
						array( 'City.id' => $city['City']['id']));
		}}
		$srednie = $this->City->find('all', array ('fields' => array('City.nazwa', 'City.srednia'),
															'order' => array('City.srednia' => 'desc')));
		$this->set('cities', $srednie);
	}*/
	public function ord() {
		
		$cities = $this->City->find('all',array ('fields' => array('City.nazwa', 'City.srednia'),'order' => array('City.srednia' => 'desc')));
		$i=0;
		foreach ($cities as $city) {
			echo $i=$i + 1;
			echo $city['City']['nazwa'];
			echo $city['City']['srednia'].'<br>';
			$this->City->updateAll( 
						array( 'City.rank' => $i), 
						array( 'City.id' => $city['City']['id']));
		}
	}

	public function plgn(){
		$this->Rank = ClassRegistry::init('Rank');
		$PartArray = $this->Rank->find('all');
		pr($PartArray);
	}
	
	/***ADMIN***/
	function admin_search() {
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
                    'LOWER(City.nazwa) LIKE' => "%$keywords%",
                )
         );
        } else { 
			$this->paginate = array(
				'limit' => 30,
				'order' => array('City.nazwa' => 'asc' ),
				'contain' => array()
			);
		}
        $universities = $this->paginate('City');
		//Debugger::dump($universities);
        $this->set('universities', $universities);
	}
	
	public function admin_edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }
            $university = $this->City->findById($id);

			//Debugger::dump($university);
			
            if ($this->request->is('post') || $this->request->is('put')) {
				//Debugger::dump($this->request->data);
                $filename = strtotime('now');
				$photo = $this->request->data['City']['photo'];
				
				
				$path = "/img/miasta/";
				$dir = getcwd().$path;
				
				if (empty($this->request->data['City']['photo']['name'])) {
					unset($this->request->data['City']['photo']);
				} else {
					if (in_array($photo['type'], array('image/jpeg','image/pjpeg','image/png'))) {				
						$img = $this->resize_image($photo, 255, 422);
						$photoFile = "$dir$id.png";
						imagepng($img, $photoFile);	
						$this->request->data['City']['photo'] = $id.'.png';				
					} else {
						$this->City->invalidate('avatar', __("Only JPG or PNG accepted.",true));
					}
				}
				//unlink($photo['tmp_name']); 
				
				///liczymy srednia

                if ($this->City->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('Nie udało sie edytować miasta.'));
                }
            } 
           
            $this->request->data = $university;
    }
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$filename = strtotime('now');
			$photo = $this->request->data['City']['photo'];
			
			$path = "/img/miasta/";
			$dir = getcwd().$path;
			
			if (empty($this->request->data['City']['photo']['name'])) {
				unset($this->request->data['City']['photo']);
				$this->City->create();
			} else {
				if (in_array($photo['type'], array('image/jpeg','image/pjpeg','image/png'))) {

					$img = $this->resize_image($photo, 255, 422);
					$this->City->create();
					$id = $this->City->id;
					$photoFile = "$dir$id.png";
					imagepng($img, $photoFile);	
					$this->request->data['City']['photo'] = $id.'.png';			
				
				} else {
					$this->City->invalidate('avatar', __("Only JPG or PNG accepted.",true));
				}
			}
			
			$this->request->data['City']['srednia']= $this->City->srednia($this->request->data);
			
            if ($this->City->save($this->request->data)) {
				$this->City->rank();
                $this->Session->setFlash(__('Utworzono miasto'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
    }
	
	public function admin_delete($kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->City->delete(array('City.id' => $kierunek_id), false)) {
            $this->Session->setFlash(__('Uczelnia usunięta'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'index'));
    }
}
