<?php

class TracksController extends AppController {

	public function index() {
	
	//GETTING FROM DATABASE
///*
		$this->Track->contain();
		$tracks = $this->Track->find('first');
		$this->set('tracks', $tracks);
//*/	
	//GETTING INFORMATION
			
		#output: 24/03/2012 17:45:12
		
		$path ='::'.$this->here; 

	//SENDING TO TABLE IN DATABASE
///*		
		$this->Track->create();
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$date = date_create();
		$date = date_format($date, 'd/m/Y H:i:s');
		$data = array(
				'Track' => array(
					'name'=>'a1',
					'messages_id'=>'a1',
					'cookie_id'=>'a1',
					'ip'=> $ip,
					'dates_times'=>$date,
					'paths'=> $path,
					'buttons_clicked'=>'a1'
		));
		$this->Track->save($data);
//*/
	}
	public function footer() {
	
	$this->University->contain();
		$this->Track->contain();
		$tracks = $this->Track->find('all');
		$this->set('tracks', $tracks);
	}
	public function send() {
		//pr($this->params->params['pass']);

	//GETTING INFORMATION
		$name = 'N.N.';
		$par1 = $this->params->params['pass'][0];
		$ip = $this->params->params['pass'][1];
		switch ($ip) {
			case '178.180.198.147:80':
			case '178.180.198.147':
			case '213.158.216.168:80':
			case '213.158.216.168':
				$name = 'T-Mobile lw';
				break;
			case '192.162.147.207:80':
			case '192.162.147.207':
				$name = 'zostanstudentem.pl';
				break;
			case '89.73.144.5:80':
			case '89.73.144.5':
				$name = 'UPC lw';
				break;
			case '66.249.67.44:80':	
			case '66.249.67.44':
			case '66.249.67.238:80':
			case '66.249.67.238':
				$name = 'Google Inc.';
				break;
			case '91.247.252.110:80':
			case '91.247.252.110':
				$name = 'Press-service Monitoring Mediow Sp. Z O.o., Poznań';
				break;
			case '173.252.100.113':
				$name = 'Facebook, Inc.';
				break;
			case '198.143.158.202':
				$name = 'SingleHop Chicago';
				break;
		}
		
		//GOOGLE SERVERS
			//64.233.160.0 - 64.233.191.255
			//66.102.0.0 - 66.102.15.255
			//66.249.64.0 - 66.249.95.255
			//72.14.192.0 - 72.14.255.255
			//74.125.0.0 - 74.125.255.255
			//209.85.128.0 - 209.85.255.255
			//216.239.32.0 - 216.239.63.255
			
			//Other Servers
				//91.247.252.110	Poland	Wielkopolskie	Poznan	Press-service Monitoring Mediow Sp. Z O.o.
				//207.241.226.216	Internet Archive	San Francisco 
				
				//173.252.100.113 - Facebook, Inc. is lcoated at Menlo Park (United States - California).
				//198.143.158.202 - SingleHop Chicago

		$aip = array();
  
		$pip = $ip;                     // AA.BBB.C.DDD:ZZ
		$pip = strstr($pip, '.',true);  // AA
			//echo $pip.'<br>';
		$aip[0] = $pip;
			//echo $aip[0].'<br>';
		  
		$pip = $ip;                     // AA.BBB.C.DDD:ZZ
		$pip = strstr($pip, '.',false); // .BBB.C.DDD:ZZ
		$pip = substr($pip, 1);         // BBB.C.DDD:ZZ
		$pip = strstr($pip, '.',true);  // BBB
			//echo $pip.'<br>';
		$aip[1] = $pip;
			//echo $aip[1].'<br>';
		  
		$pip = $ip;                     // AA.BBB.C.DDD:ZZ
		$pip = strstr($pip, '.',false); // .BBB.C.DDD:ZZ
		$pip = substr($pip, 1);         // BBB.C.DDD:ZZ
		$pip = strstr($pip, '.',false); // .C.DDD:ZZ
		$pip = substr($pip, 1);         // C.DDD:ZZ
		$pip = strstr($pip, '.',true);  // C
			//echo $pip.'<br>';
		$aip[2] = $pip;
			//echo $aip[2].'<br>';
			
		switch ($aip) {
			case ($aip[0] == '64'  && $aip[1] == '233'  && ($aip[2] >= 160 && $aip[2] < 191)):
			case ($aip[0] == '66'  && $aip[1] == '102'  && ($aip[2] >= 0   && $aip[2] < 15 )):
			case ($aip[0] == '66'  && $aip[1] == '249'  && ($aip[2] >= 64  && $aip[2] < 95 )):
			case ($aip[0] == '72'  && $aip[1] == '14'   && ($aip[2] >= 192 && $aip[2] < 255)):
			case ($aip[0] == '74'  && $aip[1] == '125'  && ($aip[2] >= 0   && $aip[2] < 255)):
			case ($aip[0] == '209' && $aip[1] == '85'   && ($aip[2] >= 128 && $aip[2] < 255)):
			case ($aip[0] == '216' && $aip[1] == '239'  && ($aip[2] >= 32  && $aip[2] < 63 )):
				$name = 'Google Inc.';
  			break;
		}

		$date = $this->params->params['pass'][2];
		$path = $this->params->params['pass'][3];
		$cookie_id = $this->params->params['pass'][4];
		//print_r($this->params->params['pass'][2]);
		
		
		$mes = NULL;
		switch ($cookie_id) {
			case '0739a4a6fb78a4dfb61d4e79ae602bdd70c34fee':
				$mes = 'zs lw';
				break;
			case '436c35aff97fb949ff4732951805762ee4592414':
				$mes = 'zs lw';
				break;
				
			case '9db039b853026e9d64e813eadbd62aa1413b7367':
				$mes = 'mob lw';
				break;
			case '248efc7b1d77d51aaf2396d54dc755d0b33c3746':
				$mes = 'Facebook, Inc.';
				break;
		}

	//SENDING TO TABLE IN DATABASE
		$this->Track->contain();
		$tracks = $this->Track->find('first');
		//pr($tracks); //WORKS!
		
		$data = array(
			'Track' => array(
				'name'=>$name,
				'messages_id'=>$mes,
				'cookie_id'=>$cookie_id,
				'ip'=> $ip,
				'dates_times'=>$date,
				'paths'=> $path,
				'buttons_clicked'=>$par1
		));
		$this->Track->save($data);
		
	}
	public function search() {
		$this->Track->contain();
	///*	
		$tracks = $this->Track->find('all');
		//, array(
        //'conditions' => array('Track.ip' => '173.252.100.113'),
		//'fields' => array('Track.ip')
		//);
	//*/
		foreach($tracks as $track){
			$ip = $track['Track']['ip'];
		/*	
			$ip = $track['Track']['ip'];
			if($ip == '173.252.100.113'){
				echo $ip;
				pr($track);
			}
		*/
			if($ip == '192.162.147.207'){
				$mid = $track['Track']['messages_id'];
				if ($mid != 'zs lw'){
					//pr($track); 
				}
				
			}
			
		}
		$this->set('tracks', $tracks);

	}
	public function parhfajlhflskfhslfhirhrihrkrlslfhflrsshssrfsrfssfsrfsffrfsrrjifjirjirjij() {
		pr($this->params->params);
	}
}

























