 <?php 
$recent_posts = $this->requestAction(array('controller' => 'blog',
											'action' => 'recent_post'));?>	
 <section id="recent_post" class="home-portfolio topspace30">
	<div class="bgarea-semitransparent">
<!-- 		<h2 class="text-center animated fadeInLeftNow notransition fadeInLeft">Z NASZEGO BLOGA</h2>
 -->			
		<div class=" slide">
			<div class="row">
				<?php foreach($recent_posts as $key => $post): ?>
					<div class="item col-md-4">
						<div class="wrap">										
							<a href="<?php echo $post['url'];?>">
								<?php if ($post['Thumbnail'] == 'none') :?>
									<img src="/img/no-photo.jpg" class="" alt="ZostańStudentem" target="_blank"/>
								<?php else :?>
									<img src="http://blog.zostanstudentem.pl/wp-content/uploads/<?php echo $post['Thumbnail'];?>" class="" alt="<?php echo h($post['wp_posts']['post_title']);?>" target="_blank"/>
								<?php endif;?>
							</a>
						</div>
						<h4 class="animated fadeInRightNow notransition topspace20 fadeInRight pullLeft">
							 <a href="<?php echo $post['url'];?>"><?php echo h($post['wp_posts']['post_title']);?></a>
						</h4>

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