<?php
	class Contact extends AppModel{
	
		var $name='Contacts';
		
		var $captcha = ''; //intializing captcha var

		var $validate = array(
				'captcha'=>array(
					'rule' => array('matchCaptcha'),
					'message'=>'Failed validating human check.'
				),/*
				'name' => array(
					'notEmpty' => array(
						'rule' => array('notEmpty'),
						'required' => true,
						'message'  => 'Proszę wpisać imię i nazwisko'
					),
				),
				'email' => array(
					'rule' => array('email', true),
					'required' => true,
					'message'  => 'Proszę wpisać prawidłowy adres email'
				),
				'thema' => array(
					'rule'    => 'notEmpty',
					'message' => 'Proszę wybrać temat',
					'required' => true
				),
				'messaqe' => array(
					'rule'       => 'notEmpty',
					'message'    => 'Proszę wpisać wiadomość',
					'required' => true,
				)	*/		
			);

		function matchCaptcha($inputValue)	{
			return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
		}

		function setCaptcha($value)	{
			$this->captcha = $value; //setting captcha value
		}

		function getCaptcha()	{
			return $this->captcha; //getting captcha value
		}

	 
		/*public $validate = array(
			'name' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'required' => true,
					'message'  => 'Proszę wpisać imię i nazwisko'
				),
			),
			'email' => array(
				'rule' => array('email', true),
				'required' => true,
				'message'  => 'Proszę wpisać prawidłowy adres email'
			),
			'thema' => array(
				'rule'    => 'notEmpty',
				'message' => 'Proszę wybrać temat',
				'required' => true
			),
			'messaqe' => array(
				'rule'       => 'notEmpty',
				'message'    => 'Proszę wpisać wiadomość',
				'required' => true,
			)			
		);*/
	}