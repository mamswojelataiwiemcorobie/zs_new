<div class="exchanges form">
	<h1>Kierunki</h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th><?php echo $this->Paginator->sort('University.nazwa', 'Uniwersytet PL');?>  </th>
					<th><?php echo $this->Paginator->sort('kraj', 'Kraj');?></th>
					<th><?php echo $this->Paginator->sort('miasto', 'Miasto');?></th>
					<th><?php echo $this->Paginator->sort('nazwa_uczelni', 'Uczelnia zagraniczna');?></th>
					<th><?php echo $this->Paginator->sort('nazwa_kierunku', 'Kierunek');?></th>
					<th><?php echo $this->Paginator->sort('URL', 'www');?></th>
					<th><?php echo $this->Paginator->sort('pakiet', 'Pakiet');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($exchanges as $exchange): ?>                
					<td><?php echo $exchange['Exchange']['id']; ?></td>
					<td><?php echo $exchange['University']['nazwa']; ?></td>
					<td><?php echo $exchange['Exchange']['kraj']; ?></td>
					<td><?php echo $exchange['Exchange']['miasto']; ?></td>
					<td><?php echo $exchange['Exchange']['nazwa_uczelni']; ?></td>
					<td><?php echo $exchange['Exchange']['nazwa_kierunku']; ?></td>
					<td><?php echo $exchange['Exchange']['URL']; ?></td>
					<td><?php echo $exchange['Exchange']['pakiet']; ?></td>
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $exchange['Exchange']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $exchange['Exchange']['id'])); ?> |
					</td>
				</tr>
				<?php endforeach; ?>
				<?php unset($exchange); ?>
			</tbody>
		</table>
	</div>
	<ul class="pagination">
		<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?></li>
		<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
	</ul>
</div>                
<?php echo $this->Html->link( "Dodaj nowego Erasmusa",   array('action'=>'add'),array('escape' => false) ); ?>