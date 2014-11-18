<?php
/**
 * Default Layout
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Yusuf Abdulla Shunan <shunan@maldicore.com>
 * @copyright  Copyright 2012, Maldicore Group Pvt Ltd. (http://maldicore.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since      CakePHP(tm) v 2.1.1
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($pluralHumanName) ? str_replace('Admin ', '', $pluralHumanName) . ' - ' : '' ?><?php echo __('Admin'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="/css/twitter/bootstrap/bootstrap.css" rel="stylesheet">
        <?php echo $this->Html->css('/Admin/css/bootstrap-wysihtml5-0.0.2'); ?>
        <?php echo $this->Html->css('/Admin/css/datepicker'); ?>
        <?php echo $this->Html->css('/Admin/css/styles'); ?>
        <link href="/css/twitter/bootstrap/bootstrap-responsive.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>        
        <?php echo $this->Html->script('/Admin/js/advanced'); // was comented ?>
        <?php echo $this->Html->script('/Admin/js/wysihtml5-0.3.0_rc2'); ?>
        <?php echo $this->Html->script('/Admin/js/bootstrap.min'); ?>
        <?php echo $this->Html->script('/Admin/js/bootstrap-wysihtml5-0.0.2'); ?>
        <?php echo $this->Html->script('/Admin/js/bootstrap-datepicker'); ?>
        <?php echo $this->Html->script('/Admin/js/jquery.dataTables'); ?>
        <?php echo $this->Html->script('/Admin/js/scripts'); ?>
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php echo $this->Html->meta('icon'); ?>

        <style>
            #main-container {
                width:100%;
                //background-color: #3d3d3d;
                display: inline-flex;

            }
            #left-column {
                width:15%;
                float:left;
                //background-color: red;
                //margin-left: 5px;
            }
            #right-column {
                width:75%;
                float:left;
                //background-color: green;
                display: inline-table;
                margin-left: 5%;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
                <div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php echo $this->Html->link(__('Admin'), array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
					</div>
                    <div class="navbar-collapse collapse">
                        <?php if (isset($navbar)): ?>
                        <?php $menuItem = 0; ?>
                            <ul class="nav nav-tabs">
                                <?php foreach ($navbar as $nav): ?>
                                <?php 
                                    if($menuItem == 7){
                                 ?>
                                  <li class="dropdown">
                                    <a class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       href="#">
                                        More
                                        <b class="caret"></b>
                                      </a>
                                    <ul class="dropdown-menu">
                                    <li<?php echo $nav['url']['controller'] == $this->request['controller'] ? ' class="active"' : ''; ?>><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
                                <?php } else { ?>
                                    <li<?php echo $nav['url']['controller'] == $this->request['controller'] ? ' class="active"' : ''; ?>><?php echo $this->Html->link($nav['title'], $nav['url']); ?></li>
                                <?php } ?>
                                <?php $menuItem += 1; ?>
                                <?php endforeach; ?>
                                <?php 
                                    if($menuItem>7){
                                 ?>
                                    </ul>
                                  </li>
                                <?php } ?>
                            </ul>
                        <?php endif; ?>
							<ul class="nav navbar-nav pull-right">
								<li><?php echo $this->Html->link(__('Visit Site'), '/'); ?></li>
								<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout')); ?></li>
							</ul>
					</div>
            </div>
        </div>
        <div id="main-container">
            <div id="left-column">
                <ul>
                <li class="active"><?php echo $this->html->link('Lista',  array('plugin' => 'admin',  'action' => 'index')); ?></li>
                <li onclick="if($(this).next().css('display') == 'none') {$(this).next().show(1000);}else{$(this).next().hide(1000);}">
                    <?php //echo $this->html->link('Lista podstron', '/admin/subsites'); ?>Lista podstron:</li>
                    <ul style="display:none">
                        <li><?php echo $this->html->link('Home', '/admin/subsites/edit/2'); ?></li>
                        <li><?php echo $this->html->link('FeedBack Thanks', '/admin/subsites/edit/1'); ?></li>
                    </ul>
                <li onclick="if($(this).next().css('display') == 'none') {$(this).next().show(1000);}else{$(this).next().hide(1000);}">lista stron</li>
                    <ul style="display:none">
                        <li><?php echo $this->html->link('Lista uczelni', '/admin/universities'); ?></li>
                            <ul>
                                <li><?php echo $this->html->link('parametry',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                                <li><?php echo $this->html->link('typy',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                            </ul>
                        <li><?php echo $this->html->link('Lista kierunków',  '/admin/courses'); ?></li>
                            <ul>
                                <li><?php echo $this->html->link('na uniwer...',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                                <li><?php echo $this->html->link('typy',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                                <li><?php echo $this->html->link('tryby',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                                <li><?php echo $this->html->link('rodzaje',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                            </ul>
                        <li><?php echo $this->html->link('Lista miast', '/admin/cities'); ?></li>
                        <li><?php echo $this->html->link('Lista zawodów',  '/admin/professions'); ?></li>
                            <ul>
                                <li><?php echo $this->html->link('po kierunkach',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                            </ul>
                        <li><?php echo $this->html->link('Lista erazmusów',  '/admin/exchanges'); ?></li>
                            <ul>
                                <li><?php echo $this->html->link('statystyki',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                            </ul>
                    </ul>
                <li><?php echo $this->html->link('FeedBacki',  '/admin/messages'); ?></li>
                <li><?php echo $this->html->link('Ranking',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                <li><?php echo $this->html->link('Administracyjne '.mb_convert_encoding('&#x1f511;', 'UTF-8', 'HTML-ENTITIES'),  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                    <ul>
                        <li><?php echo $this->html->link('Groups',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                        <li><?php echo $this->html->link('Users',  array('plugin' => 'admin', 'controller' => 'admin', 'action' => 'index')); ?></li>
                    </ul>
                    <li><a rel="external nofollow" href="https://trello.com/b/MckiuFS9/porownywarka">Trello</a></li>
                </ul>

                <ul>
                    <li onclick="if($(this).next().css('display') == 'none') {$(this).next().show(1000);}else{$(this).next().hide(1000);}">Languages</li>
                        <ul style="display:none">
                            <li>Polski</li>
                            <li>English</li>
                            <li>Русский</li>
                            <li>Українська</li>
                            <li>Беларуская</li>
                            <li>қазақша</li>
                        </ul>
                </ul>
                 <?php
                    $list = array(
                        'Projects' => array(
                            'Komentarze',
                            'Forum',
                            'MyWayDesign ©',
                            )
                    );
                    echo $this->Html->nestedList($list);
                ?>
            </div>
            <div id="right-column" sty;e="display:inline !important;">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div> 
        <hr>
        <?php //echo str_replace('class="cake-sql-log"', 'class="table table-bordered table-striped"', $thelement('sql_dump')); ?>
        <?php // debug($this); ?>
        <p style="text-align:center;">Powered by: <a href="#">CakePHP Admin Plugin</a></p>
        
    </body>
</html>
