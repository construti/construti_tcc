<?php

App::uses('AppController', 'Controller');

class EquipamentosController extends AppController {
 
	public $name = 'Equipamentos';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um equipamento
		$this->loadModel('Equipamentos_tipo');
		$tipos = $this->Equipamentos_tipo->find('list', array('order' => array('tipo_equipamento' => 'asc'), 'fields' => array('Equipamentos_tipo.tipo_id', 'Equipamentos_tipo.tipo_equipamento')));
		
		$this->set(compact('tipos'));
	
        if(!empty($this->data)){
            if($this->Equipamento->save($this->data)){
				$this->loadModel('Estoque_equipamentos');
				$this->Estoque_equipamentos->set(array( 
						'equipamento_id' => $this->Equipamento->id
					));
					
				if($this->Estoque_equipamentos->save()) { //atualizar tabela de estoque de Equipamentos com ID do novo Equipamento
					if($this->request->is('Ajax')){    // o ajax roda aqui
						echo "<center> ID do Equipamento adicionado ao estoque! </center>";
						$this->render('delete','ajax');
	                } 
	                else{              
	                    $this->flash('ID do Equipamento adicionado ao estoque!','add');
	                }
				} else {
					echo "<center> ID do Equipamento não foi adicionado ao estoque! </center>";
	                $this->render('delete','ajax');
				}
			
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
            $this->request->data['Equipamento'][$this->request->data['field']] = $this->request->data['value'];  
            $error = '';
            if($this->request->data['field'] == 'equipamento_nome' ) {
                if(empty($this->data['Equipamento']['equipamento_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'equipamento_alugado' ) {
                if(empty($this->data['Equipamento']['equipamento_alugado'])) {
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
			
			if ($tipo == 'tipo'){
				$this->loadModel('Equipamentos_tipo');
				$tipoIds = $this->Equipamentos_tipo->find('list', array('conditions' => array('Equipamentos_tipo.tipo_equipamento LIKE' => "%$pesquisa%"), 'fields' => array('Equipamentos_tipo.tipo_id')));
				
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_tipo' => $tipoIds)));
			} elseif ($tipo == 'valor_hora') {
				$this->loadModel('Equipamentos_tipo');
				$tipoIds = $this->Equipamentos_tipo->find('list', array('conditions' => array('Equipamentos_tipo.tipo_valor_hora LIKE' => "$pesquisa"), 'fields' => array('Equipamentos_tipo.tipo_id')));
				
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_tipo' => $tipoIds)));
			} else {
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_'.$tipo.' LIKE' => "%$pesquisa%")));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null, $valor = null) { //atualizar um equipamento
		$this->loadModel('Equipamentos_tipo');
		$tipos = $this->Equipamentos_tipo->find('list', array('order' => array('tipo_equipamento' => 'asc'), 'fields' => array('Equipamentos_tipo.tipo_id', 'Equipamentos_tipo.tipo_equipamento')));
		
		$this->set(compact('tipos'));
		$this->Equipamento->id = $id;
		
		$this->set('valorAt', $valor);
		
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
	
	public function popup_tipo() { //adiciona um tipo de equipamento
		$this->render('popup_tipo','popuplayout');
		
		if(!empty($this->data)){
			$this->loadModel('Equipamentos_tipo');
			if($this->Equipamentos_tipo->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
					$this->render('success','ajax');
                } 
                else{ 
                    $this->flash('Adicionado com sucesso!','add');
                    $this->redirect(array('action' => 'add'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatÃ³rios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}			
        }
	}
	
	public function search_tipo() { //pesquisar Ã¡reas
		$this->loadModel('Equipamentos_tipo');
		
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Equipamentos_tipo->find('all', array('conditions' => array('Equipamentos_tipo.tipo_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function edit_tipo($id = null) { //atualizar um tipo de equipamento
		$this->loadModel('Equipamentos_tipo');
		$this->Equipamentos_tipo->id = $id;
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Equipamentos_tipo->read();
		} else {
			if ($this->Equipamentos_tipo->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Tipo atualizado.','/equipamentos/search_tipo');
				    $this->redirect(array('action' => 'search_tipo'));
                }
			}  else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatÃ³rios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete_tipo($id) { //deletar um tipo de equipamento
		$this->loadModel('Equipamentos_tipo');
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Equipamentos_tipo->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Tipo de ID '.$id.' foi deletado.','/equipamentos/search_tipo');
				$this->redirect(array('action' => 'search_tipo'));
			}
		}		
    }
	
	public function pega_valor_tipo(){ //atualizar o campo de salÃ¡rio ao escolher o tipo
		$this->loadModel('Equipamentos_tipo');
		
		$f_area = $this->params['url']['equipamento_tipo'];
		$equip = $this->Equipamentos_tipo->find('first', array('conditions' => array('Equipamentos_tipo.tipo_id' => "$f_area")));
		$equip = $equip['Equipamentos_tipo']['tipo_valor_hora'];
		$this->set('valor',$equip);
		$this->Render('pega_valor_tipo','ajax');
	}
    
}
?>