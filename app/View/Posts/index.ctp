
<?php
echo $this->Form->create('Post');

echo $this->Form->input('body',array(
	'required' => 'true',
	'div' => false, 
	'empty' => '(Wybierz Temat)',
	'options' => array('Współpraca PR, materiały prasowe', 'Uzupełnienie profilu uczelni', 'Aktualizacja profilu')));
echo $this->Form->input('title');
echo $this->Form->input('email');
echo $this->Form->input('login');
echo $this->Form->submit('Create Post');
?>
xxx
<?php echo $this->html->link('Original', '#', 
                array('onclick'=>'return false;', 'id'=>'remanufactured-link', 'class'=>'get-type-product-link')); ?>   

<div id="content">
</div>