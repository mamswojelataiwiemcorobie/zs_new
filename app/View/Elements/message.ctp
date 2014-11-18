<?php
					$ip = $_SERVER['REMOTE_ADDR'] ;
					//$ip = $_SERVER['REMOTE_ADDR'].':'.$_SERVER['SERVER_PORT'] ;
					
					$date = date_create();
					$date = date_format($date, 'd/m/Y H:i:s');
					#output: 24/03/2012 17:45:12
					
					//$path = $this->here;
					$path = '::'.$this->here; 

					echo $this->Form->create('Contact', array('name' => 'MYFORM', 'id' => 'MYFORM','required' => 'required'));

					echo $this->Form->input('name', array('div' => false, 'label' => false, 'name' => 'name', 'size' => '30', 'required' => 'required', 'type' => 'text', 'id' => 'name', 'class' => 'col-md-6 leftradius', 'placeholder' => 'Imie, Nazwisko' ));
					echo $this->Form->input('email', array('div' => false, 'label' => false, 'name' => 'email', 'required' => 'required', 'size' => '30', 'id' => 'email', 'class' => 'col-md-6 rightradius', 'placeholder' => 'Twój Mail' ));

					echo $this->Form->input('thema', array(
						'required' => 'required',
						'div' => false, 
						'label' => false, 
						
						'style' => 'width: 100%;',
						
						'class' => 'col-md-6 allradius',
					    'options' => array('Współpraca PR, materiały prasowe', 'Uzupełnienie profilu uczelni', 'Aktualizacja profilu'),
					    'empty' => '(Wybierz Temat)'
					));
					echo $this->Form->input('message', array('div' => false, 'required' => 'required', 'label' => false, 'type' => 'textarea', 'class' => 'col-md-12 allradius', 'name' => 'message', 'placeholder' => 'Wiadomość', 'rows'=>'9' ));
					echo $this->Form->input('IP', array('type' => 'hidden', 'value' => $ip));
					echo $this->Form->input('DATE_TIME', array('type' => 'hidden', 'value' => $date));
					echo $this->Form->input('PATH', array('type' => 'hidden', 'value' => $path));
					

						
				?>
					<img src="/img/captcha/refresh.jpg" width="25" alt="" id="refresh"><img src="http://www.wowthemes.net/demo/calypso/contact/get_captcha.php" alt="" id="captcha">
					<br>
				<?php
					echo $this->Form->input('code', array('div' => false, 'required' => 'required', 'label' => false, 'name' => 'code', 'type' => 'text', 'id' => 'code', 'class' => 'top10', 'placeholder' => 'Wpisz Captcha' ));
					echo $this->Form->submit('Wyślij', array('div' => true, 'label' => false, 'type' => 'submit', 'id' => 'Send', 'class' => 'btn btn-default btn-md', 'name'=>'button'));
					//echo $this->Form->end();

					pr($this->data);
?>