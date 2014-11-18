<?php
	echo "1a";
	pr($this->request->data);
	//pr($this->Js->writeBuffer());
?>
<div id="x">
<?php
echo "1b";
	pr($this->request->data);
	//pr($this->Js->writeBuffer());
?>
	<?php 	if (isset($this->request->data['Exchange']['kraj'])) :?>

	<h2>Lista uczelni które mają podpisane umowy w ramach programu Erasmus:</h2>
	<ul id="uczelnie_lista" class="icons arrowlist">
		<?php foreach ($uczelnie_erasmus as $u) : ?>
			<li>
				<?php $slug = Inflector::slug($u['University']['nazwa'],'-');?>
				<?php echo $this->Html->link($u['University']['nazwa'],
						   array( 'controller' => 'universities',
								  'action' => 'view',
								  'id' => $u['University']['id'],
								  'slug'=>$slug
						   )); 
				?>
			</li>
		<?php endforeach ?>
	</ul>
	<?php endif;?>
</div>
