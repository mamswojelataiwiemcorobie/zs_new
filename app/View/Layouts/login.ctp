<!--****login layout ****-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>Administrator | <?php echo $title_for_layout; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        echo $this->fetch('meta');
		echo $this->Html->css('bootstrap.css');
        echo $this->Html->css(array('admin'));?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
		<?php echo $this->Html->script('bootstrap.js');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <div id="container" class="container-fluid">
        <div id="header">
            <div class="logo"></div>
            <div class="clear"></div>
        </div>
		<div class="row">
		  <div class="col-md-6 col-md-offset-3">
			<?php echo $this->Session->flash(); ?>
			 <div id="content-wrapper">
            <?php echo $this->fetch('content'); ?>
			</div>
		  </div>
		</div>
       
 
        <div id="footer">
            © <?php echo date("Y");?> - All rights          
    </div>
            
    </div>
 
</body>
</html>