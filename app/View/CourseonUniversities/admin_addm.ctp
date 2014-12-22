<div>

	<h1><?php echo __('Dodaj kierunek uczelni'); ?></h1>

<?php echo $this->Form->create('CourseonUniversity'); ?>
	<div class="form-horizontal" role="form">	
			<div class="form-group">
				<label class="col-sm-2">Wydział</label>

				<?php echo $this->Form->select('CourseonUniversity.faculty_id', $faculties,array('size' => 12) );?>
			</div> 
			<div class="col-sm-offset-2 col-sm-10">

				<?php	echo $this->Html->link("Dodaj wydział", array('action'=>'add_faculties', $university)); ?>

			</div>
			<div class="form-group">

				<?php echo $this->Form->hidden('university_id', array('value' => $university));?>

				<label class="col-sm-2"> Kierunek</label>

				<?php echo $this->Form->select('CourseonUniversity.course_id', $courses,array('multiple' => true, 'size' => 12) );?>

			</div> 

	</div>

	<div> 

</div>

<div class="form-group">

	<div class="col-sm-offset-2 col-sm-10">

		<?php echo $this->Form->button('Dodaj kierunek', array('type' => 'submit', 'class'=> 'btn btn-default'));?>

	</div>

 </div>

<?php echo $this->Form->end(); ?>

<?php 

echo $this->Html->link( "Return to Dashboard",   array('action'=>'lista', $university) ); 

?>

</div>