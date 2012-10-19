<?php

App::uses('AppModel', 'Model');

class Previsao_equipamento extends AppModel{
    var $name = 'Previsao_equipamento';
	
	var $useTable = 'previsoes_equipamentos';
	
	var $primaryKey = 'previsoes_equipamentos_id';
	
	public $belongsTo = array(
        'Equipamentos_tipo' => array(
            'className' => 'Equipamentos_tipo',
            'foreignKey' => 'tipo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'obra_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'tipo_id' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'valor_hora' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		),
		'qtd_horas' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => "Somente numeros."
		)		
	);
}

?>