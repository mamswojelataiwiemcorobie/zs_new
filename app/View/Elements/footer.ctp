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
					<img src="/img/logo2.png" width="242"  />
					<p>
						Dzięki naszemu serwisowi porównasz wybrane uczelnie, kierunki studiów, czesne, koszty, stypendia, możliwości wyjazdu w ramach programu Erasmus.					</p>
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
						<div id="quote_wrap" style="height: 120px; width: 200px">
							<div class="textItem" style="display: block;">
								W razie zaistnienia błedów lub niepoprawnych danych prosimy o ich zgłoszenie przez Formularz Kontaktowy.
							</div>
						</div>
						
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form" >
					<?php
						echo $this->Session->flash('flash');
						
						echo $this->Form->create('Contact', array('url' => '/contacts/index', 'name' => 'MYFORM', 'id' => 'MYFORM','required' => 'required'));

						echo $this->Form->input('name', array('div' => false, 'label' => false, 'name' => 'name', 'size' => '30', 'required' => 'required', 'type' => 'text', 'id' => 'name', 'class' => 'col-md-6 leftradius', 'placeholder' => 'Imie, Nazwisko' ));
						echo $this->Form->input('email', array('div' => false, 'label' => false, 'name' => 'email', 'required' => 'required', 'size' => '30', 'id' => 'email', 'class' => 'col-md-6 rightradius', 'placeholder' => 'Twój Mail' ));

						/*echo $this->Form->input('thema', array(
							'required' => 'required',
							'div' => false, 
							'label' => false, 							
							'class' => 'col-md-12 allradius',
						    'options' => array('Współpraca PR, materiały prasowe', 'Uzupełnienie profilu uczelni', 'Aktualizacja profilu'),
						    'empty' => '(Wybierz Temat)'
						));*/
						echo $this->Form->input('message', array('div' => false, 'required' => 'required', 'label' => false, 'type' => 'textarea', 'class' => 'col-md-12 allradius', 'name' => 'message', 'placeholder' => 'Wiadomość', 'rows'=>'5' ));
						echo $this->Form->input('IP', array('type' => 'hidden', 'value' => $ip));
						echo $this->Form->input('DATE_TIME', array('type' => 'hidden', 'value' => $date));
						echo $this->Form->input('PATH', array('type' => 'hidden', 'value' => $path));?>
						
						<div clas="captcha"><?php //$this->Captcha->render($captchaSettings);?></div>
						
						<?php 
						echo $this->Form->submit('Wyślij', array('div' => true, 'label' => false, 'type' => 'submit', 'id' => 'Send', 'class' => 'btn btn-default btn-md', 'name'=>'button'));
						echo $this->Form->end();
				?>
				</div>
					<?php /*
						//-------------------------------::TRACKING WVT::----------------------------
							//GETTING INFORMATION
								$ip = $_SERVER['REMOTE_ADDR'] ;
								//$ip = $_SERVER['REMOTE_ADDR'].':'.$_SERVER['SERVER_PORT'] ;
								
								$date = date_create();
								$date = date_format($date, 'd/m/Y H:i:s');
								#output: 24/03/2012 17:45:12
								
								//$path = $this->here;
								$path = '::'.$this->here; 
								
								//set get cookies
									$vn_nr = NULL;
													
									if(!isset($_COOKIE['vnd'])){ 
										$vn_nr = sha1(microtime());
										$expire = time()+60*60*24*30;
										setcookie("vnd", $vn_nr, $expire);
									}else{
										$vn_nr = $_COOKIE['vnd'];
									}
								
								$this->requestAction(
									array('controller' => 'tracks', 'action' => 'send'),
									array('pass' => array('??', $ip, $date, $path, $vn_nr))
								);
						//-------------------------------------------------------------------------
						?>
					<h1 class="title"><span class="colortext">S</span>kontaktuj <span class="font100">się z nami</span></h1>
					<div class="done">
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							Twoja wiadomość została przesłana. Dziękujemy!
						</div>
					</div>
					<form method="post" Xaction="messages/sending">
						<div >
							<?php
								echo $this->Form->create('Message', array('action'=>'/index'));
								echo $this->Form->input('name', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'col-md-6', 'name' => 'name', 'placeholder' => 'Imie' ));
								echo $this->Form->input('name', array('div' => false, 'label' => false, 'type' => 'text', 'class' => 'col-md-6', 'name' => 'email', 'placeholder' => 'E-mail' ));
								echo $this->Form->input('name', array('div' => false, 'label' => false, 'type' => 'textarea', 'class' => 'col-md-12', 'name' => 'message', 'placeholder' => 'Wiadomość', 'style'=>'height:115px;' ));
								echo $this->Form->input('IP', array('type' => 'hidden', 'value' => $ip));
								echo $this->Form->input('DATE_TIME', array('type' => 'hidden', 'value' => $date));
								echo $this->Form->input('PATH', array('type' => 'hidden', 'value' => $path));
								echo $this->Form->submit('Wyślij', array('div' => false, 'label' => false, 'type' => 'submit', 'class' => 'btn', 'name'=>'button'));
								//echo $this->Form->end();
							?>
						</div>
						<?php
						//pr($this->request->data);
							if(!empty($this->request->data['Message'])){

								$n = $_POST['name'];
								$e = $_POST['email'];
								$m = $_POST['message'];
								$b = $_POST['button'];
								$this->requestAction(
									array('controller' => 'messages', 'action' => 'send'),
									array('pass' => array($n, $e, $m, $ip, $date, $path, $b))
								);
							}

						?>
					</form>
					*/?>
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
						<li><a href="http://www.zostanstudentem.pl/">Zostań Studentem</a></li>
						<li><a href="http://blog.zostanstudentem.pl/">Blog</a></li>
						<li><a href="http://blog.zostanstudentem.pl/kontakt/">Kontakt</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>