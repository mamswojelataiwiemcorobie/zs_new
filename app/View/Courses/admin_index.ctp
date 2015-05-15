<div class="courses form">
	<h1>Kierunki</h1>
	<div class="pull-right">
		<?php echo $this->Form->create('Course',array('action'=>'search','class'=>'form-inline', 'role'=>'form'));?>
			<div class="form-group">
				<label class="sr-only"></label>
			<?php
				echo $this->Form->input('Search.keywords', array('label'=>false, 'class'=> 'form-control', 'placeholder'=>'Wpisz ID, lub nazwe'));?>
			</div>
			<div class="form-group">
				<label >Typ</label>
			<?php	echo $this->Form->input('Search.university_type_id', array('label'=>false, 'class'=> 'form-control', 'div'=>false));
				?>
			</div>
			<div class="form-group">
				<label >Kategoria</label>
				<?php	echo $this->Form->input('Search.courses_category_id', array('label'=>false,'empty'=>true,'class'=> 'form-control', 'div'=>false));?>
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
					<th><?php echo $this->Paginator->sort('id', 'ID');?></th>
					<th><?php echo $this->Paginator->sort('nazwa', 'Nazwa');?>  </th>
					<th><?php echo $this->Paginator->sort('CoursesCategory.nazwa', 'kategoria');?>  </th>
					<th><?php echo $this->Paginator->sort('UniversityType.nazwa', 'Typ');?>  </th>
					<!-- <th><?php echo $this->Paginator->sort('opis1', 'Opis');?></th>
					<th><?php echo $this->Paginator->sort('opis2', 'Opis2');?></th> -->
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($courses as $course): ?>                
					<td><?php echo $course['Course']['id']; ?></td>
					<td><?php echo $this->Html->link( $course['Course']['nazwa']  ,   array('action'=>'edit', $course['Course']['id']),array('escape' => false) );?></td>
					<td><?php echo $course['CoursesCategory']['nazwa']; ?></td>
					<td><?php echo $course['UniversityType']['nazwa']; ?></td>
					<!-- <td><?php echo $course['Course']['opis1']; ?></td>
					<td><?php echo $course['Course']['opis2']; ?></td> -->
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $course['Course']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $course['Course']['id'])); ?> 
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