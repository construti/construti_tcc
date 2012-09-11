<?php

class Embalagem extends AppModel{
    var $name = 'Embalagem';
	var $useTable = 'embalagens';
	var $primaryKey = 'embalagem_id';
	
	var $displayField = 'embalagem_tipo';
    
       var $validate = array(
		/*'embalagem_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),*/
		'embalagem_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);   

}

?>