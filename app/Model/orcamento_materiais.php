<?php

App::uses('AppModel', 'Model');

class Orcamento_materiais extends AppModel{
    var $name = 'Orcamento_materiais';
	
	var $useTable = 'orcamentos_materiais';
	
	var $primaryKey = 'orcamentos_materiais_id';
	
	public $belongsTo = array(
        'Fornecedor' => array(
            'className' => 'Fornecedor',
            'foreignKey' => 'fornecedor_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Material' => array(
            'className' => 'Material',
            'foreignKey' => 'material_id',
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
		'material_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
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