<div id="lista_erasmusy" class="view">
	<?php if (!isset($this->request->data['Exchange']['kraj'])):?>
		<?php echo $uczelnie_erasmus; ?>
	<?php endif;?>
	<?php if (isset($this->request->data['Exchange']['kraj'])):?>
	<h2 style="clear: both;">Uczelnia Zagraniczna:</h2>
		<div class="ucz_">
			<h4> Kraj: <?php echo $this->request->data['Exchange']['kraj']; ?></h4>

			<?php if (isset($this->request->data['Exchange']['miasto'])):?>
				<h4> Miasto: <?php echo $this->request->data['Exchange']['miasto']; ?></h4>

				<?php 	if (isset($this->request->data['Exchange']['uczelnia'])) :?>
					<h4> Uczelnia: 
					<?php 
						$slug = Inflector::slug($this->request->data['Exchange']['uczelnia'],'-');
						$idd = $uczelnie_erasmus[0]['Exchange']['id'];
						echo $this->Html->link($this->request->data['Exchange']['uczelnia'],
									array( 'controller' => 'exchanges',
										  'action' => 'view',
										  'id' => $idd,
										  'slug'=>$slug
									)); 
					?>
					</h4>
					<!--
					<ul class="icons handlist">
						<li>
							<b>
							<?php 
								$slug = Inflector::slug($this->request->data['Exchange']['uczelnia'],'-');
								$idd = $uczelnie_erasmus[0]['Exchange']['id'];


								/*
								pr($this->data['submit']);

								pr($this->request->data);
								pr($_POST);
								pr($this->request);
								pr($this->params);
								pr($this->data);
								*/

								echo $this->Html->link($this->request->data['Exchange']['uczelnia'],
									array( 'controller' => 'exchanges',
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
					-->
				<?php endif;?>
			
		<?php endif;?>
		</div>
		<h2>Lista uczelni które mają podpisane umowy w ramach programu Erasmus:</h2>
		<!--
			<div class="ucz_">
				<ul id="uczelnie_lista" class="icons arrowlist">

					<?php /*
						//pr($uczelnie_erasmus);
						$uni_list = array();
						foreach ($uczelnie_erasmus as $u){
							$uni = $u['University']['id'];
							if (in_array($uni, $uni_list)){
							
							}else{
								array_push($uni_list, $uni);
					//?>
						<li>
							<?php $slug = Inflector::slug($u['University']['nazwa'],'-');?>
							<?php 
								echo $this->Html->link($u['University']['nazwa'],
									   array( 'controller' => 'universities',
											  'action' => 'view',
											  'id' => $u['University']['id'],
											  'slug'=>$slug
									   )); 
							}
							?>
						</li>
					//<?php  
						}
						//pr($uni_list);
					*/ ?>
				</ul>
			</div>
		-->
	<?php endif ?>
</div>




