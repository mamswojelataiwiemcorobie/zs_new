<div class="qlist qlist-red">
	<div class="header">NAJCZĘŚCIEJ WYSZUKIWANE</div>
	<div class="cont">
		{foreach from=$najczesciej_wyszukiwane item="fit"}
		<p{cycle values=', class="sec"'}><a href="/najczesciej-szukane/{$fit.keyword|@polskie_znaki}-{$fit.id}.html">{$fit.keyword}</a></p>{/foreach}
	</div>
</div>
{if $ostatnio_odwiedzane|@count > 0}<div class="qlist qlist-blue">
	<div class="header">OSTATNIO ODWIEDZANE</div>
	<div class="cont">
		{foreach from=$ostatnio_odwiedzane item="fit"}
		<p{cycle values=', class="sec"'}><a href="{$fit.url}">{$fit.name}</a></p>{/foreach}
	</div>
</div>{/if}
{if $act!=='wyszukiwarka'}<div id="znajdz-uczelnie-mini"><div><form method="get" action="/wyszukiwarka/szukaj-4.html">
	<input type="hidden" name="s[wojewodztwo]"/>
	<div><input type="text" name="s[slowo]"/></div>
	<div><input type="text" name="st[wojewodztwo]"/></div>
	<div><input type="text" name="s[miasto]"/></div>
	<div><input type="submit" value=" "/></div>
</form></div></div>{/if}
</br>
<div><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fzostanstudentem&amp;width=300&amp;height=480&amp;colorscheme=light&amp;show_faces=true&amp;border_color=white&amp;stream=true&amp;header=false&amp;appId=290331384356620" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:480px;" allowTransparency="true"></iframe></div>
</br>
{*<div class="register-box"><form method="post" action="/rejestracja.html"><input type="hidden" name="nosubmit" value="1"/>
	<span>ZAREJESTRUJ SIĘ</span>
	<input type="text" name="login"/>
	<input type="submit" value=" "/>
</form></div>*}