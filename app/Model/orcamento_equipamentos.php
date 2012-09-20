<?php

App::uses('AppModel', 'Model');

class Orcamento_equipamentos extends AppModel{
    var $name = 'Orcamento_equipamentos';
	
	var $useTable = 'orcamentos_equipamentos';
	
	var $primaryKey = 'orcamentos_equipamentos_id';
	
	public $belongsTo = array(
        'Fornecedor' => array(
            'className' => 'Fornecedor',
            'foreignKey' => 'fornecedor_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Equipamento' => array(
            'className' => 'Equipamento',
            'foreignKey' => 'equipamento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'fornecedor_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'equipamento_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'alugado' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		),
		'quantidade' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'material_preco' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>