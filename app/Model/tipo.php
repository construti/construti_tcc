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
	
	var $validate = array(
		'tipo_area_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'tipo_funcionario' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo nÃ£o pode ser vazio"
		),
		'tipo_valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>