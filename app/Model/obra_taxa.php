<?php

App::uses('AppModel', 'Model');

class Obra_taxa extends AppModel{
    var $name = 'Obra_taxa';
	
	var $useTable ='obras_taxas';
	
	var $primaryKey = 'obras_taxas_id';
	
	var $displayField = 'descricao';
	
	public $belongsTo = array(
		'Obra' => array(
            'className' => 'Obra',
            'foreignKey' => 'obra_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'obra_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'descricao' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'custo' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
	);
}

?>