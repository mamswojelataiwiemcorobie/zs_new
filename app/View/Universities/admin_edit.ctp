<div class="university form col-sm-11">
<?php echo $this->Form->create('University', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form')); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Edit University'); ?></legend>
		<div class="form-group">
		<?php 	echo $this->Form->hidden('id', array('value' => $this->data['University']['id']));?>
			<label class="col-sm-2 control-label">Nazwa</label>			
			<?php echo $this->Form->input('nazwa', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Miasto</label>
			<div class="col-sm-10">
				<?php echo $this->Form->select('city_id',$cities);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php echo $this->Form->input('publiczna');?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Typ szkoły</label>
			<div class="col-sm-10">
				<?php echo $this->Form->select('university_type_id', $type, array('class'=> 'form-control'));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">średnia</label>
			<?php echo $this->Form->input('srednia', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<?php $this->Form->error( 'avatar' );?>
			<?php
				if(!empty( $this->request->data['University']['photo'])): ?>
					<div class="input col-sm-6">
						<label>Obecne logo:</label>
						<img src="/img/uczelnie_min/<?php echo  $this->request->data['University']['photo']; ?>" width="200" />
					</div>
				<?php endif;?>
				<div class="col-sm-6">
					<?php echo  $this->Form->input('photo', array('label'=>'Załaduj inne logo:', 'type'=>'file'));	?>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Kategoria przyznana przez ministerstwo</label>
			<?php echo $this->Form->input('kategoria', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Procent studentów niestacjonarnych</label>
			<?php echo $this->Form->input('il_st_pl', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Procent studentów niestacjonarnych</label>
			<?php echo $this->Form->input('il_st_bezpl', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Miejsce w rankingu</label>
			<?php echo $this->Form->input('rank', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->hidden('UniversitiesParameter.id', array('value' => $this->data['UniversitiesParameter']['id']));
			echo $this->Form->hidden('UniversitiesParameter.university_id', array('value' => $this->data['University']['id']));?>
			<label class="col-sm-2 control-label">www</label>
			<?php echo $this->Form->input('UniversitiesParameter.www', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'url', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Adres</label>
			<?php echo $this->Form->input('UniversitiesParameter.adres', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<?php echo $this->Form->input('UniversitiesParameter.email', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'email', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Telefon</label>
			<?php echo $this->Form->input('UniversitiesParameter.telefon', array( 'label' => false, 'div' => 'col-sm-10', 'type' => 'tel', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Opis</label>
			<?php echo $this->Form->input('UniversitiesParameter.opis', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Akademik</label>
			<?php echo $this->Form->input('UniversitiesParameter.akademik', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Stypendium socjalne</label>
			<?php echo $this->Form->input('UniversitiesParameter.s_socj', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Stypendium naukowe</label>
			<?php echo $this->Form->input('UniversitiesParameter.s_nauk', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Stypendium sportowe</label>
			<?php echo $this->Form->input('UniversitiesParameter.s_sport', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Stypendium rektora</label>
			<?php echo $this->Form->input('UniversitiesParameter.s_rektora', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Ranking</label>
			<?php echo $this->Form->input('UniversitiesParameter.ranking', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <?php echo $this->Form->button('Edytuj uczelnie', array('type' => 'submit', 'class'=> 'btn btn-default'));?>
			</div>
		  </div>
		</div>
    </form>
<?php echo $this->Form->end(); ?>
</div>
<div class="clearfix"></div>
<?php 
echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') ); 
?>