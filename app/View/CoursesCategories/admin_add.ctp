<div id="kierunek">
	<h1>Dodaj kategorie kierunków</h1>
	<?php	
		echo $this->Form->create('CoursesCategory', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form'));
		echo $this->Form->input('nazwa');?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Opis</label>
			<?php echo $this->Form->input('opis1', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Perspektywy zawodowe</label>
			<?php echo $this->Form->input('opis2', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<?php echo $this->Form->submit('edytuj', array('div'=>true));	

		echo $this->Form->end(); 
	?>
</div>