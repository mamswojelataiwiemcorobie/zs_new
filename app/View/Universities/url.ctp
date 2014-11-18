<style>
	.tl, .btn > a{
		color:#2E2F44;
	}
	.tl{
		display: inline;
	}
	.btn-block > div > p{
		display: inline;
		padding-right: 10px;
	}
	.btn-primary{
		min-height: 136px;
	}
	.btn-danger{
		background-color: white;
		color: rgb(63, 63, 63);
		border-color: rgb(179, 179, 179);
	}
	address{
		margin-bottom: 0px !important;
	}
	.pie{
		height: 406px;
	}
</style>
<?php

function truncate($string) {
	//truncates a string to a certain char length, stopping on a word if not specified otherwise.
	
	if (strrpos(substr($string, 0, 470), "\n", 1)  !== FALSE) {
		//$length =(strrpos(substr($string, 0, 550), "\n", 1);
		$length = substr($string, 0, strrpos(substr($string, 0, 550), "\n", 1));
	} else{}
		$length = 200 + strrpos(substr($string, 200, 100), ' ', 1);
		//$length = 450;	
	
	if (strlen($string) > $length) {
		//limit hit!
		$string = substr($string,0,($length));                 
	}
	//$string .= '...';
	return $string;
}
?>
<?php
	//pr($this->request->data);
	//pr($this->Js->writeBuffer());
?>
<div class="info-box shadow-large bottom0">
	<div class="info-box-inner">
	<?php 
		echo $this->Form->create('University', array('action' => 'url', 'class' => 'form-inline', 'role' => 'form'));
		echo $this->Form->input('University.id', array(
										
										'div' => 'form-group',
										'class' => 'form-control',
											'type' => 'select',
											'options' => $options,
											'selected' => $university['University']['id'],
										'label' => array(
											'class' => 'sr-only',
											'text' => 'Pierwsza szkoła'
										)
										));

		echo $this->Form->input('University.id2', array(
										'div' => 'form-group',
										'class' => 'form-control',
										'style' => '"width: 100px"',
											'type' => 'select',
											'options' => $options,
											'selected' => $university2['University']['id'],
											'empty' => '(wybierz szkołe)',
										'label' => array(
											'class' => 'sr-only',
											'text' => 'Druga szkoła'
										)
										));
		?>
		<div class="p-b-center">
			<?php 
			echo $this->Form->button('<i class="icon-th"></i>&nbsp;Porównaj', array('type' => 'submit', 'class' => 'btn btn-default'));
			echo $this->Form->end();?>
		</div>
	</div>
