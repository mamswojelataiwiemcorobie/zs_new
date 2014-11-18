<div id="kieruenk">
	<h1>Edytuj Erasmusa uczelni</h1>
	<?php
		echo $this->Form->create('Exchange', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form'));
		echo $this->Form->hidden('id', array('value' => $this->data['Exchange']['id']));?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Uniwersytet PL</label>
			<?php echo $this->Form->input('university_id', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Program</label>
			<?php echo $this->Form->input('program', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<?php echo $this->Form->input('kraj');
		echo $this->Form->input('miasto');?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Nazwa Uczelni zagranicznej</label>
			<?php echo $this->Form->input('nazwa_uczelni', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Nazwa kierunku</label>
			<?php echo $this->Form->input('nazwa_kierunku', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">URL</label>
			<?php echo $this->Form->input('URL', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<?php echo $this->Form->input('pakiet');
		echo $this->Form->input('waga_pakietu');?>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <?php echo $this->Form->button('Edytuj uczelnie', array('type' => 'submit', 'class'=> 'btn btn-default'));?>
			</div>
		  </div>
		</div>
	<?php echo $this->Form->end();?>
	<div class="clearfix"></div>
</div>