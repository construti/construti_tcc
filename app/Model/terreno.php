<?php

class Terreno extends AppModel{
    var $name = 'Terreno';
    
    var $primaryKey = 'terreno_id';
	
	var $displayField = 'terreno_nome';
	
	var $validate = array(
		'terreno_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'terreno_endereco' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'terreno_tamanho' => array(
			'rule' => 'numeric', 
            'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>