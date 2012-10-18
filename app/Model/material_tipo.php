<?php

class Material_tipo extends AppModel{
    var $name = 'Material_tipo';
	
	var $useTable = 'materiais_tipos';
	
	var $primaryKey = 'material_tipo_id';
	
	var $displayField = 'material_tipo_nome';
    
       var $validate = array(
		/*'embalagem_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),*/
		'material_tipo_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);   

}

?>