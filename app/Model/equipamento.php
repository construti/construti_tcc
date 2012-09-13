<?php

class Equipamento extends AppModel{
    var $name = 'Equipamento';
    
    var $primaryKey = 'equipamento_id';
	
	var $validate = array(
		'equipamento_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'equipamento_alugado' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'equipamento_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		),
		'equipamento_ultimo_preco' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		)
		
	);
}

?>