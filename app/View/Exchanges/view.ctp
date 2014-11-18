<div id="wymiana" class="view">
	<h2><?php echo $exchange['Exchange']['nazwa_uczelni']?></h2>
	<p>Umowa podpisana z:
		<?php 
		echo $this->Html->link($exchange['University']['nazwa'],'/uczelnia/'.Inflector::slug($exchange['University']['nazwa'],'-').'-'.$exchange['University']['id']);

		echo $this->Html->link(' (więcej umów)','#umowy',array('style' => 'color:#6495ED')); ?>
	</p>
	<?php if (!empty($exchange['Exchange']['kraj'])) :?>
		<p>Kraj: <?php echo h($exchange['Exchange']['kraj']); ?>		</p>
	<?php endif;?>
	<?php if (!empty($exchange['Exchange']['miasto'])) :?>
		<p>Miasto: <?php echo h($exchange['Exchange']['miasto']); ?>	</p>
	<?php endif;?>
	<?php if (!empty($exchange['Exchange']['URL'])) :?>
	  <p>Strona internetowa uczelni: <?php echo $this->Html->link(h($exchange['Exchange']['URL']),$exchange['Exchange']['URL'],array('style' => 'color:#6495ED')); ?>	  </p>
	 <?php endif;?>
	<!--<div class="box effect6">
		<p>informacja</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.	</p>	
	</div>-->
	<h3>Inne uczelnie w rejonie z podpisaną umową w ramach programu Erasmus z polska uczelnią: </h3>
	<div id="chart_div"></div>

	<h3> Lista uczelni które mają podpisane umowy z <?php echo $exchange['Exchange']['nazwa_uczelni'];?> w ramach programu Erasmus: </h3>
	<!--<ul class="icons arrowlist">
		<?php
		foreach ($ucz as $uc){
			echo '<li>'. $this->Html->link($uc['University']['nazwa'],'/uczelnia/'.Inflector::slug($uc['University']['nazwa'],'-').'-'.$uc['University']['id']).'</li>';
		}
		?>
	</ul>-->
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

							foreach ($ucz as $university) :

									$slug = Inflector::slug($university['University']['nazwa'],'-');

									$foto = $university['University']['photo'];
									$foto = substr($foto, 0, -4).".png";

									$i = $i+1;
							?>

							<li class="li_">
								<div class="boxcontainer" style="height:270px">

									<?php echo $this->Html->image('uczelnie_min/'.$foto, array('fullBase' => true)); ?>

									<div class="roll" style="opacity:0;">
										<div class="wrapcaption">
											<a href="/uczelnia/<?php $slug.'-'.$university['University']['id'] ; ?>">
											<i class="icon-link captionicons"></i></a>
										</div>
									</div>
									<h1></h1>
									<?php echo $this->Html->link( $university['University']['nazwa'], '/uczelnia/'.$slug.'-'.$university['University']['id'] ); ?>

								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>

				</div>

		</section>
</div>
<script type='text/javascript'>
    google.load('visualization', '1.1', {packages: ['geochart'], callback: drawMarkersMap});

    function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['City',  {role: 'tooltip', p:{html:true}}],
		<?php 	foreach ($cit2 as $city) :?>	<?php if (!empty($city)) :?>
		['<?php echo $city['nazwa']; ?>', '<?php if (!empty($city['uni_pl'])) foreach ($city['uni_pl'] as $uni) {
				echo $uni['nazwa'] .'<br> ';}?>'	],<?php endif;?>
         
		  <?php endforeach; ?>
      ]);

      var options = {
        region: <?php echo "'".$ISO_3166."'"; ?>,
        displayMode: 'markers',
        colorAxis: {minValue: 1, maxValue:4,  
			colors: ['#4A9928','#204DA8','#992F1A','#2292C9',]},
        backgroundColor: '#B9D3EE',
		 tooltip: {
            isHtml: true
        }
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
	  
	  /*google.visualization.events.addListener(chart, 'select', function() {
		var selection = chart.getSelection();

		// if same city is clicked twice in a row
		// it is "unselected", and selection = []
		if(typeof selection[0] !== "undefined") {
		  var value = data.getValue(selection[0].row, 0);
		  alert('City is: ' + value);
		}
	});*/
    };
</script>