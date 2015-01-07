<?php
App::uses('AppController', 'Controller');

class SubsitesController extends AppController {
		public function info($tid) {
			$site = $this->Subsite->findById($tid);
			//Debugger::dump($site);
			$this->set('site', $site['Subsite']);
		}
	}
