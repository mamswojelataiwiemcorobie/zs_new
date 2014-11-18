<div class="erasmusy ">
	<?php if (!empty($zawody)) :?>
	<h2>Zawody po kierunku <?php echo $kurs['nazwa'];?>:</h2>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th><?php echo $this->Paginator->sort('Profession.nazwa', 'Nazwa');?>  </th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($zawody as $course): ?>                
					<td><?php echo $course['ProfessionsCourse']['id']; ?></td>
					<td><?php echo $course['Profession']['nazwa'];?></td>
					<td><?php echo $this->Html->link(    "Delete", array('action'=>'delete', $course['ProfessionsCourse']['id'], $course['ProfessionsCourse']['course_id'])); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<ul class="pagination">
		<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?></li>
		<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
	</ul>
	<?php else : ?>
	<div><h3>Nie znaleziono żadnych zawodów po kierunku <?php echo $kurs['nazwa'];?></h3>
		<?php echo $this->Html->link( "Powrót", array('controller'=>'courses', 'action'=>'index')); ?>
	</div>
	<?php endif;?>
</div>
<div class="dodaj_kierunki">              
	<h3><?php	echo $this->Html->link("Dodaj nowe zawody po tym kierunku", array('action'=>'add_pc', $kurs['id'])); ?></h3>
</div>