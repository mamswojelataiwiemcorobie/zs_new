<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    //Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
    Router::connect('/', array('controller' => 'pages', 'action' => 'home', 'home'));
	Router::connect('/admin', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)
	);
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'google'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect(
        '/kierunki',
        array(
            'controller' => 'courses',
            'action' => 'index')
	);
		
	Router::connect(
        '/kierunek/:slug-:id',
        array(
            'controller' => 'courses',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
			'slug'=>'.+'
        ));

	Router::connect(
        '/erazmus/:slug-:id',
        array(
            'controller' => 'exchanges',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
            'slug'=>'.+'
        ));

    Router::connect(
        '/erazmusy',
        array(
            'controller' => 'exchanges',
            'action' => 'index'));
      
    Router::connect(
        '/kontakt',
        array(
            'controller' => 'contacts',
            'action' => 'index'));
        
    Router::connect(
        '/miasto/:slug-:id',
        array(
            'controller' => 'cities',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
            'slug'=>'.+'
        ));

	Router::connect(
        '/miasta',
        array(
            'controller' => 'cities',
            'action' => 'index'));
		
	Router::connect(
        '/uczelnia/:slug-:id',
        array(
            'controller' => 'universities',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
			'slug'=>'.+'
        ));
		
	Router::connect(
        '/uczelnia/:nazwa',
        array(
            'controller' => 'universities',
            'action' => 'view2'),
        array(
            'pass' => array('nazwa'),
			'slug'=>'.+'
        ));

    Router::connect(
        '/search/s&a=:id1-:id2',
        array(
            'controller' => 'universities',
            'action' => 'porownanie'),
        array(
            'pass' => array('id1', 'id2'),
            'id1' => '[0-9]+',
            'id2' => '[0-9]+'
        ));

    Router::connect(
        '/u/u:id1',
        array(
            'controller' => 'universities',
            'action' => 'url'),
        array(
            'pass' => array('id1', 'id2'),
            'id1' => '[0-9]+',
            'id2' => '[0-9]+'
        ));

    Router::connect(
        '/tests/s&a=:id1-:id2',
        array(
            'controller' => 'tests',
            'action' => 'results'),
        array(
            'pass' => array('id1', 'id2'),
            //'id1' => '[0-9]+',
            //'id2' => '[0-9]+'
        ));

    Router::connect(
        '/porownanie-:id1-:id2',
        array(
            'controller' => 'tests',
            'action' => 'resuni'),
        array(
            'pass' => array('id1', 'id2'),
            //'id1' => '[0-9]+',
            //'id2' => '[0-9]+'
        ));
		
	Router::connect(
        '/uczelnie',
        array(
            'controller' => 'universities',
            'action' => 'index'));
			
	Router::connect(
        '/zawod/:slug-:id',
        array(
            'controller' => 'professions',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
			'slug'=>'.+'
        ));		
	Router::connect(
        '/zawody',
        array(
            'controller' => 'professions',
            'action' => 'index'));
		
	Router::connect(
        '/kierunekuczelni/:slug-:id',
        array(
            'controller' => 'CourseonUniversities',
            'action' => 'view'),
        array(
            'pass' => array('id'),
            'id' => '[0-9]+',
			'slug'=>'.+'
        ));
	
	Router::connect(
        '/kierunkiuczelni',
        array(
            'controller' => 'CourseonUniversities',
            'action' => 'index'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	Router::setExtensions(array('json'),true);
    Router::parseExtensions('json');

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
