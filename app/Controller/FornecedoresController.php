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
    
    public function relequipamentos() { //relacionar equipamentos à um Fornecedor
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
	
	public function pega_fornecedores_mat_equip(){ //atualizar o campo de salário ao escolher o tipo
		
		$matID = $this->params['url']['material_id'];
		
		$this->loadModel('Fornecedor_materiais');
		$fornecedores = $this->Fornecedor_materiais->find('all', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome'), 'conditions' => array('Material.material_id' => $matID)));
		
		$this->set('fornecedores',$fornecedores);
		$this->Render('pega_fornecedores_mat_equip','ajax');
	}
	
	public function orcamento() { //requisitar Orçamento à Fornecedor(es)
		$this->loadModel('Fornecedor');
		$this->loadModel('Material');
		$this->loadModel('Equipamento');
		
		$materiais = $this->Material->query("SELECT Material.material_id,(CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.materiais AS Material LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) ORDER BY material_nome asc"); // WHERE Material.material_id =$matID");
		
		$materiais_array = array();	
		foreach($materiais as $m):
			$materiais_array[$m['Material']['material_id']] = $m['Material']['descricao'];
		endforeach;
			
		//pr($materiais_array);
			
		//$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome')));
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
	
	public function searchorcmat() { //pesquisar orçamentos de materiais
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Orcamento_materiais');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.fornecedor_id' => $fornIds), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id') ));
			} else {
				$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atprecosmat($id = null) { //atualizar preços de orçamentos e materiais
		$this->loadModel('Orcamento_materiais');
		//$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.orcamento_id LIKE' => $id)));
		$results = $this->Orcamento_materiais->query("SELECT Orcamento_materiais.orcamentos_materiais_id, Orcamento_materiais.orcamento_id, Orcamento_materiais.fornecedor_id, Orcamento_materiais.material_id, Orcamento_materiais.quantidade, Orcamento_materiais.material_preco, Orcamento_materiais.created, Orcamento_materiais.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.orcamentos_materiais AS Orcamento_materiais LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Orcamento_materiais.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Orcamento_materiais.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Orcamento_materiais.orcamento_id LIKE 1");
		
		$orcamento = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Orcamento_materiais->read();
		} else {
			$contar = count($this->data)-1;
			for($i = 0; $i < $contar; $i++) {
				if($this->data['Orcamento_materiais']['material_preco'.$i] != ''){
					$this->Orcamento_materiais->id = $orcamento[$i]['Orcamento_materiais']['orcamentos_materiais_id'];
					$materialPrecoAtual = $this->data['Orcamento_materiais']['material_preco'.$i];
					
					$this->Orcamento_materiais->set(array(
						'material_preco' => $materialPrecoAtual
					));
					
					if($this->Orcamento_materiais->save()) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','atprecosmat');
		                    $this->redirect(array('action' => 'atprecosmat'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
					
					$this->loadModel('Material');
					$materialid = $orcamento[$i]['Orcamento_materiais']['material_id'];
					$this->Material->id = $materialid;
					$materialUltimoPreco = $this->Material->find('first', array('conditions' => array('Material.material_id LIKE' => $materialid)));
					$materialUltimoPreco = $materialUltimoPreco['Material']['material_ultimo_preco'];
					
					if (($materialPrecoAtual < $materialUltimoPreco) || ($materialUltimoPreco == 0)){
						$this->Material->set(array(
							'material_ultimo_preco' => $materialPrecoAtual
						));
						
						if($this->Material->save($this->data)) {
							if($this->request->is('Ajax')){    // o ajax roda aqui
			                    $this->set('dados',$this->request->data);
			                    $this->render('success','ajax');
			                } 
			                else{              
			                    $this->flash('Atualizado com sucesso!','atprecosmat');
			                    $this->redirect(array('action' => 'atprecosmat'));
			                }
						} else {
							echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
			                $this->render('delete','ajax');
						}
					}
				} else {
					echo "<center> O valor do campo de preço da ".($i+1)."ª linha está vazio, portanto não foi atualizado. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
    }
	
	public function searchorcequip() { //pesquisar orçamentos de equipamentos
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Orcamento_equipamentos');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.fornecedor_id' => $fornIds), 'group' => array('orcamento_id', 'Orcamento_equipamentos.fornecedor_id') ));
			} else {
				$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('orcamento_id', 'Orcamento_equipamentos.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atprecosequip($id = null) { //atualizar preços de orçamentos e equipamentos
		$this->loadModel('Orcamento_equipamentos');
		$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.orcamento_id LIKE' => $id)));
		$orcamento = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Orcamento_equipamentos->read();
		} else {
			$contar = count($this->data)-1;
			for($i = 0; $i < $contar; $i++) {
				if($this->data['Orcamento_equipamentos']['equipamento_preco'.$i] != ''){
					$this->Orcamento_equipamentos->id = $orcamento[$i]['Orcamento_equipamentos']['orcamentos_equipamentos_id'];
					$equipPrecoAtual = $this->data['Orcamento_equipamentos']['equipamento_preco'.$i];
					
					$this->Orcamento_equipamentos->set(array(
						'equipamento_preco' => $equipPrecoAtual
					));
					
					if($this->Orcamento_equipamentos->save()) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','atprecosequip');
		                    $this->redirect(array('action' => 'atprecosequip'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
					
					$this->loadModel('Equipamento');
					$equipid = $orcamento[$i]['Orcamento_equipamentos']['equipamento_id'];
					$this->Equipamento->id = $equipid;
					$equipUltimoPreco = $this->Equipamento->find('first', array('conditions' => array('Equipamento.equipamento_id LIKE' => $equipid)));
					$equipUltimoPreco = $equipUltimoPreco['Equipamento']['equipamento_valor_hora'];
					
					if (($equipPrecoAtual < $equipUltimoPreco) || ($equipUltimoPreco == 0)){
						$this->Equipamento->set(array(
							'equipamento_valor_hora' => $equipPrecoAtual
						));
						
						if($this->Equipamento->save($this->data)) {
							if($this->request->is('Ajax')){    // o ajax roda aqui
			                    $this->set('dados',$this->request->data);
			                    $this->render('success','ajax');
			                } 
			                else{              
			                    $this->flash('Atualizado com sucesso!','atprecosequip');
			                    $this->redirect(array('action' => 'atprecosequip'));
			                }
						} else {
							echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
			                $this->render('delete','ajax');
						}
					}
				} else {
					echo "<center> O valor do campo de preço da ".($i+1)."ª linha está vazio, portanto não foi atualizado. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
    }
	
	public function estoque() { //checar estoque
		if (!empty($this->data['pesquisa']) || $this->data['tipo'] == 'completo'){
			$this->loadModel('Estoque_materiais');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
									
			if ($tipo == 'material_id') {
				$this->loadModel('Material');
				$matIds = $this->Material->find('list', array('conditions' => array('Material.material_nome LIKE' => "%$pesquisa%"), 'fields' => array('Material.material_id')));
				$results = $this->Estoque_materiais->find('all', array('conditions' => array('Estoque_materiais.material_id' => $matIds)));
			} else {
				$results = $this->Estoque_materiais->find('all');
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atestoque() {
		$contar = count($this->data)-1;
		pr($contar);
		for($i = 0; $i < $contar; $i++) {
			/*if($this->data['Orcamento_equipamentos']['equipamento_preco'.$i] != ''){
				$this->Orcamento_equipamentos->id = $orcamento[$i]['Orcamento_equipamentos']['orcamentos_equipamentos_id'];
				$equipPrecoAtual = $this->data['Orcamento_equipamentos']['equipamento_preco'.$i];
				
				$this->Orcamento_equipamentos->set(array(
					'equipamento_preco' => $equipPrecoAtual
				));
				
				if($this->Orcamento_equipamentos->save()) {
					if($this->request->is('Ajax')){    // o ajax roda aqui
	                    $this->set('dados',$this->request->data);
	                    $this->render('success','ajax');
	                } 
	                else{              
	                    $this->flash('Atualizado com sucesso!','atprecosequip');
	                    $this->redirect(array('action' => 'atprecosequip'));
	                }
				} else {
					echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
	                $this->render('delete','ajax');
				}
				
				$this->loadModel('Equipamento');
				$equipid = $orcamento[$i]['Orcamento_equipamentos']['equipamento_id'];
				$this->Equipamento->id = $equipid;
				$equipUltimoPreco = $this->Equipamento->find('first', array('conditions' => array('Equipamento.equipamento_id LIKE' => $equipid)));
				$equipUltimoPreco = $equipUltimoPreco['Equipamento']['equipamento_valor_hora'];
				
				if (($equipPrecoAtual < $equipUltimoPreco) || ($equipUltimoPreco == 0)){
					$this->Equipamento->set(array(
						'equipamento_valor_hora' => $equipPrecoAtual
					));
					
					if($this->Equipamento->save($this->data)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','atprecosequip');
		                    $this->redirect(array('action' => 'atprecosequip'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
				}
			} else {
				echo "<center> O valor do campo de preço da ".($i+1)."ª linha está vazio, portanto não foi atualizado. </center><br />";
				$this->render('delete','ajax');
			}*/
		}
		$this->render('delete','ajax');
	}
}
?>