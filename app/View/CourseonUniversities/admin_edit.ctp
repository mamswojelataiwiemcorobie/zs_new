<div class="form">
<?php echo $this->Form->create('CourseonUniversity'); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Edit '. $this->data['Course']['nazwa']. ' uczelni '. $this->data['University']['nazwa']); ?></legend>
		<div class="form-group">
			<?php 
			echo $this->Form->hidden('id', array('value' => $this->data['CourseonUniversity']['id']));
			echo $this->Form->input('course_id', array(  'label' => 'Nazwa'));
			echo $this->Form->input('cena', array(  'label' => 'Cena'));
			echo $this->Form->input('typ_course_id', array( 'label' => 'Typ'));
			echo $this->Form->input('tryb_course_id', array('label' => 'Tryb'));
			echo $this->Form->input('srednia', array('label' => 'Średnia'));
			echo $this->Form->input('pakiet', array( 'label' => 'Pakiet'));
			echo $this->Form->input('waga_pakietu', array( 'label' => 'Waga pakietu'));
			echo $this->Form->input('rank', array( 'label' => 'Rank'));?>
		</div> 
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default"><?php echo $this->Form->submit('Edytuj uczelnie', array('class' => 'form-submit') );?></button>
			</div>
		  </div>
		</div>
    </form>
<?php echo $this->Form->end(); ?>
</div>
<?php 
echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') ); 
?>