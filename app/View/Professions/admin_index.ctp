<div class="zawody">
	<h1>Zawody</h1>
	<div class="pull-right">
		<?php echo $this->Form->create('Profession',array('action'=>'search','class'=>'form-inline', 'role'=>'form'));?>
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
					<th><?php echo $this->Paginator->sort('placa', 'Płaca');?></th>
					<th><?php echo $this->Paginator->sort('opis', 'Opis');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($courses as $course): ?>                
					<td><?php echo $course['Profession']['id']; ?></td>
					<td><?php echo $this->Html->link( $course['Profession']['nazwa']  ,   array('action'=>'edit', $course['Profession']['id']),array('escape' => false) );?></td>
					<td><?php echo $course['Profession']['placa']; ?></td>
					<td><?php echo $course['Profession']['opis']; ?></td>
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $course['Profession']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $course['Profession']['id'])); ?> |
					<?php 	echo $this->Html->link(    "Kierunki", array('controller'=> 'professions_courses', 'action'=>'listaz', $course['Profession']['id']));	?>
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
<?php echo $this->Html->link( "Dodaj zawód",   array('action'=>'add'),array('escape' => false) ); ?>