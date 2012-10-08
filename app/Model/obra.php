<?php
class Obra extends AppModel{
    var $name = 'Obra';
	
	var $primaryKey = 'obra_id';
	
	public $belongsTo = array(
        'Obras_status' => array(
            'className' => 'Obras_status',
            'foreignKey' => 'obra_status',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Funcionario' => array(
            'className' => 'Funcionario',
            'foreignKey' => 'obra_responsavel',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	var $validate = array(
		'obra_nome' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'obra_responsavel' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		),
		'obra_data_inicio' => array(
			'rule' => array('date','ymd'),
			'allowEmpty' => false,
			'message' => "Data inválida. Formato (dd/mm/aaaa)."
		) ,
		'obra_data_fim' => array(
			'rule' => array('date','ymd'),
			'allowEmpty' => false,
			'message' => "Data inválida. Formato (dd/mm/aaaa)."
		) ,
		'obra_status' => array(
			'rule' => 'notEmpty',
			'message' => "Preencha corretamente."
		) ,
		'obra_tipo' => array(
			'rule' => 'notEmpty', 
			'message' => "Preencha corretamente."
		)
		
	);
}
?>