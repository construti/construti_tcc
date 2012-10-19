<?php

App::uses('AppModel', 'Model');

class Previsao_funcionario extends AppModel{
    var $name = 'Previsao_funcionario';
	
	var $useTable = 'previsoes_funcionarios';
	
	var $primaryKey = 'previsoes_funcionarios_id';
	
	public $belongsTo = array(
        'Tipo' => array(
            'className' => 'Tipo',
            'foreignKey' => 'tipo_id',
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
		'tipo_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd_horas' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'salario' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)		
	);
}

?>