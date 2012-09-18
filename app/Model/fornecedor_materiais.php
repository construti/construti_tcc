<?php

App::uses('AppModel', 'Model');

class Fornecedor_materiais extends AppModel{
    var $name = 'Fornecedor_materiais';
	
	var $useTable = 'fornecedores_materiais';
	
	var $primaryKey = 'fornecedores_materiais_id';
	
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
		)
		
	);
}

?>