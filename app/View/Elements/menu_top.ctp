<section class="toparea">
	<div class="container">
		<div id="gora" class="row">
			<div class="col-md-12 top-text pull-right animated fadeInLeft" style="
    display: flex;  justify-content: flex-end;
">			
			
				<div class="social-icons">
					<a class="icon icon-facebook" href="https://www.facebook.com/zostanstudentem"></a>
					<a class="icon icon-twitter" href="https://twitter.com/ZostanStudentem"></a>	
					<a class="icon icon-google-plus" href="https://plus.google.com/+ZostanstudentemPl/posts"></a>
				</div>
				<div id="fb-root">
					<div id="welcome">
						<div id="fb-login-button" scope="public_profile,email" class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<nav class="navbar navbar-fixed-top wowmenu" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<a class="navbar-brand logo-nav" href="/">
				<img src="/img/logoZS_www.png" alt="logo">
			</a>
		</div>

		<ul id="nav" class="nav navbar-nav pull-right l_tinynav1">
			<li><a href="/">Strona główna</a></li>
			<li>	<a href="http://blog.zostanstudentem.pl/" target="_blank">AKTUALNOŚCI</a></li>
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

