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
        '/kierunki/:slug-:tid',
        array(
            'controller' => 'courses',
            'action' => 'index'),
         array(
            'pass' => array('tid'),
            'tid' => '[0-9]+',
            'slug'=>'.+'
    ));
		
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
        '/uczelnia/:slug-:id/:zakladka-:nrzakladki',
        array(
            'controller' => 'universities',
            'action' => 'view'),
        array(
            'pass' => array('id', 'nrzakladki'),
            'id' => '[0-9]+',
            'slug'=>'.+',
            'zakladka'=>'.+',
            'nrzakladki' => '[0-9]+',
        ));

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
        '/uczelnie',
        array(
            'controller' => 'universities',
            'action' => 'index'));
		
	Router::connect(
        '/wyszukiwarka/:slug-:tid',
        array(
            'controller' => 'universities',
            'action' => 'search'),
        array(
            'pass' => array('tid'),
            'tid' => '[0-9]+',
			'slug'=>'.+'
        ));
    Router::connect(
        '/wyszukiwarka/:slug-:tid/*',
        array(
            'controller' => 'universities',
            'action' => 'search'),
        array(
            'pass' => array('tid'),
            'tid' => '[0-9]+',
            'slug'=>'.+'
        ));



/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	Router::setExtensions(array('json'),true);
    Router::parseExtensions('json', 'html', 'rss');

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
