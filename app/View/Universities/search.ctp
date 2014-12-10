<div id="searchpage" class="row <?php if ($tid == '2'):?>znajdz-szkole-policealna<?php elseif ($tid == '3'):?>znajdz-szkole-jezykowa<?php endif;?>">
	<?php echo $this->element('sql_dump');?>
	<div class="col-md-8 l">
		<?php echo $this->Form->create('University',array('action'=>'search/'.$tid,'class'=>'form-inline input-append', 'role'=>'form', 'type' => 'GET'));?>
			<input type="text" name="keywords" placeholder="Type something…" class="input-medium">
			<button class="btn" type="submit" >Search</button>
			<button class="btn" type="button">Options</button>
		<?php echo $this->Form->end();?>
		<!-- <div class="znajdz-uczelnie-c"><div class="znajdz-uczelnie">
			<form method="get"{if $tid===4} action="/wyszukiwarka/szukaj-1"{/if}>
				<div class="inputs">
					<?php if ($tid == '1' || $tid == '4'):?><input type="text" name="slowo" value="<?php echo $sf['slowo'];?>"/>
					<input type="text" name="kierunek" class="s" value="<?php echo $sf['kierunek'];?>"/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="<?php echo $sf['miasto'];?>"/>
					<input type="text" name="tryb"/>
					<input type="text" name="typ" class="s"/>
					<input type="hidden" name="id_tryb" value="<?php echo $sf['id_tryb'];?>"/>
					<input type="hidden" name="id_typ" value="<?php echo $sf['id_typ'];?>"/>
					<?php elseif ($tid == '2'):?><input type="text" name="slowo" value="<?php echo $sf['slowo'];?>"/>
					<input type="text" name="kierunek" class="s" value="<?php echo $sf['kierunek'];?>"/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="<?php echo $sf['miasto'];?>"/>
					<?php elseif ($tid == '3'):?><input type="text" name="slowo" value="<?php echo $sf['slowo'];?>"/>
					<input type="text" name="jezyk" class="s" value="<?php echo $sf['jezyk'];?>"/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="<?php echo $sf['miasto'];?>"/>
					<input type="hidden" name="jezyk_id" value="<?php echo $sf['jezyk_id'];?>"/>
					<?php endif;?>
					<input type="hidden" name="kierunek_id" value="<?php echo $sf['kierunek_id'];?>"/>
					<input type="hidden" name="id_wojewodztwo" value="<?php echo $sf['id_wojewodztwo'];?>"/>
					<input type="hidden" name="rodzaj" value="<?php echo $sf['rodzaj'];?>"/>
				</div>
				<div class="submit"><input type="submit" value=" "/></div>
			</form>
		</div></div> -->
		<!-- <div id="znajdz-uczelnie-mini"><div><form method="get" action="/wyszukiwarka/szukaj-4.html">
			<input type="hidden" name="id_wojewodztwo"/>
			<div><input type="text" name="slowo"/></div>
			<div><input type="text" name="wojewodztwo"/></div>
			<div><input type="text" name="miasto"/></div>
			<div><input type="submit" value=" "/></div>
			<input type="hidden" name="rodzaj" value="{$sf.rodzaj}"/>
		</form></div></div> -->
		<?php if (!isset($uczelnie_nosearch)):?>
		<div class="znajdz-paginacja-c{if !isset($uczelnie_wyniki) || $uczelnie_wyniki|@count == 0} no-data{/if}"><div class="znajdz-paginacja">
			<h1 class="smalltitle"><br>
				<span>Wyniki wyszukiwania</span>
			</h1>
			<?php if (!isset($uczelnie_wyniki_brak)):?>
			<ul class="pagination pagination-lg">
				<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
				<li><?php echo $this->Paginator->numbers(array(   'currentClass' => 'active' , 'modulus' => 2    ));?></li>
				<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
			</ul><?php endif;?>
		</div></div><?php endif;?>
		<?php if (!isset($uczelnie_wyniki_brak)):?>
		<?php if (count($uczelnie_wyniki) > 0) echo $this->element('wyniki_promo');?>
		<?php if (isset($uczelnie_wyniki_demo)):?><div class="znajdz-wyniki-low">
			<?php foreach ($uczelnie_wyniki_demo as $uw):?><hr/>
			<div class="item-low">
				<div class="header">
					<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>.html" class="title"><?php echo $uw['University']['nazwa'];?></a>
					<span class="url"><?php echo $uw['UniversitiesParameter']['www'];?></span>
				</div>
				<address><?php echo $uw['UniversitiesParameter']['adres'];?><br/><?php if ($uw['UniversitiesParameter']['telefon']):?>tel: <?php echo $uw['UniversitiesParameter']['telefon']; endif;?></address>
			</div>
			<?php endforeach;?>
			<hr/>
		</div><?php endif;?>
		<?php else:?><div class="no-data-info">Nie znaleziono żadnych uczelni o podanych kryteriach.</div>
		<?php endif;?>
		<?php if (!isset($uczelnie_nosearch)):?>
		<div class="znajdz-paginacja-c znajdz-paginacja-c-footer"><div class="znajdz-paginacja">
			<?php if (!isset($uczelnie_wyniki_brak)):?>
				<ul class="pagination pagination-lg">
					<li><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></li>
					<li><?php echo $this->Paginator->numbers(array(   'currentClass' => 'active' , 'modulus' => 5    ));?></li>
					<li><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
				</ul>
			<?php endif;?>
		</div></div><?php endif;?>
	</div>
	<div class="col-md-4 r"><?php echo $this->element('column_right');?></div>
	<div class="cl"></div>
</div>