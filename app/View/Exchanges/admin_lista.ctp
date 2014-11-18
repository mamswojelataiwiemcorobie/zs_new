<div class="erasmusy ">
	<h2>Ta uczelnia ma podpisane umowy w ramach programu Erasmus z następującymi krajami:</h2>
		<div class="panel-group" id="accordion">
		<?php foreach ($exchanges as $ex2) : ?>
		<?php $doubler_kraj2[]="";
			$slug2 = Inflector::slug($ex2['Exchange']['kraj'],'-');
				if(!in_array($slug2, $doubler_kraj2)): 
		?>
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $ex2['Exchange']['kraj'];?>">
						<?php 	//echo $slug = Inflector::slug($ex['kraj'],'-');
								$doubler_kraj2[]= $slug2;
								echo $ex2['Exchange']['kraj'];
								$pa= $ex2['Exchange']['kraj'];
								?>
						<div class = "pull-right"><?php	//echo $this->Html->link("Edit", array('action'=>'editk', $university, $ex2['Exchange']['kraj'])); ?> |
						<?php	echo $this->Html->link("Delete", array('action'=>'deletek', $university, $ex2['Exchange']['kraj'])); ?></div
					</a>
				  </h4>
				</div>
				<div id="collapse_<?php echo $ex2['Exchange']['kraj']; ?>" class="panel-collapse collapse">
					<ul>
						<?php
						foreach ($exchanges as $x){
							//echo $slug = Inflector::slug($x['kraj'],'-');
							//$slug = Inflector::slug($x['miasto'],'-');
							if($x['Exchange']['kraj']==$pa){
								$slug=($x['Exchange']['miasto']);
								$doubler_miasto[]="";
								if(!in_array($slug, $doubler_miasto)){
									$slug=($x['Exchange']['miasto']);?>
									<li><?php echo $x['Exchange']['miasto'];?>
										<?php echo $this->Html->link("Usuń", array('action'=>'deletem', $university, $x['Exchange']['miasto']), array('class'=>'text-danger')); ?>
										<ul>
										<?php $doubler_miasto[]= $slug;
										$mi= $slug;
										foreach ($exchanges as $e){
											if($e['Exchange']['miasto']==$mi){
												$slug1=Inflector::slug($e['Exchange']['nazwa_uczelni'],'-');
												$doubler_uni[]="";
												if(!in_array($slug1, $doubler_uni)){
													$slug1=Inflector::slug($e['Exchange']['nazwa_uczelni'],'-');
													$doubler_uni[]= $slug1;?>
													<li><?php echo $this->Html->link(  $e['Exchange']['nazwa_uczelni'], array('action'=>'editu', $university, $e['Exchange']['nazwa_uczelni']));?>
														<?php echo $this->Html->link("Usuń", array('action'=>'deleteu', $university, $e['Exchange']['nazwa_uczelni']), array('class'=>'text-danger')); ?>
														<ul>
														<?php 
														foreach ($exchanges as $kierunek) {
															if($kierunek['Exchange']['miasto']==$mi){
																$slug2=Inflector::slug($kierunek['Exchange']['nazwa_kierunku'],'-');
																$doubler_k[]="";
																if(!in_array($slug2, $doubler_uni)){
																	$slug1=Inflector::slug($kierunek['Exchange']['nazwa_kierunku'],'-');
																	$doubler_k[]= $slug2;?>
																	<li>
																		<?php echo $this->Html->link($kierunek['Exchange']['nazwa_kierunku'], array('action'=>'editkierunek', $university, $kierunek['Exchange']['nazwa_kierunku']));?>
																		<?php echo $this->Html->link("Usuń", array('action'=>'deletekierunek', $university, $ex2['Exchange']['nazwa_kierunku']), array('class'=>'text-danger')); ?>
																	</li>
																<?php
																}
															}
														}?>
														</ul>
													</li><?php
												}
											}
										}?>
										</ul>
									</li><?php
								}
							}
						}?>
					</ul>
				</div>
			</div><?php endif; ?><?php endforeach; ?>
		</div>

</div>
<div class="dodaj_kierunki">              
	<h3><?php	echo $this->Html->link("Dodaj nowe kierunki wyjazdu na erasmusa na tej uczelni", array('action'=>'addu', $university)); ?></h3>
</div>