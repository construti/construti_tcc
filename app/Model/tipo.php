<?php

App::uses('AppModel', 'Model');

class Tipo extends AppModel{
    var $name = 'Tipo';
	
	var $primaryKey = 'tipo_id';
	
	var $displayField = 'tipo_funcionario';
	
	public $belongsTo = array(
        'Area' => array(
            'className' => 'Area',
            'foreignKey' => 'tipo_area_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}

?>