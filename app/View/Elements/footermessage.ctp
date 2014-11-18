<p>Wyślij wiadomość:</p>
	<?php
		echo $this->Form->create();
		echo $this->Form->input('imie');
		echo $this->Form->input('mail');
		echo $this->Form->input('tresc');
		echo $this->Form->submit('wyślij',array('name'=>'button_messageView_footermessage'));
		echo $this->Form->end(); 
	 
		function strToHex($string){
			$hex = '';
			for ($i=0; $i<strlen($string); $i++){
				$ord = ord($string[$i]);
				$hexCode = dechex($ord);
				$hex .= substr('0'.$hexCode, -2);
			}
			return strToUpper($hex);
		}
		//print_r(strToHex('abc'));
		
		#echo 'cval: '.$myValue;
		if (!empty($post)) {
			echo ' ->hex: '.strToHex($myValue);
		}
	
		#echo '<br>'."dbval: ";
		//echo $message.'<br>';
		//echo $message[1].'<br>';
		//echo $message['id'].'<br>';
		//echo $message['messages']['id'].'<br>';
		#echo $message['Message']['id'].'<br>';
		//echo $message[1]['messages']['id'].'<br>';
		//echo $message[1]['message']['id'].'<br>';
		//echo $message['1']['messages']['id'].'<br>';
		//echo $message['1']['message']['id'].'<br>';
		//print_r($message);
		//echo '<br>';
		//print_r($message['Message']);
		//echo '<br>';
		
	?>
	<?php
			
        #echo 'pst: ';
		if (!empty($post)) {
			#print_r($post);
		}else{
			#echo 'no';
		}

	?>

	<?php
		/* 
			$user_name = "st183148";
			$password = "baor4j37";
			$database = "st183148_bdstudeo";
			$server = "46.242.145.22";

			$db_handle = mysql_connect($server, $user_name, $password);
			$db_found = mysql_select_db($database, $db_handle);

			if ($db_found) {

			$SQL = "SELECT * FROM st183148_bdstudeo";
			$result = mysql_query($SQL);

			while ( $db_field = mysql_fetch_assoc($result) ) {

			print $db_field['ID'] . "<BR>";
			echo 'ok';

			}

			mysql_close($db_handle);

			}
			else {

			print "Database NOT Found ";
			mysql_close($db_handle);

			}
		*/
	?>























