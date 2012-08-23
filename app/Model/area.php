<?php

App::uses('AppModel', 'Model');

class Area extends AppModel{
    var $name = 'Area';
	
	public $displayField = 'nome';
	
	public $hasMany = array(
        'Tipo' => array(
            'className' => 'Tipo',
            'foreignKey' => 'area_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}

?>