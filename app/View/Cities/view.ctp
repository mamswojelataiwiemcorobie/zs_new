<div id="miasto" class="view">
	<div class="row">
		<div class="col-xs-12 col-md-3"><img class="herb img-responsive center-block" src="/img/miasta/<?php echo $city['City']['photo']?>"></div>
		<div class="col-xs-12 col-md-9">
			<h1><?php echo h($city['City']['nazwa']); ?></h1>
			<div class="opis"><?php echo $city['City']['opis']?></div>
			<div id="map-canvas"  style="width: 100%; height: 266px; margin-bottom: 5%;"></div>
		</div>
	</div>
	<div class="clearfix"></div>

	<h2>Wskaźniki obrazujące miasto</h2>

	<div >

		<div id="chart_miasto" style="height: 400px;"></div>
		<div class="wykresy_male">
			<div id="chart_miasto2" style=" height: 80px;"></div>
			<?php if (!empty($city['City']['studenci'])) :?>
			<div id="chart_miasto3" style="height: 80px;"></div>
			<?php endif;?>
		</div>
	</div>
	
	<div class="carousel">
		<h2>Uczelnie wyższe w mieście <?php echo $this->Html->link( $city['City']['nazwa'], 'http://www.zostanstudentem.pl/wyszukiwarka/szkoly-wyzsze-1.html?miasto='.$city['City']['nazwa'] );?></h2>

		<!--

		<ul class="icons arrowlist">

		<?php foreach ($city['University'] as $uni) {

					$slug = Inflector::slug($uni['nazwa'],'-');

					echo '<li>'. $this->Html->link($uni['nazwa'], '/uczelnia/'.$slug.'-'.$uni['id'] ) .'</li>';
				}
		?>

		</ul>

		-->
		<section class=" recent-projects-home topspace30 animated fadeInUpNow notransition">

				<div class="text-center smalltitle"></div>	

				<div class="col-md-12">

					<div id="carousel" class="list_carousel text-center">

						<div class="carousel_nav">

							<a class="prev" id="car_prev" href="#"><span>prev</span></a>

							<a class="next" id="car_next" href="#"><span>next</span></a>

						</div>

						<div class="clearfix"></div>

						<ul id="carousel-projects">
						<?php 
							$i = 0;

							foreach ($city['University'] as $university) :

									$slug = Inflector::slug($university['nazwa'],'-');

									$foto = $university['photo'];

									$foto = substr($foto, 0, -4).".png";

									$i = $i+1;
							?>

							<li class="li_">
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
							<?php endforeach; ?>
						</ul>
					</div>

				</div>

		</section>
	</div>
</div>

<script type="text/javascript">

//Google Map

function initialize() {

	var myLatlng = new google.maps.LatLng(<?php echo $city['City']['lat'].','.$city['City']['lng']?>);

	var mapOptions = {

		zoom: 8,

		center: myLatlng

	}

	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	var marker = new google.maps.Marker({

		position: myLatlng,

		map: map,

		draggable: false,

		animation: google.maps.Animation.Bounce,//DROP,

		//icon: getNewIcon(markerType != "archive", isBig),

		title: '<?php echo $city['City']['nazwa']?>'

	});

	var clicked = 0;

	/*var iconOptions = {};

				iconOptions.width = 40;

				iconOptions.height = 40;

				iconOptions.primaryColor = "#428bca";

				iconOptions.cornerColor = "";

				iconOptions.strokeColor = "#000000";

	var icon1 = MapIconMaker.createMarkerIcon(iconOptions);

	*/ 

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


//Charts

	function drawcharts() {

		var data1 = google.visualization.arrayToDataTable([

			['Label', '<?php echo $city['City']['nazwa']; ?>', { role: 'style' }],

			<?php if (!empty($city['City']['bilet'])) :?>

			['Bilet jednorazowy studencki',  <?php if (!empty($city['City']['bilet'])) echo $city['City']['bilet'];?>, 'color: #F6FF68'

			],<?php endif;?>

			<?php if (!empty($city['City']['bilet_m'])) :?>

			['Bilet miesięczny',  <?php if (!empty($city['City']['bilet_m'])) echo $city['City']['bilet_m'];?>,  

			'color: #FFEA6F'

			],<?php endif;?>

			<?php if (!empty($city['City']['obiad'])) :?>

			['Obiad',  <?php if (!empty($city['City']['obiad'])) echo $city['City']['obiad'];?>,  

			'color: #FFCC6F'

			],<?php endif;?>

			<?php if (!empty($city['City']['pokoj_miejsce'])) :?>

			['Miejsce w pokoju',  <?php if (!empty($city['City']['pokoj_miejsce'])) echo $city['City']['pokoj_miejsce'];?>, 

			'color: #FFAB68;'

			],<?php endif;?>

			<?php if (!empty($city['City']['pokoj'])) :?>

			['Pokój jednoosobowy',  <?php if (!empty($city['City']['pokoj'])) echo $city['City']['pokoj'];?>,  

			'color: #FF875B;'

			],<?php endif;?>

			<?php if (!empty($city['City']['placa'])) :?>

			['Przeciętne wynagrodzenie',  <?php if (!empty($city['City']['placa'])) echo $city['City']['placa'];?>,  

			'color: #FF5F49;'

			]<?php endif;?>

		]);



		var options1 = {

		 hAxis: {
		 	//title: 'koszt [zł]', 

		 	logScale: true,
		 	format:"#' zł'",

		},
		 legend: {position: 'none'},

		 chartArea: {
					left:'25%',
				}
		};		

		var chartA = new google.visualization.BarChart(document.getElementById('chart_miasto'));

		chartA.draw(data1, options1);

	}

	function drawcharts2() {

		var data1 = google.visualization.arrayToDataTable([

			['Label', '<?php echo $city['City']['nazwa']; ?>', { role: 'style' }],

			 <?php if (!empty($city['City']['bezrobocie'])) :?>

			['Bezrobocie [%]',  <?php if (!empty($city['City']['bezrobocie'])) echo $city['City']['bezrobocie'];?>,  

			'color: #891600'

			],<?php endif;?>		

		]);



		var options1 = {

		//title: "Liczba studentów",

		//vAxis: {title: "ludność", logScale: true},
		hAxis: {
				format:"#'%'", 

				},
				
		legend: {position: 'none'},

		chartArea: {left:'25%',width:'100%'},
		};

		

		var chartA = new google.visualization.BarChart(document.getElementById('chart_miasto2'));

		chartA.draw(data1, options1);

	}
	<?php if (!empty($city['City']['studenci'])) :?>
	function drawcharts3() {

		var data1 = google.visualization.arrayToDataTable([

			['Label', '<?php echo $city['City']['nazwa']; ?>', { role: 'style' }],

			['Liczba studentów',  <?php echo $city['City']['studenci'];?>,  'color: #3C3C3C'],	

		]);



		var options1 = {

		//title: "Liczba studentów",

		//vAxis: {title: "ludność", logScale: true},

		legend: {position: 'none'},

		chartArea: {left:'25%',},

		hAxis: {
				format:"#' os.'", 
				},

		};		

		var chartA = new google.visualization.BarChart(document.getElementById('chart_miasto3'));

		chartA.draw(data1, options1);

	}<?php endif;?>

	

	google.setOnLoadCallback(drawcharts);

	google.setOnLoadCallback(drawcharts2);
	<?php if (!empty($city['City']['studenci'])) :?>
	google.setOnLoadCallback(drawcharts3);
	<?php endif;?>
	google.load("visualization", "1", {packages:["corechart"]});

</script>



