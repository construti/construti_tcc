<?php

App::uses('AppModel', 'Model');

class Obras_historico extends AppModel{
    var $name = 'Obras_historico';
	
	var $primaryKey = 'obras_historicos_id';
	
	//var $useTable ='obras_status';
	public $belongsTo = array(
        'Obras_status' => array(
            'className' => 'Obras_status',
            'foreignKey' => 'obra_status',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'obra_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'andamento' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'obra_status' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);
}

?>