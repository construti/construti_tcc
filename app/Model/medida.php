<?php

class Medida extends AppModel{
    var $name = 'Medida';
	var $useTable = 'medidas';
	var $primaryKey = 'medida_id';
	
	var $displayField = 'medida_tipo';
	
	/*public $belongsTo = array(
        'Material' => array(
            'className' => 'Material',
            'foreignKey' => 'material_medida',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );*/
    
       var $validate = array(
		/*'embalagem_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),*/
		'medida_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);   

}

?>