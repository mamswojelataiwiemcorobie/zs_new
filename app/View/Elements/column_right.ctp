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
	<h3>OSTATNIO ODWIEDZANE</h3>
	<div class="cont">
		<ul>
		<?php foreach($ostatnio_odwiedzane as $fit):?>
			<li><a href="<?php echo $fit['url']; ?>"><?php echo $fit['name'];?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
</div><?php endif;?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fzostanstudentem&amp;send=false&amp;layout=standard&amp;width=320&amp;show_faces=true&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=80&amp;appId=290331384356620" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:320px; height:80px;" allowTransparency="true"></iframe>		
<a href="http://www.uniplaces.com/?utm_source=zostanstudentem&utm_medium=Display_Partners&utm_term=Homepage&utm_content=London&utm_campaign=zostanstudentem"><img src="/img/banners-12.jpg" width="301" height="251" TARGET="_blank"/></a>
</br>
</br>
<a href="http://studiujwuk.pl/"><img src="/img/logoUK.png" width="280" height="280"  TARGET="_blank"/></a>
</br>
<!-- {if $act!=='wyszukiwarka'}<div id="znajdz-uczelnie-mini"><div><form method="get" action="/wyszukiwarka/szukaj-4.html">
	<input type="hidden" name="s[wojewodztwo]"/>
	<div><input type="text" name="s[slowo]"/></div>
	<div><input type="text" name="st[wojewodztwo]"/></div>
	<div><input type="text" name="s[miasto]"/></div>
	<div><input type="submit" value=" "/></div>
</form></div></div>{/if} -->