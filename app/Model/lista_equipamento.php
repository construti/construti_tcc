<?php

App::uses('AppModel', 'Model');

class Lista_equipamento extends AppModel{
    var $name = 'Lista_equipamento';
	
	var $useTable = 'listas_equipamentos';
	
	var $primaryKey = 'lista_equipamento_id';
	
	public $belongsTo = array(
        'Equipamento' => array(
            'className' => 'Equipamento',
            'foreignKey' => 'equipamento_id',
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
		'equipamento_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'alugado' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio."
		),
		'dt_aluguel_ini' => array(
			'rule' => array('datetime'),
			'allowEmpty' => false,
			'message' => "Este campo não pode ser vazio. Preencha com o formato (dd/mm/aaaa)"
		),
		'dt_aluguel_fim' => array(
			'rule' => array('datetime'),
			'allowEmpty' => false,
			'message' => "Este campo não pode ser vazio. Preencha com o formato (dd/mm/aaaa)"
		)
		
	);
}

?>