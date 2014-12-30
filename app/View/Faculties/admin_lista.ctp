<div class="wydzialy form">
	<?php if(!empty($wydzialy)) : ?>
		<h1>Lista wydziałów uniwersytetu</h1>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nazwa</th>
						<th>Kierunki</th>
						<th>Opis</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>                       
					<?php foreach($wydzialy as $wydzial): ?>                
						<td><?php echo $wydzial['Faculty']['id']; ?></td>
						<td><?php echo $this->Html->link( $wydzial['Faculty']['nazwa']  ,   array('action'=>'edit', $wydzial['Faculty']['id']),array('escape' => false) );?></td>
						<td><ul>
							<?php foreach ($kursy[$wydzial['Faculty']['id']] as $kierunek):?>
								<li><?php echo $kierunek['Course']['nazwa'];?></li>
							<?php endforeach;?>
							</ul>
						</td>
						<td><?php echo $this->Text->truncate(strip_tags ($wydzial['Faculty']['opis']),
														    382,
														    array(
														        'ellipsis' => '...',
														        'exact' => false
														    )
														);?>
						</td>
						<td >
						<?php 	echo $this->Html->link(    "Edit",   array('action'=>'edit', $wydzial['Faculty']['id'])) ; ?> | 
						<?php	echo $this->Html->link(    "Delete", array('action'=>'delete', $wydzial['Faculty']['id'])); ?> 
						</td>
					</tr>
					<?php endforeach; ?>
					<?php unset($university); ?>
				</tbody>
			</table>
		</div>
	<?php else :?>
		<h2>Uczelnia nie ma jeszcze wydziałów, czy chcesz utworzyć nowe? </h2>
	<?php endif;?>
</div>  
<div class="dodaj_kierunki">              
	<h3>
		<?php	echo $this->Html->link("Dodaj nowe wydziały", array('controller'=>'faculties', 'action'=>'add_faculties', $university_id)); ?>
	</h3>
</div>