<?php

class Material extends AppModel{

    var $name = 'Material';
	
	var $useTable = 'materiais';
	
	var $primaryKey = 'material_id';
	
	var $displayField = 'material_nome';
	
	var $hasMany = array(
		
	);
	
	var $belongsTo = array(
		'Material_tipo' => array(
			'className' => 'Material_tipo',
            'foreignKey' => 'material_tipo',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		),
		'Embalagem' => array(
			'className' => 'Embalagem',
            'foreignKey' => 'material_embalagem',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		),
		'Medida' => array(
			'className' => 'Medida',
            'foreignKey' => 'material_medida',
            'conditions' => '',
            'fields' => '',
            'order' => ''
		)
	);
	
	public $virtualFields = array(
    'descricao' => 'CONCAT(material_nome, " - ", material_embalagem , " - ", material_qtd_base, " - ", material_medida)'
);

    
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