<div class="znajdz-wyniki">
	<?php foreach ($uczelnie_wyniki as $uw): ?>
	<div class="item">
		<div class="image"<?php if ($uw['logo']):?> style="background-image:url('/miniatura/160x125/uploads/<?php echo $uw['logo'];?>')"<?php endif;?>>
		</div>
		<div class="data-c"><div class="data">
			<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>.html" class="title"><h3><?php echo $uw['University']['nazwa'];?></h3></a>
			<div class="data-l">
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
			<div class="data-r">
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
	<?php endforeach;?>
</div>