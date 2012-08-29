<?php

App::uses('AppController', 'Controller');

class FornecedoresController extends AppController {
 
	public $name = 'Fornecedores';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	
	public $uses = array('Fornecedor'); //usa a Model Fornecedor
	    
    public function add() { //adiciona um Fornecedor
        if(!empty($this->data)){
            if($this->Fornecedor->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } 
                else{              
                    $this->flash('Adicionado com sucesso!','add');
                    $this->redirect(array('action' => 'add'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }  
    }
    
    public function validate_form() { //validação do formulário
       $this->layout = 'ajax';
        if($this->request->is('Ajax')){  
            $this->request->data['Fornecedor'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'fornecedor_nome' ) {
                if(empty($this->data['Fornecedor']['fornecedor_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
            
			if($this->request->data['field'] == 'fornecedor_estado' ) {
                if(empty($this->data['Fornecedor']['fornecedor_estado'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'fornecedor_cidade' ) {
                if(empty($this->data['Fornecedor']['fornecedor_cidade'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'fornecedor_bairro' ) {
                if(empty($this->data['Fornecedor']['fornecedor_bairro'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'fornecedor_endereco' ) {
                if(empty($this->data['Fornecedor']['fornecedor_endereco'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
            if($this->request->data['field'] == 'fornecedor_email' ) {
                if(empty($this->data['Fornecedor']['fornecedor_email'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }

			if($this->request->data['field'] == 'fornecedor_tipo' ) {
                if(empty($this->data['Fornecedor']['fornecedor_tipo'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar fornecedores
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Fornecedor->find('all', array('conditions' => array('Fornecedor.fornecedor_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um fornecedor
		$this->Fornecedor->id = $id;
        if ($this->request->is('get')) {
			$this->request->data = $this->Fornecedor->read();
		} else {
			if ($this->Fornecedor->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Fornecedor atualizado.','/fornecedores/search');
				    $this->redirect(array('action' => 'search'));
                }
			} else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um fornecedor
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Fornecedor->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Fornecedor de ID '.$id.' foi deletado.','/fornecedores/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
    
}
?>