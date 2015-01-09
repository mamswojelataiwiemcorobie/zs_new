<div class="subsite form col-sm-11">
<?php echo $this->Form->create('Subsite', array('type' => 'file', 'class'=>'form-horizontal', 'role'=>'form')); ?>
    <form class="form-horizontal" role="form">
		
        <legend><?php echo __('Edytuj podstronę'); ?></legend>
		<div class="form-group">
		<?php 	echo $this->Form->hidden('id', array('value' => $this->data['Subsite']['id']));?>
			<label class="col-sm-2 control-label">Nazwa</label>			
			<?php echo $this->Form->input('tytul', array('label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Html</label>
			<?php echo $this->Form->input('html', array( 
				'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control wysiwig'
				) 
			); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta title</label>
			<?php echo $this->Form->input('meta_title', array( 'label' => false, 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta description</label>
			<?php echo $this->Form->input('meta_description', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<label class="col-sm-2">Meta keywords</label>
			<?php echo $this->Form->input('meta_keywords', array( 'label' => false, 'type'=>'textarea', 'div' => 'col-sm-10', 'class'=> 'form-control'));?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <?php echo $this->Form->button('Edytuj podstronę', array('type' => 'submit', 'class'=> 'btn btn-default'));?>
			</div>
		  </div>
		</div>
    </form>
<?php echo $this->Form->end(); ?>
</div>
<div class="clearfix"></div>
<?php echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') ); ?>