<?php
	class Ajak extends AppModel{
		public $belongsTo = array('University');
	//public $belongsTo = array('Track');
	public $actsAs = array('Containable');
	}