 <?php 
$recent_posts = $this->requestAction(array('controller' => 'blog',
											'action' => 'recent_post'));?>	
 <section id="recent_post" class="home-portfolio topspace30">
	<div class="bgarea-semitransparent">
		<h2 class="text-center animated fadeInLeftNow notransition fadeInLeft">Z NASZEGO BLOGA</h2>
			
		<div class=" slide">
			<div class="row">
				<?php foreach($recent_posts as $key => $post): ?>
					<div class="item col-md-4">
																		
						<a href="<?php echo $post['url'];?>"><img src="http://blog.zostanstudentem.pl/wp-content/uploads/<?php echo $post['Thumbnail'];?>" class="" alt="" /></a>
						<h1 class="animated fadeInRightNow notransition text-center topspace20 fadeInRight">
							 <a href="<?php echo $post['url'];?>"><?php echo h($post['wp_posts']['post_title']);?></a>
						</h1>

						<p><a href="<?php echo $post['url'];?>"><?php echo strip_tags($this->Text->truncate(
										    $post['wp_posts']['post_content'],
										    202,
										    array(
										        'ellipsis' => '...',
										        'exact' => false,
										        'html' => true
										    )
										));?></a>
						</p>

					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</section>