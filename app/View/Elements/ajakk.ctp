<div id="lista_erasmusy">
	<?php 	if (isset($this->request->data['Ajak']['kraj'])) :?>
	<h2>Uczelnia Zagraniczna:</h2>
	<h3> Kraj: <?php echo $this->request->data['Ajak']['kraj']; ?></h3>
	<h3> Miasto: <?php echo $this->request->data['Ajak']['miasto']; ?></h3>
	<?php 	if (isset($this->request->data['Ajak']['uczelnia'])) :?>
	<h3> Uczelnia:</h3>
	<ul class="icons handlist">
		<li>
			<b>
				<?php 
					$slug = Inflector::slug($this->request->data['Ajak']['uczelnia'],'-');
					$idd = $uczelnie_erasmus[0]['Ajak']['id'];
					
					echo $this->Html->link($this->request->data['Ajak']['uczelnia'],
				   		array( 'controller' => 'Ajaks',
							  'action' => 'view',
							  'id' => $idd,
							  'slug'=>$slug
				   		)); 
				?>
			</b>
			<?php 
			/*
				echo 'www ';
				echo $this->Html->link('erasmus','http://www.erasmus.org.pl/',
					array('class' => 'button', 'target' => '_blank','style' => 'color:#39c;')); 
			*/
			?>
		</li>
	</ul>
	<?php endif;?>
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


