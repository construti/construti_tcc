<?php

App::uses('AppModel', 'Model');

class Lista_equipamento_historico extends AppModel{
    var $name = 'Lista_equipamento_historico';
	
	var $useTable = 'listas_equipamentos_historicos';
	
	var $primaryKey = 'listas_equipamentos_historicos_id';
	
	public $belongsTo = array(
        'Equipamento' => array(
            'className' => 'Equipamento',
            'foreignKey' => 'equipamento_id',
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
		'equipamento_id' => array(
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
		'valor_hora' => array(
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