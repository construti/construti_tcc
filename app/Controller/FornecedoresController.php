<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class FornecedoresController extends AppController {
 
	public $name = 'Fornecedores';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler', 'Email'); 
	
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
			$materiaissel = $this->Fornecedor_materiais->find('all', array('recursive' => 2, 'order' => array('material_nome' => 'asc'), 'conditions' => array('Fornecedor_materiais.fornecedor_id' => $fornID)));
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
				
				if(isset($orcamento_material['mat'])){
					
					foreach($orcamento_material['mat'] as $orcMat):
						$orcMat['Orcamento_materiais']['orcamento_id'] = $orcamento_id;
						$this->Orcamento_materiais->create();
						$this->Orcamento_materiais->save($orcMat);
					endforeach;
				}
				
				if(isset($orcamento_material['equip'])){
					foreach($orcamento_equipamento['equip'] as $orcEquip):
						$orcEquip['Orcamento_equipamentos']['orcamento_id'] = $orcamento_id;
						$this->Orcamento_equipamentos->create();
						$this->Orcamento_equipamentos->save($orcEquip);
					endforeach;
				}
				$materiais_equipamentos_orcamento = $this->Orcamento_materiais->query("
					SELECT * from 
						(SELECT (SELECT material_nome from materiais where materiais.material_id = M.material_id) as nome,
								 M.quantidade,
								(SELECT fornecedor_nome from fornecedores where fornecedores.fornecedor_id = M.fornecedor_id) as fornecedor_nome,  							 'C' as transacao ,
								'M' as tipo 
							FROM `orcamentos_materiais` as M where M.orcamento_id = $orcamento_id
					UNION 
						SELECT (SELECT equipamento_nome from equipamentos where equipamentos.equipamento_id = E.equipamento_id) as nome,
								 E.quantidade, 
								 (SELECT fornecedor_nome from fornecedores where fornecedores.fornecedor_id = E.fornecedor_id) as fornecedor_nome, 							 alugado as transacao ,
								 'E' as tipo 
							FROM orcamentos_equipamentos as E where E.orcamento_id = $orcamento_id) 
					as materiais_equipamentos_orcamento order by fornecedor_nome
				"); // ESSE SQL RETORNA TODOS OS DADOS DO ORCAMENTO QUE ACABOU DE SER GRAVADO COM NOME DE FORNECEDOR E ITENS 
				
				$mensagem = array();
				$chave = '';
				$i = 0;
				foreach($materiais_equipamentos_orcamento as $o): // Pega a lista de fornecedores dos materiais requisitados.
						if($chave!=$o['materiais_equipamentos_orcamento']['fornecedor_nome']){
							$chave =$o['materiais_equipamentos_orcamento']['fornecedor_nome'];
							$i++;
							
							$mensagem[$i].= "<strong>Pedido de Materiais e Equipamentos</strong> \n \n ";
							$mensagem[$i] .= "<b>Fornecedor:</b>".$o['materiais_equipamentos_orcamento']['fornecedor_nome']." \n\n ";
						}
						if($i!=0){
							$mensagem[$i] .= "<b>Tipo do Item:</b> ".$o['materiais_equipamentos_orcamento']['tipo']." \n ";
							$mensagem[$i] .= "<b>Item:</b> ".$o['materiais_equipamentos_orcamento']['nome']." \n ";
							$mensagem[$i] .= "<b>Quantidade:</b> ".$o['materiais_equipamentos_orcamento']['quantidade']." \n ";
							$mensagem[$i] .= "---------------------------------------------------- \n \n ";
						}
				endforeach;
				
				$email = new CakeEmail('default');
				for($k=1;$k<=sizeof($mensagem);$k++){
					echo $mensagem[$k];
					
					$email->from(array('construti@construti.com' => 'Empresa de Engenharia'));
					$email->to('dudu.yusuke@gmail.com');
					$email->subject('Pedido de Orçamento Construti');
					$email->send($mensagem[$k]);
					
					echo " \n\n ";
				}
				
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
	
	public function atprecosmat($id = null, $fid = null) { //atualizar preços de orçamentos de materiais
		$this->loadModel('Orcamento_materiais');
		$results = $this->Orcamento_materiais->find('all', array('recursive' => 2, 'conditions' => array('Orcamento_materiais.orcamento_id' => $id , 'Orcamento_materiais.fornecedor_id' => $fid)));
		//$results = $this->Orcamento_materiais->query("SELECT Orcamento_materiais.orcamentos_materiais_id, Orcamento_materiais.orcamento_id, Orcamento_materiais.fornecedor_id, Orcamento_materiais.material_id, Orcamento_materiais.quantidade, Orcamento_materiais.material_preco, Orcamento_materiais.created, Orcamento_materiais.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.orcamentos_materiais AS Orcamento_materiais LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Orcamento_materiais.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Orcamento_materiais.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Orcamento_materiais.orcamento_id LIKE ".$id);
		
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
	
	public function atprecosequip($id = null, $fid = null) { //atualizar preços de orçamentos de equipamentos
		$this->loadModel('Orcamento_equipamentos');
		$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.orcamento_id' => $id, 'Orcamento_equipamentos.fornecedor_id' => $fid)));
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
	
	public function atestoquemat($id = null, $fid = null) { //atualizar estoque de materiais
		$this->loadModel('Material_requisitado');
		$results = $this->Material_requisitado->find('all', array('recursive' => 2, 'conditions' => array('Material_requisitado.requisicao_id' => $id, 'Material_requisitado.fornecedor_id' => $fid)));
		//$results = $this->Material_requisitado->query("SELECT Material_requisitado.materiais_requisitados_id, Material_requisitado.requisicao_id, Material_requisitado.fornecedor_id, Material_requisitado.material_id, Material_requisitado.quantidade, Material_requisitado.material_preco, Material_requisitado.created, Material_requisitado.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.materiais_requisitados AS Material_requisitado LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Material_requisitado.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Material_requisitado.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Material_requisitado.requisicao_id LIKE ".$id);
		
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
					$qntdTotal = $qntdAEstocar + $qntdAtual;
					
					$this->Estoque_materiais->set(array( 
					//	'material_preco' => $materialPrecoAtual,
						'quantidade' => $qntdTotal
					));
					
					if($this->Estoque_materiais->save()) { // atualiza o estoque de materiais
						$this->loadModel('Estoque_materiais_historico');
						$ultimo = $this->Estoque_materiais_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Estoque_materiais_historico.estoques_materiais_id' => $estId['Estoque_materiais']['estoques_materiais_id'])));
						$andamento = $ultimo['Estoque_materiais_historico']['andamento'] + 1;
						
						$this->Estoque_materiais_historico->set(array( 
							'estoques_materiais_id' => $estId['Estoque_materiais']['estoques_materiais_id'],
							'andamento' => $andamento,
							'quantidade_estocada' => $qntdAEstocar, 
							'quantidade' => $qntdTotal
						));
						
						if($this->Estoque_materiais_historico->save()) { // atualiza o histórico de estoque de materiais
							if($this->request->is('Ajax')){    // o ajax roda aqui
								echo "<center> Histórico do estoque de materiais atualizado! </center><br/>";
								$this->render('delete','ajax');
			                } 
			                else{              
			                    $this->flash('Histórico do estoque de materiais atualizado!','add');
			                }
						} else {
							echo "<center> Histórico do estoque de materiais não foi atualizado! </center>";
			                $this->render('delete','ajax');
						}
					
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
	
	public function search_hist_estoque_mat() { //busca de materiais em estoque
		if(!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'tipo') {
				$this->loadModel('Material_tipo');
				$tipoIds = $this->Material_tipo->find('list', array('conditions' => array('Material_tipo.material_tipo_nome LIKE' => "%$pesquisa%"), 'fields' => array('Material_tipo.material_tipo_id')));
				$this->loadModel('Material');
				$results = $this->Material->find('all', array('conditions' => array('Material.material_tipo' => $tipoIds)));				
			} else {
				$this->loadModel('Material');
            	$results = $this->Material->find('all', array('conditions' => array('Material.material_'.$tipo.' LIKE' => "%$pesquisa%")));
			}
       } 
       if (!empty($results)){
            $this->set(compact('results'));
        }
	}
	
	public function hist_estoque_mat($id = null) { //checar histórico de materiais
		$this->loadModel('Estoque_materiais');
		$estoque = $this->Estoque_materiais->find('first', array('recursive' => 2, 'conditions' => array('Estoque_materiais.material_id' => $id)));
		$estoque_id = $estoque['Estoque_materiais']['estoques_materiais_id'];
	
		$this->loadModel('Estoque_materiais_historico');
		$historico = $this->Estoque_materiais_historico->find('all', array('order' => 'andamento', 'conditions' => array('Estoque_materiais_historico.estoques_materiais_id' => $estoque_id)));
		
		$this->set(compact('historico', 'estoque'));
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
	
	public function atestoqueequip($id = null, $fid = null) { //atualizar estoque de equipamentos
		$this->loadModel('Equipamento_requisitado');
		$results = $this->Equipamento_requisitado->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Equipamento_requisitado.requisicao_id' => $id, 'Equipamento_requisitado.fornecedor_id' => $fid)));
		
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
					$qntdTotal = $qntdAEstocar + $qntdAtual;
					$alugado = $this->data['Equipamento_requisitado']['alug'.$i];
					
					$this->Estoque_equipamentos->set(array( 
					//	'equipamento_preco' => $equipamentoPrecoAtual,
						'alugado' => $alugado, 
						'quantidade' => $qntdTotal
					));
					
					if($this->Estoque_equipamentos->save()) { 
						$this->loadModel('Estoque_equipamentos_historico');
						$ultimo = $this->Estoque_equipamentos_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Estoque_equipamentos_historico.estoques_equipamentos_id' => $estId['Estoque_equipamentos']['estoques_equipamentos_id'])));
						$andamento = $ultimo['Estoque_equipamentos_historico']['andamento'] + 1;
						
						$this->Estoque_equipamentos_historico->set(array( 
							'estoques_equipamentos_id' => $estId['Estoque_equipamentos']['estoques_equipamentos_id'],
							'andamento' => $andamento,
							'quantidade_estocada' => $qntdAEstocar, 
							'quantidade' => $qntdTotal
						));
						
						if($this->Estoque_equipamentos_historico->save()) { // atualiza o histórico do galpão de equipamentos
							if($this->request->is('Ajax')){    // o ajax roda aqui
								echo "<center> Histórico do galpão de equipamentos atualizado! </center><br/>";
								$this->render('delete','ajax');
			                } 
			                else{              
			                    $this->flash('Histórico do galpão de equipamentos atualizado!','add');
			                }
						} else {
							echo "<center> Histórico do galpão de equipamentos não foi atualizado! </center>";
			                $this->render('delete','ajax');
						}
					
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
	
	public function search_hist_estoque_equip() { //busca de equipamentos no galpão
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'tipo'){
				$this->loadModel('Equipamentos_tipo');
				$tipoIds = $this->Equipamentos_tipo->find('list', array('conditions' => array('Equipamentos_tipo.tipo_equipamento LIKE' => "%$pesquisa%"), 'fields' => array('Equipamentos_tipo.tipo_id')));
				
				$this->loadModel('Equipamento');
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_tipo' => $tipoIds)));
			} elseif ($tipo == 'valor_hora') {
				$this->loadModel('Equipamentos_tipo');
				$tipoIds = $this->Equipamentos_tipo->find('list', array('conditions' => array('Equipamentos_tipo.tipo_valor_hora LIKE' => "$pesquisa"), 'fields' => array('Equipamentos_tipo.tipo_id')));
				
				$this->loadModel('Equipamento');
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_tipo' => $tipoIds)));
			} else {
				$this->loadModel('Equipamento');
				$results = $this->Equipamento->find('all', array('conditions' => array('Equipamento.equipamento_'.$tipo.' LIKE' => "%$pesquisa%")));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function hist_estoque_equip($id = null) { //checar histórico de equipamentos
		$this->loadModel('Estoque_equipamentos');
		$estoque = $this->Estoque_equipamentos->find('first', array('recursive' => 2, 'conditions' => array('Estoque_equipamentos.equipamento_id' => $id)));
		$estoque_id = $estoque['Estoque_equipamentos']['estoques_equipamentos_id'];
	
		$this->loadModel('Estoque_equipamentos_historico');
		$historico = $this->Estoque_equipamentos_historico->find('all', array('order' => 'andamento', 'conditions' => array('Estoque_equipamentos_historico.estoques_equipamentos_id' => $estoque_id)));
		
		$this->set(compact('historico', 'estoque'));
	}
	
	public function search_req_mat() { //pesquisar orçamentos de materiais
		
		$this->loadModel('Material');
		$tiposMat = $this->Material->query("SELECT materiais.material_id, concat(materiais.material_nome, ' (' ,(SELECT embalagem_tipo from embalagens WHERE embalagens.embalagem_id = materiais.material_embalagem), ' - ', materiais.material_qtd_base, ' ', (SELECT medida_tipo from medidas WHERE medidas.medida_id = materiais.material_medida), ')') AS descricao from materiais");
		
		$this->set(compact('tiposMat'));
		
		if (!empty($this->data)){
			$this->loadModel('Orcamento_materiais');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			$tp_pesq = $this->data['tipo_pesq']; //guarda o tipo da palavra a ser pesquisada
			$mat_id = $this->data['Orcamento_materiais']['mat_desc']; //guarda o material
			
			//pr($this->data);
			
			if($tp_pesq == 1){ //se a pesquisa foi por materiais
				
				$results = $this->Orcamento_materiais->query('SELECT distinct orcamento_id, material_id, (SELECT material_nome from materiais where materiais.material_id = orcamentos_materiais.material_id) as material_descricao ,fornecedor_id  FROM orcamentos_materiais where material_id = '.$mat_id.' order by orcamento_id desc');
				
				pr($results);
			}
			
			else if($tp_pesq == 2){ // se a pesquisa foi por fornecedor ou data
				if ($tipo == 'fornecedor_id') {
					$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
					$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.fornecedor_id' => $fornIds, 'Orcamento_materiais.material_preco <>' => 0), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id') ));
				} else {
					//Data formatada como dd/mm/yyyy
					list($d, $m, $y) = preg_split('/\//', $pesquisa);
					$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
					$results = $this->Orcamento_materiais->find('all', array('conditions' => array('Orcamento_materiais.'.$tipo.' LIKE' => "%$pesquisa%", 'Orcamento_materiais.material_preco <>' => 0), 'group' => array('orcamento_id', 'Orcamento_materiais.fornecedor_id')));
				}	
			}
			
			
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function reqmat($id = null, $forn_id = null) { //atualizar estoque de materiais
		$this->loadModel('Orcamento_materiais');
		
		$results = $this->Orcamento_materiais->find('all', array('recursive' => 2, 'conditions' => array('Orcamento_materiais.fornecedor_id'=>$forn_id,'Orcamento_materiais.orcamento_id LIKE' => $id)));
		//$results = $this->Orcamento_materiais->query("SELECT Orcamento_materiais.orcamentos_materiais_id, Orcamento_materiais.orcamento_id, Orcamento_materiais.fornecedor_id, Orcamento_materiais.material_id, Orcamento_materiais.quantidade, Orcamento_materiais.material_preco, Orcamento_materiais.prazo, Orcamento_materiais.created, Orcamento_materiais.modified, Fornecedor.fornecedor_id, Fornecedor.fornecedor_nome, Fornecedor.fornecedor_cnpj, Fornecedor.fornecedor_estado, Fornecedor.fornecedor_cidade, Fornecedor.fornecedor_bairro, Fornecedor.fornecedor_endereco, Fornecedor.fornecedor_contato, Fornecedor.fornecedor_email, Fornecedor.fornecedor_descricao, Fornecedor.created, Fornecedor.modified, Material.material_id, Material.material_nome, Material.material_tipo, Material.material_ultimo_preco, Material.material_descricao, Material.material_embalagem, Material.material_qtd_base, Material.material_medida, Material.created, Material.modified, (CONCAT(material_nome, ' - ', embalagem_tipo, ' - ', material_qtd_base, ' ', medida_tipo)) AS Material__descricao FROM construti_oficial.orcamentos_materiais AS Orcamento_materiais LEFT JOIN construti_oficial.fornecedores AS Fornecedor ON (Orcamento_materiais.fornecedor_id = Fornecedor.fornecedor_id) LEFT JOIN construti_oficial.materiais AS Material ON (Orcamento_materiais.material_id = Material.material_id) LEFT JOIN construti_oficial.embalagens AS Embalagem ON (Embalagem.embalagem_id = Material.material_embalagem) LEFT JOIN construti_oficial.medidas AS Medida ON (Medida.medida_id = Material.material_medida) WHERE Orcamento_materiais.orcamento_id LIKE ".$id);
		
		$requisicao = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Orcamento_materiais->read();
		} else {
			$this->loadModel('Materiais_requisitado');
			$contar = count($this->data)-1;
			for($i = 0; $i < $contar; $i++) {
			
				if($this->data['Materiais_requisitado']['requisitar'.$i] != 0){
					
					$grava_requisicao['Materiais_requisitado']['material_id'] = $this->request->data['material_id'.$i];
					$grava_requisicao['Materiais_requisitado']['quantidade'] = $this->request->data['Materiais_requisitado']['qnt'.$i];
					$grava_requisicao['Materiais_requisitado']['material_preco'] = $this->request->data['Materiais_requisitado']['material_preco'.$i];
					$grava_requisicao['Materiais_requisitado']['prazo'] = $this->request->data['Materiais_requisitado']['prazo'.$i];
					$grava_requisicao['Materiais_requisitado']['requisicao_id'] = $this->request->data['Materiais_requisitado']['orcamento_id'.$i];
					$grava_requisicao['Materiais_requisitado']['fornecedor_id'] = $this->request->data['Materiais_requisitado']['fornecedor_id'.$i];
					$this->Materiais_requisitado->create();
					if($this->Materiais_requisitado->save($grava_requisicao)) {
						$this->loadModel('Material');
						$materialid = $grava_requisicao['Materiais_requisitado']['material_id'];
						$this->Material->id = $materialid;
						$materialUltimoPreco = $this->Material->find('first', array('conditions' => array('Material.material_id LIKE' => $materialid)));
						$materialUltimoPreco = $materialUltimoPreco['Material']['material_ultimo_preco'];
						$materialPrecoAtual = $grava_requisicao['Materiais_requisitado']['material_preco'];
						
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
						
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','reqmat');
		                    $this->redirect(array('action' => 'reqmat'));
		                }
					} else {
						echo "<center> A atualização falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
					
				} else {
					//echo "<center> Os materiais da ".($i+1)."ª linha não foram estocados. </center><br />";
					$this->render('delete','ajax');
				}
			}
		}
	}
	
	public function search_req_equip() { //pesquisar orçamentos de equipamentos
		if (!empty($this->data['pesquisa'])){
			$this->loadModel('Orcamento_equipamentos');
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'fornecedor_id') {
				$fornIds = $this->Fornecedor->find('list', array('conditions' => array('Fornecedor.fornecedor_nome LIKE' => "%$pesquisa%"), 'fields' => array('Fornecedor.fornecedor_id')));
				$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.fornecedor_id' => $fornIds, 'Orcamento_equipamentos.equipamento_preco <>' => 0), 'group' => array('orcamento_id', 'Orcamento_equipamentos.fornecedor_id') ));
			} else {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
				
				$results = $this->Orcamento_equipamentos->find('all', array('conditions' => array('Orcamento_equipamentos.'.$tipo.' LIKE' => "%$pesquisa%", 'Orcamento_equipamentos.equipamento_preco <>' => 0), 'group' => array('orcamento_id', 'Orcamento_equipamentos.fornecedor_id')));
			}
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function reqequip($id = null, $forn_id=null) { //atualizar estoque de equipamentos
		$this->loadModel('Orcamento_equipamentos');
		$results = $this->Orcamento_equipamentos->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Orcamento_equipamentos.fornecedor_id'=>$forn_id,'Orcamento_equipamentos.orcamento_id' => $id)));
		
		$requisicao = $results;
		$this->set(compact('results'));
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Orcamento_equipamentos->read();
		} else {
			$contar = count($this->data)-1;
			$this->loadModel('Equipamento_requisitado');
			for($i = 0; $i < $contar; $i++) {
				if($this->data['Equipamento_requisitado']['requisitar'.$i] != 0){
					
					$grava_requisicao['Equipamento_requisitado']['equipamento_id'] = $this->request->data['equipamento_id'.$i];
					$grava_requisicao['Equipamento_requisitado']['alugado'] = $this->request->data['Equipamento_requisitado']['alug'.$i];
					$grava_requisicao['Equipamento_requisitado']['quantidade'] = $this->request->data['Equipamento_requisitado']['qnt'.$i];
					$grava_requisicao['Equipamento_requisitado']['equipamento_preco'] = $this->request->data['Equipamento_requisitado']['equipamento_preco'.$i];
					$grava_requisicao['Equipamento_requisitado']['prazo'] = $this->request->data['Equipamento_requisitado']['prazo'.$i];
					$grava_requisicao['Equipamento_requisitado']['requisicao_id'] = $this->request->data['Equipamento_requisitado']['orcamento_id'.$i];
					$grava_requisicao['Equipamento_requisitado']['fornecedor_id'] = $this->request->data['Equipamento_requisitado']['fornecedor_id'.$i];
					$grava_requisicao['Equipamento_requisitado']['dt_aluguel_ini'] = $this->request->data['Equipamento_requisitado']['dt_aluguel_ini'.$i];
					list($d, $m, $y) = preg_split('/\//', $grava_requisicao['Equipamento_requisitado']['dt_aluguel_ini']);
					$grava_requisicao['Equipamento_requisitado']['dt_aluguel_ini'] = sprintf('%4d-%02d-%02d', $y, $m, $d);
					
					$grava_requisicao['Equipamento_requisitado']['dt_aluguel_fim'] = $this->request->data['Equipamento_requisitado']['dt_aluguel_fim'.$i];
					list($d, $m, $y) = preg_split('/\//', $grava_requisicao['Equipamento_requisitado']['dt_aluguel_fim']);
					$grava_requisicao['Equipamento_requisitado']['dt_aluguel_fim'] = sprintf('%4d-%02d-%02d', $y, $m, $d);
					
					//pr($grava_requisicao);
					$this->Equipamento_requisitado->create();
					if($this->Equipamento_requisitado->save($grava_requisicao)) { 
						$this->loadModel('Equipamento');
						$equipid = $grava_requisicao['Equipamento_requisitado']['equipamento_id'];
						$equipTipo = $this->Equipamento->find('first', array('conditions' => array('Equipamento.equipamento_id LIKE' => $equipid)));
						
						$this->loadModel('Equipamentos_tipo');
						$equipUltimoPreco = $this->Equipamentos_tipo->find('first', array('conditions' => array('Equipamentos_tipo.tipo_id LIKE' => $equipTipo['Equipamento']['equipamento_tipo'])));
						$equipUltimoPreco2 = $equipUltimoPreco['Equipamentos_tipo']['tipo_valor_hora'];
						$this->Equipamentos_tipo->id = $equipUltimoPreco['Equipamentos_tipo']['tipo_id'];
						$equipPrecoAtual = $grava_requisicao['Equipamento_requisitado']['equipamento_preco'];
						
						if (($equipPrecoAtual < $equipUltimoPreco2) || ($equipUltimoPreco2 == 0)){
							$this->Equipamentos_tipo->set(array(
								'tipo_valor_hora' => $equipPrecoAtual
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
					
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Atualizado com sucesso!','reqequip');
		                    $this->redirect(array('action' => 'reqequip'));
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