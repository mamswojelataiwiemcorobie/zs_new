<section class="recent-projects-home topspace30 animated fadeInUpNow notransition fadeInUp">
	<div class="row">
		<div class="text-center smalltitle">
			</div>
		<div class="col-md-12">
			<div class="list_carousel text-center">					
				
				<ul id="carousel-projects_uni">
					<?php 
						$universities = $this->requestAction(array('controller' => 'universities',

																	'action' => 'home_slider'));
						foreach ($universities as $key => $university) :

							$slug = strtolower(Inflector::slug($university['University']['nazwa'],'-'));
					?>						
					<li>
						<div class="boxcontainer">
							<div class="wrap">
								<?php if($key < 4):?>
									<img src="miniatura/255x185/uploads/<?php echo $university['UniversitiesPhoto']['path']; ?>" alt="Logo <?php echo $university['University']['nazwa'];?>">
								<?php else :?>
									<img class="owl-lazy" data-src="miniatura/255x185/uploads/<?php echo $university['UniversitiesPhoto']['path']; ?>" alt="Logo <?php echo $university['University']['nazwa'];?>">
								<?php endif;?>
							</div>
							<div class="roll" style="opacity: 0;">
								<div class="wrapcaption">
									<a href="/uczelnia/<?php echo $slug.'-'.  $university['University']['id'];?>.html">
										<i class="icon-link captionicons"></i>
									</a>
								</div>
							</div>
							<h1>
								<a href="/uczelnia/<?php echo $slug.'-'.  $university['University']['id'];?>.html">
									<?php echo $university['University']['nazwa'];?> 
								</a>
							</h1>
							<p>
								<?php echo $university['University']['miasto'];?>
							</p>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
				<div class="carousel_nav">
					<a class="prev" id="car_prev" href="#" style="display: block;"><span>prev</span></a>
					<a class="next" id="car_next" href="#" style="display: block;"><span>next</span></a>
				</div>
				<div class="clearfix"></div>
				
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>