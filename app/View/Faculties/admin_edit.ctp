<div class="university form col-sm-11">
<?php echo $this->Form->create('Faculty', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form')); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Edit Faculty'); ?></legend>
		<div class="form-group">
		<?php 	echo $this->Form->hidden('id', array('value' => $this->data['Faculty']['id']));?>
			<label class="col-sm-2 control-label">Nazwa</label>			
			<?php echo $this->Form->input('nazwa', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">www</label>
			<?php echo $this->Form->input('www', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
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
		<div class="form-group"> 
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
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Logo</label>
			<div class="col-sm-10">
				<div class="jsimageupload_single">
				<?php if (!empty($this->request->data['Faculty']['logo'])) :?>
					<div class="uimage"><input type="hidden" name="FacultyLogo" value="<?php echo $this->request->data['Faculty']['logo']?>"/><img src="/miniatura/200x200/uploads/<?php echo $this->request->data['Faculty']['logo']?>"/>
					</div>
				<?php endif;?>
				</div>
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
			<?php echo $this->Form->input('meta_keywords', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <?php echo $this->Form->button('Edytuj uczelnie', array('type' => 'submit', 'class'=> 'btn btn-default'));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Kierunki</label>
			<div class="col-sm-10">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nazwa</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>                       
						<?php foreach ($courses as $course): ?>                
							<td><?php echo $course['Course']['id']; ?></td>
							<td><?php echo  $course['Course']['nazwa'];?></td>
							<td >
							<?php echo $this->Html->link("Delete", array('action'=>'delete_kurs', $this->data['Faculty']['id'], $course['Course']['id'])); ?> 
							</td>
						</tr>
						<?php endforeach; ?>
						<?php echo $this->Html->link("Dodaj kursy na wydziale", array('action'=>'add_courses', $this->data['Faculty']['id'])); ?> 
					</tbody>
				</table>
			</div>			
		</div>
	</form>
</div>
<div class="clearfix"></div>

<?php 
	echo $this->element('html_gmap_faculty');
?>
