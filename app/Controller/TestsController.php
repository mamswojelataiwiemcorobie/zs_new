<?php
	class TestsController extends AppController {
		public function index() {
			echo $variableName;
		}
		public function results($u1 = null, $u2 = null) {
			if ($this->data) {
				$par1 = $this->data['tests']['p1'];
				$par2 = $this->data['tests']['p2'];
				$this->redirect('http://szkolywyzsze.edu.pl/tests/s&a='.$par1.'-'.$par2);
			}
			$this->set('uni1', $u1);
			$this->set('uni2', $u2);
		}
		public function resuni($u1 = null, $u2 = null) {
			if ($this->data['University']) {
				$par1 = $this->data['University']['id'];
				$par2 = $this->data['University']['id2'];
				//$this->redirect('http://szkolywyzsze.edu.pl/porownanie-'.$par1.'-'.$par2);
			}
			//http://szkolywyzsze.edu.pl/tuni/s&a=185-178
			$this->set('uni1', $u1);

		// TEST select submit go url 

			if(!isset($u1)){
				$id = 1;
			}else{
				$id = $u1;
			}
			$this->University = ClassRegistry::init('University');
			$university = $this->University->findById($id);
			$this->set('university', $university);

						$this->set('uni2', $u2);
			if(!isset($u2)){
				$this->University->contain('City', 'UniversityType', 'UniversitiesParameter', 'Exchange');
				$university2 = $this->University->find('first', array(
					'conditions' =>	array('University.id !=' => $university['University']['id'],
						'University.university_type_id' => $university['University']['university_type_id']))
				);
			}else{
				$this->University->contain('City', 'UniversityType', 'UniversitiesParameter', 'Exchange');
				$university2 = $this->University->find('first', array(
					'conditions' =>	array('University.id' => $u2)));
			}
			$this->set('university2', $university2);

			$this->University->contain('UniversityType');
			$universityo = $this->University->find('all', array('fields' => array('University.id', 'University.nazwa', 'UniversityType.nazwa'),
				'order' => array('University.nazwa')));

			//Debugger::dump($universityo);
			foreach ($universityo as $o) {
				$options[$o['UniversityType']['nazwa']][$o['University']['id']] = $o['University']['nazwa'];
			}
			$this->set('options', $options);

		}

		public function resuni_2($u1 = null, $u2 = null) {
			if (!$query && $this->data) {
				$par1 = $this->data['tests']['p1'];
				$par2 = $this->data['tests']['p2'];
				$this->redirect('http://szkolywyzsze.edu.pl/tests/s&a='.$par1.'-'.$par2);
			}
			$this->set('uni1', $u1);
			$this->set('uni2', $u2);
		}
	}
