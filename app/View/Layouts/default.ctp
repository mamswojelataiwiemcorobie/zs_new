<?php
/**
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title_for_layout . ' | Zostań Studentem'  ?></title>
	
	<?php
		echo '<link rel="shortcut icon" href="/img/icon/icon5.ico" />';

		if(isset($description_for_layout)){ 
			echo $this->Html->meta('description', $description_for_layout);
			// Outputs: <meta name='description' content='".$description_for_layout."' /> 
		}
		if(isset($keywords_for_layout)){ 
			echo $this->Html->meta('keywords', $keywords_for_layout);
			// Outputs: <meta name='keywords' content='".$keywords_for_layout."' />"; 
		} 
		//echo $this->Html->meta('favicon.ico', 'img/icon/favicon.ico', array('type' => 'icon'));
			// Outputs: <link href="http://example.com/favicon.ico" title="favicon.ico" type="image/x-icon"  rel="alternate" />
			// InSteadOf: 
		//echo '<link rel="shortcut icon" href="img/icon/favicon.ico" />';
		
		echo $this->Html->css('bootstrap.css');
		echo $this->Html->css('app.min.css');
		//Responsive
		echo $this->Html->css('responsive.css');
		
		if ($tabele) 	{
			echo $this->Html->css('/js/datatables/css/jquery.dataTables.css', null, array('media' => 'screen'));
			echo $this->Html->css('jquery.dataTables_themeroller.css');
			echo $this->Html->css('table_chr1.css');
			echo $this->Html->css('table_nowrap.css');
			//responsive
			echo $this->Html->css('/css/display/rwd-table.css');
		}
	?>
	
	<!-- IE -->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	      <script src="/js/html5shiv.js"></script>
	      <script src="/js/respond.min.js"></script>	   
	<![endif]-->
	<!--[if lte IE 8]>
		<link href="css/ie8.css" rel="stylesheet">
	<![endif]-->
	<?php 
		echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css');
		echo $this->Html->css('jdy.css');
		if ($mapy) 	{
			echo '<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>';
		}
	?>

<script async type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31696467-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<meta name="google-site-verification" content="_sN9VAdYA89dMemv5QW1VtC4NX3q5ZgcYC8UW_NZ2Fk" />
</head>
<body class="on" scroll="yes" >
	<?php 
		if(isset($user)) echo $this->element('menu_top', array("username"=>$user['Client']['login'])); 
		else echo $this->element('menu_top'); 
		if ($this->request->here == '/') 		{
			echo $this->element('slider', array(), array('cache' => true));
		} 		else 		{
			echo $this->element('slider2');
		}  
	?>
	<div class="wrapsemibox">
    	<div class="semiboxshadow text-center">
    		
    	</div>
    	<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>	
	<div >
		<?php echo $this->element('footer', array(), array('cache' => true)); ?>
	</div>
	<?php
		
			echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');

		
		if ($tabele) 		{
			echo $this->Html->script('/js/datatables/js/jquery.dataTables.min.js');
			//echo $this->Html->script('/js/datatables/js/jquery.dataTables.rowGrouping.js');
			echo $this->Html->script('/jquery.dataTables.yadcf.js');
			echo $this->Html->script('http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js');
			echo $this->Html->script('funkcje_tabele.js');
		}
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		// Writes cached scripts
	echo $this->Html->script('jquery.scrollable-1.0.2.min.js');
		echo $this->Html->script('bootstrap.js');
		echo $this->Html->script('common.js');
		echo $this->Html->script('plugins.js');
		if(isset($glowna)) {
			echo $this->Html->css('owl.carousel_v1.1.css');
			echo $this->Html->script('owl.carousel.min.js');
		}
		echo $this->Html->script('index_func.js');
	?>
	
</body>
</html>
