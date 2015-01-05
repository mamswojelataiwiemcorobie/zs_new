<section class="toparea">
	<div class="container">
		<div id="gora" class="row">

			<div class="col-md-6 top-text pull-left animated fadeInLeft">
				<!--
				<i class="icon-phone"></i><span class="separator"></span><i class="icon-envelope"></i> Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej. 
				-->
				<?php echo $this->Html->link('Ta strona wykorzystuje pliki cookie x','', array('style'=>'color:#444'));	?>
			</div>

			<div class="col-md-6 text-right animated fadeInRight">
				<div class="social-icons">
					<a class="icon icon-facebook" href="https://www.facebook.com/zostanstudentem"></a>
					<a class="icon icon-twitter" href="https://twitter.com/ZostanStudentem"></a>	
					<a class="icon icon-google-plus" href="https://plus.google.com/+ZostanstudentemPl/posts"></a>
				</div>
			</div>
		</div>
	</div>
</section>

<nav class="navbar navbar-fixed-top wowmenu" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<a class="navbar-brand logo-nav" href="/">
				<img src="/img/logo.png" alt="logo">
			</a>
		</div>

		<ul id="nav" class="nav navbar-nav pull-right l_tinynav1">
			<li><a href="/">Strona główna</a></li>
			<li>	<a href="http://blog.zostanstudentem.pl/">AKTUALNOŚCI</a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">WYSZUKIWARKA<i class="icon-angle-down"></i></a>
			<ul class="dropdown-menu">
				<li class="dropdown"><?php echo $this->Html->link('SZKOŁY WYŻSZE', '/wyszukiwarka/szkoly-wyzsze-1.html', array('escape' => false)); ?></li>
				<li class="dropdown"><a href="/wyszukiwarka/szkoly-policealne-2.html">SZKOŁY POLICEALNE</a></li>
				<li>	<a href="/wyszukiwarka/szkoly-jezykowe-3.html">SZKOŁY JĘZYKOWE</a></li>
			</ul>
			<li>	<a href="/kierunki/artystyczne-1.html">KIERUNKI STUDIÓW</a></li>
			<li>	<a href="/info/informator-2014-9.html">INFORMATOR</a></li>
			<li><a href="/kontakt.html">KONTAKT</a></li>
		</ul>
	</div>
</nav>

