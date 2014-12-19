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
			<label class="col-sm-2 control-label">Typ szkoły</label>
			<div class="col-sm-10">
				<?php echo $this->Form->select('university_type_id', $type, array('class'=> 'form-control'));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Miasto</label>
			<div class="col-sm-10">
				<?php echo $this->Form->input('miasto', array('label' => false, 'class'=> 'form-control'));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Województwo</label>
			<div class="col-sm-10">
				<?php echo $this->Form->select('district_id', $district, array('class'=> 'form-control'));?>
			</div>
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
			<label class="col-sm-2 control-label">Fb</label>
			<?php echo $this->Form->input('UniversitiesParameter.fb', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Google+</label>
			<?php echo $this->Form->input('UniversitiesParameter.gplus', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">YouTube</label>
			<?php echo $this->Form->input('UniversitiesParameter.yt', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Twitter</label>
			<?php echo $this->Form->input('UniversitiesParameter.twitter', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Opis</label>
			<?php echo $this->Form->input('UniversitiesParameter.opis', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Link rejestreacji</label>
			<?php echo $this->Form->input('link_rejestracji', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="col-md-2">
			<span class="gmap-overflow-call" data-toggle="modal" data-target="#gmap-overflow">mapa</span>
		</div>
		<div class="col-md-10">			
			<div class="form-group col-md-6">
				<label class="col-sm-4">Lokalizacja X</label>
				<?php echo $this->Form->input('UniversitiesParameter.lokalizacja_x', array( 'label' => false, 'div' => 'col-sm-8', 'class'=> 'gmap-lon form-control'));?>
			</div>
			<div class="form-group col-md-6">
				<label class="col-sm-4">Lokalizacja Y</label>
				<?php echo $this->Form->input('UniversitiesParameter.lokalizacja_y', array( 'label' => false, 'div' => 'col-sm-8', 'class'=> 'gmap-lat form-control'));?>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-sm-2 control-label">Logo</label>
			<div class="col-sm-10">
				<?php $this->Form->error( 'avatar' );?>
				<?php
				if(!empty( $this->request->data['logo'])): ?>
					<div class="input col-sm-6">
						<label>Obecne logo:</label>
						<img src="/uploads/<?php echo  $this->request->data['logo']; ?>" width="200" />
					</div>
				<?php endif;?>
				<div class="col-sm-6">
					<?php echo  $this->Form->input('Loga.logo', array('label'=>'Załaduj inne logo:', 'type'=>'file'));	?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Galeria</label>
			<div class="col-sm-10">
				<?php if (isset($this->request->data['galeria'])) :?>
					<?php foreach($this->request->data['galeria'] as $image):?>
						<img src="/miniatura/200x200/uploads/<?php echo  $image; ?>"/>
					<?php endforeach;?>
				<?php endif;?>
				<?php echo $this->Upload->edit('University', $this->Form->fields['University.id']);?>
			</div>
		</div> -->

		<!-- <div class="form-group">
			<label class="col-sm-2 control-label">Galeria</label>
			<div class="col-sm-10">
				<div class="jsimageupload_multi">
				<?php if (!empty($this->request->data['galeria'])) :
					foreach ($this->request->data['galeria'] as $gal) :?>
						<div class="uimage">
							<input type="hidden" name="galeria[]" value="<?php echo $gal;?>"/>
							<img src="/miniatura/200x200/uploads/<?php echo $gal;?>"/>
							<div class="buttons"><span class="leftimage"> &laquo; </span><span class="delimage">usuń</span><span class="rightimage"> &raquo; </span></div></div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-2 control-label">Zakladka1</label>
			<?php echo $this->Form->input('UniversitiesParameter.zakladka1', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Zakladka2</label>
			<?php echo $this->Form->input('UniversitiesParameter.zakladka2', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Zakladka3</label>
			<?php echo $this->Form->input('UniversitiesParameter.zakladka3', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Zakladka4</label>
			<?php echo $this->Form->input('UniversitiesParameter.zakladka4', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Nazwa zakładki 1</label>
			<?php echo $this->Form->input('UniversitiesParameter.nzakladki1', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Nazwa zakładki 2</label>
			<?php echo $this->Form->input('UniversitiesParameter.nzakladki2', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Nazwa zakładki 3</label>
			<?php echo $this->Form->input('UniversitiesParameter.nzakladki3', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Nazwa zakładki 4</label>
			<?php echo $this->Form->input('UniversitiesParameter.nzakladki4', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Tagi</label>
			<?php echo $this->Form->input('UniversitiesParameter.tagi', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta description</label>
			<?php echo $this->Form->input('UniversitiesParameter.meta_description', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta keywords</label>
			<?php echo $this->Form->input('UniversitiesParameter.meta_keywords', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
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
	echo $this->element('html_gmap');
?>