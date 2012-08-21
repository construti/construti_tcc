<?php

class Area extends AppModel{
    var $name = 'Area';
	
	var $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) 		
	);
}

?>