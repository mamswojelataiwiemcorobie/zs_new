<?php 
	echo $this->form->create('tests', array('action' => 'results', 'type' => 'post')); 
	
	$options = array
	(
	    'size' => 45,
	    'id' => 'search',
	    'tabindex' => 1,
	    'maxlength' => 250
	);
	
	echo $this->form->text('p1');
	echo $this->form->text('p2');
	
	echo $this->Form->button('<i class="icon-th"></i>&nbsp;Porównaj', array('type' => 'submit', 'class' => 'btn btn-	default'));
	echo $this->Form->end();
	
	pr($this->data);
	pr($uni1);
	pr($uni2);
?>