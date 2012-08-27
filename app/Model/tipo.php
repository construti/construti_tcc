<?php

App::uses('AppModel', 'Model');

class Tipo extends AppModel{
    var $name = 'Tipo';
	
	public $displayField = 'nome';
	
	public $belongsTo = array(
        'Area' => array(
            'className' => 'Area',
            'foreignKey' => 'area_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}

?>