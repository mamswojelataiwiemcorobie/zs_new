<div class="courses form">
	<h1>Kierunki</h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th><?php echo $this->Paginator->sort('nazwa', 'Nazwa');?>  </th>
					<th><?php echo $this->Paginator->sort('CoursesType.nazwa', 'Typ');?>  </th>
					<th><?php echo $this->Paginator->sort('placa', 'Płaca');?></th>
					<th><?php echo $this->Paginator->sort('opis', 'Opis');?></th>
					<th><?php echo $this->Paginator->sort('srednia', 'średnia');?></th>
					<th><?php echo $this->Paginator->sort('rank', 'rank');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($courses as $course): ?>                
					<td><?php echo $course['Course']['id']; ?></td>
					<td><?php echo $this->Html->link( $course['Course']['nazwa']  ,   array('action'=>'edit', $course['Course']['id']),array('escape' => false) );?></td>
					<td><?php echo $course['CoursesType']['nazwa']; ?></td>
					<td><?php echo $course['Course']['placa']; ?></td>
					<td><?php echo $course['Course']['opis']; ?></td>
					<td><?php echo $course['Course']['srednia']; ?></td>
					<td><?php echo $course['Course']['rank']; ?></td>
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $course['Course']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $course['Course']['id'])); ?> |
					<?php 	echo $this->Html->link(    "Zawody", array('controller'=> 'professions_courses', 'action'=>'lista', $course['Course']['id']));	?>
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
<?php echo $this->Html->link( "Dodaj kierunek",   array('action'=>'add'),array('escape' => false) ); ?>