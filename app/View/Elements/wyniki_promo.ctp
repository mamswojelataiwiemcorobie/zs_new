<div class="znajdz-wyniki">
	<?php foreach ($uczelnie_wyniki as $uw): ?>
	<div class="item row">
		<div class="image col-sm-4"<?php if ($uw['logo']):?> style="background-image:url('/miniatura/160x125/uploads/<?php echo $uw['logo'];?>')"<?php endif;?>>
		</div>
		<div class="data-c col-sm-8 row"><div class="data">
			<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>.html" class="title"><h3><?php echo $uw['University']['nazwa'];?></h3></a>
			<div class="data-l col-md-8">
				<a href="http://<?php echo $uw['UniversitiesParameter']['www'];?>" class="url" target="_blank" rel="nofollow"><?php echo $uw['UniversitiesParameter']['www'];?></a>
				<address><?php echo $uw['UniversitiesParameter']['adres'];?><br/><?php if ($uw['UniversitiesParameter']['telefon']):?>tel: <?php echo $uw['UniversitiesParameter']['telefon']; endif;?></address>
				<?php if ($uw['UniversitiesParameter']['opis']):?>
					<span><?php echo $this->Text->truncate(
												    strip_tags($uw['UniversitiesParameter']['opis']),
												    68,
												    array(
												        'ellipsis' => '...',
												        'exact' => false
												    )
												);?>
						<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>.html">&gt;&gt; WIĘCEJ</a>
					</span>
				<?php endif;?>
			</div>
			<div class="data-r col-md-4">
				<?php if ($uw['University']['link_rejestracji']):?>
					<a href="<?php echo $uw['University']['link_rejestracji'];?>" class="uczelnia-rekrutuj btn btn-success" target="_blank" rel="nofollow">
						<i class="icon-plus"></i> Rekrutuj
					</a><?php endif;?>
				<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>/KIERUNKI-5" class="uczelnia-kierunki btn btn-large btn-primary">
					<i class="icon-ok-sign"></i> Kierunki
				</a>
			</div>
		</div></div>
	</div>
	<hr>
	<?php endforeach;?>
</div>