<?php

App::uses('AppController', 'Controller');

class RelatoriosController extends AppController {
 
	public $name = 'Relatorios';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um relatório
        if(!empty($this->data)){
            if($this->Relatorio->save($this->data)){
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
        if($this->request->is('Ajax')){  
            $this->request->data['Relatorio'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'relatorios_nome' ) {
                if(empty($this->data['Relatorio']['relatorios_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
              
            if($this->request->data['field'] == 'relatorios_cpf' ) {
                $error = 'CPF inválido!';
            }
              
            if($this->request->data['field'] == 'relatorios_email' ) {
                if(empty($this->data['Relatorio']['relatorios_email'])) {
                    $error = 'não esqueça de colocar o email!';
                }
            }
			
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar relatórios
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Relatorio->find('all', array('conditions' => array('Relatorio.relatorios_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um relatório
		$this->Relatorio->id = $id;
        if ($this->request->is('get')) {
			$this->request->data = $this->Relatorio->read();
		} else {
			if ($this->Relatorio->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Relatório atualizado.','/relatorios/search');
				    $this->redirect(array('action' => 'search'));
                }
			} else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um relatório
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Relatorio->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Relatório de ID '.$id.' foi deletado.','/relatorios/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
    
}
?>