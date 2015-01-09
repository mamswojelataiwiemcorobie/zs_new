<div id= "kierunek">
		<div id="horizontalTab">
			<ul class="nav nav-tabs">
				<?php foreach($kategorie as $kik =>$ki):?>
					<li class="<?php if ($kik==$kierunek['CoursesCategory']['id']-1):?>active<?php endif;?>">
						<a href="/kierunki/<?php echo $slug=Inflector::slug($ki['CoursesCategory']['nazwa'],'-').'-'. $ki['CoursesCategory']['id'];?>.html" ><?php echo $ki['CoursesCategory']['nazwa'];?></a>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="tab-content" >	
				<div class="tab-pane active" style="display: -webkit-box;
						  display: -moz-box;
						  display: -ms-flexbox;
						  display: -webkit-flex;
						  display: flex; 
						  -webkit-flex-flow: column wrap;
						  flex-flow: column wrap;
							align-items: flex-start;">	
					<h1>
						<?php echo $kierunek['Course']['nazwa'];?>
					</h1>
					<?php if (!empty($kierunek['Course']['opis1'])):?>
						<h3>Charakterystyka</h3>
						<div class="descr"><?php echo $kierunek['Course']['opis1'];?></div><?php endif;?>
					<?php if (!empty($kierunek['Course']['opis2'])):?>
						<h3>Perspektywy zawodowe</h3>
						<div class="descr"><?php echo $kierunek['Course']['opis2'];?></div><?php endif;?>
				</div>

			</div>
			<div class="rekomendowane">
				<?php if (!isset($uczelnie_nosearch)):?>
					<h2 class="subtitle fancy">
						<span>REKOMENDOWANE</span>
					</h2>

					<?php if (!isset($uczelnie_wyniki_brak)):?>
					<?php if (count($uczelnie_wyniki) > 0) echo $this->element('wyniki_promo');?>
					<?php else:?><div class="no-data-info">Nie znaleziono żadnych uczelni o podanych kryteriach.</div>
					<?php endif;?>

					<div class="znajdz-paginacja-c znajdz-paginacja-c-footer"><div class="znajdz-paginacja">
						<?php if (!isset($uczelnie_wyniki_brak)):?>
							<ul class="pagination pagination-lg">
								<?php $this->Paginator->options(array('url' => array('controller'=>'/kierunek/',
																				'action'=> Inflector::slug($kierunek['Course']['nazwa'],'-').'-'. $kierunek['Course']['id'].'.html')));
								  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
								  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
								  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
								?>
							</ul>
						<?php endif;?>
					</div></div><?php endif;?>
			</div>
		</div>
	</div>
	<!-- <div class="col-md-4 r"><?php echo $this->element('column_right');?></div> -->
</div>