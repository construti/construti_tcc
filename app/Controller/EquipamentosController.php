<?php

App::uses('AppController', 'Controller');

class EquipamentosController extends AppController {
 
	public $name = 'Equipamentos';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um equipamento
        if(!empty($this->data)){
            if($this->Equipamento->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } 
                else{              
                    $this->flash('Adicionado com sucesso!','add');
                    //$this->Redirect(array('action' => 'add'));
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
            $this->request->data['Equipamento'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'equipamento_nome' ) {
                if(empty($this->data['Equipamento']['equipamento_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }

			if($this->request->data['field'] == 'equipamento_tipo' ) {
                if(empty($this->data['Equipamento']['equipamento_tipo'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar equipamentos
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um equipamento
		$this->Equipamento->id = $id;
        if ($this->request->is('get')) {
			$this->request->data = $this->Equipamento->read();
		} else {
			if ($this->Equipamento->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Equipamento atualizado.','/equipamentos/search');
				    $this->redirect(array('action' => 'search'));
                }
			} else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um equipamento
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Equipamento->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Equipamento de ID '.$id.' foi deletado.','/equipamentos/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
    
}
?>