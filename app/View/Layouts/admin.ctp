<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>Administrator | <?php echo $title_for_layout; ?></title>
    <?php
        echo $this->fetch('meta');
		echo $this->Html->css('bootstrap.css');
        echo $this->Html->css(array('admin'));
        echo $this->fetch('css');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
		echo $this->Html->script('/js/tinymce/tinymce.min');
    ?>
	<script type="text/javascript">
	tinymce.init({
		selector: "textarea.wysiwig",
		theme : "modern",
 		plugins: [
	        "advlist autolink lists link image charmap",
	        "searchreplace visualblocks code fullscreen",
	        "table contextmenu paste"
	    ],
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen",
		image_advtab: true,
		image_class_list: [
	        {title: 'img-responsive', value: 'img-responsive'}
	    ],
	    extended_valid_elements : "i[class]",
		paste_word_valid_elements: "b,strong,i,em,h1,h2,h3,table,tr,td,tbody,thead,ol,ul,li,p",
		style_formats_merge: true,
		style_formats: [
		    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}}
		],
		extended_valid_elements: "table[class=table table-hover table-bordered], td[width=100%]",
	 });
	</script>

</head>
<body>
    <div id="container" class="container-fluid">
        <div id="header">
            <div class="logo"></div>
            <div class="clear"></div>
        </div>
		<div class="row">
		  <div class="col-md-2">
			<div class="left_menu">
				<?php echo $this->element('menu_admin'); ?>
			</div>
		  </div>
		  <div class="col-md-10">
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

	<?php
		//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		echo $this->Html->script('https://www.google.com/jsapi');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');

		if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) 	
			echo $this->Js->writeBuffer();
		// Writes cached scripts

		echo $this->Html->script('bootstrap_admin.js');
	?>
	<script src="/js/jquery.form.js" type="text/javascript"></script>

	<script type="text/javascript" src="/js/admin.js"></script>

</body>
</html>