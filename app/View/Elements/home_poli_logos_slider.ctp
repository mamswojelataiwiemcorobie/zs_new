<section class="grayarea recent-projects-home topspace30 animated fadeInUpNow notransition fadeInUp">
	<div class="container">
		<div class="row">
			<div class="text-center smalltitle"></div>
			<div class="col-md-12">
				<div class="list_carousel text-center">
					<div class="carousel_nav">
						<a class="prev" id="car_prev" href="#" style="display: block;"><span>prev</span></a>
						<a class="next" id="car_next" href="#" style="display: block;"><span>next</span></a>
					</div>
					<div class="clearfix"></div>
					<div class="caroufredsel_wrapper" style="display: block; text-align: center; float: none; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; margin: 0px; overflow: hidden; position: relative; width: 1120px; height: 295px;">
						<ul id="carousel-projects" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; z-index: 1; margin: 0px; width: 5600px; height: 295px; left: 0px;">
							<?php 
								$universities = $this->requestAction(array('controller' => 'universities',

																			'action' => 'home_slider_poli'));
								foreach ($universities as $university) :
							?>						
							<li>
								<div class="boxcontainer">
									<div class="wrap">
										<img src="/uploads/<?php echo $university['UniversitiesPhoto']['path']; ?>" alt="Logo">
									</div>
									<div class="roll" style="opacity: 0;">
										<div class="wrapcaption">
											<a href="/uczelnia/<?php echo $university['University']['id']. "/". Inflector::slug($university['University']['nazwa'],'-');?>.html">
												<i class="icon-link captionicons"></i>
											</a>
										</div>
									</div>
									<h1>
										<a href="<?php echo "uczelnia/". $university['University']['id']. "/". Inflector::slug($university['University']['nazwa'],'-');?>.html">
											<?php echo $university['University']['nazwa'];?>
										</a>
									</h1>
									<p>
										<?php echo $university['University']['nazwa'];?>
									</p>
								</div>
							</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>