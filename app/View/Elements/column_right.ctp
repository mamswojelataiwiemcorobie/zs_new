<?php 
	$najczesciej_wyszukiwane = $this->requestAction(array('controller' => 'SearchKeywords',
									'action' => 'najczesciej'));
							?>		
<div class="qlist qlist-red">
	<h3>NAJCZĘŚCIEJ WYSZUKIWANE</h3>
	<div class="cont">
		<ul id="cloud">
			<?php foreach ($najczesciej_wyszukiwane as $fit):?>
				<li>
					<a href="/najczesciej_szukane/<?php echo Inflector::slug($fit['SearchKeyword']['keyword'],'-').'-'.  $fit['SearchKeyword']['id'];?>.html" class="tag<?php echo $fit['SearchKeyword']['rank'];?>">
						<?php echo $fit['SearchKeyword']['keyword']; ?>
					</a>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>
<?php 
	$ostatnio_odwiedzane = $this->requestAction(array('controller' => 'SearchKeywords',
									'action' => 'ostatnio'));
							?>		
<?php if (count($ostatnio_odwiedzane) > 0):?><div class="qlist qlist-blue">
	<div class="header">OSTATNIO ODWIEDZANE</div>
	<div class="cont">
		<ul>
		<?php foreach($ostatnio_odwiedzane as $fit):?>
			<li><a href="<?php echo $fit['url']; ?>"><?php echo $fit['name'];?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
</div><?php endif;?>
<!-- {if $act!=='wyszukiwarka'}<div id="znajdz-uczelnie-mini"><div><form method="get" action="/wyszukiwarka/szukaj-4.html">
	<input type="hidden" name="s[wojewodztwo]"/>
	<div><input type="text" name="s[slowo]"/></div>
	<div><input type="text" name="st[wojewodztwo]"/></div>
	<div><input type="text" name="s[miasto]"/></div>
	<div><input type="submit" value=" "/></div>
</form></div></div>{/if} -->