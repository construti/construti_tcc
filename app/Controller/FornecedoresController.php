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
   /////////////////////////////////////////////////////////////////////////  
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
   /////////////////////////////////////////////////////////////////////////  
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
	///////////////////////////////////////////////////////////////////////// 
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
	///////////////////////////////////////////////////////////////////////// 
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
	///////////////////////////////////////////////////////////////////////// 
	public function relmateriais() { //relacionar materiais à um Fornecedor
		$this->loadModel('Material');
		
		$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome')));
		$materiais = $this->Material->find('list', array('order' => array('material_nome' => 'asc'), 'fields' => array('Material.material_id', 'Material.material_nome')));
		
		$this->set(compact('fornecedores'));
		$this->set(compact('materiais'));
	
        if(!empty($this->data)){
			$this->loadModel('Fornecedor_materiais');
			if( ($this->data['Fornecedor_materiais']['fornecedor_id'] == '') || ($this->data['Fornecedor_materiais']['material_id'] == '') ) {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
	            $this->render('delete','ajax');
			} else {
				$contar = count($this->data['Fornecedor_materiais']['material_id']);
				for($i = 0; $i < $contar; $i++) {
					if($this->data['Fornecedor_materiais']['material_id'][$i]!=''){
						$this->Fornecedor_materiais->set(array(
							'fornecedor_id' => $this->data['Fornecedor_materiais']['fornecedor_id'],
							'material_id' => $this->data['Fornecedor_materiais']['material_id'][$i]
						));
						
						if($this->Fornecedor_materiais->saveAll()) {
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
			}
        }  
    }
   ///////////////////////////////////////////////////////////////////////// 
    public function relequipamentos() { //relacionar materiais à um Fornecedor
		$this->loadModel('Equipamento');
		
		$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome')));
		$equipamentos = $this->Equipamento->find('list', array('order' => array('equipamento_nome' => 'asc'), 'fields' => array('Equipamento.equipamento_id', 'Equipamento.equipamento_nome')));
		
		$this->set(compact('fornecedores'));
		$this->set(compact('equipamentos'));
	
        if(!empty($this->data)){
			$this->loadModel('Fornecedor_equipamentos');
			if( ($this->data['Fornecedor_equipamentos']['fornecedor_id'] == '') || ($this->data['Fornecedor_equipamentos']['equipamento_id'] == '') ) {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
	            $this->render('delete','ajax');
			} else {
				$contar = count($this->data['Fornecedor_equipamentos']['equipamento_id']);
				for($i = 0; $i < $contar; $i++) {
					$this->Fornecedor_equipamentos->set(array(
						'fornecedor_id' => $this->data['Fornecedor_equipamentos']['fornecedor_id'],
						'equipamento_id' => $this->data['Fornecedor_equipamentos']['equipamento_id'][$i]
					));
					
					if($this->Fornecedor_equipamentos->saveAll()) {
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
        }  
    }
	
/////////////////////////////////////////////////////////////////////////////	
	public function pega_fornecedores_mat_equip(){ //atualizar o campo de salário ao escolher o tipo
		
		$matID = $this->params['url']['material_id'];
		$equipID = $this->params['url']['equipamento_id'];
		
		$fornecedores='';
		
		if($matID!='-1' && $equipID!='-1'){ // se equipamentos E materiais, pega o fornecedor de cada e faz a intersceção do ID
			
			$this->loadModel('Fornecedor_materiais');
			$fornecedoresM = $this->Fornecedor_materiais->find('all', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Material.material_id' => $matID)));
			//pr($fornecedoresM);
			
			$this->loadModel('Fornecedor_equipamentos');
			$fornecedoresE = $this->Fornecedor_equipamentos->find('all', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Equipamento.equipamento_id' => $equipID)));
			//pr($fornecedoresE);
			
			$i=0;
			foreach($fornecedoresM as $M):
				foreach($fornecedoresE as $E):
					if($M['Fornecedor']['fornecedor_id']==$E['Fornecedor']['fornecedor_id']){
						$fornecedores[$i]['Fornecedor']['fornecedor_id']=$M['Fornecedor']['fornecedor_id'];
						$fornecedores[$i]['Fornecedor']['fornecedor_nome']=$M['Fornecedor']['fornecedor_nome'];
						$i++;
					}
				endforeach;
			endforeach;
		}
		else if($equipID!='-1'){// se for somente equipamento válido, carrega o fornecedor pra ele
			$this->loadModel('Fornecedor_equipamentos');
			$fornecedores = $this->Fornecedor_equipamentos->find('all', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Equipamento.equipamento_id' => $equipID)));
		}
		else if($matID!='-1'){
			$this->loadModel('Fornecedor_materiais');
			$fornecedores = $this->Fornecedor_materiais->find('all', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Material.material_id' => $matID)));
		}
		
		$this->set('fornecedores',$fornecedores);
		$this->Render('pega_fornecedores_mat_equip','ajax');
	}
	
//////////////////////////////////////////////////////////////////////		
	public function orcamento() { //requisitar Orçamento à Fornecedor(es)
		$this->loadModel('Fornecedor');
		$this->loadModel('Material');
		$this->loadModel('Equipamento');
		
		$materiais = $this->Material->query("SELECT Material.material_id,(CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.materiais AS Material LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) ORDER BY material_nome asc"); // WHERE Material.material_id =$matID");
		
		$materiais_array = array();	
		foreach($materiais as $m):
			$materiais_array[$m['Material']['material_id']] = $m['Material']['descricao'];
		endforeach;
			
		$equipamentos = $this->Equipamento->find('list', array('order' => array('equipamento_nome' => 'asc'), 'fields' => array('Equipamento.equipamento_id', 'Equipamento.equipamento_nome')));
		
		//$this->set(compact('fornecedores'));
		$this->set(compact('equipamentos'));
		$this->set(compact('materiais_array'));
	
        if(!empty($this->datao)){
			$this->loadModel('Fornecedor_equipamentos');
			if( ($this->data['Fornecedor_equipamentos']['fornecedor_id'] == '') || ($this->data['Fornecedor_equipamentos']['equipamento_id'] == '') ) {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
	            $this->render('delete','ajax');
			} else {
				$contar = count($this->data['Fornecedor_equipamentos']['equipamento_id']);
				for($i = 0; $i < $contar; $i++) {
					$this->Fornecedor_equipamentos->set(array(
						'fornecedor_id' => $this->data['Fornecedor_equipamentos']['fornecedor_id'],
						'equipamento_id' => $this->data['Fornecedor_equipamentos']['equipamento_id'][$i]
					));
					
					if($this->Fornecedor_equipamentos->saveAll()) {
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
        }  
    }
	
	public function searchorcmat() { //pesquisar fornecedores
		if (!empty($this->data['pesquisa'])){
			$this->loadModel(Orcamento_materiais);
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atprecosmat($id = null) { //atualizar um fornecedor
		$this->Material->id = $id;
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
}
?>