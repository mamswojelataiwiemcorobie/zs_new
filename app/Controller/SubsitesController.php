<?php
App::uses('AppController', 'Controller');

class SubsitesController extends AppController {
		public function info($tid) {
			$site = $this->Subsite->findById($tid);
			//Debugger::dump($site);
			$this->set('site', $site['Subsite']);
			$this->set('title_for_layout', $site['Subsite']['meta_title']);
			$this->set('description_for_layout', $site['Subsite']['meta_description']);
			$this->set('keywords_for_layout', $site['Subsite']['meta_keywords']);
		}
	}
