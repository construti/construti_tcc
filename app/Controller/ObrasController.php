<?php

App::uses('AppController', 'Controller');

class ObrasController extends AppController {
 
	public $name = 'Obras';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um obra
	
		$Funcionario = $this->loadModel('Funcionario');
		$responsavel = $this->Funcionario->find('list', array('fields' => array('funcionario_nome'),'order' => array('funcionario_nome' => 'asc'	)));
		
		 $this->set(compact('responsavel')); 
	
        if(!empty($this->data)){
            if($this->Obra->save($this->data)){
				$id_da_obra = $this->Obra->getLastInsertId(); 
				
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } 
                else{              
                    $this->flash('Adicionado com sucesso!','add');
                    $this->redirect(array('action' => 'add'));
                }
				// SE SALVAR A OBRA, DEVERÁ ENCAMINHAR O USUARIO PARA O CADASTRO DE PROJETO COM A OBRA ESPECÍFICA PARA GRAVAR UM PROJETO.
				$this->set('id_da_obra',$id_da_obra);
				$this->redirect(array('controller' => 'my_controller', 'action' => 'my_action')); apsjidpsd
				$this->render('/Projetos/add');
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }
    }
    
    public function validate_form() { //validação do formulário
       $this->layout = 'ajax';
        if($this->request->is('Ajax')){  
            $this->request->data['Obra'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'obra_nome' ) {
                if(empty($this->data['Obra']['obra_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'obra_responsavel' ) {
                if(empty($this->data['Obra']['obra_responsavel'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
							
			if($this->request->data['field'] == 'obra_data_inicio' ) {
                if(empty($this->data['Obra']['obra_data_inicio'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_data_fim' ) {
                if(empty($this->data['Obra']['obra_data_fim'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_status' ) {
                if(empty($this->data['Obra']['obra_status'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_tipo' ) {
                if(empty($this->data['Obra']['obra_tipo'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_estado' ) {
                if(empty($this->data['Obra']['obra_estado'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_cidade' ) {
                if(empty($this->data['Obra']['obra_cidade'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_bairro' ) {
                if(empty($this->data['Obra']['obra_bairro'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
			if($this->request->data['field'] == 'obra_endereco' ) {
                if(empty($this->data['Obra']['obra_endereco'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }  
			
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar obras
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um obra
		$this->Obra->id = $id;
		
		//$Terreno = $this->loadModel('Terreno');
		//$terrenos = $this->Terreno->find('list', array('order' => array('terreno_nome' => 'asc'	)));
		
		$Projeto = $this->loadModel('Projeto');
		$projetos = $this->Projeto->find('list', array('order' => array('projeto_nome' => 'asc'	)));
		
		$this->set(compact('terrenos','projetos'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Obra->read();
		} else {
			if ($this->Obra->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Obra atualizada.','/obras/search');
				    $this->redirect(array('action' => 'search'));
                }
			} else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um obra
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Obra->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Obra de ID '.$id.' foi deletado.','/obras/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
    
}
?>