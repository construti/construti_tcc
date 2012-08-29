<?php

class Fornecedor extends AppModel{
    var $name = 'Fornecedor';
    
    var $primaryKey = 'fornecedor_id';
	
	var $useTable ='fornecedores';
	
	var $displayField = 'fornecedor_nome';
	
	var $validate = array(
		'fornecedor_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'fornecedor_cnpj' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		) ,
		'fornecedor_estado' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'fornecedor_cidade' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'fornecedor_bairro' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'fornecedor_endereco' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'fornecedor_contato' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		) ,
		'fornecedor_email' => array(
			'rule' => array('email', true), 
            'allowEmpty' => false,
			'message' => "E-mail inexistente."
		) ,
		'fornecedor_tipo' => array(
			'rule' => 'notEmpty', 
			'message' => "Preencha corretamente."
		)
		
	);
}

?>