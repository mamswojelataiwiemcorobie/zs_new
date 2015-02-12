 <?php 
$recent_posts = $this->requestAction(array('controller' => 'blog',
											'action' => 'recent_post'));?>	
 <section id="recent_post" class="home-portfolio topspace30">
	<div class="bgarea-semitransparent">
		<h2 class="small text-center animated fadeInLeftNow notransition fadeInLeft">Z NASZEGO BLOGA</h2>
			
		<div class="carousel carousel-fade slide carousel-featuredwork" id="carousel-featuredwork">
			<ol class="carousel-indicators">
				<li data-target="#carousel-featuredwork" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-featuredwork" data-slide-to="1" class=""></li>
				<li data-target="#carousel-featuredwork" data-slide-to="2" class=""></li>
			</ol>
			<div class="carousel-inner" style="margin-top:-20px;">
				<?php foreach($recent_posts as $key => $post): ?>
					<div class="item <?php if ($key==0) echo 'active';?>">
						<h1 class="animated fadeInRightNow notransition text-center topspace20 fadeInRight">
							 <a href="<?php echo $post['url'];?>"><?php echo h($post['wp_posts']['post_title']);?></a>
						</h1>
						<div class="row">
							<div class="col-md-4 animated fadeInLeftNow notransition fadeInLeft flex">									
								<a href="<?php echo $post['url'];?>"><img src="http://blog.zostanstudentem.pl/wp-content/uploads/<?php echo $post['Thumbnail'];?>" class="" alt="" /></a>
							</div>
							<div class="col-md-8 animated fadeInRightNow notransition fadeInRight">
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
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</section>