<div class="znajdz-wyniki">{assign var="fstart" value=1}
	<?php foreach ($uczelnie_wyniki as $uw): ?>}{if $fstart==1}{assign var="fstart" value=0}{else}<hr/>{/if}
	<div class="item{cycle values=", blueitem"}">
		<div class="image"<?php if ($uw.logo):?> style="background-image:url('/miniatura/160x125/uploads/<?php echo $uw.logo;?>')"<?php endif;?>></div>
		<div class="data-c"><div class="data">
			<a href="{$uw.url}" class="title"><?php echo $uw['University']['nazwa'];?></a>
			<div class="data-l">
				<a href="http://{$uw.www}" class="url" target="_blank" rel="nofollow">{$uw.www}</a>
				<address>{$uw.adres}<br/>{if $uw.telefon}tel: {$uw.telefon}{/if}</address>
				{if $uw.opis}<span>{$uw.opis|strip_tags:false|truncate:60:"…"} <a href="{$uw.url}">&gt;&gt; WIĘCEJ</a></span>{/if}
			</div>
			<div class="data-r">
				{if $uw.link_rejestracji}<a href="{$uw.link_rejestracji}" class="uczelnia-rekrutuj" target="_blank" rel="nofollow"></a>{/if}
				{if $uw.url}<a href="{$uw.url}#kierunki" class="uczelnia-{if $uw.typ != 3}kierunki{else}jezyki{/if}"></a>{/if}
			</div>
		</div></div>
	</div>
	<?php endforeach;?>
	<hr class="lst"/>
</div>