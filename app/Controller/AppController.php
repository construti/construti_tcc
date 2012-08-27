<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    
    public $helpers = array('Html', 'Session'); 
	
	public $components = array(
        'Session', 
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'usuarios',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'pages',
				'action' => 'home'
			),
			'logoutRedirect'=>array(
				'controller'=>'usuarios', 
				'action'=>'login'
			),
			'authError' => "Você não tem permissão para visualizar isto.<br/><br/>",
			'authenticate' => array(
				'Form' => array (
					'userModel' => 'Usuario',
					'fields' => array(
						'username' => 'usuario_login',
						'password' => 'usuario_senha'
					),
					'scope' => array('Usuario.usuario_ativo' => 1)
				)
			)
		)
    );

    function beforeFilter() {
		Security::setHash('md5');
		$this->Auth->allow('login', 'view', 'home');
		
		/*
		// Carrega o model de clientes
		$this->loadModel('Usuario');

		// Cria um novo usuário
		$this->Usuario->create();
		$this->Usuario->save(array(
			'usuario_login' => 'eduserra',
			'usuario_senha' => $this->Auth->password('teste'),
			'usuario_ativo' => true
		));
		*/
		
    }
}
?>