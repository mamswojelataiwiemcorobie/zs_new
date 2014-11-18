<div>
	<h1><?php echo __('Dodaj kierunek uczelni'); ?></h1>
<?php echo $this->Form->create('CourseonUniversity'); ?>
<?php for ($i=0; $i<$count; $i++) : ?>
	<div class="form-horizontal" role="form">	
			<div class="form-group">
				<?php echo $this->Form->hidden('university_id', array('value' => $university));?>
				<label class="col-sm-2"> Kierunek</label>
				<?php echo $this->Form->select('CourseonUniversity.course_id', $courses );?>
			</div> 
			<div class="form-group">
				<label class="col-sm-2">Typ</label>
				<div class="col-sm-10">
					<?php echo $this->Form->select('typ_course_id',	$typCourses	);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2">Tryb</label>
				<div class="col-sm-10">
					<?php echo $this->Form->select('tryb_course_id',$trybCourses);?>
				</div>
			</div> 
			<div class="form-group">
				<label class="col-sm-2">Cena</label>
				<div class="col-sm-10">
					<?php echo $this->Form->input('cena', array('label'=> false));?>
				</div>
			</div> 
			<div class="form-group">
				<label class="col-sm-2">Średnia</label>
				<div class="col-sm-10">
					<?php echo $this->Form->input('srednia', array( 'label' => false));?>
				</div>
			</div> 
	</div>
	<div> </div>
<?php endfor;?>
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