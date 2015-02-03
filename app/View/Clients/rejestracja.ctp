<?php echo $this->Form->create('Client', array('class'=>'form-horizontal', 'role'=>'form')); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Podaj swoje dane aby się zarejestrować'); ?></legend>
		<div class="form-group">
			<label class="col-sm-2 control-label">login</label>			
			<?php echo $this->Form->input('login', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Hasło</label>			
			<?php echo $this->Form->input('password', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Imie</label>			
			<?php echo $this->Form->input('ClientUsersData.name', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Nazwisko</label>			
			<?php echo $this->Form->input('ClientUsersData.surname', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Miasto</label>			
			<?php echo $this->Form->input('ClientUsersData.city', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Postcode</label>			
			<?php echo $this->Form->input('ClientUsersData.postcode', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">		
			<label class="col-sm-2 control-label">Województwo</label>			
			<?php echo $this->Form->input('ClientUsersData.district_id', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
	</form>
<?php echo $this->Form->end(); ?>
</div>
<div class="clearfix"></div>
<?php 
echo $this->Html->link( "Powrót",   array('action'=>'view') ); 
?>