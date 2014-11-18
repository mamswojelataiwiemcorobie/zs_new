<style type="text/css">
body{
	font-size: 13px !important;
}
</style>

<?php
pr($unv3);
pr($unv1);

foreach($unv1 as $key => $unv2){
	//pr($unv2);
	$key1=$key;
	foreach($unv2 as $key => $value){
		echo $key1."=>".$key."=>".$value."<br>";
	}
}


/*
	$ret = array();
	$i=0;
	foreach($unv as $key => $value){
		$i++;
		$ret[$i]=array($key, $value);

	  //echo $key.$value;
	  //echo $i;
		#$this->University->id =$key; 
		#$this->University->saveField('promonr', $i);
	}
	echo '<br>';echo '<br>';
	print_r($ret);
	echo '<br>';echo '<br>';echo '<br>';
*/

?>