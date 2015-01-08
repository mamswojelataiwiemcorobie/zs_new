
		
		<!-- CONTACT
================================================== -->
	
		<iframe 
			class="gmap" 
			style="width:100%;height:370px;border: 0;z-index: 11;position: relative;" 
			src="https://maps.google.com/maps?
				f=q&amp;
				source=s_q&amp;
				hl=en&amp;
				geocode=&amp;
				q=Zontań+Studentem,+Królewska+65+Kraków,+Małopolska,+Polska+&amp;
				aq=1&amp;
				oq=hol&amp;sll=50.0721817,19.9192569&amp;
				
				t=m&amp;
				ie=UTF8&amp;
				hq=Zontań+Studentem&amp;
				hnear=Królewska,+Kraków,+Małopolska&amp;
				ll=50.0721817,,19.9192569&amp;
				
				output=embed"
				
		>
		</iframe>
	

		<section >
		<div class="row">
			<div class="col-md-8 animated fadeInLeft notransition">
				<h1 class="smalltitle">
				<span>Wyślij wiadomość</span>
				</h1>
				<?php
					//echo $this->element('message');
				?>
				<?php
					$ip = $_SERVER['REMOTE_ADDR'] ;
					//$ip = $_SERVER['REMOTE_ADDR'].':'.$_SERVER['SERVER_PORT'] ;
					
					$date = date_create();
					$date = date_format($date, 'd/m/Y H:i:s');
					#output: 24/03/2012 17:45:12
					
					//$path = $this->here;
					$path = '::'.$this->here; 
				?>

				<div id="form" >
					<?php
						echo $this->Session->flash('flash');
						
						echo $this->Form->create('Contact', array('name' => 'MYFORM', 'id' => 'MYFORM','required' => 'required'));

						echo $this->Form->input('name', array('div' => false, 'label' => false, 'name' => 'name', 'size' => '30', 'required' => 'required', 'type' => 'text', 'id' => 'name', 'class' => 'col-md-6 leftradius', 'placeholder' => 'Imie, Nazwisko' ));
						echo $this->Form->input('email', array('div' => false, 'label' => false, 'name' => 'email', 'required' => 'required', 'size' => '30', 'id' => 'email', 'class' => 'col-md-6 rightradius', 'placeholder' => 'Twój Mail' ));

						echo $this->Form->input('thema', array(
							'required' => 'required',
							'div' => false, 
							'label' => false, 
							'class' => 'col-md-12 allradius',
						    'options' => array('Współpraca PR, materiały prasowe', 'Uzupełnienie profilu uczelni', 'Aktualizacja profilu'),
						    'empty' => '(Wybierz Temat)'
						));
						echo $this->Form->input('message', array('div' => false, 'required' => 'required', 'label' => false, 'type' => 'textarea', 'class' => 'col-md-12 allradius', 'name' => 'message', 'placeholder' => 'Wiadomość', 'rows'=>'9' ));
						echo $this->Form->input('IP', array('type' => 'hidden', 'value' => $ip));
						echo $this->Form->input('DATE_TIME', array('type' => 'hidden', 'value' => $date));
						echo $this->Form->input('PATH', array('type' => 'hidden', 'value' => $path));?>
						
						<div clas="captcha"><?php $this->Captcha->render($captchaSettings);?></div>
						
						<?php echo $this->Form->submit('Wyślij', array('div' => true, 'label' => false, 'type' => 'submit', 'id' => 'Send', 'class' => 'btn btn-default btn-md', 'name'=>'button'));
						echo $this->Form->end();
				?>
				</div>
			</div>
			<div class="col-md-4 animated fadeInRight notransition">
				<h1 class="smalltitle">
				<span>Kontakt</span>
				</h1>
				<h3>
				<img src="/img/logos/logo1.png" width="242" height="29" alt="zs" longdesc="http://www.zostanstudentem.pl/" width="400" height="50">
				</h3>
				<h3><strong>Zostań Studentem</strong></h3>
				
				<h4 class="font100">Redakcja</h4>
				<ul class="unstyled">
					<li><span style="margin-right:5px;"><i class="icon-map-marker"></i></span> Adres: Królewska 65A p.2, 30-081 Kraków</li>
					<li><span style="margin-right:2px;"><i class="icon-envelope"></i></span> Email: <a href="mailto:redakcja@zostanstudentem.pl">redakcja@zostanstudentem.pl</a></li>
				</ul>
				
			</div>
		</div>
		</section>
		<!--CALL TO ACTION PANEL
================================================== -->



<?php //pr($this->request->data); ?>
<?php
		/*$this->Js->get('#MYFORM')->event(
          'submit',
          $this->Js->request(
            array('controller'=>'Contacts','action' => 'message'),
            array(
                    'update' => '#form',
                    'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				)),
                    'async' => true,    
                    'dataExpression'=>true,
                    'method' => 'POST'
                )
            )
        );


?>


<div class="send">

</div>*/

