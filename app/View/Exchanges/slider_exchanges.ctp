<?php if (isset($this->request->data['Exchange']['kraj'])):?>
	<?php 
		$i = 0;
		$uni_list = array();
		foreach ($uczelnie_erasmus as $university){
			$uni = $university['University']['id'];
			if (in_array($uni, $uni_list)){
			}else{
				array_push($uni_list, $uni);
	
				$university= $university['University'];
				$slug = Inflector::slug($university['nazwa'],'-');
				$foto = $university['photo'];
				$foto = substr($foto, 0, -4).".png";
				$i = $i+1;
	
	?>
				<li class="li_" style="width:270px">
					<div class="boxcontainer" style="height:270px">
						<?php echo $this->Html->image('uczelnie_min/'.$foto, array('fullBase' => true)); ?>
						<div class="roll">
							<div class="wrapcaption">
								<?php echo $this->Html->link("", '/uczelnia/'.$slug.'-'.$university['id'] ); ?>
								<i class="icon-link captionicons"></i></a>
							</div>
						</div>
						<h1></h1>
							<?php echo $this->Html->link( $university['nazwa'], '/uczelnia/'.$slug.'-'.$university['id'] ); ?>
					</div>
				</li>
	<?php
			}
		}
	?>

	
<?php endif ?>

