<section id="uczelnia" class="container">
		<div id="content">
			<div class="row">
				<div class="col-md-8">
					<section class="animated fadeInUp notransitioncont main">
						<?php if (isset($university['logo'])): ?><div class="ml"><img itemprop="logo" src="/miniatura/180x260/uploads/<?php echo $university['logo'];?>" alt="Logo uczelni <?php echo $university['University']['nazwa'];?>"/></div><?php endif; ?>
						<div class="mr<?php if (!isset($university['logo'])): ?> mr-noimage <?php endif; ?>">
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
								<?php if ($university['University']['abonament'] < 2):?>
									<a href="/info/kontakt-1.html" class="uzupelnij-profil"></a>
								<?php else : ?>
									<span rel="{$uczelnia.id}" class="uczelnia-schowek"></span>
								<?php endif;?>
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
						<!-- GALERIA -->
						<?php if ($university['University']['abonament'] < 2):?>
							<?php if (count($university['galeria'])>0) :?>
								<?php foreach ($university['galeria'] as $image) : ?>
							<div class="boxportfolio4 item cat2 cat3">
								<div class="boxcontainer">
									<img src="/uploads/<?php echo $image;?>" alt="" />
									<div class="roll">
										<div class="wrapcaption">
											<a href="projectdetail.html"><i class="icon-link captionicons"></i></a>
											<a data-gal="prettyPhoto[gallery1]" href="/uploads/<?php echo $image;?>" title="La Chaux De Fonds"><i class="icon-zoom-in captionicons"></i></a>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach;?>
							<?php endif;?>
						<?php endif;?>
						<div class="clearfix"></div>
					</section>
				</div>
				<div class="col-md-4">
					<h4>One Half</h4>
					 Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam tincidunt, felis vel varius tristique, dui nisi mollis massa, vel porta elit libero ullamcorper lacus. Donec fringilla libero condimentum ligula tempus dapibus. Nulla interdum ante quis nisi dignissim sed tempus libero fermentum. In hac habitasse platea dictumst. Sed non arcu luctus quam accumsan iaculis. Integer molestie, massa eu lacinia rhoncus, elit ligula egestas mi, et aliquam turpis neque at dolor.
				</div>
			</div>
		</div>
</section>