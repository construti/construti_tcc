<?php

App::uses('AppController', 'Controller');

class TerrenosController extends AppController {
 
	public $name = 'Terrenos';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um terreno
        if(!empty($this->data)){
            if($this->Terreno->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } 
                else{              
                    $this->flash('Adicionado com sucesso!','add');
                    $this->Redirect(array('action' => 'add'));
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
            $this->request->data['Terreno'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'terreno_nome' ) {
                if(empty($this->data['Terreno']['terreno_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }

			if($this->request->data['field'] == 'terreno_endereco' ) {
                if(empty($this->data['Terreno']['terreno_endereco'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'terreno_tamanho' ) {
                if(empty($this->data['Terreno']['terreno_tamanho'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar terrenos
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Terreno->find('all', array('conditions' => array('Terreno.terreno_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um terreno
		$this->Terreno->id = $id;
        if ($this->request->is('get')) {
			$this->request->data = $this->Terreno->read();
		} else {
			if ($this->Terreno->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Terreno atualizado.','/terrenos/search');
				    $this->redirect(array('action' => 'search'));
                }
			} else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um terreno
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Terreno->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Terreno de ID '.$id.' foi deletado.','/terrenos/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
    
}
?>