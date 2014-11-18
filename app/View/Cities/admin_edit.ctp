<div class="university form col-sm-11">
<?php echo $this->Form->create('City', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form')); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Edit City'); ?></legend>
		<div class="form-group">
		<?php 	echo $this->Form->hidden('id', array('value' => $this->data['City']['id']));?>
			<label class="col-sm-2 control-label">Nazwa</label>			
			<?php echo $this->Form->input('nazwa', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<?php
				if(!empty( $this->request->data['City']['photo'])): ?>
					<div class="input col-sm-6">
						<label>Obecny herb:</label>
						<img src="/img/miasta/<?php echo  $this->request->data['City']['photo']; ?>" width="200" />
					</div>
				<?php endif;?>
				<div class="col-sm-6">
					<?php echo  $this->Form->input('photo', array('label'=>'Załaduj nowy herb:', 'type'=>'file'));	?>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Cena za miejsce w pokoju</label>
				<?php echo $this->Form->input('pokoj_miejsce', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Cena za pokój</label>
			<?php echo $this->Form->input('pokoj', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Cena biletu studenckiego</label>
			<?php echo $this->Form->input('bilet', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Cena z bilet miesięczny studencki</label>
			<?php echo $this->Form->input('bilet_m', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Cena obiadu</label>
			<?php echo $this->Form->input('obiad', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Stopa bezrobocia</label>
			<?php echo $this->Form->input('bezrobocie', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Ilość studentów</label>
			<?php echo $this->Form->input('studenci', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">średnia płaca w mieście</label>
			<?php echo $this->Form->input('placa', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Srednia</label>
			<?php echo $this->Form->input('srednia', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Szerokość geograficzna</label>
			<?php echo $this->Form->input('lat', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Długość geograficzna</label>
			<?php echo $this->Form->input('lng', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Opis</label>
			<?php echo $this->Form->input('opis', array( 'label' => false, 'div' => 'col-sm-10'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Rank</label>
			<?php echo $this->Form->input('rank', array( 'label' => false, 'div' => 'col-sm-10'));?>
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