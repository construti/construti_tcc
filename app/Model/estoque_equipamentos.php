<?php

class Estoque_equipamentos extends AppModel{

    var $name = 'Estoque_equipamentos';
	
	var $useTable = 'estoques_equipamentos';
	
	var $primaryKey = 'estoques_equipamentos_id';
	
	var $belongsTo = array(
		'Equipamento' => array(
			'className' => 'Equipamento',
            'foreignKey' => 'equipamento_id',
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
		'quantidade' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		),
		'alugado' => array(
			'rule' => array('maxLength', '1'),
			'allowEmpty' => true,
			'message' => "Campo incorreto."
		)
	);   

}

?>