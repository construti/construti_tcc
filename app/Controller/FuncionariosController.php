<?php

App::uses('AppController', 'Controller');

class FuncionariosController extends AppController {
 
	public $name = 'Funcionarios';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	
	/*function beforeFilter() {
        $this->loadModel('Area');
        $this->loadModel('Tipo');
    }*/
	    
    public function add() { //adiciona um funcionário
		$this->loadModel('Area');
		$areas = $this->Area->find('list', array('order' => array('area_id' => 'asc'), 'fields' => array('Area.area_id', 'Area.area_descricao')));
		
		$this->set(compact('areas'));
	
		
        if(!empty($this->data)){
			
			if($this->Funcionario->save($this->data)){
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
            $this->request->data['Funcionario'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'funcionario_nome' ) {
                if(empty($this->data['Funcionario']['funcionario_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
              
            if($this->request->data['field'] == 'funcionario_cpf' ) {
                $error = 'CPF inválido!';
            }
			
			if($this->request->data['field'] == 'funcionario_data_nasc' ) {
                if(empty($this->data['Funcionario']['funcionario_data_nasc'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_endereco' ) {
                if(empty($this->data['Funcionario']['funcionario_endereco'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_bairro' ) {
                if(empty($this->data['Funcionario']['funcionario_bairro'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_cidade' ) {
                if(empty($this->data['Funcionario']['funcionario_cidade'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_estado' ) {
                if(empty($this->data['Funcionario']['funcionario_estado'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_pais' ) {
                if(empty($this->data['Funcionario']['funcionario_pais'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
              
            if($this->request->data['field'] == 'funcionario_email' ) {
                if(empty($this->data['Funcionario']['funcionario_email'])) {
                    $error = 'não esqueça de colocar o email!';
                }
            }
			
			if($this->request->data['field'] == 'funcionario_salario' ) {
                if(empty($this->data['Funcionario']['funcionario_salario'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
            $this->set('error', $error);      
        }
   } 
    
	public function search() { //pesquisar funcionários
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Funcionario->find('all', array('conditions' => array('Funcionario.funcionario_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um funcionário
		$this->Funcionario->id = $id;
        if ($this->request->is('get')) {
			$this->request->data = $this->Funcionario->read();
		} else {
			if ($this->Funcionario->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Funcionário atualizado.','/funcionarios/search');
				    $this->redirect(array('action' => 'search'));
                }
			}  else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete($id) { //deletar um funcionário
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Funcionario->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Funcionário de ID '.$id.' foi deletado.','/funcionarios/search');
				$this->redirect(array('action' => 'search'));
			}
		}		
    }
	
	public function popup_area() {
		$this->render('popup_area','popuplayout');
		
		if(!empty($this->data)){
			$this->loadModel('Area');
			if($this->Area->save($this->data)){
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
	
	public function popup_tipo() {
		$this->loadModel('Area');
		$areas = $this->Area->find('list', array('order' => array('area_id' => 'asc'), 'fields' => array('Area.area_id', 'Area.area_descricao')));
		
		$this->set(compact('areas'));
		$this->render('popup_tipo','popuplayout');
		
		if(!empty($this->data)){
			$this->loadModel('Tipo');
			if($this->Tipo->save($this->data)){
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
	
	public function pega_tipo_area(){
		$Area = $this->loadModel('Area');
		$Tipo = $this->loadModel('Tipo');
		
		$f_area = $this->params['url']['funcionario_area'];
		$funcionario_area = $this->Area->find('first', array('conditions' => array('Area.area_id LIKE' => "%$f_area%")));
		$funcionario_area = $funcionario_area['Area']['area_id'];
		$funcionario_tipo = $this->Tipo->find('all', array('conditions' => array('Tipo.tipo_area_id LIKE' => "%$funcionario_area%")));
		//print_r($funcionario_tipo);
		$this->set('funcionario_tipo',$funcionario_tipo);
		$this->Render('pega_tipo_area','ajax');
	}
}
?>