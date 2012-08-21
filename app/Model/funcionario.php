<?php

class Funcionario extends AppModel{
    var $name = 'Funcionario';
    
    var $primaryKey = 'funcionario_id';
    
	var $validate = array(
		'funcionario_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_cpf' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'funcionario_data_nasc' => array(
			'rule' => array('date','ymd'),
			'allowEmpty' => false,
			'message' => "Este campo não pode ser vazio. Preencha com o formato (dd/mm/aaaa)"
		),
		'funcionario_endereco' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_bairro' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_cidade' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_estado' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_pais' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'funcionario_email' => array(
			'rule' => array('email', true), 
            'allowEmpty' => false,
			'message' => "E-mail inexistente."
		),
		'funcionario_salario' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
	
}

?>