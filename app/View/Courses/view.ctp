<div id= "kierunki" class="row">
	<div class="col-md-8 l">
		<!--Begin Tabs 1-->
		<div id="horizontalTab">
			<ul class="resp-tabs-list">
				<?php foreach($kategorie as $kik =>$ki):?>
					<li class="<?php if ($kategoria_set && $kik==$kategoria['CoursesCategory']['id']-1):?>resp-tab-active<?php endif;?>">
						<a href="/kierunki/<?php echo $slug=Inflector::slug($ki['CoursesCategory']['nazwa'],'-').'-'. $ki['CoursesCategory']['id'];?>.html" ><?php echo $ki['CoursesCategory']['nazwa'];?></a>
					</li>
				<?php endforeach;?>
			</ul>
			<?php if ($kategoria_set): ?>
				<div class="resp-tabs-container">
					<div  <?php if ($kategoria_set && $tid==$kategoria['CoursesCategory']['id']):?> style="display: -webkit-box;
																										  display: -moz-box;
																										  display: -ms-flexbox;
																										  display: -webkit-flex;
																										  display: flex; "<?php endif;?>>
					
					<h1 class="smalltitle">
						<span><?php echo $kierunek['Course']['nazwa'];?></span>
					</h1>
					<?php if (!empty($kierunek['Course']['opis1'])):?><div><h3>Charakterystyka</h3></div>
						<div class="descr"><?php echo $kierunek['Course']['opis1'];?></div><?php endif;?>
					<?php if (!empty($kierunek['Course']['opis2'])):?><div><h3>Perspektywy zawodowe</h3></div>
					<div class="descr"><?php echo $kierunek['Course']['opis2'];?></div><?php endif;?>

				</div>
					</div>
				</div>
				<div>
					//rekomendowane
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="col-md-4 r"><?php echo $this->element('column_right');?></div>
</div>