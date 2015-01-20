<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public function countSearchKeywords($keyword) {
		$db = $this->getDataSource();
		$query = 'INSERT INTO search_keywords (id,keyword,counter) VALUES (NULL,"'.$keyword.'",1) ON DUPLICATE KEY UPDATE counter = counter+1';
		$db->fetchAll($query);
	}

	public function getSearchKeyword($id) {
		$db = $this->getDataSource();
		$r= $db->fetchAll("SELECT * FROM search_keywords WHERE id = ?",array($id));
		return $r;
	}

	function afterSave($created) {
	    clearCache();
	}

	public function afterDelete() {
	    clearCache();
	}

	function getCurrentUser() {
	  // for CakePHP 1.x:
	  App::import('Component','Session');
	  $Session = new SessionComponent();

	  // for CakePHP 2.x:
	  App::uses('CakeSession', 'Model/Datasource');
	  $Session = new CakeSession();


	  $user = $Session->read('Auth.Client');

	  return $user;
	}
}
