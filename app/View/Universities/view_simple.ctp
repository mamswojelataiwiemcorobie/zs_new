<section id="uczelnia" class="container">
	<div id="content">
		<div class="row">
			<div class="col-md-8">
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
							<p>Zobacz tą uczelnię w naszej porównywarce >><a href="http://porownywarkauczelni.pl/uczelnia<?php echo Inflector::slug($university['University']['nazwa'],'-').'-'.  $university['University']['id'];?>"><?php echo $university['University']['nazwa'];?></a></p>
						</div>
						<div class="mbr">
							<a href="/info/kontakt-1.html" class="uzupelnij-profil"></a>
							<?php if ($university['University']['link_rejestracji']): ?><a href="<?php echo $university['University']['link_rejestracji']; ?>" class="uczelnia-rekrutuj" target="_blank"></a><?php endif;?>
							<?php if($university['UniversitiesParameter']['fb'] || $university['UniversitiesParameter']['gplus'] || $university['UniversitiesParameter']['yt']):?>
								<ul class="social">
									<?php if($university['UniversitiesParameter']['fb']):?>
										<li><a href="<?php echo $university['UniversitiesParameter']['fb'];?>" class="fb" target="_blank"></a></li>
									<?php endif;?>
									<?php if($university['UniversitiesParameter']['gplus']):?>
										<li><a href="<?php echo $university['UniversitiesParameter']['gplus'];?>" class="gp" id="plusone" target="_blank"></a></li>
									<?php endif;?>
									<?php if($university['UniversitiesParameter']['yt']):?>
										<li><a href="<?php echo $university['UniversitiesParameter']['yt'];?>" class="yt" target="_blank"></a></li>
									<?php endif;?>
									<?php if($university['UniversitiesParameter']['twitter']):?>
										<li><a href="<?php echo $university['UniversitiesParameter']['twitter'];?>" class="twitter" target="_blank"></a></li>
									<?php endif;?>
								</ul>
							<?php endif;?>
						</div>
					</div>
					<div class="clearfix"></div>
				</section>
				<!--Begin Tabs 1-->
				<div id="horizontalTab">
					<ul class="nav nav-tabs">
						<li class="<?php if ($zakladka_page === 0) : ?>active<?php endif;?>">
							<a href="<?php echo $university['url'];?>"><?php if($university['University']['university_type_id'] == 1):?>O UCZELNI<?php else : ?>O SZKOLE<?php endif;?></a>
						</li>
						<li class="<?php if ($zakladka_page === 5): ?>active<?php endif;?>">
							<a href="<?php echo $university['url'];?>/KIERUNKI-5">KIERUNKI</a>
						</li>
					</ul>
					<div class="tab-content cont">
						<?php if ($zakladka_page === 0) : ?>
							<div class="tab-pane active">
								<?php if (strlen($university['UniversitiesParameter']['opis']) > 0):?>
									<h1 class="smalltitle">
									<span>Opis</span>
									</h1>
									<section>
										<div class="info"><?php echo $university['UniversitiesParameter']['opis'];?>
											<?php if ($university['University']['university_type_id'] == 1):?>. Kierunki studiów. Studia dzienne (stacjonarne) i zaoczne (niestacjonarne), licencjackie, inżynierskie, magisterskie. Jakie studia wybrać? Czy warto tu studiować twój wymarzony kierunek. <?php endif;?>
											<?php if ($university['University']['university_type_id'] == 2):?>. Szkoła policealna - kursy roczne i dwuletnie po których jest pewna praca.<?php endif;?>
											<?php if ($university['University']['university_type_id'] == 3):?>. Szkoła językowa - angielski, niemiecki, rosyjski, hiszpański, japoński<?php endif;?>
										</div>
									</section>
								<?php endif;?>
							</div>
						<!-- KIERUNKI -->
						<?php elseif ($zakladka_page === 5) :?>
							<div class="tab-pane active">
								<?php if($university['University']['university_type_id'] == 3): ?>
									<div class="lista_jezykow">
										<h1 class="smalltitle">
											<span>JĘZYKI</span>
										</h1>
										<div class="info">
											<ul>
											<?php foreach ($kierunki as $uk): ?>
												<li><?php echo $uk['Course']['nazwa']?></li>
											<?php endforeach;?>
											</ul></div>
										<div class="cl"></div>
									</div>
								<?php endif;?>
								<?php if ($university['University']['university_type_id'] != 3) :?>
									<div class="lista_kierunkow">
										<h1 class="smalltitle">
											<span>KIERUNKI</span>
										</h1>
										<div class="info">
											<?php foreach ($kierunki as $kierunek) :?>
												<a href="/kierunek/<?php echo Inflector::slug($kierunek['Course']['nazwa'],'-').'-'. $kierunek['Course']['id'];?>.html">
													<?php echo $kierunek['Course']['nazwa'];?></a> | 
											<?php endforeach;?>
										</div>
										<div class="cl"></div>
									</div>
								<?php endif;?>
							</div>
						<?php endif;?>
					</div>
				</div>
				<!--End Tabs 1-->
			</div>
			<div class="col-md-4">
				<?php if ($lokalizacja_poparawna) :?>
					<h1 class="smalltitle"><span>Lokalizacja</span></h1>
					<div class="row">
						<div class="col-md-12 animated fadeInLeft notransition">
							<div class="info" id="map-canvas" style="width: 100%; height: 266px; margin-bottom: 5%;"></div>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>
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
	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
<?php endif;?>