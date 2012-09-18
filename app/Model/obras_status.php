<?php

App::uses('AppModel', 'Model');

class Obras_status extends AppModel{
    var $name = 'Obras_status';
	
	var $primaryKey = 'status_id';
	
	var $displayField = 'status_obra';
	
	var $useTable ='obras_status';
	
	var $validate = array(
		'status_obra' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);
}

?>