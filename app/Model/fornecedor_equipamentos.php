<?php

App::uses('AppModel', 'Model');

class Fornecedor_equipamentos extends AppModel{
    var $name = 'Fornecedor_equipamentos';
	
	var $useTable = 'fornecedores_equipamentos';
	
	var $primaryKey = 'fornecedores_equipamentos_id';
	
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
		)
		
	);
}

?>