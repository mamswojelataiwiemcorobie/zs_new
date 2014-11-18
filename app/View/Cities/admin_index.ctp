<div class="universitys form">
	<h1>Miasta</h1>
	<div class="pull-right">
		<?php echo $this->Form->create('City',array('action'=>'search','class'=>'form-inline', 'role'=>'form'));?>
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
					<th><?php echo $this->Paginator->sort('photo', 'Zdjęcie');?></th>
					<th><?php echo $this->Paginator->sort('pokoj_miejsce', 'Cena miejce w pokoju');?>  </th>
					<th><?php echo $this->Paginator->sort('pokoj', 'Cana za pokój');?></th>
					<th><?php echo $this->Paginator->sort('bilet', 'Cena za bilet studencki');?></th>
					<th><?php echo $this->Paginator->sort('bilet_m', 'Cena za bilet miesięczny');?></th>
					<th><?php echo $this->Paginator->sort('obiad', 'Cena za obiad');?></th>
					<th><?php echo $this->Paginator->sort('bezrobocie', 'Bezrobocie[%]');?></th>
					<th><?php echo $this->Paginator->sort('studenci', 'Ilość studentów');?></th>
					<th><?php echo $this->Paginator->sort('placa', 'śr. płaca');?></th>
					<th>Lat/lng</th>
					<th><?php echo $this->Paginator->sort('opis', 'Opis');?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>                       
				<?php foreach($universities as $university): ?>                
					<td><?php echo $university['City']['id']; ?></td>
					<td><?php echo $this->Html->link( $university['City']['nazwa']  ,   array('action'=>'edit', $university['City']['id']),array('escape' => false) );?></td>
					<td><?php if (!empty($university['City']['photo'])) :?><img src="/img/miasta/<?php echo $university['City']['photo']; ?>" class="img-responsive"><?php else : echo 'NO image'; endif;?></td>
					<td><?php echo $university['City']['pokoj_miejsce']; ?></td>
					<td><?php echo $university['City']['pokoj']; ?></td>
					<td><?php echo $university['City']['bilet']; ?></td>
					<td><?php echo $university['City']['bilet_m']; ?></td>
					<td><?php echo $university['City']['obiad']; ?></td>
					<td><?php echo $university['City']['bezrobocie']; ?></td>
					<td><?php echo $university['City']['studenci']; ?></td>
					<td><?php echo $university['City']['placa']; ?></td>
					<td><?php echo $university['City']['lat']. '/'. $university['City']['lng']; ?></td>
					<td><?php echo $this->Text->truncate(
										$university['City']['opis'],
										220,
										array(
											'ellipsis' => '...',
											'exact' => false
										)
									);?></td>
					<td >
					<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $university['City']['id']) ); ?> | 
					<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $university['City']['id'])); ?> |
					</td>
				</tr>
				<?php endforeach; ?>
				<?php unset($university); ?>
			</tbody>
		</table>
	</div>
	<ul class="pagination">
		<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array(   'class' => 'numbers'  , 'separator'=>''   ));?></li>
		<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
	</ul>
</div>   
<?php echo $this->Html->link( "Powrót do listy uniwersytetów",   array('action'=>'index'),array('escape' => false) ); ?>    
<br>         
<?php echo $this->Html->link( "Dodaj miasto",   array('action'=>'add'),array('escape' => false) ); ?>