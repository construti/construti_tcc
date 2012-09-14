<?php

class Equipamento extends AppModel{
    var $name = 'Equipamento';
    
    var $primaryKey = 'equipamento_id';
	
	public $belongsTo = array(
        'Equipamentos_tipo' => array(
            'className' => 'Equipamentos_tipo',
            'foreignKey' => 'equipamento_tipo',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'equipamento_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'equipamento_tipo' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		),
		'equipamento_valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => "Somente numeros."
		)
		
	);
}

?>