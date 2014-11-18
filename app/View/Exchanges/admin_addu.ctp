<div id="erasmus">
	<?php
	if (!isset($this->request->data['Exchange'])){
		echo $this->Form->create();
		echo $this->Form->hidden('university_id', array('value' => $university));
		echo $this->Form->hidden('program', array('value' => 'Erasmus'));
		echo $this->Form->input('kraj', array(	'options' => $kraje_v,
												'class' => 'form-control',
												'size' => 7, 
												'type' => 'select' ,
												'security' => false));
		echo $this->Form->input('miasto', array('class' => 'form-control',
												'size' => 7, 
												'type' => 'select' ,
												'security' => false));
		echo $this->Form->input('nazwa_uczelni', array('class' => 'form-control',
												'size' => 7, 
												'type' => 'select' ));
		echo $this->Form->input('nazwa_kierunku', array('class' => 'form-control' ));
		echo $this->Form->submit('dodaj', array('div'=>true));	

		echo $this->Form->end(); 
	}
	?>
	<div class="clearfix"></div>
</div>
<?php
$this->Js->get('#ExchangeKraj')->event('change', 
	$this->Js->request(array(
		'controller'=>'Exchanges',
		'action'=>'getByKraj'
		), array(
			'update'=>'#ExchangeMiasto',
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				))
		))
	);
$this->Js->get('#ExchangeMiasto')->event('click', 
	$this->Js->request(array(
		'controller'=>'Exchanges',
		'action'=>'getByMiasto'
		), array(
			'update'=>'#ExchangeNazwaUczelni',
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				))
		))
	);
?>