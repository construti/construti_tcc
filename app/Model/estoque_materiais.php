<?php

class Estoque_materiais extends AppModel{

    var $name = 'Estoque_materiais';
	
	var $useTable = 'estoques_materiais';
	
	var $primaryKey = 'estoques_materiais_id';
	
	var $belongsTo = array(
		'Material' => array(
			'className' => 'Material',
            'foreignKey' => 'material_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		)
	);
    
    var $validate = array(
		'material_id' => array(
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