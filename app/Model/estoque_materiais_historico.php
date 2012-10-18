<?php

class Estoque_materiais_historico extends AppModel{

    var $name = 'Estoque_materiais_historico';
	
	var $useTable = 'estoques_materiais_historicos';
	
	var $primaryKey = 'estoques_materiais_historicos_id';
	
	var $belongsTo = array(
		'Estoque_materiais' => array(
			'className' => 'Estoque_materiais',
            'foreignKey' => 'estoques_materiais_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		)
	);
    
    var $validate = array(
		'estoques_materiais_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'andamento' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		),
		'quantidade_estocada' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		),
		'quantidade' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		)
	);   

}

?>