<div id="kieruenk">
	<h1>Edytuj zawód</h1>
	<?php
	if (!isset($this->request->data['Exchange'])){
		echo $this->Form->create('Profession', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form'));?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Nazwa</label>
			<?php echo $this->Form->input('nazwa', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Płaca</label>
			<?php echo $this->Form->input('placa', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Opis</label>
			<?php echo $this->Form->input('opis', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			<?php echo $this->Form->submit('Edytuj zawód', array('type' => 'submit', 'class'=> 'btn btn-default'));	?>
			</div>
		</div>
		<?php echo $this->Form->end(); 
	}
	?>
	<div class="clearfix"></div>
</div>