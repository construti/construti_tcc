<?php

class Requisicao extends AppModel{
    var $name = 'Requisicao';
    
    var $primaryKey = 'requisicao_id';
	
	var $useTable ='requisicoes';
	
	var $validate = array(
		'requisicao_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'requisicao_email' => array(
			'rule' => array('email', true), 
            'allowEmpty' => false,
			'message' => "E-mail inexistente."
		) 
		
	);
}

?>