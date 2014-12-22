<div>

	<h1><?php echo __('Dodaj wydział uczelni'); ?></h1>

<?php echo $this->Form->create('Faculty'); ?>
	<div class="form-horizontal" role="form">	
		<div class="form-group">
			<?php echo $this->Form->hidden('university_id', array('value' => $university));?>

			<label class="col-sm-2 control-label">*Nazwa</label>
			<?php echo $this->Form->input('nazwa', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>

		</div> 
		<div class="form-group">
			<label class="col-sm-2 control-label">www</label>
			<?php echo $this->Form->input('www', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'url', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Adres</label>
			<?php echo $this->Form->input('adres', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<?php echo $this->Form->input('email', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'email', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Telefon</label>
			<?php echo $this->Form->input('telefon', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'tel', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Fb</label>
			<?php echo $this->Form->input('fb', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Google+</label>
			<?php echo $this->Form->input('gplus', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">YouTube</label>
			<?php echo $this->Form->input('yt', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Twitter</label>
			<?php echo $this->Form->input('twitter', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Opis</label>
			<?php echo $this->Form->input('opis', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="col-md-2">
			<span class="gmap-overflow-call" data-toggle="modal" data-target="#gmap-overflow">mapa</span>
		</div>
		<div class="col-md-10">			
			<div class="form-group col-md-6">
				<label class="col-sm-4">Lokalizacja X</label>
				<?php echo $this->Form->input('lokalizacja_x', array( 'label' => false, 'div' => 'col-sm-8', 'class'=> 'gmap-lon form-control'));?>
			</div>
			<div class="form-group col-md-6">
				<label class="col-sm-4">Lokalizacja Y</label>
				<?php echo $this->Form->input('lokalizacja_y', array( 'label' => false, 'div' => 'col-sm-8', 'class'=> 'gmap-lat form-control'));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta title</label>
			<?php echo $this->Form->input('meta_title', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta description</label>
			<?php echo $this->Form->input('meta_description', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta keywords</label>
			<?php echo $this->Form->input('meta_keywords', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>

	</div>
	<div class="form-group">

		<div class="col-sm-offset-2 col-sm-10">

			<?php echo $this->Form->button('Dodaj wydział', array('type' => 'submit', 'class'=> 'btn btn-default'));?>

		</div>

	 </div>

	<?php echo $this->Form->end(); ?>

<?php 

echo $this->Html->link( "Return to Dashboard",   array('action'=>'lista', $university) ); 
echo $this->element('html_gmap');
?>

</div>