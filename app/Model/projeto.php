<?php

class Projeto extends AppModel{
    var $name = 'Projeto';
	
	var $primaryKey = 'projeto_id';
	
	var $displayField = 'projeto_nome';
    
       var $validate = array(
		/*'projeto_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),*/
		'obra_id' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'projeto_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'projeto_custo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'projeto_arquivo' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
		
	);   

}

?>