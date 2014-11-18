<?php
class Post extends AppModel {


    var $validate = array(
        
        'body' => array(
        'notEmpty' => array(
            'rule' => array('notEmpty'),
        )
    ),
        'title' => array(
                   'rule'=>'email',
            'message'=>'Enter a valid email address'
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address',
                'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'login' => array(
        'rule' => array('custom', '/[0-9]{0,600}/i'),
        'message' => 'This email address must be @domain.com'
    )
        
    );
}