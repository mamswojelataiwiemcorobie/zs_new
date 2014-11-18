<?php

class MessagesController extends AppController {

		
	
	public function index() {
		//debug($this->Message); //WORKS!
		
	//GETTING INFORMATION
		$post= $this->request->data;
		$this-> set('post', $post);
		//print_r($post);
				
		
		if (!empty($post)) {	
			$imie = $post['Message']['imie'];
			$mail = $post['Message']['mail'];
			$tresc = $post['Message']['tresc'];
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		
		
		//$date = date_create($row[0]);
		$date = date_create();
		$date = date_format($date, 'd/m/Y H:i:s');
		#output: 24/03/2012 17:45:12
		
		$path ='::'.$this->here;
		
		$idbutton = array_shift(array_keys($post));
		
		if (!empty($post)) {	
			//SENDING TO TABLE IN DATABASE
				$this->Message->create();
				$data = array(
						'Message' => array(
							'name'=>$imie,
							'email'=>$mail,
							'message'=>$tresc,
							'IP'=> $ip,
							'DATE_TIME'=>$date,
							'PATH'=> $path,
							'BUTTON_CLICKED_ID'=>$idbutton
				));
				$this->Message->save($data);
		}else{
			$myValue = "no";
			$this->set('myValue', $myValue);
		}	
	
	//GETTING FROM DATABASE
		$this->Message->contain();
		$message = $this->Message-> find('first');
		$this-> set('message', $message);
}

		public function footerMessage(){
		//$this->set('post', $this->Message->read(NULL, $id));
		//$this->Session-
		echo $this->request->data;
	}
	public function send() {
		$n = $this->params->params['pass'][0];
		$e = $this->params->params['pass'][1];
		$m = $this->params->params['pass'][2];
		$i = $this->params->params['pass'][3];
		$d = $this->params->params['pass'][4];
		$p = $this->params->params['pass'][5];
		$b = $this->params->params['pass'][6];
		
		$data = array(
			'Message' => array(
				'name'=>$n,
				'email'=>$e,
				'message'=>$m,
				'IP'=>$i,
				'DATE_TIME'=>$d,
				'PATH'=>$p,
				'BUTTON_CLICKED_ID'=>$b
		));
		
		$this->Message->save($data);
	}
	public function sending(){
		
	}
	public function plus($id){
		echo 'ff';
		$this->Message->create();
		$data = array(
			'Message' => array(
				'name'=>$id
		)); 
		
		$this->Message->save($data);
	}
	public function  acknowledgments(){
		$URL="http://szkolywyzsze.edu.pl/messages/acknowledgments";  
		header ("Location: $URL"); 
	}
}
