<div>
	<h1>Dodaj kierunek wydziału <?php echo $faculty['Faculty']['nazwa']; ?></h1>
<?php echo $this->Form->create('CourseonUniversity'); ?>
	<div class="form-horizontal" role="form">	
			<div class="form-group">
				<label class="col-sm-2">Kierunek</label>
				<?php echo $this->Form->select('CourseonUniversity.course_id', $courses, array('multiple' => true, 'size'=>12));?>
			</div> 
	</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<?php echo $this->Form->button('Dodaj kierunki', array('type' => 'submit', 'class'=> 'btn btn-default'));?>
	</div>
 </div>
<?php echo $this->Form->end(); ?>
<?php 
echo $this->Html->link( "Return to Dashboard",   array('action'=>'edit', $faculty['Faculty']['id']) ); 
?>
</div>