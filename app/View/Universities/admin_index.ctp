<div class="universitys form">
	<h1>Universytety</h1>
	<div class="pull-right">
		<?php echo $this->Form->create('University',array('action'=>'search','class'=>'form-inline', 'role'=>'form'));?>
			<div class="form-group">
				<label class="sr-only"></label>
			<?php
				echo $this->Form->input('Search.keywords', array('label'=>false, 'class'=> 'form-control'));?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->submit('Szukaj', array('class'=> 'btn btn-default'));
			?>
			</div>
		<?php echo $this->Form->end();?>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th><?php echo $this->Paginator->sort('nazwa', 'Nazwa');?>  </th>
					<th><?php echo $this->Paginator->sort('UniversityType.nazwa', 'Typ');?>  </th>
					<th><?php echo $this->Paginator->sort('City.nazwa', 'Miasto');?></th>
					<th><?php echo $this->Paginator->sort('pakiet', 'Pakiet');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($universities as $university): ?>                
					<td><?php echo $university['University']['id']; ?></td>
					<td><?php echo $this->Html->link( $university['University']['nazwa']  ,   array('action'=>'edit', $university['University']['id']),array('escape' => false) );?></td>
					<td><?php echo $university['UniversityType']['nazwa']; ?></td>
					<td><?php echo $university['City']['nazwa']; ?></td>
					<td><?php echo $university['University']['pakiet']; ?></td>
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $university['University']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $university['University']['id'])); ?> |
					<?php 	echo $this->Html->link(    "Kierunki", array('controller'=> 'courseon_universities', 'action'=>'lista', $university['University']['id']));	?> |
					<?php 	echo $this->Html->link(    "Erasmusy", array('controller'=> 'exchanges', 'action'=>'lista', $university['University']['id']));	?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php unset($university); ?>
			</tbody>
		</table>
	</div>
	<ul class="pagination">
		<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?></li>
		<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
	</ul>
</div>   
<?php echo $this->Html->link( "Powrót do listy uniwersytetów",   array('action'=>'index'),array('escape' => false) ); ?>    
<br>         
<?php echo $this->Html->link( "Add A New University.",   array('action'=>'add'),array('escape' => false) ); ?>