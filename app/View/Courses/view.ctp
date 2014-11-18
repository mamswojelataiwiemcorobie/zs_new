<div id="kierunek" class="view">
	<div class="col-xs-12 col-sm-12 col-md-9">
		<div id="text" class="">
			<h1><?php echo h($course['Course']['nazwa']); ?></h1>
			<?php if (h($course['CoursesType']['nazwa']) !== "Inne") :?>
				<h4> - kierunek <?php echo strtolower(substr(h($course['CoursesType']['nazwa']), 0, -1).'y'); ?></h4>
			<?php endif; ?>

			<?php echo $course['Course']['opis'] ?>
			<!--<p>Ocena uzyskana w naszym rankingu: <?php //echo h($course['Course']['srednia']); ?></p>
			<?php $slug = Inflector::slug($course['Course']['nazwa'],'-');?>
			<p>Zobacz więcej informacji na temat tego kierunku na portalu <b>www.zostanstudentem.pl</b> => <?php echo $this->Html->link( $course['Course']['nazwa'], 'http://www.zostanstudentem.pl/kierunek/'.$slug.'-'.$course['Course']['id'].'.html' );?></p>
			 -->
			<div class="">
				<div class="btn btn-default btn-lg btn-block btn-zbc">
				<a class="zbc" href="<?php echo 'http://www.zostanstudentem.pl/kierunek/'.$slug.'-'.$course['Course']['id'].'.html';?>">
						<i class="icon-th"></i> Zobacz więcej</a>
					
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class=" zarobki">
			<h3>Możliwości zawodowe i zarobki po ukończeniu studiów: </h3>
			<div id="chart_kierunek" style="width: 100%; height: <?php if (count($course['Profession'])>8) {echo "900";} else { echo "600";}?>px;"></div>
		</div>

		<h2>Polecane uczelnie:</h2>
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
						$i=0;
						foreach ($u as $university) :
								$slug = Inflector::slug($university['University']['nazwa'],'-');
								$foto = $university['University']['photo'];
								$foto = substr($foto, 0, -4).".png";
								$i = $i+1;
						?>
						<li class="li_">
								<div class="boxcontainer" style="height:270px;">
									<?php echo $this->Html->image('uczelnie_min/'.$foto, array('fullBase' => true)); ?>
									<div class="roll">
										<div class="wrapcaption">
											<?php echo $this->Html->link("", '/uczelnia/'.$slug.'-'.$university['University']['id'] ); ?>
											<i class="icon-link captionicons"></i></a>
										</div>
									</div>
									<h1></h1>
									<p><?php echo $this->Html->link( $university['University']['nazwa'], '/uczelnia/'.$slug.'-'.$university['University']['id'] ); ?></p>
								</div>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>
	</div>
	<div class="reklama_bok .visible-md col-md-3"></div>
</div>
<script type="text/javascript">
    function drawcharts() {
        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Zawód'],
          <?php if (!empty($course['Profession'])) :
					foreach ($course['Profession'] as $profession) :?>
		  
		  <?php if (!empty($profession)) :?>['<?php echo $profession['nazwa'] ?>',  <?php if (!empty($profession['placa'])) echo $profession['placa'];?>],<?php endif;?>
         
		  <?php endforeach; endif;?>
        ]);
		
		var view = new google.visualization.DataView(data1);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                       ]);

        var options1 = {
          hAxis: {title: 'wysokość zarobków [PLN]', titleTextStyle: {color: 'red'}, minValue: 0, format:"#' zł'"},
		  legend: {position: 'none'},
		  chartArea: {	left:'35%',	height:'87%'}
        };
		
		var chartA = new google.visualization.BarChart(document.getElementById('chart_kierunek'));
        chartA.draw(view, options1);
	}
	google.setOnLoadCallback(drawcharts);
    google.load("visualization", "1", {packages:["corechart"]});
</script>

