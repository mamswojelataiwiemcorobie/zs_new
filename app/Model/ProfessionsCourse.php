<?php
class ProfessionsCourse extends AppModel {
    public $belongsTo = array('Profession','Course');
}