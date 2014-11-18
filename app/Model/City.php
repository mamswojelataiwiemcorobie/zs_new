<?php
class City extends AppModel {
	public $hasMany = 'University';
	public $displayField = 'nazwa';
	
	public function srednia($city) {
		/*wartosci wspólczynników wagi:
			wpom- ceny miejsca w pokoju, wbm - ceny biletu misięcznego, ws-liczby studentów*/
		$wpom=4;
		$wpo=3;
		$wb=2;
		$wbm=2;
		$wo=2;
		$wbe=4;
		$ws=2;
		$wp=5;
		$sum = $wpom + $wpo + $wb + $wbm + $wo + $wbe + $ws + $wp;
		if ($city['City']['bilet_m'] != 0 && $city['City']['bilet_m'] != "0" ){
			echo $city['City']['nazwa'];
			$srednias= ((1/$city['City']['bilet_m'])*$wpom)+((1/$city['City']['pokoj'])*$wpo)+((1/$city['City']['bilet'])*$wb)+((1/$city['City']['bilet_m'])*$wbm)+((1/$city['City']['obiad'])*$wo)+((1/$city['City']['bezrobocie'])*$wbe)+(($city['City']['studenci']/10000)*$ws)+($city['City']['placa']*$wp);
			
			$srednia= $srednias/ $sum;
		}
		return($srednia);
	}
	
	public function rank() {
		$PartArray = $this->find('all', array ('fields' => array('id','srednia'),'order' => array('srednia' => 'desc')));
		$i=0;
		foreach ($PartArray as $Record) {
			$i++;
			$this->id = $Record['City']['id'];
			$this->saveField('rank', $i);
		} 
	}
}