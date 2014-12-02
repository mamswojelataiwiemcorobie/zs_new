<div id="searchpage"<?php if ($tid == '2'):?> class="znajdz-szkole-policealna"<?php elseif ($tid == '3'):?> class="znajdz-szkole-jezykowa"<?php endif;?>>
	<div class="l">
		<div class="znajdz-uczelnie-c"><div class="znajdz-uczelnie">
			<form method="get"{if $tid===4} action="/wyszukiwarka/szukaj-4.html"{/if}>
				<div class="inputs">
					<?php if ($tid == '1' || $tid == '4'):?><input type="text" name="slowo" value="{$sf.slowo}"/>
					<input type="text" name="kierunek" class="s" value="<?php echo $sf.kierunek;?> "/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="{$sf.miasto}"/>
					<input type="text" name="tryb"/>
					<input type="text" name="typ" class="s"/>
					<input type="hidden" name="id_tryb" value="{$sf.id_tryb}"/>
					<input type="hidden" name="id_typ" value="{$sf.id_typ}"/>
					<?php elseif ($tid == '2'):?><input type="text" name="slowo" value="{$sf.slowo}"/>
					<input type="text" name="kierunek" class="s" value="{$sf.kierunek}"/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="{$sf.miasto}"/>
					<?php elseif ($tid == '3'):?><input type="text" name="slowo" value="{$sf.slowo}"/>
					<input type="text" name="jezyk" class="s" value="{$sf.jezyk}"/>
					<input type="text" name="wojewodztwo"/>
					<input type="text" name="miasto" class="s" value="{$sf.miasto}"/>
					<input type="hidden" name="jezyk_id" value="{$sf.jezyk_id}"/>
					<?php endif;?>
					<input type="hidden" name="kierunek_id" value="{$sf.kierunek_id}"/>
					<input type="hidden" name="id_wojewodztwo" value="{$sf.id_wojewodztwo}"/>
					<input type="hidden" name="rodzaj" value="{$sf.rodzaj}"/>
				</div>
				<div class="submit"><input type="submit" value=" "/></div>
			</form>
		</div></div>
		<div id="znajdz-uczelnie-mini"><div><form method="get" action="/wyszukiwarka/szukaj-4.html">
			<input type="hidden" name="id_wojewodztwo"/>
			<div><input type="text" name="slowo"/></div>
			<div><input type="text" name="wojewodztwo"/></div>
			<div><input type="text" name="miasto"/></div>
			<div><input type="submit" value=" "/></div>
			<input type="hidden" name="rodzaj" value="{$sf.rodzaj}"/>
		</form></div></div>
		<?php if (!isset($uczelnie_nosearch)):?>
		<div class="znajdz-paginacja-c{if !isset($uczelnie_wyniki) || $uczelnie_wyniki|@count == 0} no-data{/if}"><div class="znajdz-paginacja">
			<div class="title">Wyniki wyszukiwania</div>
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
					<a href="{$uw.url}" class="title">{$uw.nazwa}</a>
					<span class="url">{$uw.www}</span>
				</div>
				<address>{$uw.adres}<br/>{if $uw.telefon}tel: {$uw.telefon}{/if}</address>
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
	<div class="r">{include file="column-right.tpl"}</div>
	<div class="cl"></div>
</div>