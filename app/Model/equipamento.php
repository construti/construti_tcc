<?php

class Equipamento extends AppModel{
    var $name = 'Equipamento';
    
    var $primaryKey = 'equipamento_id';
	
	var $validate = array(
		'equipamento_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'equipamento_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		)
		
	);
}

?>