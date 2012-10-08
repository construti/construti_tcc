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
	
	public function searchrelmateriais() { //pesquisar fornecedores
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Fornecedor->find('all', array('conditions' => array('Fornecedor.fornecedor_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function relmateriais($id = null) { //relacionar materiais à um Fornecedor
		$this->Fornecedor->id = $id;
		
		$forn = $this->Fornecedor->find('first', array('conditions' => array('Fornecedor.fornecedor_id' => $id)));
		$fornecedor = $forn['Fornecedor']['fornecedor_nome'];
		$this->set('fornecedor', $fornecedor);
		$this->set('fornecedorId', $id);
				
		//$fornecedores = $this->Fornecedor->find('list', array('order' => array('fornecedor_nome' => 'asc'), 'fields' => array('Fornecedor.fornecedor_id', 'Fornecedor.fornecedor_nome')));
		
		//$this->loadModel('Material');
		//$materiais = $this->Material->find('list', array('order' => array('material_nome' => 'asc'), 'fields' => array('Material.material_id', 'Material.material_nome')));
		
		//$this->set(compact('fornecedores'));
		//$this->set(compact('materiais'));
		
		$this->loadModel('Fornecedor_materiais');
		if ($this->request->is('get')) {
			$this->request->data = $this->Fornecedor_materiais->read();
		} else {
	        if(!empty($this->data)){
				if( ($this->data['Fornecedor_materiais']['materiais'] == '') ) {
					$materiaissel = $this->data['Fornecedor_materiais']['materiais'];
					$this->loadModel('Material');
					$compforn = $this->Material->find('list', array('conditions' => array("NOT" => array('Material.material_id' => $materiaissel) ), 'fields' => array('Material.material_id')));
					
					$this->loadModel('Fornecedor_materiais');
					if ($this->Fornecedor_materiais->deleteAll(array('Fornecedor_materiais.fornecedor_id' => $id, 'Fornecedor_materiais.material_id' => $compforn), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Não há mais materiais relacionados ao fornecedor em questão!','/fornecedores/relmateriais');
							$this->redirect(array('action' => 'relmateriais'));
						}
						echo "<center>Não há mais materiais relacionados ao fornecedor em questão!</center>";
					}
				} else {
					$contar = count($this->data['Fornecedor_materiais']['materiais']);
					for($i = 0; $i < $contar; $i++) {
						$esteMaterial = $this->data['Fornecedor_materiais']['materiais'][$i];
						if($esteMaterial != ''){
							$this->loadModel('Fornecedor_materiais');
							$compforn = $this->Fornecedor_materiais->find('count', array('conditions' => array('Fornecedor_materiais.fornecedor_id' => $id, 'Fornecedor_materiais.material_id' => $esteMaterial)));
							if($compforn == 0){
								$this->loadModel('Fornecedor_materiais');
								$this->Fornecedor_materiais->set(array(
									'fornecedor_id' => $this->data['Fornecedor_materiais']['fid'],
									'material_id' => $esteMaterial
								));
								
								if($this->Fornecedor_materiais->saveAll()) {
									if($this->request->is('Ajax')){    // o ajax roda aqui
					                    $this->set('dados',$this->request->data);
					                    $this->render('success','ajax');
					                } 
					                else{              
					                    $this->flash('Adicionado com sucesso!','relmateriais');
					                    $this->redirect(array('action' => 'relmateriais'));
					                }
								} else {
									echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
					                $this->render('delete','ajax');
								}
							}
							
							
						}
					}
					$materiaissel = $this->data['Fornecedor_materiais']['materiais'];
					$this->loadModel('Material');
					$compforn = $this->Material->find('list', array('conditions' => array("NOT" => array('Material.material_id' => $materiaissel) ), 'fields' => array('Material.material_id')));
					
					$this->loadModel('Fornecedor_materiais');
					if ($this->Fornecedor_materiais->deleteAll(array('Fornecedor_materiais.fornecedor_id' => $id, 'Fornecedor_materiais.material_id' => $compforn), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Alguns materiais foram desaliados ao fornecedor em questão.','/fornecedores/relmateriais');
							$this->redirect(array('action' => 'relmateriais'));
						}
					}
				}
	        }
		}  
    }
	
	public function pega_materiais(){ //preencher o campo de materiais
		
		$fornID = $this->params['url']['fornecedor_id'];
				
		if($fornID!='-1'){ // checa se o fornecedor é válido
			$this->loadModel('Fornecedor_materiais');			
			$materiaissel = $this->Fornecedor_materiais->find('all', array('order' => array('material_nome' => 'asc'), 'conditions' => array('Fornecedor_materiais.fornecedor_id' => $fornID)));
			$matsel = '';
			foreach($materiaissel as $M):
				$matsel[$M['Fornecedor_materiais']['material_id']]=$M['Material']['material_id'];
			endforeach;
						
			$this->loadModel('Material');
			$materiaisnsel = $this->Material->find('all', array('order' => array('material_nome' => 'asc'), 'conditions' => array("NOT" => array('Material.material_id' => $matsel))));
		}
		
		$this->set('matnsel', $materiaisnsel);
		$this->set('matsel', $materiaissel);
		$this->Render('pega_materiais','ajax');
	}
    
	public function searchrelequipamentos() { //pesquisar fornecedores
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$results = $this->Fornecedor->find('all', array('conditions' => array('Fornecedor.fornecedor_'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
    public function relequipamentos($id = null) { //relacionar equipamentos à um Fornecedor
		$this->Fornecedor->id = $id;
		
		$forn = $this->Fornecedor->find('first', array('conditions' => array('Fornecedor.fornecedor_id' => $id)));
		$fornecedor = $forn['Fornecedor']['fornecedor_nome'];
		$this->set('fornecedor', $fornecedor);
		$this->set('fornecedorId', $id);
		
		$this->loadModel('Fornecedor_equipamentos');
		if ($this->request->is('get')) {
			$this->request->data = $this->Fornecedor_equipamentos->read();
		} else {
	        if(!empty($this->data)){
				if( ($this->data['Fornecedor_equipamentos']['equipamentos'] == '') ) {
		            $equipssel = $this->data['Fornecedor_equipamentos']['equipamentos'];
					$this->loadModel('Equipamento');
					$compforn = $this->Equipamento->find('list', array('conditions' => array("NOT" => array('Equipamento.equipamento_id' => $equipssel) ), 'fields' => array('Equipamento.equipamento_id')));
					
					$this->loadModel('Fornecedor_equipamentos');
					if ($this->Fornecedor_equipamentos->deleteAll(array('Fornecedor_equipamentos.fornecedor_id' => $id, 'Fornecedor_equipamentos.equipamento_id' => $compforn), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Não há mais equipamentos relacionados ao fornecedor em questão!','/fornecedores/relequipamentos');
							$this->redirect(array('action' => 'relequipamentos'));
						}
						echo "<center>Não há mais equipamentos relacionados ao fornecedor em questão!</center>";
					}
				} else {
					$contar = count($this->data['Fornecedor_equipamentos']['equipamentos']);
					for($i = 0; $i < $contar; $i++) {
						$esteEquip = $this->data['Fornecedor_equipamentos']['equipamentos'][$i];
						if($esteEquip != ''){
							$this->loadModel('Fornecedor_equipamentos');
							$compforn = $this->Fornecedor_equipamentos->find('count', array('conditions' => array('Fornecedor_equipamentos.fornecedor_id' => $id, 'Fornecedor_equipamentos.equipamento_id' => $esteEquip)));
							if($compforn == 0){
								$this->loadModel('Fornecedor_equipamentos');
								$this->Fornecedor_equipamentos->set(array(
									'fornecedor_id' => $this->data['Fornecedor_equipamentos']['fid'],
									'equipamento_id' => $esteEquip
								));
								
								if($this->Fornecedor_equipamentos->saveAll()) {
									if($this->request->is('Ajax')){    // o ajax roda aqui
					                    $this->set('dados',$this->request->data);
					                    $this->render('success','ajax');
					                } 
					                else{              
					                    $this->flash('Adicionado com sucesso!','relequipamentos');
					                    $this->redirect(array('action' => 'relequipamentos'));
					                }
								} else {
									echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
					                $this->render('delete','ajax');
								}
							}
							
							
						}
					}
					$equipssel = $this->data['Fornecedor_equipamentos']['equipamentos'];
					$this->loadModel('Equipamento');
					$compforn = $this->Equipamento->find('list', array('conditions' => array("NOT" => array('Equipamento.equipamento_id' => $equipssel) ), 'fields' => array('Equipamento.equipamento_id')));
					
					$this->loadModel('Fornecedor_equipamentos');
					if ($this->Fornecedor_equipamentos->deleteAll(array('Fornecedor_equipamentos.fornecedor_id' => $id, 'Fornecedor_equipamentos.equipamento_id' => $compforn), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Alguns equipamentos foram desaliados ao fornecedor em questão.','/fornecedores/relequipamentos');
							$this->redirect(array('action' => 'relequipamentos'));
						}
					}
				}
	        }
		}  
    }
	
	public function pega_equipamentos(){ //preencher o campo de equipamentos
		
		$fornID = $this->params['url']['fornecedor_id'];
				
		if($fornID!='-1'){ // checa se o fornecedor é válido
			$this->loadModel('Fornecedor_equipamentos');			
			$equipssel = $this->Fornecedor_equipamentos->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Fornecedor_equipamentos.fornecedor_id' => $fornID)));
			$equipsel = '';
			foreach($equipssel as $M):
				$equipsel[$M['Fornecedor_equipamentos']['equipamento_id']]=$M['Equipamento']['equipamento_id'];
			endforeach;
						
			$this->loadModel('Equipamento');
			$equipsnsel = $this->Equipamento->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array("NOT" => array('Equipamento.equipamento_id' => $equipsel))));
		}
		
		$this->set('equipnsel', $equipsnsel);
		$this->set('equipsel', $equipssel);
		$this->Render('pega_equipamentos','ajax');
	}
	
	public function pega_fornecedores_mat_equip(){ //atualizar o campo de fornecedores ao escolher materiais ou equipamentos
		
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
		
		$usuID = $this->Session->read();
		
		
	
        if(!empty($this->data)){
			$this->loadModel('Orcamento');
			$orcamento['Orcamento']['usuario_id'] = $usuID['Auth']['User']['usuario_id'];
			
			if($this->Orcamento->save($orcamento)){
				$orcamento_id = $this->Orcamento->getLastInsertID();

				$orcamento_material = $this->request->data;
				$orcamento_equipamento = $this->request->data;
				//pr($orcamento_material);
				
				$this->loadModel('Orcamento_materiais');
				$this->loadModel('Orcamento_equipamentos');
				
				foreach($orcamento_material['mat'] as $orcMat):
					$orcMat['Orcamento_materiais']['orcamento_id'] = $orcamento_id;
					$this->Orcamento_materiais->create();
					$this->Orcamento_materiais->save($orcMat);
				endforeach;
				
				foreach($orcamento_equipamento['equip'] as $orcEquip):
					$orcEquip['Orcamento_equipamentos']['orcamento_id'] = $orcamento_id;
					$this->Orcamento_equipamentos->create();
					$this->Orcamento_equipamentos->save($orcEquip);
				endforeach;
				
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
	
	public function searchorcmat() { //pesquisar orçamentos de materiais
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Orcamento_materiais');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.fornecedor_id' => $fornIds), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id') ));
			} else {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
				
				$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atprecosmat($id = null) { //atualizar preços de orçamentos de materiais
		$this->loadModel('Orcamento_materiais');
		//$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.orcamento_id LIKE' => $id)));
		$results = $this->Orcamento_materiais->query("SELECT Orcamento_materiais.orcamentos_materiais_id, Orcamento_materiais.orcamento_id, Orcamento_materiais.fornecedor_id, Orcamento_materiais.material_id, Orcamento_materiais.quantidade, Orcamento_materiais.material_preco, Orcamento_materiais.created, Orcamento_materiais.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.orcamentos_materiais AS Orcamento_materiais LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Orcamento_materiais.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Orcamento_materiais.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Orcamento_materiais.orcamento_id LIKE ".$id);
		
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
					$prazo = $this->data['Orcamento_materiais']['prazo'.$i];
					
					$this->Orcamento_materiais->set(array(
						'material_preco' => $materialPrecoAtual,
						'prazo' => $prazo
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
					
					/*$this->loadModel('Material');
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
					}*/
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
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
				
				$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('orcamento_id', 'Orcamento_equipamentos.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atprecosequip($id = null) { //atualizar preços de orçamentos de equipamentos
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
					$prazo = $this->data['Orcamento_equipamentos']['prazo'.$i];
					
					$this->Orcamento_equipamentos->set(array(
						'equipamento_preco' => $equipPrecoAtual,
						'prazo' => $prazo
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
					
					/*$this->loadModel('Equipamento');
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
					}*/
				} else {
					echo "<center> O valor do campo de preço da ".($i+1)."ª linha está vazio, portanto não foi atualizado. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
    }
	
	public function estoquemat() { //checar estoque de materiais
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Material_requisitado');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Material_requisitado->find('all', array('conditions' => array('Material_requisitado.fornecedor_id' => $fornIds), 'group' => array('requisicao_id', 'Material_requisitado.fornecedor_id') ));
			} else {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
				
				$results = $this->Material_requisitado->find('all', array('conditions' => array('Material_requisitado.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('requisicao_id', 'Material_requisitado.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atestoquemat($id = null) { //atualizar estoque de materiais
		$this->loadModel('Material_requisitado');
		$results = $this->Material_requisitado->query("SELECT Material_requisitado.materiais_requisitados_id, Material_requisitado.requisicao_id, Material_requisitado.fornecedor_id, Material_requisitado.material_id, Material_requisitado.quantidade, Material_requisitado.material_preco, Material_requisitado.created, Material_requisitado.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.materiais_requisitados AS Material_requisitado LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Material_requisitado.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Material_requisitado.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Material_requisitado.requisicao_id LIKE ".$id);
		
		$requisicao = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Material_requisitado->read();
		} else {
			$contar = count($this->data)-1;
			for($i = 0; $i < $contar; $i++) {
				if($this->data['Material_requisitado']['recebido'.$i] != 0){
					$matId = $this->data['material_id'.$i];
					$this->loadModel('Estoque_materiais');
					$estId = $this->Estoque_materiais->find('first', array('conditions' => array('Estoque_materiais.material_id' => $matId)));
					$this->Estoque_materiais->id = $estId['Estoque_materiais']['estoques_materiais_id'];
					//$materialPrecoAtual = $this->data['Material_requisitado']['preco'.$i];
					
					$qntdAtual = $estId['Estoque_materiais']['quantidade'];
					$qntdAEstocar = $this->data['Material_requisitado']['qnt'.$i];
					$qntdAEstocar = $qntdAEstocar + $qntdAtual;
					
					$this->Estoque_materiais->set(array( 
					//	'material_preco' => $materialPrecoAtual,
						'quantidade' => $qntdAEstocar
					));
					
					if($this->Estoque_materiais->save()) { 
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','atestoquemat');
		                    $this->redirect(array('action' => 'atestoquemat'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
					
				} else {
					echo "<center> Os materiais da ".($i+1)."ª linha não foram estocados. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
	}
	
	public function estoqueequip() { //checar estoque de equipamentos
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Equipamento_requisitado');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Equipamento_requisitado->find('all', array('conditions' => array('Equipamento_requisitado.fornecedor_id' => $fornIds), 'group' => array('requisicao_id', 'Equipamento_requisitado.fornecedor_id') ));
			} else {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
				
				$results = $this->Equipamento_requisitado->find('all', array('conditions' => array('Equipamento_requisitado.'.$tipo.' LIKE' => "%$pesquisa%"), 'group' => array('requisicao_id', 'Equipamento_requisitado.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function atestoqueequip($id = null) { //atualizar estoque de equipamentos
		$this->loadModel('Equipamento_requisitado');
		$results = $this->Equipamento_requisitado->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Equipamento_requisitado.requisicao_id' => $id)));
		
		$requisicao = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Equipamento_requisitado->read();
		} else {
			$contar = count($this->data)-1;
			for($i = 0; $i < $contar; $i++) {
				if($this->data['Equipamento_requisitado']['recebido'.$i] != 0){
					$equipId = $this->data['equipamento_id'.$i];
					$this->loadModel('Estoque_equipamentos');
					$estId = $this->Estoque_equipamentos->find('first', array('conditions' => array('Estoque_equipamentos.equipamento_id' => $equipId)));
					$this->Estoque_equipamentos->id = $estId['Estoque_equipamentos']['estoques_equipamentos_id'];
					//$equipamentoPrecoAtual = $this->data['Equipamento_requisitado']['preco'.$i];
					
					$qntdAtual = $estId['Estoque_equipamentos']['quantidade'];
					$qntdAEstocar = $this->data['Equipamento_requisitado']['qnt'.$i];
					$qntdAEstocar = $qntdAEstocar + $qntdAtual;
					$alugado = $this->data['Equipamento_requisitado']['alug'.$i];
					
					$this->Estoque_equipamentos->set(array( 
					//	'equipamento_preco' => $equipamentoPrecoAtual,
						'alugado' => $alugado, 
						'quantidade' => $qntdAEstocar
					));
					
					if($this->Estoque_equipamentos->save()) { 
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','atestoquemat');
		                    $this->redirect(array('action' => 'atestoquemat'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
					
				} else {
					echo "<center> Os equipamentos da ".($i+1)."ª linha não foram estocados. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
	}
}
?>