</div>
<div id="uniwersytet">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="bg">
				<img src="http://porownywarka.local/img/shp.png" class="img-responsive" alt="">
			</div>		
			<div class="p-uni" >
				<div class="p-uni-2">
					<h2><?php echo h($university['University']['nazwa']); ?></h2>
				</div>
			</div>
		</div>	
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="bg">
				<img src="http://porownywarka.local/img/shp.png" class="img-responsive" alt="">
			</div>
			<div class="p-uni" >
				<div class="p-uni-2">
					<h2><?php echo h($university2['University']['nazwa']); ?></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="p-log" >
				<div class="p-log-2">
					<div class="p-log-3">
						<div class="p-log-4">
							<?php 
							$image = substr($university['University']['photo'],0, -4).".png";
							if (!empty($university['University']['photo'])) :?>
								<img class="logo img-responsive" src="/img/uczelnie_min/<?php echo $image;?>" ph="<?php echo $university['University']['photo'];?>" alt="<?php echo $university['University']['nazwa'];?> ">
							<?php else :?>
								<img class="logo img-responsive" src="/img/uczelnie/<?php echo 'no-photo.jpg';?>">
							<?php endif;?>
						</div>
					</div>
				 </div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="p-log" id="p-log">
				<div class="p-log-2" id="p-log-2">
					<div class="p-log-3" id="p-log-3">
						<div class="p-log-4" id="p-log-4">
							<?php 
							$image2 = substr($university2['University']['photo'],0, -4).".png";
							if (!empty($university['University']['photo'])) :?>
								<img class="logo img-responsive" src="/img/uczelnie_min/<?php echo $image2;?>" alt="<?php echo $university2['University']['nazwa'];?>">
							<?php else :?>
								<img class="logo img-responsive" src="/img/uczelnie/<?php echo 'no-photo.jpg';?>">
							<?php endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-primary btn-lg btn-block">
				<?php if (isset($university['UniversitiesParameter']['adres'])) :?>
					<address>
						<?php 
							if(!empty($university['UniversitiesParameter']['adres'])){
								echo $university['UniversitiesParameter']['adres'];
								echo '<br info="adres" />';
							}else{
								if(!empty($university2['UniversitiesParameter']['adres'])){
									echo '<br i="adres not exist" />';
								}
							}

							if(!empty($university['UniversitiesParameter']['telefon'])){
								echo $university['UniversitiesParameter']['telefon'];
								echo '<br info="telefon" />';
							}else{
								if(!empty($university2['UniversitiesParameter']['telefon'])){
									echo '<br i="telefon not exist" />';
								}
							}

							if(!empty($university['UniversitiesParameter']['email'])){
								echo $university['UniversitiesParameter']['email'];
								echo '<br info="email" />';
							}else{
								if(!empty($university2['UniversitiesParameter']['email'])){
									echo '<br i="email not exist" />';
								}
							}
						?>
					</address>
				<?php endif;?>
				<?php 
					if(!empty($university['UniversitiesParameter']['www'])){
							echo '<a href="'.$university['UniversitiesParameter']['www'].'">'.$university['UniversitiesParameter']['www'].'</a>';
							echo '<br info="www2" />';
						}else{
							if(!empty($university2['UniversitiesParameter']['www'])){
								echo '<br i="www2 not exist" />';
							}
						}
				?>
				<br>
				<a class="btn btn-danger" href="#">
				<i class="icon-th"></i> Zobacz więcej</a>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-primary btn-lg btn-block">
				<?php if (isset($university2['UniversitiesParameter']['adres'])) :?>
					<address>
						<?php 
							if(!empty($university2['UniversitiesParameter']['adres'])){
								echo $university2['UniversitiesParameter']['adres'];
								echo '<br info="adres2" />';
							}else{
								if(!empty($university['UniversitiesParameter']['adres'])){
									echo '<br i="adres2 not exist" />';
								}
							}
														
							if(!empty($university2['UniversitiesParameter']['telefon'])){
								echo $university2['UniversitiesParameter']['telefon'];
								echo '<br info="telefon2" />';
							}else{
								if(!empty($university['UniversitiesParameter']['telefon'])){
									echo '<br i="telefon2 not exist" />';
								}
							}

							if(!empty($university['UniversitiesParameter']['email'])){
								echo $university['UniversitiesParameter']['email'];
								echo '<br info="email" />';
							}else{
								if(!empty($university2['UniversitiesParameter']['email'])){
									echo '<br i="email not exist" />';
								}
							}
						?>
					</address>
				<?php endif;?>
				<?php 
					if(!empty($university2['UniversitiesParameter']['www'])){
							echo '<a href="'.$university2['UniversitiesParameter']['www'].'">'.$university2['UniversitiesParameter']['www'].'</a>';
							echo '<br info="www2" />';
						}else{
							if(!empty($university['UniversitiesParameter']['www'])){
								echo '<br i="www2 not exist" />';
							}
						}
				?>
				<br>
				<a class="btn btn-danger" href="#">
				<i class="icon-th"></i> Zobacz więcej</a>
			</div>
		</div>	
	</div>
	<!--
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-default btn-lg btn-block">
				<p>Kategoria: <?php //echo $university['UniversityType']['nazwa']; ?>	</p>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-default btn-lg btn-block">
				<p>Kategoria: <?php //echo $university2['UniversityType']['nazwa']; ?>		</p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-default btn-lg btn-block">
				<?php
					$slug = Inflector::slug($university['University']['nazwa'],'-');
					echo $this->Html->link( "Zobacz wiecej na Zostań Studentem", 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university['University']['id'].".html",array('class' => 'tl') );?>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-default btn-lg btn-block">
				<?php $slug = Inflector::slug($university2['University']['nazwa'],'-');?>
				<?php echo $this->Html->link( "Zobacz wiecej na Zostań Studentem", 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university2['University']['id'].".html" ,array('class' => 'tl'));?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-primary btn-lg btn-block">
				<?php if (isset($university['UniversitiesParameter']['opis'])) :?>
					<div>
						<?php //echo truncate($university['UniversitiesParameter']['opis']);
							 $slug = Inflector::slug($university['University']['nazwa'],'-');
							//echo $this->Html->link( "...", 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university['University']['id'].".html",array('class' => 'tl') );?>
					</div>
				<?php endif;?>			
					
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div class="btn btn-primary btn-lg btn-block">
				<?php if (isset($university2['UniversitiesParameter']['opis'])) :?>
					<div>
						<?php //echo  truncate($university2['UniversitiesParameter']['opis'])?>
						<?php $slug = Inflector::slug($university2['University']['nazwa'],'-');?>
						<?php //echo $this->Html->link( "...", 'http://www.zostanstudentem.pl/uczelnia/'.$slug.'-'.$university2['University']['id'].".html" ,array('class' => 'tl'));?>
					</div>
				<?php endif;?>
				
				
			</div>
		</div>
	</div>
	-->
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">	
			<?php if (isset($university['University']['srednia'])) :?>		
				<div type="button" class="btn btn-default btn-lg btn-block">
					Pozycja w naszym rankingu: <?php echo $university['University']['rank']; ?>
				</div>
			<?php endif;?>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">	
			<?php if (isset($university2['University']['srednia'])) :?>
				<div type="button" class="btn btn-default btn-lg btn-block">
					Pozycja w naszym rankingu: <?php echo $university2['University']['rank']; ?>
				</div>
			<?php endif;?>
		</div>
	</div>
	<!--
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">						
			<?php if (!empty($university['University']['kategoria'])) :?>
				<div type="button" class="btn btn-default btn-lg btn-block">
					<p>Kategoria przyznana szkole przez Ministerstwo Nauki: <?php echo h($university['University']['kategoria']); ?></p>
				</div>
			<?php endif;?>		
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">			
			<?php if (!empty($university2['University']['kategoria'])) :?>
				<div type="button" class="btn btn-default btn-lg btn-block">
					<p>Kategoria przyznana szkole przez Ministerstwo Nauki: <?php echo h($university2['University']['kategoria']); ?></p>
				</div>
			<?php endif;?>		
		</div>
	</div>
	-->


	<?php
		$style_1 = "";
		$style_2 = "";
		if( ( $university['University']['il_st_pl'] ==0) || ($university['University']['il_st_bezpl'] ==0) ){
			$style_1 = 'style="visibility:hidden;';
		}
		if( ( $university2['University']['il_st_pl'] ==0) || ($university2['University']['il_st_bezpl'] ==0) ){
			$style_2 = 'style="visibility:hidden;';
		}
	?>	
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 pie">	
				<div class="vuzz-pricing popular">
					<h2>Ilość studentów stacjonarnych i niestacjonarnych:</h2>
					<div id="chart_publiczne1" class="sto" <?php echo $style_1; ?> ></div>		
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 pie">	
				<div class="vuzz-pricing popular">
					<h2>Ilość studentów stacjonarnych i niestacjonarnych:</h2>
					<div id="chart_publiczne2" class="sto" <?php echo $style_2; ?> ></div>		
				</div>
			</div>
		</div>


	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div><?php if (!empty($u)):?>
				<h2>Kierunki na tej uczelni:</h2>
				<div class="panel-group" id="accordion">
					<?php foreach ($u as $kursy) : ?>
					<div >
					<div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $kursy['nazwa_typ'];?>" onclick=" if (this.className=='active'){this.className='';} else {this.className='active'}">
						<h4 class="fontregular">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $kursy['nazwa_typ'];?>">
							<?php echo $kursy['nazwa_typ']; ?>
						</a>					
						</h4>
					</div>
					<div id="<?php echo $kursy['nazwa_typ']; unset($kursy['nazwa_typ']);?>" class="panel-collapse collapse">
						<div class="panel-body">
						<ul>
							<?php //$doubler_kraj[];
							foreach ($kursy as $kurs) {
									$slug = Inflector::slug($kurs['nazwa'],'-');
									echo '<li>'. $this->Html->link( $kurs['nazwa'], '/kierunek/'.$slug.'-'.$kurs['id'] ) .'</li>';	
							}?>
						</ul>
						</div>
					</div>
					</div><?php endforeach; ?>
				</div><?php endif ?>			
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div>
			<?php if (!empty($u2)):?>
				<h2>Kierunki na tej uczelni:</h2>
				<div class="panel-group" id="accordion">
					<?php foreach ($u2 as $kursy2) : ?>
					<div >
						<div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"  href="#<?php echo $kursy2['nazwa_typ'];?>2"  onclick=" if (this.className=='active'){ this.className=''; } else {this.className='active'}">
							<h4 >
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $kursy2['nazwa_typ'];?>2">
								<?php echo $kursy2['nazwa_typ']; ?>
							</a>
							</h4>
						</div>
						<div id="<?php echo $kursy2['nazwa_typ']. '2'; unset($kursy2['nazwa_typ']);?>" class="panel-collapse collapse">
							<div class="panel-body">
							<ul><?php 
								foreach ($kursy2 as $kurs2) {
										$slug = Inflector::slug($kurs2['nazwa'],'-');
										echo '<li>'. $this->Html->link( $kurs2['nazwa'], '/kierunek/'.$slug.'-'.$kurs2['id'] ) .'</li>';
								} ?>
							</ul>
							</div>
						</div>
					</div><?php endforeach; ?>
				</div><?php endif ?>			
			</div>
		</div>	
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div>
			<?php if (!empty($university['Exchange'])):?>
				<h2>Ta uczelnia ma podpisane umowy w ramach programu Erasmus z następującymi krajami:</h2>				
				<ul>
					<div class="panel-group" id="accordion">
					<?php foreach ($university['Exchange'] as $ex) : ?>
						<?php $doubler_kraj[]=""; 
							$slug = Inflector::slug($ex['kraj'],'-');
							if(!in_array($slug, $doubler_kraj)): 
						?>
						<div >
							<div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo str_replace(" ", "-", $ex['kraj']); ?>"  onclick=" if (this.className=='active'){ this.className=''; } else {this.className='active'}">
								<h4>
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo str_replace(" ", "-", $ex['kraj']); ?>" >
									<?php 	//echo $slug = Inflector::slug($ex['kraj'],'-');
											$doubler_kraj[]= $slug;
											echo $ex['kraj'];
											$pa= $ex['kraj'];?>
								</a>								
								</h4>
							</div>
							<div  id="<?php echo str_replace(" ", "-", $ex['kraj']); unset( $ex['kraj']);?>" class="panel-collapse collapse">
								<div class="panel-body">
								<ul>
									<?php
									foreach ($university['Exchange'] as $x){
										//echo $slug = Inflector::slug($x['kraj'],'-');
										//$slug = Inflector::slug($x['miasto'],'-');
										if($x['kraj']==$pa){
											$slug=($x['miasto']);
											$doubler_miasto[]="";
											if(!in_array($slug, $doubler_miasto)){
												echo $slug=($x['miasto']);
												$doubler_miasto[]= $slug;
												$mi= $slug;
												foreach ($university['Exchange'] as $e){
													if($e['miasto']==$mi){
														$slug1=Inflector::slug($e['nazwa_uczelni'],'-');
														$doubler_uni[]="";
														if(!in_array($slug1, $doubler_uni)){
															$slug1=Inflector::slug($e['nazwa_uczelni'],'-');
															$doubler_uni[]= $slug1;
															echo '<li>'. $this->Html->link( $e['nazwa_uczelni'], '/er
																azmus/'.$slug1.'-'.$e['id']).' '.$this->Html->link( 'www',$e['URL'],array('style' => 'color:#6495ED')).'</li>';
															//echo $mi;
															//echo $this-> Exchange-> find ('first', array('field' => 'Exchange.kraj');
															//echo '<li>'. $this->Html->link( $e['nazwa_uczelni'], ''] ) .'</li>';
														}
													}
												}
											}
										}
									}?>
								</ul>
								</div>
							</div>
						</div><?php endif; ?><?php endforeach; ?>
					</div><?php 
							/* 
							foreach ($university['Exchange'] as $ex) {
									$slug = Inflector::slug($ex['kraj'],'-');
									echo '<li>'. $this->Html->link( $ex['kraj'], 'http://www.erasmusy.pl/'.$slug.'-'.$ex['id'].'.html' ) .'</li>';
									echo $ex['miasto'];
									echo"----->";
									echo $ex['nazwa_uczelni'];
							}
							*/
							?>
				</ul><?php endif ?>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6">
			<div>
			<?php if (!empty($university2['Exchange'])):?>
				<h2>Ta uczelnia ma podpisane umowy w ramach programu Erasmus z następującymi krajami:</h2>
				<ul>
					<?php foreach ($university2['Exchange'] as $ex2) {
							//$slug = Inflector::slug($ex2['kraj'],'-');
							//echo '<li>'. $this->Html->link( $ex2['kraj'].'('.$ex2['miasto'].')', 'http://www.erasmusy.pl/'.$slug.'-'.$ex2['id'].'.html' ) .'</li>';
					}?>
				</ul>
				<ul>
					<div class="panel-group" id="accordion">
					<?php foreach ($university2['Exchange'] as $ex) : ?>
					<?php $doubler_kraj[]="";
						$slug = Inflector::slug($ex['kraj'],'-');
							if(!in_array($slug, $doubler_kraj)): 
					?>
						<div >
							<div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo  $ex['kraj'];?>"  onclick=" if (this.className=='active'){ this.className=''; } else {this.className='active'}">
								<h4 >
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo  $ex['kraj'];?>" >
									<?php 	//echo $slug = Inflector::slug($ex['kraj'],'-');
											$doubler_kraj[]= $slug;
											echo $ex['kraj'];
											$pa= $ex['kraj']?>
								</a>
								</h4>
							</div>
							<div  id="<?php echo $ex['kraj']; unset( $ex['kraj']);?>" class="panel-collapse collapse">
								<div class="panel-body">
								<ul>
									<?php
									foreach ($university2['Exchange'] as $x){
										//echo $slug = Inflector::slug($x['kraj'],'-');
										//$slug = Inflector::slug($x['miasto'],'-');
										if($x['kraj']==$pa){
											$slug=($x['miasto']);
											$doubler_miasto[]="";
											if(!in_array($slug, $doubler_miasto)){
											echo $slug=($x['miasto']);
												$doubler_miasto[]= $slug;
												$mi= $slug;
												foreach ($university2['Exchange'] as $e){
													if($e['miasto']==$mi){
														$slug1=Inflector::slug($e['nazwa_uczelni'],'-');
														$doubler_uni[]="";
														if(!in_array($slug1, $doubler_uni)){
															$slug1=Inflector::slug($e['nazwa_uczelni'],'-');
															$doubler_uni[]= $slug1;
															echo '<li>'. $this->Html->link( $e['nazwa_uczelni'], '/erazmus/'.$slug1.'-'.$e['id']).' '.$this->Html->link( 'www',$e['URL'],array('style' => 'color:#6495ED')).'</li>';


														}
													}
												}
											}
										}
									}?>
							</ul>
							</div>
						</div>
						</div><?php endif; ?><?php endforeach; ?>
					</div>
					<?php 
					/* 
					foreach ($university2['Exchange'] as $ex) {
							$slug = Inflector::slug($ex['kraj'],'-');
							echo '<li>'. $this->Html->link( $ex['kraj'], 'http://www.erasmusy.pl/'.$slug.'-'.$ex['id'].'.html' ) .'</li>';
							echo $ex['miasto'];
							echo"----->";
							echo $ex['nazwa_uczelni'];
					}
					*/
					?>
				</ul><?php endif ?>			
			</div>
		</div>
	</div>
	<div class="row">
			<h2>Stypendia i inna pomoc finansowa dostepna na uczelni:</h2>
			<div id="chart_uczelnia" class="sto chart"></div>
	</div>
	<div class="row">
			<h2>Koszty życia w mieście:</h2>
			<div id="chart_div" class="sto chart"></div>
	</div>
</div>


 <script type="text/javascript">
	function drawcharts() {
		//Struktura studentów wykres
		var student1_data = google.visualization.arrayToDataTable([
		  ['Label', 'Ilość'],
		  ['Ilość studentów stacjonarnych',<?php echo $university['University']['il_st_bezpl'] ?>],
		  ['Ilość studentów niestacjonarnych', <?php echo $university['University']['il_st_pl'] ?>],
		]);
		
			var student2_data = google.visualization.arrayToDataTable([
		  ['Label', 'Ilość'],
		  ['Ilość studentów stacjonarnych',<?php echo $university['University']['il_st_bezpl'] ?>],
		  ['Ilość studentów niestacjonarnych', <?php echo $university2['University']['il_st_pl'] ?>],
		]);

		var student_options = {
			tooltip: {text: 'percentage'},
			slices: {
				0: { color: '#f54828' },
				1: { color: '#3276b0' }
			},
			legend: {position:'top', alignment: 'center'}, 
			'chartArea':{left:"5%",width:"80%"},
			};

		var chart1 = new google.visualization.PieChart(document.getElementById('chart_publiczne1'));
		chart1.draw(student1_data, student_options);
				var chart2 = new google.visualization.PieChart(document.getElementById('chart_publiczne2'));
		chart2.draw(student2_data, student_options);

		//Stypendia Wykres
		var stypendia_data = google.visualization.arrayToDataTable([
		  ['Label', '<?php echo $university['University']['nazwa'] ?>', '<?php echo $university2['University']['nazwa']?>'],
		  <?php if (!empty($university['UniversitiesParameter']['akademik']) or !empty($university2['UniversitiesParameter']['akademik'])) :?>
			['Akademik',  <?php if (!empty($university['UniversitiesParameter']['akademik'])or !empty($university2['UniversitiesParameter']['akademik'])) echo $university['UniversitiesParameter']['akademik'].","; if (!empty($university['UniversitiesParameter']['akademik'])or !empty($university2['UniversitiesParameter']['akademik'])) echo $university2['UniversitiesParameter']['akademik'];?>],<?php endif;?>
		  <?php if (!empty($university['UniversitiesParameter']['s_sport']) or !empty($university2['UniversitiesParameter']['s_sport'])) :?>
			['Stypendium sportowe',  <?php if (!empty($university['UniversitiesParameter']['s_sport'])or !empty($university2['UniversitiesParameter']['s_sport'])) echo $university['UniversitiesParameter']['s_sport'].","; if (!empty($university['UniversitiesParameter']['s_sport'])or !empty($university2['UniversitiesParameter']['s_sport'])) echo $university2['UniversitiesParameter']['s_sport'];?>],<?php endif;?>
			 <?php if (!empty($university['UniversitiesParameter']['s_nauk']) or !empty($university2['UniversitiesParameter']['s_nauk'])) :?>
			['Stypendium naukowe',  <?php if (!empty($university['UniversitiesParameter']['s_nauk'])or !empty($university2['UniversitiesParameter']['s_nauk'])) echo $university['UniversitiesParameter']['s_nauk'].","; if (!empty($university['UniversitiesParameter']['s_nauk'])or !empty($university2['UniversitiesParameter']['s_nauk'])) echo $university2['UniversitiesParameter']['s_nauk'];?>],<?php endif;?>
			<?php if (!empty($university['UniversitiesParameter']['s_rektora']) or !empty($university2['UniversitiesParameter']['s_rektora'])) :?>
			['Stypendium rektora',  <?php if (!empty($university['UniversitiesParameter']['s_socj'])or !empty($university2['UniversitiesParameter']['s_rektora'])) echo $university['UniversitiesParameter']['s_rektora'].","; if (!empty($university['UniversitiesParameter']['s_rektora'])or !empty($university2['UniversitiesParameter']['s_rektora'])) echo $university2['UniversitiesParameter']['s_rektora'];?>],<?php endif;?>
			<?php if (!empty($university['UniversitiesParameter']['s_socj']) or !empty($university2['UniversitiesParameter']['s_socj'])) :?>
			['Stypendium socjalne',  <?php if (!empty($university['UniversitiesParameter']['s_socj'])or !empty($university2['UniversitiesParameter']['s_socj'])) echo $university['UniversitiesParameter']['s_socj'].","; if (!empty($university['UniversitiesParameter']['s_socj'])or !empty($university2['UniversitiesParameter']['s_socj'])) echo $university2['UniversitiesParameter']['s_socj'];?>],<?php endif;?>  
		]);

		var stypendia_options = {
			vAxis: {
				title: '[PLN]', 
				titleTextStyle: {color: 'red'}
			},
			colors: ['#f54828','#3276b0'],
		};

		var stypendia_chart = new google.visualization.ColumnChart(document.getElementById('chart_uczelnia'));
		stypendia_chart.draw(stypendia_data, stypendia_options);
		
		//Ceny Wykres
<?php if ( $university['City']['id'] == $university2['City']['id'] ) :?>
		var ceny_data = google.visualization.arrayToDataTable([
			['Label', '<?php echo $university['City']['nazwa'] ?>'],
			[<?php 
				if( !empty($university['City']['obiad']) or !empty($university2['City']['obiad']) ){
					echo "'Obiad', ";
				}

				if( !empty($university['City']['obiad']) or !empty($university2['City']['obiad']) ){
					echo $university['City']['obiad'];
				} 

			?>],
			[<?php 
				if( !empty($university['City']['bilet_m']) or !empty($university2['City']['bilet_m']) ){
					echo "'Bilet miesięczny', ";
				}

				if( !empty($university['City']['bilet_m']) or !empty($university2['City']['bilet_m']) ){
					echo $university['City']['bilet_m'];
				}
			?>],
			[<?php 
				if( !empty($university['City']['pokoj_miejsce']) or !empty($university2['City']['pokoj_miejsce']) ){
					echo "'Miejsce w pokoju', ";
				}

				if( !empty($university['City']['pokoj_miejsce']) or !empty($university2['City']['pokoj_miejsce']) ){
					echo $university['City']['pokoj_miejsce'];
				}
			?>],
			[<?php 
				if( !empty($university['City']['pokoj']) or !empty($university2['City']['pokoj']) ){
					echo "'Pokój jednoosobowy', ";
				}

				if( !empty($university['City']['pokoj']) or !empty($university2['City']['pokoj']) ){
					echo $university['City']['pokoj'];
				}
			?>]
		]);

		var ceny_options = {
			vAxis: {title: '[PLN]', titleTextStyle: {color: 'red'}, logScale: true},
			colors: ['#3276b0'],
		};

		var ceny_chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		ceny_chart.draw(ceny_data, ceny_options);
<?php else :?>
		var ceny_data = google.visualization.arrayToDataTable([
			['Label', '<?php echo $university['City']['nazwa'] ?>', '<?php echo $university2['City']['nazwa']?>'],
			[<?php 
				if( !empty($university['City']['obiad']) or !empty($university2['City']['obiad']) ){
					echo "'Obiad', ";
				}

				if( !empty($university['City']['obiad']) or !empty($university2['City']['obiad']) ){
					echo $university['City']['obiad'].",";
				} 

				if( !empty($university['City']['obiad']) or !empty($university2['City']['obiad']) ){
					echo $university2['City']['obiad'];
				}
			?>],
			[<?php 
				if( !empty($university['City']['bilet_m']) or !empty($university2['City']['bilet_m']) ){
					echo "'Bilet miesięczny', ";
				}

				if( !empty($university['City']['bilet_m']) or !empty($university2['City']['bilet_m']) ){
					echo $university['City']['bilet_m'].",";
				} 

				if( !empty($university['City']['bilet_m']) or !empty($university2['City']['bilet_m']) ){
					echo $university2['City']['bilet_m'];
				}
			?>],
			[<?php 
				if( !empty($university['City']['pokoj_miejsce']) or !empty($university2['City']['pokoj_miejsce']) ){
					echo "'Miejsce w pokoju', ";
				}

				if( !empty($university['City']['pokoj_miejsce']) or !empty($university2['City']['pokoj_miejsce']) ){
					echo $university['City']['pokoj_miejsce'].",";
				} 

				if( !empty($university['City']['pokoj_miejsce']) or !empty($university2['City']['pokoj_miejsce']) ){
					echo $university2['City']['pokoj_miejsce'];
				}
			?>],
			[<?php 
				if( !empty($university['City']['pokoj']) or !empty($university2['City']['pokoj']) ){
					echo "'Pokój jednoosobowy', ";
				}

				if( !empty($university['City']['pokoj']) or !empty($university2['City']['pokoj']) ){
					echo $university['City']['pokoj'].",";
				} 

				if( !empty($university['City']['pokoj']) or !empty($university2['City']['pokoj']) ){
					echo $university2['City']['pokoj'];
				}
			?>]
		]);

		var ceny_options = {
			vAxis: {title: '[PLN]', titleTextStyle: {color: 'red'}, logScale: true},
			colors: ['#f54828','#3276b0'],
		};

		var ceny_chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		ceny_chart.draw(ceny_data, ceny_options);
<?php endif; ?>		
		//Struktura studentów wykres
		var student1_data = google.visualization.arrayToDataTable([
		  ['Label', 'Ilość'],
		  ['Ilość studentów stacjonarnych',<?php echo $university['University']['il_st_bezpl'] ?>],
		  ['Ilość studentów niestacjonarnych', <?php echo $university['University']['il_st_pl'] ?>],
		]);
		
		var student_options = {
			tooltip: {text: 'percentage'},
			slices: {
			0: { color: '#f54828' },
			1: { color: '#3276b0' }
		  },
			//legend: {position:'top', alignment: 'center'}, 
			'chartArea':{left:"5%",width:"80%"},
		};
		
		var student2_data = google.visualization.arrayToDataTable([
		  ['Label', 'Ilość'],
		  ['Ilość studentów stacjonarnych',<?php echo $university2['University']['il_st_bezpl'] ?>],
		  ['Ilość studentów niestacjonarnych', <?php echo $university2['University']['il_st_pl'] ?>],
		]);

		

		

		
		var chartPublic1 = new google.visualization.PieChart(document.getElementById('chart_publiczne1'));
		chartPublic1.draw(student_data, student_options);
		
		var chartPublic2 = new google.visualization.PieChart(document.getElementById('chart_publiczne2'));
		chartPublic2.draw(student2_data, student_options);
	}
	google.setOnLoadCallback(drawcharts);
	google.load("visualization", "1", {packages:["corechart"]});
</script>

