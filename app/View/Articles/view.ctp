	<!-- BLOG
================================================== -->
	<section class="container animated fadeInDown notransition">
		<div class="row blogindex">
			<!-- MAIN -->
			<div class="col-md-9">
				<div class="text-center">
					<h2><?php echo $article['tytul'];?></h2>
					<span class="meta bottomspace30"><?php echo $this->Time->format($article['created'], '%e-%m-%Y %H:%M');?></span>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php echo $article['html'];?>
					</div>
				</div>
				<p><a href="/artykuly.html">Przeczytaj pozostałe artykuły</a></p>
			</div>
			<!-- SIDEBAR -->
			<div class="col-md-3">
				<?php echo $this->element('column_right');?>
			</div>
			<!-- end sidebar -->
		</div>
	</section>