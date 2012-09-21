<?php

class Embalagem extends AppModel{
    var $name = 'Embalagem';
	var $useTable = 'embalagens';
	var $primaryKey = 'embalagem_id';
	
	var $displayField = 'embalagem_tipo';
	
	/*public $belongsTo = array(
        'Material' => array(
            'className' => 'Material',
            'foreignKey' => 'material_embalagem',
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
		'embalagem_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);   

}

?>