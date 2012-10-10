<?php

App::uses('AppModel', 'Model');

class Lista_funcionario extends AppModel{
    var $name = 'Lista_funcionario';
	
	var $useTable = 'listas_funcionarios';
	
	var $primaryKey = 'listas_funcionarios_id';
	
	public $belongsTo = array(
        'Funcionario' => array(
            'className' => 'Funcionario',
            'foreignKey' => 'funcionario_id',
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
		'funcionario_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd_horas' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>