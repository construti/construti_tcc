<?php

App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
 
	public $name = 'Usuarios';
	
	public $helpers = array('Form', 'Js');
	
   public $components = array('RequestHandler'); 
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }
    
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect( $this->Auth->redirect() );
				
			} else {
				$this->Session->setFlash("Usuário ou senha incorreros.<br/><br/>", 'default', array(), 'auth');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	public function getUser($request) {
		$username = env('PHP_AUTH_USER');
		$pass = env('PHP_AUTH_PW');

		if (empty($username) || empty($pass)) {
			return false;
		}
		return $this->_findUser($username, $pass);
	}
	
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->layout = 'construtilayout';
		$this->render(implode('/', $path));
	} 
}
?>