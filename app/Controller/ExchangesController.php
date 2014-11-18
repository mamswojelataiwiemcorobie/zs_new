<?php
App::uses('Controller', 'Controller');

class ExchangesController extends AppController {	
	
	public function index() {		
		$uczelnie_erasmus = "Wybierz Kraj, do którego chcesz wyjechać na Erazmusa";

		$this->set('title_for_layout', 'Gdzie na Erasmusa?');
		$this->set('description_for_layout', 'Gdzie na Erasmusa? Najlepsze miasta do studiowania za granicą  w ramach projektu Erasmus.');
		$this->set('keywords_for_layout', 'erasmus, kraj, miasta, uczelnia,');

		$kraje = $this-> Exchange-> find ('list', array(
			'fields' => array('Exchange.kraj', 'Exchange.kraj'),
			'group' => array('Exchange.kraj')
			));
		$this-> set ('kraje_v', $kraje);
		$this-> set ('uczelnie_erasmus', $uczelnie_erasmus);	
	}
	
	public function uczelnie_erasmus() {	
		$dane= $this->request->data;
		$uczelnie_erasmus = "Wybierz Kraj, do którego chcesz wyjechać na Erazmusa";
			if (isset($dane['Exchange']['uczelnia'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.nazwa_uczelni' => $dane['Exchange']['uczelnia'] )));
			} else if (isset($dane['Exchange']['miasto'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.miasto' => $dane['Exchange']['miasto'] )));
			
			} else if (isset($dane['Exchange']['kraj'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.kraj' => $dane['Exchange']['kraj'] )));
			} 
		$this-> set ('uczelnie_erasmus', $uczelnie_erasmus);
	}
	public function slider_exchanges() {	
		$dane= $this->request->data;
		$uczelnie_erasmus = "Wybierz Kraj, do którego chcesz wyjechać na Erazmusa";
			if (isset($dane['Exchange']['uczelnia'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.nazwa_uczelni' => $dane['Exchange']['uczelnia'] )));
			} else if (isset($dane['Exchange']['miasto'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.miasto' => $dane['Exchange']['miasto'] )));
			
			} else if (isset($dane['Exchange']['kraj'])) {
				$uczelnie_erasmus = $this-> Exchange-> find ('all', array('conditions' => array('Exchange.kraj' => $dane['Exchange']['kraj'] )));
			} 
		$this-> set ('uczelnie_erasmus', $uczelnie_erasmus);
	}
	public function getByKraj() {		
		$kraj = $this->request->data['Exchange']['kraj'];
		//$kraj = 'Belgia';
		$miasta = $this->Exchange->find('list', array(
			'fields' => array('Exchange.miasto', 'Exchange.miasto'),
			'conditions' => array('Exchange.kraj' => $kraj),
			'recursive' => -1
			));
 
		$this->set('miasta',$miasta);
		$this->layout = false;
	}
	
	public function getByMiasto() {		
		$miasto = $this->request->data['Exchange']['miasto'];

		$uczelnie = $this->Exchange->find('list', array(
			'fields' => array('Exchange.nazwa_uczelni', 'Exchange.nazwa_uczelni'),
			'conditions' => array('Exchange.miasto' => $miasto),
			'recursive' => -1
			));
 
		$this->set('uczelnie',$uczelnie);
		$this->layout = false;
	}

	public function view($id = null) { //null=>1
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$exchange = $this->Exchange->findById($id);
		if (!$exchange) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('title_for_layout', $exchange['Exchange']['nazwa_uczelni'].' | Porównywarka uczelni');
		$this->set('description_for_layout', $exchange['Exchange']['nazwa_uczelni'].' - Gdzie na Erasmusa? Najlepsze miasta do studiowania za granicą  w ramach projektu Erasmus.');
		$this->set('keywords_for_layout', $exchange['Exchange']['nazwa_uczelni'] .', erasmus, kraj, miasta, uczelnia,');
		
		$this->set('exchange', $exchange);

		$this->set('title_for_slider2', 'Gdzie na Erasmusa?');

		$ucz = $this->Exchange->find('all', array(
						'conditions' => array('Exchange.URL' => $exchange['Exchange']['URL']),
						'fields' => array('University.id', 'University.nazwa', 'University.photo'),
						'group' => array('University.nazwa')));
						
		$this->Exchange->contain();
		$countuni =  $this->Exchange->find('all', array(
						'conditions' => array('Exchange.kraj' => $exchange['Exchange']['kraj']),
						'group' => array('Exchange.miasto', 'Exchange.nazwa_uczelni')));	
		$cities2 = array();
		$i=0;
		$j=0;
		$cities2[0]['nazwa'] = '';
		foreach ($countuni as $key => $city) {
				if ($cities2[$i]['nazwa'] !== $city['Exchange']['miasto']) {
					$i++;
					$j=0;
					$cities2[$i]['nazwa'] = $city['Exchange']['miasto'];
					if ($j !==  0) {
						if ($cities2[$i]['uni_pl'][$j-1] !== h( h($city['Exchange']['nazwa_uczelni']))) {
							$cities2[$i]['uni_pl'][$j]['nazwa'] =  h($city['Exchange']['nazwa_uczelni']);
							$cities2[$i]['uni_pl'][$j]['id'] =  h( h($city['Exchange']['nazwa_uczelni']));
							$j++;
						} else {
							$j=0;
						}
					} else {
						$cities2[$i]['uni_pl'] = array();
						$cities2[$i]['uni_pl'][$j]['nazwa'] =  h($city['Exchange']['nazwa_uczelni']);
							$cities2[$i]['uni_pl'][$j]['id'] =  h($city['Exchange']['nazwa_uczelni']);
						$j++;
					}
				} else {
					if ($j !== 0) {
						if ( h($city['Exchange']['nazwa_uczelni']) !== $cities2[$i]['uni_pl'][$j-1]) {
							$cities2[$i]['uni_pl'][$j]['nazwa'] =  h($city['Exchange']['nazwa_uczelni']);
							$cities2[$i]['uni_pl'][$j]['id'] =  h($city['Exchange']['nazwa_uczelni']);
							$j++;
						} else {
							$j=0;
						}
					} else {
						$cities2[$i]['uni_pl'] = array();
						$cities2[$i]['uni_pl'][$j]['nazwa'] =  h($city['Exchange']['nazwa_uczelni']);
							$cities2[$i]['uni_pl'][$j]['id'] =  h($city['Exchange']['nazwa_uczelni']);
						$j++;
					}
				}		

		}
		//Debugger::dump($cities2,4);
		
		$krj=array('Austria', 'Belgia', 'Bułgaria', 'Chorwacja', 'Cypr', 'Czechy', 'Dania', 'Estonia', 'Finlandia', 'Francja', 'Grecja', 'Hiszpania', 'Holandia', 'Irlandia', 'Islandia', 'Lichtenstein', 'Liechtenstein', 'Litwa', 'Luksemburg', 'Łotwa', 'Macedonia', 'Malta', 'Niemcy', 'Norwegia', 'Portugalia', 'Rumunia', 'Słowacja', 'Słowenia', 'Szwajcaria', 'Szwecja', 'Turcja', 'Węgry', 'Wielka Brytania', 'Włochy', 'Szkocja', 'Walia', 'Francja/Martinique', );
		$iso=array('AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'GR', 'ES', 'NL', 'IE', 'IS', 'LI', 'LI', 'LT', 'LU', 'LV', 'MK', 'MT', 'DE', 'NO', 'PT', 'RO', 'SK', 'SI', 'CH', 'SE', 'TR', 'HU', 'GB', 'IT', 'GB', 'GB', 'FR', );

		//echo $iso[array_search($exchange['Exchange']['kraj'],$krj)];
		$ISO_3166 = $iso[array_search($exchange['Exchange']['kraj'],$krj)];
		$this->set('ISO_3166', $ISO_3166);
		$this->set('ucz', $ucz);
		$this->set('cit2', $cities2);
	}

	/***ADMIN***/
	public function admin_index() {
		$this->paginate = array(
            'limit' => 30,
            'order' => array('Exchange.kraj' => 'asc' ),
			'contain' => array('University.nazwa')
        );
        $exchanges = $this->paginate('Exchange');
		//Debugger::dump($exchanges);
        $this->set('exchanges', $exchanges);
	}
	
	public function admin_lista($university_id = null) {
		if (!$university_id) {
			throw new NotFoundException(__('Invalid post'));
		}			
		$this->Exchange->contain();
		$exchanges = $this->Exchange->find('all', array(
			'order' => array('kraj', 'miasto'),
		'conditions' => array('Exchange.university_id' => $university_id)));
		//Debugger::dump($exchanges);
				
		$this->set('exchanges', $exchanges);
		$this->set('university', $university_id);
	}
	
	public function admin_deletek($uni_id = null, $kraj_id) {
         
        if (!$kraj_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->Exchange->deleteAll(array('Exchange.university_id' => $uni_id, 'Exchange.kraj' => $kraj_id))) {
            $this->Session->setFlash(__('Erasmusy uczelni usunięte'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	public function admin_deletem($uni_id = null, $miasto) {         
        if (!$miasto) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->Exchange->deleteAll(array('Exchange.university_id' => $uni_id, 'Exchange.miasto' => $miasto))) {
            $this->Session->setFlash(__('Erasmusy uczelni usunięte'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	public function admin_deleteu($uni_id = null, $ucz_id) {
         
        if (!$ucz_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->Exchange->deleteAll(array('Exchange.university_id' => $uni_id, 'Exchange.nazwa_uczelni' => $ucz_id))) {
            $this->Session->setFlash(__('Erasmusy uczelni usunięte'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	public function admin_deletekierunek($uni_id = null, $kierunek_id) {
         
        if (!$kierunek_id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'lista',$uni_id));
        }

        if ($this->Exchange->deleteAll(array('Exchange.university_id' => $uni_id, 'Exchange.nazwa_kierunku' => $kierunek_id))) {
            $this->Session->setFlash(__('Erasmusy uczelni usunięte'));
            $this->redirect(array('action' => 'lista',$uni_id));
        }
        $this->Session->setFlash(__('Kierunek nie mógł być usunięty'));
        $this->redirect(array('action' => 'lista', $uni_id));
    }
	
	public function admin_addu($university_id) {		
		if ($this->request->is('post')) {
			$this->Exchange->create();
            if ($this->Exchange->save($this->request->data)) {
                $this->Session->setFlash(__('Erasmus uczelni dodany'));
                $this->redirect(array('action' => 'lista', $university_id));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
		}

		$kraje = $this-> Exchange-> find ('list', array(
			'fields' => array('Exchange.kraj', 'Exchange.kraj'),
			'group' => array('Exchange.kraj'))
			);
		$this->set('university', $university_id);
		$this-> set ('kraje_v', $kraje);
	}
	
	public function admin_getByKraj() {		
		$kraj = $this->request->data['Exchange']['kraj'];
		Debugger::dump( $this->request->data);
		$miasta = $this->Exchange->find('list', array(
			'fields' => array('Exchange.miasto', 'Exchange.miasto'),
			'conditions' => array('Exchange.kraj' => $kraj),
			'recursive' => -1
			));
 
		$this->set('miasta',$miasta);
		$this->layout = false;
	}
	
	public function admin_getByMiasto() {		
		$miasto = $this->request->data['Exchange']['miasto'];

		$uczelnie = $this->Exchange->find('list', array(
			'fields' => array('Exchange.nazwa_uczelni', 'Exchange.nazwa_uczelni'),
			'conditions' => array('Exchange.miasto' => $miasto),
			'recursive' => -1
			));
 
		$this->set('uczelnie',$uczelnie);
		$this->layout = false;
	}
	
	public function admin_add() {
		//Debugger::dump($this->request->data);
        if ($this->request->is('post')) {
			$this->Exchange->create();
            if ($this->Exchange->save($this->request->data)) {
                $this->Session->setFlash(__('Utworzono Erasmusa'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
		$this->set('universities', $this->Exchange->University->find('list'));
    }
	
	public function admin_editkierunek($university_id = null, $nazwa_kierunku) {
		if (!$university_id) {
			$this->Session->setFlash('Prosze podać kod uczelni');
			$this->redirect(array('action'=>'index'));
		}
		$this->Exchange->contain();
		$course = $this->Exchange->find('first', array('conditions' => array('university_id'=> $university_id, 'nazwa_kierunku'=>$nazwa_kierunku)));
		
		$id= $course['Exchange']['id'];
		$this->set('universities', $this->Exchange->University->find('list'));

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Exchange->id = $id;
			if ($this->Exchange->save($this->request->data)) {
				$this->Session->setFlash(__('Zaktualizowano kierunek'));
				$this->redirect(array('action' => 'lista', $this->request->data['Exchange']['university_id']));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $course;
		}
    }

}