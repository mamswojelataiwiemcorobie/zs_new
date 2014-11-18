<?php 


	$universities = $this->requestAction(array(
												 'controller' => 'universities',
												 'action' => 'home_slider')); 
	$dt_recs = $this->requestAction(array(
												 'controller' => 'universities',
												 'action' => 'home_slider'));
	$il=0;
//znaleźć szybsza metode	
	foreach ($dt_recs as $d){
		$il++;
	} 
	$il=$il-1;
	//$il=10;

	for ($t1 = 0; $t1 <= $il; $t1++) {
	
	if ($t1 != "189" && $t1 != "207" && $t1 != "430" && $t1 != "432"){

		$foto= $universities[$t1]['University']['photo'];
		$newfoto= substr($foto, 0, -4).".png";
		$nazw = $universities[$t1]['University']['nazwa'];
?>
				
				<img style="width:10%; height:10%" src="img/uczelnie_min/<?php echo $newfoto; ?>" alt="<?php echo $nazw; echo $t1;?>" />
				
				
	<?php }} ?>
	