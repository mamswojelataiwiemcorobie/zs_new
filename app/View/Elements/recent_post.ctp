 <?php 
$recent_post = $this->requestAction(array('controller' => 'blog',
											'action' => 'recent_post'));?>	
 <section id="recent_post" class="home-portfolio bgarea topspace30">
	<div class="bgarea-semitransparent">
		<div class="container">
			<?php foreach($recent_post as $post): ?>
			<h2 class="small text-center animated fadeInLeftNow notransition fadeInLeft">Z NASZEGO BLOGA</h2>
			<h1 class="animated fadeInRightNow notransition text-center topspace20 fadeInRight">
				 <a href="<?php echo $post['url'];?>"><?php echo h($post['wp_posts']['post_title']);?></a>
			</h1>
			<br>
			<div class="row">
				<div class="col-md-6 animated fadeInLeftNow notransition fadeInLeft">
					<div class="carousel carousel-fade slide carousel-featuredwork" id="carousel-featuredwork">
						<ol class="carousel-indicators">
							<li data-target="#carousel-featuredwork" data-slide-to="0" class="active"></li>
							<!-- <li data-target="#carousel-featuredwork" data-slide-to="1" class=""></li>
							<li data-target="#carousel-featuredwork" data-slide-to="2" class=""></li> -->
						</ol>
						<div class="carousel-inner" style="margin-top:-20px;">
							<div class="item active">
								<a href="<?php echo $post['url'];?>"><img src="http://blog.zostanstudentem.pl/wp-content/uploads/<?php echo $post['Thumbnail'];?>" class="" alt="" /></a>
							</div>
							<div class="item">
								<img src="img/demo/slide1-1.png" alt="">
							</div>
							<div class="item">
								<img src="img/demo/desktop2.png" alt="">
							</div>
						</div>
						<!-- /.carousel-inner -->
					</div>
				</div>
				<div class="col-md-6 animated fadeInRightNow notransition fadeInRight">
					<p><a href="<?php echo $post['url'];?>"><?php echo strip_tags($this->Text->truncate(
											    $post['wp_posts']['post_content'],
											    902,
											    array(
											        'ellipsis' => '...',
											        'exact' => false,
											        'html' => true
											    )
											));?></a>
					</p>
				</div>
			</div>
		<?php endforeach;?>
		</div>
	</div>
	</section>