<?php

class Projeto extends AppModel{
    var $name = 'Projeto';
	
	var $primaryKey = 'projeto_id';
	
	var $displayField = 'projeto_nome';
    
       var $validate = array(
		'projeto_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		),
		'projeto_descricao' => array(
			'rule' => 'notEmpty',
			'message' => "Este campo não pode ser vazio"
		)
	);   

}

?>