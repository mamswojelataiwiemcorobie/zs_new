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
			<li class="dropdown">
			<li class="dropdown"><?php echo $this->Html->link('SZKOŁY WYŻSZE', '/uczelnie', array('escape' => false)); ?></li>
			<li class="dropdown"><?php echo $this->Html->link('KIERUNKI', '/kierunki', array('escape' => false)); ?></li>
			<li class="dropdown"><?php echo $this->Html->link('MIASTA', '/miasta', array('escape' => false)); ?></li>
			<li class="dropdown"><?php echo $this->Html->link('ZAWODY', '/zawody', array('escape' => false)); ?></li>
			<li class="dropdown"><?php echo $this->Html->link('ERASMUS', '/erazmusy', array('escape' => false)); ?></li>
			<li class="dropdown"><?php echo $this->Html->link('KONTAKT', '/kontakt', array('escape' => false)); ?></li>
		</ul>
	</div>
</nav>

