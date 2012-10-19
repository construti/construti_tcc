<?php

App::uses('AppModel', 'Model');

class Previsao_taxa extends AppModel{
    var $name = 'Previsao_taxa';
	
	var $useTable = 'previsoes_taxas';
	
	var $primaryKey = 'previsoes_taxas_id';
	
	var $validate = array(
		'obra_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'descricao' => array(
			'rule' => 'notEmpty',
			'message' => "Somente numeros."
		),
		'custo' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>