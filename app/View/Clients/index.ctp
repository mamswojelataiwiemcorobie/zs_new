<div class="users form">
	<h1>Client Users</h1>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th><?php echo $this->Paginator->sort('login', 'Login');?> </th>
				<th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>                       
			<?php foreach($users as $user): ?>    
			<tr>
				<td><?php echo $user['ClientUser']['id']; ?></td>
				<td><?php echo $this->Html->link( $user['Client']['login']  ,   array('action'=>'edit', $user['Client']['id']),array('escape' => false) );?></td>
				<td style="text-align: center;"><?php echo $user['ClientUser']['email']; ?></td>
				<td >
				<?php echo $this->Html->link( "Edit", array('action'=>'edit', $user['ClientUser']['id']) ); ?> | 
				<?php
				   
						echo $this->Html->link("Delete", array('action'=>'delete', $user['ClientUser']['id']));
				?>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php unset($user); ?>
		</tbody>
	</table>
	<ul class="pagination">
		<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?></li>
		<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
	</ul>
</div>                
<?php echo $this->Html->link( "Add A New Client User.",   array('action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>