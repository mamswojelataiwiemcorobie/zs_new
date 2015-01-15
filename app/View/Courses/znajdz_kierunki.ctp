<div id="kierunki">
	<div id="searchpage">
		<div id="kierser">
			<form method="get" action="/courses/znajdz_kierunki/1">
				<input type="hidden" name="kierunek_id" />
				<input type="text" name="kierunek" class="s kieronly input-medium form-control"/>
			</form>
		</div>
	</div>
	<div >
	<?php if (count($kierunki) >0):?>
		<p>Wyniki wyszukiwania kierunku: "<?php echo $_GET['kierunek'];?>"</p>
		<ul class="icons chevronlist lista_kierunkow">
			<?php foreach ($kierunki as $ki):?>
				<li class="col-sm-6">
					<a href="/kierunek/<?php echo $slug=Inflector::slug($ki['Course']['nazwa'],'-').'-'. $ki['Course']['id'];?>.html">
						<?php echo $ki['Course']['nazwa'];?>
					</a>
				</li>
			<?php endforeach;?>
		</ul>
	<?php else:?>
		<p>Nie znaleziono żadnych kierunków o podanych kryteriach.</p>
	<?php endif;?>
	</div>
		
	<!-- <div class="col-md-4 r"><?php echo $this->element('column_right');?></div> -->
</div>