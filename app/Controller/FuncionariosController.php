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
		$this->loadModel('Area');
		$areas = $this->Area->find('list', array('order' => array('area_id' => 'asc'), 'fields' => array('Area.area_id', 'Area.area_descricao')));
		
		$this->set(compact('areas'));
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
	
	public function popup_area() { //adiciona uma Área de funcionário
		$this->render('popup_area','popuplayout');
		
		if(!empty($this->data)){
			$this->loadModel('Area');
			if($this->Area->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
					$this->render('success','ajax');
                } 
                else{ 
                    $this->flash('Adicionada com sucesso!','popup_area');
                    $this->redirect(array('action' => 'popup_area'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}			
        }
	}
	
	public function search_area() { //pesquisar Áreas
		$this->loadModel('Area');
		
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
			$results = $this->Area->find('all', array('conditions' => array('Area.area_descricao LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function edit_area($id = null) { //atualizar uma Área
		$this->loadModel('Area');
		$this->Area->id = $id;
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Area->read();
		} else {
			if ($this->Area->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Área atualizada.','/funcionarios/search_area');
				    $this->redirect(array('action' => 'search_area'));
                }
			}  else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete_area($id) { //deletar uma Área
		$this->loadModel('Area');
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Area->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('A Área de ID '.$id.' foi deletada.','/funcionarios/search_area');
				$this->redirect(array('action' => 'search_area'));
			}
		}		
    }
	
	public function popup_tipo() { //adiciona um tipo de funcionário
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
                    $this->flash('Adicionado com sucesso!','popup_tipo');
                    $this->redirect(array('action' => 'popup_tipo'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}			
        }
	}
	
	public function search_tipo() { //pesquisar tipos
		$this->loadModel('Tipo');
		$this->loadModel('Area');
		$areas = $this->Area->find('list', array('order' => array('area_id' => 'asc'), 'fields' => array('Area.area_id', 'Area.area_descricao')));
		
		$this->set(compact('areas'));
		
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
			$tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'area_id'){
				$areaIds = $this->Area->find('list', array('conditions' => array('Area.area_descricao LIKE' => "%$pesquisa%"), 'fields' => array('Area.area_id')));
				$results = $this->Tipo->find('all', array('conditions' => array('Tipo.tipo_area_id' => $areaIds)));
			} else {
				$results = $this->Tipo->find('all', array('conditions' => array('Tipo.tipo_'.$tipo.' LIKE' => "%$pesquisa%")));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function edit_tipo($id = null) { //atualizar um tipo
		$this->loadModel('Tipo');
		$this->loadModel('Area');
		$areas = $this->Area->find('list', array('order' => array('area_id' => 'asc'), 'fields' => array('Area.area_id', 'Area.area_descricao')));
		
		$this->set(compact('areas'));
		$this->Tipo->id = $id;
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Tipo->read();
		} else {
			if ($this->Tipo->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Tipo atualizado.','/funcionarios/search_tipo');
				    $this->redirect(array('action' => 'search_tipo'));
                }
			}  else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete_tipo($id) { //deletar um tipo
		$this->loadModel('Tipo');
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Tipo->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Tipo de ID '.$id.' foi deletado.','/funcionarios/search_tipo');
				$this->redirect(array('action' => 'search_tipo'));
			}
		}		
    }	
	
	public function pega_tipo_area(){ //select dinâmico do tipo ao escolher a Área
		$this->loadModel('Area');
		$this->loadModel('Tipo');
		
		$f_area = $this->params['url']['funcionario_area'];
		$funcionario_area = $this->Area->find('first', array('conditions' => array('Area.area_id LIKE' => "%$f_area%")));
		$funcionario_area = $funcionario_area['Area']['area_id'];
		$funcionario_tipo = $this->Tipo->find('all', array('conditions' => array('Tipo.tipo_area_id LIKE' => "%$funcionario_area%")));
		$this->set('funcionario_tipo',$funcionario_tipo);
		$this->Render('pega_tipo_area','ajax');
	}
	
	public function pega_valor_tipo(){ //atualizar o campo de salário ao escolher o tipo
		$this->loadModel('Tipo');
		
		$f_area = $this->params['url']['funcionario_tipo'];
		$funcionario = $this->Tipo->find('first', array('conditions' => array('Tipo.tipo_funcionario LIKE' => "%$f_area%")));
		$funcionario = $funcionario['Tipo']['tipo_valor_hora'];
		$this->set('salario',$funcionario);
		$this->Render('pega_valor_tipo','ajax');
	}
	
}
?>