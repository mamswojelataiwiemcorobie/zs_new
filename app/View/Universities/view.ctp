<div id="uczelnia" class="container">
	<div id="content">
		<section class="animated fadeInUp notransitioncont main">
			<?php if ($university['logo']): ?>
				<div class="ml">
					<img itemprop="logo" src="/miniatura/180x260/uploads/<?php echo $university['logo'];?>" alt="Logo uczelni <?php echo $university['University']['nazwa'];?>"/>
				</div>
			<?php endif; ?>
			<div class="mr<?php if (!($university['logo'])): ?> mr-noimage <?php endif; ?>">
				<h1 itemprop="legalname"><?php echo $university['University']['nazwa'];?></h1>
				<div class="mbrl">
					<a href="http://<?php echo $university['UniversitiesParameter']['www'];?>" itemprop="url" class="url" target="_blank"><?php echo $university['UniversitiesParameter']['www'];?></a>
					<address itemprop="address">
						<?php echo $university['UniversitiesParameter']['adres'];?>
						<?php if($university['UniversitiesParameter']['telefon']):?><br/>tel: <?php echo $university['UniversitiesParameter']['telefon']; endif; ?>
						<?php if($university['UniversitiesParameter']['email']):?><br/>e-mail: <?php echo $university['UniversitiesParameter']['email']; endif; ?>
					</address>
				</div>
				<div class="mbr">
					<?php if ($university['University']['abonament_id'] < 2):?>
						<a href="/info/kontakt-1.html" class="uzupelnij-profil"></a>
					<?php else : ?>
						<span rel="<?php echo $university['University']['id'];?>" class="uczelnia-schowek btn btn-large"><i class="icon-heart"></i> ULUBIONE</span>
					<?php endif;?>
					<?php if ($university['University']['link_rejestracji']): ?>
						<a href="<?php echo $university['University']['link_rejestracji']; ?>" class="uczelnia-rekrutuj btn" target="_blank"><i class="icon-plus"></i> REKRUTUJ</a>
					<?php endif;?>
					<?php if($university['UniversitiesParameter']['fb'] || $university['UniversitiesParameter']['gplus'] || $university['UniversitiesParameter']['yt']):?>
						<ul class="social">
							<?php if($university['UniversitiesParameter']['fb']):?>
								<li>
									<a href="<?php echo $university['UniversitiesParameter']['fb'];?>" class="fb" target="_blank"><span class="icon-stack icon-lg"><i class="icon icon-facebook"></i></span></a>
								</li>
							<?php endif;?>
							<?php if($university['UniversitiesParameter']['gplus']):?>
								<li>
									<a href="<?php echo $university['UniversitiesParameter']['gplus'];?>" class="gp" id="plusone" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-google-plus"></i></span></a>
								</li>
							<?php endif;?>
							<?php if($university['UniversitiesParameter']['yt']):?>
								<li><a href="<?php echo $university['UniversitiesParameter']['yt'];?>" class="yt" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-youtube"></i></span></a></li>
							<?php endif;?>
							<?php if($university['UniversitiesParameter']['twitter']):?>
								<li><a href="<?php echo $university['UniversitiesParameter']['twitter'];?>" class="twitter" target="_blank"><span class="icon-stack icon-lg"><i class="fa icon-twitter"></i></span></a></li>
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
				<ul class="resp-tabs-list">
					<li class="<?php if ($zakladka_page === 0) : ?>resp-tab-active<?php endif;?>">
						<a href="<?php echo $university['url'];?>"><?php if($university['University']['university_type_id'] == 1):?>O UCZELNI<?php else : ?>O SZKOLE<?php endif;?></a>
					</li>
					<li class="<?php if ($zakladka_page === 5): ?>resp-tab-active<?php endif;?>">
						<a href="<?php echo $university['url'];?>/KIERUNKI-5">KIERUNKI</a>
					</li>
					<?php if($university['UniversitiesParameter']['zakladka1']):?>
						<li class="<?php if ($zakladka_page === 1): ?>resp-tab-active<?php endif;?>">
							<a href="<?php echo $university['zakladka1url'];?>"><?php echo $university['UniversitiesParameter']['nzakladki1'];?></a>
						</li>
					<?php endif;?>
					<?php if($university['UniversitiesParameter']['zakladka2']):?>
						<li class="<?php if ($zakladka_page === 2): ?>resp-tab-active<?php endif;?>">
							<a href="<?php echo $university['zakladka2url'];?>"><?php echo $university['UniversitiesParameter']['nzakladki2'];?></a>
						</li>
					<?php endif;?>
					<?php if($university['UniversitiesParameter']['zakladka3']):?>
						<li class="<?php if ($zakladka_page === 3): ?>resp-tab-active<?php endif;?>">
							<a href="<?php echo $university['zakladka3url'];?>"><?php echo $university['UniversitiesParameter']['nzakladki3'];?></a>
						</li>
					<?php endif;?>
					<?php if($university['UniversitiesParameter']['zakladka4']):?>
						<li class="<?php if ($zakladka_page === 4) : ?>resp-tab-active<?php endif;?>">
							<a href="<?php echo $university['zakladka4url'];?>"><?php echo $university['UniversitiesParameter']['nzakladki4'];?></a>
						</li>
					<?php endif;?>
				</ul>
				<div class="resp-tabs-container cont">
					<?php if ($zakladka_page === 0) : ?>
						<div class="row" style="display:block;">
							<div class="col-sm-6">
								<?php if (strlen($university['UniversitiesParameter']['opis']) > 0):?>
									<h1 class="smalltitle">
										<span>OPIS</span>
									</h1>
									<section >
										<div class="row">
											<div class="col-md-12 animated fadeInLeft notransition">
												<div class="info"><?php echo $university['UniversitiesParameter']['opis'];?>
													<?php if ($university['University']['abonament_id'] < 2 && $university['University']['university_type_id'] == 1):?>. Kierunki studiów. Studia dzienne (stacjonarne) i zaoczne (niestacjonarne), licencjackie, inżynierskie, magisterskie. Jakie studia wybrać? Czy warto tu studiować twój wymarzony kierunek. <?php endif;?>
													<?php if ($university['University']['abonament_id'] < 2 && $university['University']['university_type_id'] == 2):?>. Szkoła policealna - kursy roczne i dwuletnie po których jest pewna praca.<?php endif;?>
													<?php if ($university['University']['abonament_id'] < 2 && $university['University']['university_type_id'] == 3):?>. Szkoła językowa - angielski, niemiecki, rosyjski, hiszpański, japoński<?php endif;?>
												</div>
											</div>
										</div>
									</section>
								<?php endif;?>
							</div>
							<div class="col-sm-6">
								<div id="accordion-container" style="display: block; "?>
									<!-- GALERIA -->
									<?php if ($university['University']['abonament_id'] > 2):?>
									<div class="row galeria">
										<h2 class="accordion-header">Galeria</h2>
										<?php if (count($university['galeria'])>0) :?>
										<div class="col-md-12 accordion-content">
											<div class="list_carousel text-center">
												<ul id="carousel-projects">
													<!--featured-projects 1-->
													<?php foreach ($university['galeria'] as $image) : ?>
													<li>
														<div class="boxcontainer">
															<img src="/uploads/min/<?php echo $image;?>" alt="" />
															<div class="roll">
																<div class="wrapcaption">
																	<a data-gal="prettyPhoto[gallery1]" href="/uploads/min/<?php echo $image;?>"><i class="icon-zoom-in captionicons"></i></a>
																</div>
															</div>
														</div>
													</li>
													<?php endforeach;?>
												</ul>
												<div class="carousel_nav">
													<a class="prev" id="car_prev" href="#"><span>prev</span></a>
													<a class="next" id="car_next" href="#"><span>next</span></a>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
										<?php endif;?>
									</div>
									<?php endif;?>
									
									<?php if ($wydzialy) :?>
										<h2 class="accordion-header">Wydziały</h2>
										<div class="row accordion-content">
											<div class="col-md-12 animated fadeInLeft notransition">
												<ul class="icons chevronlist">	
													<?php foreach($wydzialy as $wydzial) : ?>											
														<li>
															<a href="/wydzial<?php echo Inflector::slug($wydzial['Faculty']['nazwa'],'-').'-'. $wydzial['Faculty']['id'];?>"><?php echo $wydzial['Faculty']['nazwa'];?></a>
														</li>
													<?php endforeach;?>
												</ul>
											</div>
										</div>
									<?php endif;?>
									<?php if ($lokalizacja_poparawna) :?>
										<h2 id= "lokalizacja"class="accordion-header">Lokalizacja</h2>
										<div class="row accordion-content">
											<div class="col-md-12 animated fadeInLeft notransition">
												<div class="info" id="map-canvas" style="width: 100%; height: 266px; margin-bottom: 5%;"></div>
											</div>
										</div>
									<?php endif;?>
								</div>
							</div>
						</div>
					<!-- KIERUNKI -->
					<?php elseif ($zakladka_page === 5) :?>
						
							<div class="row" style="display:block;">
								<div class="col-md-12 animated fadeInLeft notransition">
								<?php if($university['University']['university_type_id'] == 3): ?>
									<div class="cont lista_jezykow">
										<h1 class="smalltitle">
											<span>JĘZYKI</span>
										</h1>
										<div class="info">
											<ul>
											<?php foreach ($kierunki as $uk): ?>
												<li><?php echo $uk['nazwa']?></li>{cycle values=',,<div class="cl"></div>'}
											<?php endforeach;?>
											</ul></div>
										<div class="cl"></div>
									</div>
								<?php endif;?>
								<?php if (count($kierunki_full) > 0): if($university['University']['university_type_id'] != 3):?>
									<div class="lista_kierunkow" id="kierunki">
										<div class="info">
											<table class="kierunki-full">
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
														<?php if (in_array('31',$kierunki_types)):?><th>II st.</th><?php endif;?>
														<?php if (in_array('71',$kierunki_types)):?><th>j.m.</th><?php endif;?>
														<?php if (in_array('12',$kierunki_types)):?><th>I st. lic</th><?php endif;?>
														<?php if (in_array('22',$kierunki_types)):?><th>I st. inż</th><?php endif;?>
														<?php if (in_array('32',$kierunki_types)):?><th>II st.</th><?php endif;?>
														<?php if (in_array('72',$kierunki_types)):?><th>j.m.</th><?php endif;?>
														<?php if (in_array('61',$kierunki_types)):?><th>st</th><?php endif;?>
														<?php if (in_array('62',$kierunki_types)):?><th>niest</th><?php endif;?>
														<?php if (in_array('51',$kierunki_types)):?><th>st</th><?php endif;?>
														<?php if (in_array('52',$kierunki_types)):?><th>niest</th><?php endif;?>
													</tr>
												</thead>
												
													<?php $w2=0; $i=0;?>
													<?php foreach ($kierunki_full as $ukk => $uk):?>
														<?php foreach ($uk as $ukk2 => $uk2): ?>
															<?php if (isset($kierunki_full[$ukk][$ukk2]['wydzialnazwa'])): $w1=$kierunki_full[$ukk][$ukk2]['wydzialnazwa'];?>
																<?php if ($w1!==$w2):?>
																	<tr data-toggle="collapse" id="<?php echo $kierunki_full[$ukk][$ukk2]['wydzial_id'];?>" data-target=".<?php echo $kierunki_full[$ukk][$ukk2]['wydzial_id'];?>collapsed" aria-expanded="true">
																		<td id="wydzial" colspan="<?php echo in_array('11',$kierunki_types) + in_array('21',$kierunki_types) + in_array('31',$kierunki_types) + in_array('41',$kierunki_types) + in_array('71',$kierunki_types) + in_array('12',$kierunki_types) + in_array('22',$kierunki_types) + in_array('32',$kierunki_types) + in_array('42',$kierunki_types) + in_array('72',$kierunki_types) + in_array('60',$kierunki_types) + in_array('61',$kierunki_types) + in_array('62',$kierunki_types) + in_array('50',$kierunki_types) + in_array('51',$kierunki_types) + in_array('52',$kierunki_types) + in_array('70',$kierunki_types) + 1?>">
																			<?php echo $kierunki_full[$ukk][$ukk2]['wydzialnazwa'];?><i class="glyphicon glyphicon-plus pull-right "></i>
																		</td>
																	</tr>
																	<?php $w2=$kierunki_full[$ukk][$ukk2]['wydzialnazwa'];?>	
																<?php endif;?>
															<?php endif;?>
																<tr <?php if (isset($kierunki_full[$ukk][$ukk2]['wydzialnazwa'])):?> class="collapse <?php if($i!==0):?>out<?php else :?>in<?php endif;?> <?php echo $kierunki_full[$ukk][$ukk2]['wydzial_id'];?>collapsed" <?php endif;?>>	
																	<td >
																		<div >
																			<a href="/kierunek/<?php echo Inflector::slug($kierunki_full[$ukk][$ukk2]['nazwa'],'-').'-'. $ukk2;?>.html">
																				<?php echo $kierunki_full[$ukk][$ukk2]['nazwa'];?>
																			</a>
																		</div>
																	</td>
																	<?php foreach ($kierunki_types as $value):?>
																		<td ><div ><?php if (isset($uk2[$value])):?>•<?php endif;?></div></td>
																	<?php endforeach;?>																
																</tr>																
														<?php endforeach;?>
													<?php $i++; endforeach;?>
												
											</table>
										</div>
										<div class="cl"></div>
									</div>
									<?php endif;?>
								<?php endif;?>
								</div>
							</div>
					
					<?php elseif ($zakladka_page === 1) : if ($university['UniversitiesParameter']['zakladka1']) :?>
						<div class="cont-c zakladka" style="display:block"><?php echo $university['UniversitiesParameter']['zakladka1'];?></div>
					<?php endif;?>
					<?php elseif ($zakladka_page === 2) : if ($university['UniversitiesParameter']['zakladka2']) :?>
						<div class="cont-c zakladka" style="display:block"><?php echo $university['UniversitiesParameter']['zakladka2'];?></div><?php endif;?>
					<?php elseif ($zakladka_page === 3) : if ($university['UniversitiesParameter']['zakladka3']) :?>
						<div class="cont-c zakladka" style="display:block"><?php echo $university['UniversitiesParameter']['zakladka3'];?></div>
					<?php endif;?>
					<?php elseif ($zakladka_page === 4) : if ($university['UniversitiesParameter']['zakladka4']) :?>
						<div class="cont-c zakladka" style="display:block"><?php echo $university['UniversitiesParameter']['zakladka4'];?></div>
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

		var myLatlng = new google.maps.LatLng(<?php echo $university['UniversitiesParameter']['lokalizacja_y'].','.$university['UniversitiesParameter']['lokalizacja_x']?>);

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

			title: '<?php echo $university['University']['nazwa'];?>'

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