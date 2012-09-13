<?php

App::uses('AppModel', 'Model');

class Equipamentos_tipo extends AppModel{
    var $name = 'Equipamentos_tipo';
	
	var $primaryKey = 'tipo_id';
	
	var $displayField = 'tipo_equipamento';
	
	var $useTable ='equipamentos_tipos';
	
	var $validate = array(
		'tipo_equipamento' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'tipo_valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)
		
	);
}

?>