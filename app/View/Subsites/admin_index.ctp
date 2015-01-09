<div class="universitys form">
	<h1>Podstrony info</h1>
	<div class="pull-right">
		<?php echo $this->Form->create('Subsites',array('action'=>'search','class'=>'form-inline', 'role'=>'form'));?>
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
					<th><?php echo $this->Paginator->sort('tytul', 'Tytul');?>  </th>
					<th><?php echo $this->Paginator->sort('html', 'Treść');?>  </th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($subsites as $university): ?>                
					<td><?php echo $university['Subsite']['id']; ?></td>
					<td><?php echo $this->Html->link( $university['Subsite']['tytul']  ,   array('action'=>'edit', $university['Subsite']['id']),array('escape' => false) );?></td>
					<td><?php echo $this->Text->truncate(strip_tags ($university['Subsite']['html']),
														    382,
														    array(
														        'ellipsis' => '...',
														        'exact' => false
														    )
														);?>
					<td >
					<?php 	echo $this->Html->link("Edit",   array('action'=>'edit', $university['Subsite']['id']) ); ?> | 
					<?php	echo $this->Html->link("Delete", array('action'=>'delete', $university['Subsite']['id'])); ?> |
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
<?php echo $this->Html->link( "Add A New Subsite.",   array('action'=>'add'),array('escape' => false) ); ?>