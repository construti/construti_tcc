<?php

class Material extends AppModel{

    var $name = 'Material';
	
	var $useTable = 'materiais';
	
	var $primaryKey = 'material_id';
	
	var $displayField = 'material_nome';
	
	var $hasMany = array('Embalagem','Medida');
	
	 
    
    var $validate = array(
		'material_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'material_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'material_ultimo_preco' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		)
	);   

}

?>