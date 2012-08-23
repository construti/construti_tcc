<?php

App::uses('AuthComponent', 'Controller/Component');

class Usuario extends AppModel{

    var $name = 'Usuario';
	
	var $primaryKey = 'usuario_id';
    
    public $validate = array(
		'usuario_login' => array(
            'rule' => 'notEmpty',
            'message' => 'Usuário obrigatório!',
            'required' => true
        ),
        'usuario_senha' => array(
            'rule' => 'notEmpty',
            'message' => 'Senha obrigatória!',
			'required' => true
        )        
    );
	
	public function beforeSave($options = array()) {
        $this->data['Usuario']['usuario_senha'] = AuthComponent::password($this->data['Usuario']['usuario_senha']);
        return true;
    }

}
?>