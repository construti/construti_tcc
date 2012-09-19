<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class RequisicoesController extends AppController {
 
	public $name = 'Requisicoes';
	public $helpers = array('Form','Js');
	public $components = array('RequestHandler','Email'); 
	public $uses = array('Fornecedor', 'Material'); 
    
    public function validate_form() { //validação do formulário
       $this->layout = 'ajax';
        if($this->request->is('Ajax')){  
            $this->request->data['Requisicao'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'requisicao_nome' ) {
                if(empty($this->data['Requisicao']['requisicao_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
            
			if($this->request->data['field'] == 'requisicao_contato' ) {
                if(empty($this->data['Requisicao']['requisicao_contato'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
            if($this->request->data['field'] == 'requisicao_email' ) {
                if(empty($this->data['Requisicao']['requisicao_email'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
            $this->set('error', $error);      
        }
	}
	
	function reqmat() { //Enviar requisição de Materiais
		
		$materiais = $this->Material->find('all');
		
		pr($materiais);
		
		$fornecedores = $this->Fornecedor->find('list', array('fields' => array('fornecedor_nome'),'order' => array('fornecedor_nome' => 'asc'	)));
		
		$this->set(compact('fornecedores'));
		
		if(!empty($this->data)) {
			$this->Email = new CakeEmail('default');
			$arquivo = $this->request->data['Document']['submittedfile'];
			$sessao = $this->Session->read();
			$usuarioemail = $sessao['Auth']['User']['usuario_email'];
			$this->Email->from($usuarioemail);
			$this->Email->to($this->request->data['Requisicao']['requisicao_email']);
            $this->Email->subject('Requisição de Materiais');
            if ($arquivo['error'] != 4) {
				$this->Email->attachments(array(
					$arquivo['name'] => array(
						'file' => $arquivo['tmp_name'],
						'mimetype' => $arquivo['type']
					)
				));
			}
			if ($arquivo['error'] == 0 || $arquivo['error'] == 4) {
				$this->Email->send($this->data['Requisicao']['requisicao_mensagem']);             
				$this->Session->setFlash("Mensagem enviada com sucesso.<br/><br/>", 'default', array(), 'msg');
			} else {
				$this->Session->setFlash("Houve um problema com o arquivo anexado, sua mensagem não foi enviada.<br/><br/>", 'default', array(), 'msg');
			}
        }
	}
	
	function reqequip() { //Enviar requisição de Equipamentos
		$this->loadModel('Fornecedor');
		$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_email', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Fornecedor.fornecedor_tipo' => 'equipamento') ));
		
		$this->set(compact('fornecedores'));
	
		if(!empty($this->data)) {
			$this->Email = new CakeEmail('default');
			$arquivo = $this->request->data['Document']['submittedfile'];
			$sessao = $this->Session->read();
			$usuarioemail = $sessao['Auth']['User']['usuario_email'];
			$this->Email->from($usuarioemail);
			$this->Email->to($this->request->data['Requisicao']['requisicao_email']);
            $this->Email->subject('Requisição de Equipamentos');
            if ($arquivo['error'] != 4) {
				$this->Email->attachments(array(
					$arquivo['name'] => array(
						'file' => $arquivo['tmp_name'],
						'mimetype' => $arquivo['type']
					)
				));
			}			
			if ($arquivo['error'] == 0 || $arquivo['error'] == 4) {
				$this->Email->send($this->data['Requisicao']['requisicao_mensagem']);             
				$this->Session->setFlash("Mensagem enviada com sucesso.<br/><br/>", 'default', array(), 'msg');
			} else {
				$this->Session->setFlash("Houve um problema com o arquivo anexado, sua mensagem não foi enviada.<br/><br/>", 'default', array(), 'msg');
			}
        }
	}
    
	function reqcomp() { //Enviar requisição Completa
		$this->loadModel('Fornecedor');
		$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_email', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Fornecedor.fornecedor_tipo' => 'completo') ));
		
		$this->set(compact('fornecedores'));
		
		if(!empty($this->data)) {
			$this->Email = new CakeEmail('default');
			$arquivo = $this->request->data['Document']['submittedfile'];
			$sessao = $this->Session->read();
			$usuarioemail = $sessao['Auth']['User']['usuario_email'];
			$this->Email->from($usuarioemail);
			$this->Email->to($this->request->data['Requisicao']['requisicao_email']);
            $this->Email->subject('Requisição de Materiais e Equipamentos');
            if ($arquivo['error'] != 4) {
				$this->Email->attachments(array(
					$arquivo['name'] => array(
						'file' => $arquivo['tmp_name'],
						'mimetype' => $arquivo['type']
					)
				));
			}
			if ($arquivo['error'] == 0 || $arquivo['error'] == 4) {
				$this->Email->send($this->data['Requisicao']['requisicao_mensagem']);             
				$this->Session->setFlash("Mensagem enviada com sucesso.<br/><br/>", 'default', array(), 'msg');
			} else {
				$this->Session->setFlash("Houve um problema com o arquivo anexado, sua mensagem não foi enviada.<br/><br/>", 'default', array(), 'msg');
			}
        }
	}
}
?>