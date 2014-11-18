<?php
	App::uses('CakeEmail', 'Network/Email');
	
	class ContactsController extends AppController {
		
		var $helpers = array('Html', 'Form', 'Captcha');
		
		var $name='Contacts';
		
		var $uses = array('Contact');
		
		function captcha()	{
			$this->autoRender = false;
			$this->layout='ajax';
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				$this->Captcha = $this->Components->load('Captcha', array(
					'width' => 150,
					'height' => 50,
					'theme' => 'random', //possible values : default, random ; No value means 'default'
				)); //load it
				}
			$this->Captcha->create();
		}
		
		public function index() {

			$this->set('title_for_layout', 'Kontakt');
			$this->set('description_for_layout', 'Kontakt');
			$this->set('keywords_for_layout', 'Kontakt, mail, address, telephon, message');
			
			 $this->Captcha = $this->Components->load('Captcha', array('captchaType'=>'image', 'jquerylib'=>true, 'modelName'=>'Contact', 'fieldName'=>'captcha')); //load it
			
			if ($this->request->is('post')) {
				$this->Contact->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
				$this->Contact->set($this->request->data);
				if($this->Contact->validates()) {
					// do something, save you data, login, whatever
					$name = addslashes($this->data['name']);
					$email = addslashes($this->data['email']);
					if(isset($thema)) {
						$thema = $this->data['Contact']['thema'];
					}else {
						$thema = 0;
					}
					switch ($thema) {
						case 0 : $thema = 'Współpraca PR, materiały prasowe'; break;
						case 1 : $thema = 'Uzupełnienie profilu uczelni'; break;
						case 2 : $thema = 'Aktualizacja profilu'; break;
					}
					$message = addslashes($this->data['message']);
					$IP = $this->data['Contact']['IP'];
					$DATE_TIME = $this->data['Contact']['DATE_TIME'];
					$PATH = $this->data['Contact']['PATH'];
					
					$wiadomosc = 'Wiadomość z serwisu szkolywyzsze.edu.pl na temat - ' .$thema. "\r\n\r\n";
					$wiadomosc .= 'Od - ' .$name. ' (adres email: ' .$email. ") \r\n\r\n";
					$wiadomosc .= 'Wysłana ' .$DATE_TIME. "\r\n\r\n";
					$wiadomosc .=  $message;
	 
					// send email with CakeEmail
					$Email = new CakeEmail();
					$Email->from(array('szkolywyzsze@edu.pl' => 'Porównywarka'))
						->to('redakcja@zostanstudentem.pl')
						->subject('Formularz kontaktowy - ' .$thema);
					//response to user
					$Email2 = new CakeEmail();
					$Email2->from(array('no-reply@szkolywyzsze.edu.pl' => 'Porównywarka uczelni'))
						->to($email)
						->emailFormat('html')
						->subject('Potwierdzenie wysłania formularza kontaktowego szkolywyzsze.edu.pl - ' .$thema);
					$potwierdzenie = "Dziękujemy za wysłanie formularza kontaktowego. <br/><br/>
										Postaramy się odpowiedzieć na niego jak najszybciej. <br/><br/>
										Zespół szkolywysze.edu.pl";
										
					if($Email->send($wiadomosc) && $Email2->send($potwierdzenie)){
							$record = array('name' => $name,'email' => $email,'temat' => $thema,'message' => $message,'IP' => $IP,'DATE_TIME' => $DATE_TIME,'PATH' => $PATH);
							$this->Contact->save($record);
							unset($this->request->data['Contact']);
							$this->Session->setFlash('Dziękujemy! Wiadomość została wysłana.', 'odpowiedz');
							$this->redirect(array('action'=>'index'));
					}else{
						$this->Session->setFlash('Nie można wysłać wiadomości. Proszę spróbować ponownie', 'bad');
					}
				} else {
					// display the raw API error
					$this->Session->setFlash('Proszę wprowadzić prawidłowy kod captcha', 'bad');
				}					 
			}
		}
		public function message() {
			if(isset($this->data['Contact']) && $this->data['Contact']['call_button'] == 'Wyślij'){
				//pr($this->data);
				$name = $this->data['name'];
				$email = $this->data['email'];
				$thema = $this->data['Contact']['thema'];
				$message = $this->data['message'];
				$code = $this->data['code'];
				$button = $this->data['Contact']['call_button'];
				$IP = $this->data['Contact']['IP'];
				$DATE_TIME = $this->data['Contact']['DATE_TIME'];
				$PATH = $this->data['Contact']['PATH'];

				$record = array('name' => $name,'email' => $email,'temat' => $thema,'message' => $message,'IP' => $IP,'DATE_TIME' => $DATE_TIME,'PATH' => $PATH,'captcha' => $code,'button' => $button);
				$this->Contact->save($record);
			}
		}
	}

