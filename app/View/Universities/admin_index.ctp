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
					<th><?php echo $this->Paginator->sort('University.miasta', 'Miasto');?></th>
					<th><?php echo $this->Paginator->sort('Abonament.nazwa', 'Pakiet');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($universities as $university): ?>                
					<td><?php echo $university['University']['id']; ?></td>
					<td><?php echo $this->Html->link( $university['University']['nazwa']  ,   array('action'=>'edit', $university['University']['id']),array('escape' => false) );?></td>
					<td><?php echo $university['UniversityType']['nazwa']; ?></td>
					<td><?php echo $university['University']['miasto']; ?></td>
					<td><?php echo $university['Abonament']['nazwa']; ?></td>
					<td >
					<?php 	echo $this->Html->link("Edit",   array('action'=>'edit', $university['University']['id']) ); ?> | 
					<?php	echo $this->Form->postLink('Usuń', array('action' => 'delete', $university['University']['id']),
	                    array('confirm' => 'Jesteś pewnien, że chcesz USUNĄĆ uczelnie?')
	                );?> |
					<?php 	echo $this->Html->link("Kierunki", array('controller'=> 'courseon_universities', 'action'=>'lista', $university['University']['id']));?> |
					<?php 	echo $this->Html->link("Wydziały", array('controller'=> 'faculties', 'action'=>'lista', $university['University']['id']));	?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php unset($university); ?>
			</tbody>
		</table>
	</div>
	<ul class="pagination">
		<?php
		  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
		  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
		  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
		?>
	</ul>
</div>   
<?php echo $this->Html->link( "Powrót do listy uniwersytetów",   array('action'=>'index'),array('escape' => false) ); ?>    
<br>         
<?php echo $this->Html->link( "Add A New University.",   array('action'=>'add'),array('escape' => false) ); ?>