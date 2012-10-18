<?php

App::uses('AppModel', 'Model');

class Lista_funcionario_historico extends AppModel{
    var $name = 'Lista_funcionario_historico';
	
	var $useTable = 'listas_funcionarios_historicos';
	
	var $primaryKey = 'listas_funcionarios_historicos_id';
	
	public $belongsTo = array(
        'Funcionario' => array(
            'className' => 'Funcionario',
            'foreignKey' => 'funcionario_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Obra' => array(
            'className' => 'Obra',
            'foreignKey' => 'obra_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'funcionario_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
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
		'qtd_horas' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'situacao' => array(
			'rule' => 'notEmpty',
			'message' => "Não pode ser vazio."
		)
		
	);
}

?>