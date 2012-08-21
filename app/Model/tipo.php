<?php

class Tipo extends AppModel{
    var $name = 'Tipo';
	
	var $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'area_id' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) 
	);
}

?>