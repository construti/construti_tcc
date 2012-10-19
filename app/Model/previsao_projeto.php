<?php

App::uses('AppModel', 'Model');

class Previsao_projeto extends AppModel{
    var $name = 'Previsao_projeto';
	
	var $useTable = 'previsoes_projetos';
	
	var $primaryKey = 'previsoes_projetos_id';
	
	var $validate = array(
		'obra_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'tipo' => array(
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