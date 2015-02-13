				<?php
					$ip = $_SERVER['REMOTE_ADDR'] ;
					//$ip = $_SERVER['REMOTE_ADDR'].':'.$_SERVER['SERVER_PORT'] ;
					
					$date = date_create();
					$date = date_format($date, 'd/m/Y H:i:s');
					#output: 24/03/2012 17:45:12
					
					//$path = $this->here;
					$path = '::'.$this->here; 
				?>
<section>
	<div class="footer">
		<div class="container animated fadeInUpNow notransition fadeInUp">
			<div class="row">
				<div class="col-md-3">
					<p>
						<img src="/img/logoZS.png" width="242" height="29" alt="logo Zostaństudentem" />
					</p>
					<p>
						Dzięki naszemu serwisowi szybko znajdziesz informacje na temat interesujących Cię uczelni, kierunków, kursów.</p>
				</div>
				<div class="col-md-3">
						<p>
							<img src="/img/logoZS.png" width="242" height="29" alt="zs" longdesc="http://www.zostanstudentem.pl/" /> </p>

						</br>					
						<p>
							<strong>Adres: </strong> Królewska 65A, 30-081 Kraków
						</p>
						<p>
							<strong>Email: </strong> redakcja@zostanstudentem.pl
						</p>
						<ul class="social-icons list-soc">
							<li><a href="http://www.facebook.com/zostanstudentem"><i class="icon-facebook"></i></a></li>
							<li><a href="http://twitter.com/ZostanStudentem"><i class="icon-twitter"></i></a></li>
							<li><a href="http://plus.google.com/117566299125307739451"><i class="icon-google-plus"></i></a></li>
						</ul>
					
				</div>
				<div class="col-md-3">
					<h1 class="title"><span class="colortext">Z</span>głaszanie <span class="font100">uwag</span></h1>
					<div id="quotes">
						<div id="quote_wrap">
							<div>
								W razie zaistnienia błedów lub niepoprawnych danych prosimy o ich zgłoszenie przez <a href="/kontakt">Formularz Kontaktowy</a>.
							</div>
						</div>
						
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-3">
					<div class="k two-col">
						<h1>Inne serwisy</h1>
						<ul>
							<li><a href="http://studiujwuk.pl/">STUDIUJ W UK</a></li>
							<li><a href="http://porownywarkauczelni.pl/">PORÓWNYWARKA UCZELNI</a></li>
							<li><a href="http://studyinpoland.com.ua/">ZOSTAŃ STUDENTEM UA</a></li>
							<li><a href="http://studyinpoland.com.ru/">ZOSTAŃ STUDENTEM RU</a></li>
							<li><a href="http://studyinpoland.by/">ZOSTAŃ STUDENTEM BY</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p id="back-top" style="display: block;">
		<a href="#top">
			<span></span>
		</a>
	</p>
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<p class="pull-left">
						 © Copyright 2015 Zostanstudentem.pl 
						
					</p>
				</div>
				<div class="col-md-8">
					<ul class="footermenu pull-right">
						<!-- <li><a href="#">Porownywarka Uczelni</a></li> -->
						<li><a href="http://www.studiujwuk.pl/">Studiuj w UK</a></li>
						<li><a href="http://blog.zostanstudentem.pl/">Blog</a></li>
						<li><a href="http://blog.zostanstudentem.pl/kontakt/">Kontakt</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>