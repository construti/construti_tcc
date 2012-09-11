<?php

App::uses('AppModel', 'Model');

class Area extends AppModel{
    var $name = 'Area';
	
	var $primaryKey = 'area_id';
	
	var $displayField = 'area_descricao';
	
	var $validate = array(
		'area_descricao' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) 
		
	);
		
}

?>