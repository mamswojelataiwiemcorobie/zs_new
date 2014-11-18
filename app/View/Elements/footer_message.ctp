<?php 


	$messages = $this->requestAction(array(
												 'controller' => 'messages',
												 'action' => 'footerMessage')); 
	


echo $this->$form->create('Messages', array('action' => 'footerMessage'));
echo $this->$form->input('title');
echo $this->$form->input('body');
echo $this->$form->end();
?>