<div id= "kierunki">
	<div id="searchpage">
		<div id="kierser">
			<form method="get" action="/courses/znajdz_kierunki/1">
				<input type="hidden" name="kierunek_id" />
				<input type="text" name="kierunek" class="s kieronly input-medium form-control"/>
			</form>
		</div>
	</div>
		<!--Begin Tabs 1-->
		<div id="horizontalTab">
			<ul class="nav nav-tabs">
				<?php foreach($kategorie as $kik =>$ki):?>
					<li class="<?php if ($kategoria_set && $kik==$kategoria['CoursesCategory']['id']-1):?>active<?php endif;?>">
						<a href="/kierunki/<?php echo $slug=strtolower(Inflector::slug($ki['CoursesCategory']['nazwa'],'-')).'-'. $ki['CoursesCategory']['id'];?>.html" ><?php echo $ki['CoursesCategory']['nazwa'];?></a>
					</li>
				<?php endforeach;?>
			</ul>
			<?php if ($kategoria_set): ?>
				<div class="tab-content">
					<div  class="tab-pane active" <?php if ($kategoria_set && $tid==$kategoria['CoursesCategory']['id']):?> style="display: -webkit-box;
																										  display: -moz-box;
																										  display: -ms-flexbox;
																										  display: -webkit-flex;
																										  display: flex; "<?php endif;?>>
					<p>
						<ul class="icons chevronlist lista_kierunkow">
							<?php foreach ($kierunki as $ki):?>
								<li class="col-sm-6">
									<a href="/kierunek/<?php echo $slug=strtolower(Inflector::slug($ki['Course']['nazwa'],'-')).'-'. $ki['Course']['id'];?>.html"><?php echo $ki['Course']['nazwa'];?></a>
								</li>
							<?php endforeach;?>
						</ul>
						</p>
					</div>
				</div>
				<div>
					<h2 class="subtitle fancy">
						<span><?php echo $kategoria['CoursesCategory']['nazwa'];?></span>
					</h2>
					<div class="box effect4">
						<?php if (!empty($kategoria['CoursesCategory']['opis1'])):?><div><h3>Charakterystyka</h3></div>
							<div class="descr"><?php echo $kategoria['CoursesCategory']['opis1'];?></div><?php endif;?>
						<?php if (!empty($kategoria['CoursesCategory']['opis2'])):?><div><h3>Perspektywy zawodowe</h3></div>
						<div class="descr"><?php echo $kategoria['CoursesCategory']['opis2'];?></div><?php endif;?>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
	<!-- <div class="col-md-4 r"><?php echo $this->element('column_right');?></div> -->
</div>