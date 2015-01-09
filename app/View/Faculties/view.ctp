<div id="uczelnia">
	<div id="content">
		<section id="faculty" class="animated fadeInUp notransitioncont main row">
			<?php if ($university['Faculty']['logo']): ?>
				<div class="ml col-sm-4">
					<img itemprop="logo" src="/miniatura/180x260/uploads/<?php echo $university['Faculty']['logo'];?>" alt="Logo uczelni <?php echo $university['Faculty']['nazwa'];?>"/>
				</div>
			<?php endif; ?>
			<div class="mr row <?php if (!($university['Faculty']['logo'])): ?> mr-noimage<?php else: ?>col-sm-8<?php endif; ?>">
				<h2 itemprop="legalname">
					<a href="/uczelnia/<?php echo Inflector::slug($uczelnia['University']['nazwa'],'-').'-'.  $uczelnia['University']['id'];?>.html"><?php echo $uczelnia['University']['nazwa'];?></a>
				</h2>
				<h1 ><?php echo $university['Faculty']['nazwa'];?></h1>
				<div class="mbrl col-sm-8">
					<a href="http://<?php echo $university['Faculty']['www'];?>" itemprop="url" class="url" target="_blank"><?php echo $university['Faculty']['www'];?></a>
					<address itemprop="address">
						<?php echo $university['Faculty']['adres'];?>
						<?php if($university['Faculty']['telefon']):?><br/>tel: <?php echo $university['Faculty']['telefon']; endif; ?>
						<?php if($university['Faculty']['email']):?><br/>e-mail: <?php echo $university['Faculty']['email']; endif; ?>
					</address>
				</div>
				<div class="mbr col-sm-4">
					<?php if($university['Faculty']['fb'] || $university['Faculty']['gplus'] || $university['Faculty']['yt']):?>
						<ul class="social">
							<?php if($university['Faculty']['fb']):?>
								<li>
									<a href="<?php echo $university['Faculty']['fb'];?>" class="fb" target="_blank"><span class="icon-stack icon-lg"><i class="icon icon-facebook"></i></span></a>
								</li>
							<?php endif;?>
							<?php if($university['Faculty']['gplus']):?>
								<li>
									<a href="<?php echo $university['Faculty']['gplus'];?>" class="gp" id="plusone" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-google-plus"></i></span></a>
								</li>
							<?php endif;?>
							<?php if($university['Faculty']['yt']):?>
								<li><a href="<?php echo $university['Faculty']['yt'];?>" class="yt" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-youtube"></i></span></a></li>
							<?php endif;?>
							<?php if($university['Faculty']['twitter']):?>
								<li><a href="<?php echo $university['Faculty']['twitter'];?>" class="twitter" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-twitter"></i></span></a></li>
							<?php endif;?>
						</ul>
					<?php endif;?>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<div class="">
			<!--Begin Tabs 1-->
			<div id="horizontalTab">
				<ul class="nav nav-tabs">
					<li class="<?php if ($zakladka_page === 0) : ?>active<?php endif;?>">
						<a href="<?php echo $university['url'];?>">O WYDZIALE</a>
					</li>
					<li class="<?php if ($zakladka_page === 5): ?>active<?php endif;?>">
						<a href="<?php echo $university['url'];?>/KIERUNKI-5">KIERUNKI</a>
					</li>
				</ul>
				<div class="tab-content cont">
					<?php if ($zakladka_page === 0) : ?>
						<div class="tab-pane active row">
							<div class="col-sm-6">
								<?php if (strlen($university['Faculty']['opis']) > 0):?>
									<h1 class="smalltitle">
										<span>OPIS</span>
									</h1>
									<section >
										<div class="row">
											<div class="col-md-12 animated fadeInLeft notransition">
												<div class="info"><?php echo $university['Faculty']['opis'];?></div>
											</div>
										</div>
									</section>
								<?php endif;?>
							</div>
							<div class="col-sm-6">
								<div id="accordion-container" style="display: block; "?>
														
									<?php if ($wydzialy) :?>
										<h2 class="accordion-header">Inne wydziały uczelni</h2>
										<div class="accordion-content">
											<div class="col-md-12 animated fadeInLeft notransition">
												<ul class="icons chevronlist">	
													<?php foreach($wydzialy as $wydzial) : ?>											
														<li>
															<a href="/wydzial/<?php echo Inflector::slug($wydzial['Faculty']['nazwa'],'-').'-'. $wydzial['Faculty']['id'];?>.html"><?php echo $wydzial['Faculty']['nazwa'];?></a>
														</li>
													<?php endforeach;?>
												</ul>
											</div>
										</div>
									<?php endif;?>
									<?php if ($lokalizacja_poparawna) :?>
										<h2 id= "lokalizacja"class="accordion-header">Lokalizacja</h2>
										<div class="accordion-content mapa">
											<div class="animated fadeInLeft notransition">
												<div class="info" id="map-canvas" style="width: 100%; height: 266px; margin-bottom: 5%;"></div>
											</div>
										</div>
									<?php endif;?>
								</div>
							</div>
						</div>
					<!-- KIERUNKI -->
					<?php elseif ($zakladka_page === 5) :?>
						
							<div class="tab-pane active row">
								<div class="col-md-12 animated fadeInLeft notransition">
								<?php if (count($kierunki_full) > 0): ?>
									<div class="lista_kierunkow" id="kierunki">
										<div class="info">
										<div class="table-responsive">
											<table class="kierunki-full table">
												<thead>
													<tr><th rowspan="2" class="tal">Kierunek</th>
														<?php if (in_array('11',$kierunki_types) || in_array('21',$kierunki_types) || in_array('31',$kierunki_types) || in_array('41',$kierunki_types) || in_array('71',$kierunki_types)):?>
															<th colspan="<?php echo in_array('11',$kierunki_types) + in_array('21',$kierunki_types) + in_array('31',$kierunki_types) + in_array('41',$kierunki_types) + in_array('71',$kierunki_types); ?>">Stacjonarne</th><?php endif;?>
														<?php if(in_array('12',$kierunki_types) || in_array('22',$kierunki_types) || in_array('32',$kierunki_types) || in_array('42',$kierunki_types) || in_array('72',$kierunki_types)):?>
															<th colspan="<?php echo in_array('12',$kierunki_types) + in_array('22',$kierunki_types) + in_array('32',$kierunki_types) + in_array('42',$kierunki_types) + in_array('72',$kierunki_types);?>">Niestacjonarne</th><?php endif;?>
														<?php if(in_array('60',$kierunki_types) || in_array('62',$kierunki_types) || in_array('61',$kierunki_types)):?>
															<th colspan="<?php echo in_array('60',$kierunki_types) + in_array('61',$kierunki_types) + in_array('62',$kierunki_types);?>" >Szkoła 2&#8209;letnia</th><?php endif;?>
														<?php if(in_array('50',$kierunki_types) || in_array('52',$kierunki_types) || in_array('51',$kierunki_types)):?>
															<th colspan="<?php echo in_array('50',$kierunki_types) + in_array('51',$kierunki_types) + in_array('52',$kierunki_types);?>" >Szkoła 1&#8209;roczna</th><?php endif;?>
														<?php if(in_array('70',$kierunki_types)):?>
															<th colspan="<?php echo in_array('70',$kierunki_types);?>" rowspan="2">j.m.</th>
														<?php endif;?>
													</tr>
													<tr>
														<?php if (in_array('11',$kierunki_types)):?><th>I st. lic</th><?php endif;?>
														<?php if (in_array('21',$kierunki_types)):?><th>I st. inż</th><?php endif;?>
														<?php if (in_array('31',$kierunki_types)):?><th>  II st. </th><?php endif;?>
														<?php if (in_array('71',$kierunki_types)):?><th>  j.mgr  </th><?php endif;?>
														<?php if (in_array('12',$kierunki_types)):?><th>I st. lic</th><?php endif;?>
														<?php if (in_array('22',$kierunki_types)):?><th>I st. inż</th><?php endif;?>
														<?php if (in_array('32',$kierunki_types)):?><th>  II st. </th><?php endif;?>
														<?php if (in_array('72',$kierunki_types)):?><th>  j.mgr  </th><?php endif;?>
														<?php if (in_array('61',$kierunki_types)):?><th>  st </th><?php endif;?>
														<?php if (in_array('62',$kierunki_types)):?><th>niest</th><?php endif;?>
														<?php if (in_array('51',$kierunki_types)):?><th>  st </th><?php endif;?>
														<?php if (in_array('52',$kierunki_types)):?><th>niest</th><?php endif;?>
													</tr>
												</thead>
												<tbody>												
													<?php foreach ($kierunki_full as $ukk => $uk):?>
														<tr>	
															<td >
																<div >
																	<a href="/kierunek/<?php echo Inflector::slug($kierunki_full[$ukk]['nazwa'],'-').'-'. $ukk;?>.html">
																		<?php echo $kierunki_full[$ukk]['nazwa'];?>
																	</a>
																</div>
															</td>
															<?php foreach ($kierunki_types as $value):?>
																<td ><div ><?php if (isset($uk[$value])):?>•<?php endif;?></div></td>
															<?php endforeach;?>																
														</tr>							
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
										</div>
										<div class="cl"></div>
									</div>
								<?php endif;?>
								</div>
							</div>
					
					<?php elseif ($zakladka_page === 1) : if ($university['Faculty']['zakladka1']) :?>
						<div class="tab-pane active cont-c zakladka" ><?php echo $university['Faculty']['zakladka1'];?></div>
					<?php endif;?>
					<?php elseif ($zakladka_page === 2) : if ($university['Faculty']['zakladka2']) :?>
						<div class="tab-pane active cont-c zakladka" ><?php echo $university['Faculty']['zakladka2'];?></div><?php endif;?>
					<?php elseif ($zakladka_page === 3) : if ($university['Faculty']['zakladka3']) :?>
						<div class="tab-pane active cont-c zakladka" ><?php echo $university['Faculty']['zakladka3'];?></div>
					<?php endif;?>
					<?php elseif ($zakladka_page === 4) : if ($university['Faculty']['zakladka4']) :?>
						<div class="tab-pane active cont-c zakladka" ><?php echo $university['Faculty']['zakladka4'];?></div>
					<?php endif;?>
					<?php endif;?>
				</div>
			</div>
			<!--End Tabs 1-->
		</div>
	</div>
</div>
<?php if ($lokalizacja_poparawna) :?>
	<script type="text/javascript">

	//Google Map

	function initialize() {

		var myLatlng = new google.maps.LatLng(<?php echo $university['Faculty']['lokalizacja_y'].','.$university['Faculty']['lokalizacja_x']?>);

		var mapOptions = {

			zoom: 12,

			center: myLatlng

		}

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		var marker = new google.maps.Marker({

			position: myLatlng,

			map: map,

			draggable: false,

			animation: google.maps.Animation.Bounce,

			title: '<?php echo $university['Faculty']['nazwa'];?>'

		});

		var clicked = 0;

		google.maps.event.addDomListener(marker, 'click', function() {

			if(clicked == 0 ){

				map.setZoom(10);

				map.setCenter(marker.getPosition());

				marker.setIcon('/img/icon.png');

				clicked = 1; 

			}else{

				map.setZoom(8);

				map.setCenter(myLatlng);

				marker.setIcon('/img/default_icon.png');

				clicked = 0; 

			}
		});

	}
	</script>
<?php endif;?>