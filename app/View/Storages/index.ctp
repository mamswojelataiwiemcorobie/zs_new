<!-- BLOG
================================================== -->
	<section class="container animated fadeInDown notransition">
		<div class="row blogindex">
			<!-- MAIN -->	
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<?php foreach($articles as $article):?>
							<div class="text-center">
								<h2><?php echo $article['Article']['tytul'];?></h2>
								<?php echo $this->Time->format($article['Article']['created'], '%e-%m-%Y %H:%M');?>
							</div>
							<p class="lead">
								<a href="/artykul/<?php echo Inflector::slug($article['Article']['tytul'],'-').'-'.  $article['Article']['id'];?>.html">
									<img src="/miniatura/320x280/uploads/<?php echo $article['Article']['logo'];?>" class="pull-left img-responsive" alt="<?php echo $article['Article']['tytul'];?>" style="max-width:180px;">
								</a>
								<?php echo $this->Text->truncate(strip_tags ($article['Article']['html']),
														    300,
														    array(
														        'ellipsis' => '...',
														        'exact' => false
														    )
														);?>
							</p>
							<a href="/artykul/<?php echo Inflector::slug($article['Article']['tytul'],'-').'-'.  $article['Article']['id'];?>.html" class="btn btn-default">Czytaj więcej</a>
							<hr class="clearfix" />
						<?php endforeach;?>
						<ul class="pagination pagination-lg">
							<?php
							  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
							  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
							  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
							?>
						</ul>
					</div>
				</div>
			</div>
			<!-- SIDEBAR -->	
			<div class="col-md-3">
				<?php echo $this->element('column_right');?>
			</div><!-- end sidebar -->	
		</div>
		</section>