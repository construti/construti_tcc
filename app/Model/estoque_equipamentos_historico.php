<?php

class Estoque_equipamentos_historico extends AppModel{

    var $name = 'Estoque_equipamentos_historico';
	
	var $useTable = 'estoques_equipamentos_historicos';
	
	var $primaryKey = 'estoques_equipamentos_historicos_id';
	
	var $belongsTo = array(
		'Estoque_equipamentos' => array(
			'className' => 'Estoque_equipamentos',
            'foreignKey' => 'estoques_equipamentos_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		)
	);
    
    var $validate = array(
		'estoques_equipamentos_id' => array(
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