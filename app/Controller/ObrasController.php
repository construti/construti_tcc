<?php

App::uses('AppController', 'Controller');

class ObrasController extends AppController {
 
	public $name = 'Obras';
	
	public $helpers = array('Form','Js');
	
    public $components = array('RequestHandler'); 
	    
    public function add() { //adiciona um obra
		$this->loadModel('Obras_status');
		$status = $this->Obras_status->find('list', array('order' => array('status_obra' => 'asc'), 'fields' => array('Obras_status.status_id', 'Obras_status.status_obra')));
		
		$this->loadModel('Funcionario');
		$responsavel = $this->Funcionario->find('list', array('fields' => array('funcionario_nome'), 'order' => array('funcionario_nome' => 'asc')));
		
		$this->set(compact('responsavel'));
		$this->set(compact('status'));
	
        if(!empty($this->data)){
            if($this->Obra->save($this->data)){
				//$id_da_obra = $this->Obra->getLastInsertId(); 
				
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
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function edit($id = null) { //atualizar um obra
		$this->Obra->id = $id;
		$this->loadModel('Obras_status');
		$status = $this->Obras_status->find('list', array('order' => array('status_obra' => 'asc'), 'fields' => array('Obras_status.status_id', 'Obras_status.status_obra')));
		
		$this->loadModel('Funcionario');
		$responsavel = $this->Funcionario->find('list', array('fields' => array('funcionario_nome'),'order' => array('funcionario_nome' => 'asc'	)));
		

		$this->set(compact('responsavel')); 
		$this->set(compact('status'));

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
	
	public function add_status() { //adiciona um Status de obra		
		if(!empty($this->data)){
			$this->loadModel('Obras_status');
			if($this->Obras_status->save($this->data)){
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
					$this->render('success','ajax');
                } 
                else{ 
                    $this->flash('Adicionado com sucesso!','add_status');
                    $this->redirect(array('action' => 'add_status'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}			
        }
	}
	
	public function search_status() { //pesquisar Status
		$this->loadModel('Obras_status');
		
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
			$results = $this->Obras_status->find('all', array('conditions' => array('Obras_status.status_obra LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function edit_status($id = null) { //atualizar um Status
		$this->loadModel('Obras_status');
		$this->Obras_status->id = $id;
		
        if ($this->request->is('get')) {
			$this->request->data = $this->Obras_status->read();
		} else {
			if ($this->Obras_status->save($this->request->data)) {
				if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->render('success','ajax');
                } else {
				    $this->flash('Status atualizado.','/obras/search_status');
				    $this->redirect(array('action' => 'search_status'));
                }
			}  else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
		}
    }
	
	public function delete_status($id) { //deletar um Status
		$this->loadModel('Obras_status');
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Obras_status->delete($id)) {
			if($this->request->is('Ajax')){    // o ajax roda aqui
                $this->set('dados',$this->request->data);
                $this->render('success','ajax');
            } else {
				$this->flash('O Status de ID '.$id.' foi deletado.','/obras/search_status');
				$this->redirect(array('action' => 'search_status'));
			}
		}		
    }
	
    public function search_status_obra() { //pesquisar obras para atualizar a situação
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function at_status($id = null) {
		$this->Obra->id = $id;
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
		$this->set(compact('obra'));
		
		$this->loadModel('Obras_historico');
		$historico = $this->Obras_historico->find('all', array('order' => array('andamento' => 'asc'), 'conditions' => array('Obras_historico.obra_id' => $id)));
		$this->set(compact('historico'));
		
		$this->loadModel('Obras_status');
		$status = $this->Obras_status->find('list', array('order' => array('status_obra' => 'asc'), 'fields' => array('Obras_status.status_id', 'Obras_status.status_obra')));
		$this->set(compact('status'));
		
		if ($this->request->is('get')) {
			$this->request->data = $this->Obra->read();
		} else {
			$this->loadModel('Obras_historico');
			$ultimo = $this->Obras_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Obras_historico.obra_id' => $id)));
			$andamento = $ultimo['Obras_historico']['andamento'] + 1;
			$this->Obras_historico->set(array( 
						'obra_id' => $id,
						'andamento' => $andamento
					));
			
			$this->loadModel('Obras_status');
			$situacao = $this->Obras_status->find('first', array('conditions' => array('Obras_status.status_id' => $this->data['Obras_historico']['obra_status'])));
			$situacao = $situacao['Obras_status']['status_obra'];
			
			if($situacao != "Cancelada" && $situacao != "Paralisada") {
				if($this->Obras_historico->save($this->data)){
					$this->loadModel('Obra');
					$this->Obra->id = $id;
					$this->Obra->set(array( 
							'obra_status' => $this->data['Obras_historico']['obra_status']
						));
					if($this->Obra->save()){
						if($this->request->is('Ajax')){    // o ajax roda aqui
							echo "<center> Situação de Obra atualizada! </center>";
							$this->render('delete','ajax');
		                } 
		                else{              
		                    $this->flash('Situação de Obra atualizada','add');
		                }
						
		            } else {
						echo "<center> Situação de Obra não foi atualizada! </center>";
		                $this->render('delete','ajax');
					}
							
					if($this->request->is('Ajax')){    // o ajax roda aqui
	                    $this->set('dados',$this->request->data);
	                    $this->render('success','ajax');
	                } 
	                else{              
	                    $this->flash('Histórico atualizado!','at_status');
	                    $this->redirect(array('action' => 'at_status'));
	                }
					
	            } else {
					echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
	                $this->render('delete','ajax');
				}
			} else {
				if(trim($this->data['Obras_historico']['motivo']) != "" ) {
					if($this->Obras_historico->save($this->data)){
						$this->loadModel('Obra');
						$this->Obra->id = $id;
						$this->Obra->set(array( 
								'obra_status' => $this->data['Obras_historico']['obra_status']
							));
						if($this->Obra->save()){
							if($this->request->is('Ajax')){    // o ajax roda aqui
								echo "<center> Situação de Obra atualizada! </center>";
								$this->render('delete','ajax');
			                } 
			                else{              
			                    $this->flash('Situação de Obra atualizada','add');
			                }
							
			            } else {
							echo "<center> Situação de Obra não foi atualizada! </center>";
			                $this->render('delete','ajax');
						}
								
						if($this->request->is('Ajax')){    // o ajax roda aqui
		                    $this->set('dados',$this->request->data);
		                    $this->render('success','ajax');
		                } 
		                else{              
		                    $this->flash('Histórico atualizado!','at_status');
		                    $this->redirect(array('action' => 'at_status'));
		                }
						
		            } else {
						echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
		                $this->render('delete','ajax');
					}
				} else {
					echo "<center> Não foi possível atualizar a Situação de Obra. Preencha o motivo! </center>";
					$this->render('delete','ajax');
				}
			}
		}
	}
	
	public function orcamento_obra() { //pesquisar obras
		$this->loadModel('Obra');
		$obras = $this->Obra->find('list', array('order' => 'obra_nome', 'fields' => array('obra_nome')));
		
		$this->loadModel('Tipo');
		$tiposFunc = $this->Tipo->find('list', array('order' => 'tipo_funcionario', 'fields' => array('tipo_funcionario')));
		
		$this->loadModel('Material');
		$tiposMat = $this->Material->query("SELECT materiais.material_id, concat(materiais.material_nome, ' (' ,(SELECT embalagem_tipo from embalagens WHERE embalagens.embalagem_id = materiais.material_embalagem), ' - ', materiais.material_qtd_base, ' ', (SELECT medida_tipo from medidas WHERE medidas.medida_id = materiais.material_medida), ')') AS descricao from materiais");
		//$tiposFunc = $this->Material->find('list', array('order' => 'tipo_funcionario', 'fields' => array('tipo_funcionario')));
		
		$this->loadModel('Equipamento');
		$tiposEquip = $this->Equipamento->find('list', array('order' => 'equipamento_nome', 'fields' => array('equipamento_nome')));
		
		$this->set(compact('obras', 'tiposFunc', 'tiposMat', 'tiposEquip'));
    }
	
	public function pega_valor_material(){ //atualizar o campo de salário ao escolher o tipo
		$this->loadModel('Material');
		
		$f_area = $this->params['url']['material_tipo'];
		$material = $this->Material->find('first', array('conditions' => array('Material.material_id' => $f_area)));
		$material = $material['Material']['material_ultimo_preco'];
		$this->set('valor', $material);
		$this->Render('pega_valor','ajax');
	}
	
	public function pega_valor_equipamento(){ //atualizar o campo de salário ao escolher o tipo
		$this->loadModel('Equipamento');
		
		$f_area = $this->params['url']['equipamento_tipo'];
		$equipamento = $this->Equipamento->find('first', array('conditions' => array('Equipamento.equipamento_id' => $f_area)));
		$equipamento = $equipamento['Equipamento']['equipamento_valor_hora'];
		$this->set('valor', $equipamento);
		$this->Render('pega_valor','ajax');
	}
	
	public function custo_obra() { //pesquisar obras
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	
	public function visualizar_custo($id = null) { //pesquisar obras
		$this->layout = 'blank';
		$this->loadModel('Obra');
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
		//pr($obra);
		
		$this->loadModel('Projeto');
		$projetos = $this->Projeto->find('all', array('order' => 'projeto_tipo', 'conditions' => array('Projeto.obra_id' => $id)));
		//pr($projetos);
		
		$this->loadModel('Lista_funcionario');
		$listafuncs = $this->Lista_funcionario->find('all', array('recursive' => 2, 'order' => 'funcionario_nome', 'conditions' => array('Lista_funcionario.obra_id' => $id)));
		//pr($listafuncs);
		
		$this->loadModel('Lista_equipamento');
		$listaequips = $this->Lista_equipamento->find('all', array('recursive' => 2, 'order' => 'equipamento_nome', 'conditions' => array('Lista_equipamento.obra_id' => $id)));
		//pr($listaequips);
		
		$this->loadModel('Lista_material');
		$listamats = $this->Lista_material->find('all', array('recursive' => 2, 'order' => 'material_nome', 'conditions' => array('Lista_material.obra_id' => $id)));		
		//pr($listamats);
		
		$this->set(compact('projetos', 'listafuncs', 'listaequips', 'listamats', 'obra'));
	
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function search_mao_de_obra() { //pesquisar obras para alocação de mão de obra
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function des_alocar_mao_de_obra($id = null) { //alocar e desalocar mão de obra para Obra		
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
		$obraNome = $obra['Obra']['obra_nome'];
		$this->set('obra', $obraNome);
		$this->set('obraId', $id);
		
		$this->loadModel('Lista_funcionario');
		if ($this->request->is('get')) {
			$this->request->data = $this->Lista_funcionario->read();
		} else {
	        if(!empty($this->data)){
				$histerros = 0;
				$histsalvos = 0;
				if( ($this->data['Lista_funcionario']['funcionarios'] == '') ) {
		            $funcssel = $this->data['Lista_funcionario']['funcionarios'];
					$this->loadModel('Funcionario');
					$compfunc = $this->Funcionario->find('list', array('conditions' => array("NOT" => array('Funcionario.funcionario_id' => $funcssel) ), 'fields' => array('Funcionario.funcionario_id')));
					$desalocados = count($compfunc);
					$desalocadosId = array_keys($compfunc);
					
					//SALVAR HISTÓRICO DA DESALOCAÇÃO DE MÃO DE OBRA
					for($i = 0; $i < $desalocados; $i++) {
						$this->loadModel('Lista_funcionario');
						$lista_func_id = $this->Lista_funcionario->find('first', array('conditions' => array('Lista_funcionario.funcionario_id' => $desalocadosId[$i], 'Lista_funcionario.obra_id' => $id)));
						
						if(count($lista_func_id) > 0){
							$this->loadModel('Lista_funcionario_historico');
							$ultimo = $this->Lista_funcionario_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_funcionario_historico.obra_id' => $id)));
							$andamento = $ultimo['Lista_funcionario_historico']['andamento'] + 1;
							
							$ultimoID = $this->Lista_funcionario_historico->find('first', array('order' => array('listas_funcionarios_historicos_id' => 'desc')));
							$ultimoID = $ultimoID['Lista_funcionario_historico']['listas_funcionarios_historicos_id'];
							$ultimoID++;
															
							$this->Lista_funcionario_historico->set(array(
								'listas_funcionarios_historicos_id' => $ultimoID,
								'funcionario_id' => $lista_func_id['Lista_funcionario']['funcionario_id'],
								'obra_id' => $id,
								'andamento' => $andamento,
								'qtd_horas' => $lista_func_id['Lista_funcionario']['qtd_horas'],
								'situacao' => "Desalocado"
							));
							
							if($this->Lista_funcionario_historico->save()) { // atualiza o histórico de mão de obra
								if($this->request->is('Ajax')){    // o ajax roda aqui
									$this->render('delete','ajax');
				                } 
							} else {
								$histerros++;
				                $this->render('delete','ajax');
							}
						}
					}					
					
					$this->loadModel('Lista_funcionario');
					if ($this->Lista_funcionario->deleteAll(array('Lista_funcionario.obra_id' => $id, 'Lista_funcionario.funcionario_id' => $compfunc), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Não há mais funcionários alocados à obra em questão!','/obras/des_alocar_mao_de_obra');
							$this->redirect(array('action' => 'des_alocar_mao_de_obra'));
						}
						echo "<center>Não há mais funcionários alocados à obra em questão!</center>";
					}
				} else {
					$contar = count($this->data['Lista_funcionario']['funcionarios']); 
					for($i = 0; $i < $contar; $i++) {
						$esteFunc = $this->data['Lista_funcionario']['funcionarios'][$i];
						if($esteFunc != ''){
							$this->loadModel('Funcionario');
							$salfunc = $this->Funcionario->find('first', array('conditions' => array('Funcionario.funcionario_id' => $esteFunc)));
							$this->loadModel('Lista_funcionario');
							$listaID = $this->Lista_funcionario->find('first', array('conditions' => array('Lista_funcionario.funcionario_id' => $esteFunc)));
							
							$this->Lista_funcionario->set(array(
								'lista_funcionario_id' => $listaID['Lista_funcionario']['lista_funcionario_id'],
								'obra_id' => $this->data['Lista_funcionario']['oid'],
								'funcionario_id' => $esteFunc,
								'qtd_horas' => $this->data['funcionarioSel'][$i],
								'valor_hora' => $salfunc['Funcionario']['funcionario_salario']
							));
							if($this->Lista_funcionario->save()) {
								//SALVAR HISTÓRICO DA ALOCAÇÃO DE MÃO DE OBRA
								$this->loadModel('Lista_funcionario_historico');
								$ultimo = $this->Lista_funcionario_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_funcionario_historico.obra_id' => $id)));
								$andamento = $ultimo['Lista_funcionario_historico']['andamento'] + 1;
								
								$ultimoID = $this->Lista_funcionario_historico->find('first', array('order' => array('listas_funcionarios_historicos_id' => 'desc')));
								$ultimoID = $ultimoID['Lista_funcionario_historico']['listas_funcionarios_historicos_id'];
								$ultimoID++;
								
								$this->Lista_funcionario_historico->set(array(
									'listas_funcionarios_historicos_id' => $ultimoID,
									'funcionario_id' => $esteFunc,
									'obra_id' => $id,
									'andamento' => $andamento,
									'qtd_horas' => $this->data['funcionarioSel'][$i],
									'situacao' => "Alocado"
								));
								
								if($this->Lista_funcionario_historico->save()) { // atualiza o histórico de mão de obra
									if($this->request->is('Ajax')){    // o ajax roda aqui
										$histsalvos++;
										$this->render('delete','ajax');
					                } 
					                else{              
					                    $histsalvos++;
					                }
								} else {
									$histerros++;
					                $this->render('delete','ajax');
								}
								
								if($this->request->is('Ajax')){    // o ajax roda aqui
				                    $this->set('dados',$this->request->data);
				                    $this->render('success','ajax');
				                } 
				                else{              
				                    $this->flash('Adicionado com sucesso!','des_alocar_mao_de_obra');
				                    $this->redirect(array('action' => 'des_alocar_mao_de_obra'));
				                }
							} else {
								echo "<center> A alocação do funcionário ".$salfunc['Funcionario']['funcionario_nome']." falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
				                $this->render('delete','ajax');
							}
							
						}
					}
					$funcssel = $this->data['Lista_funcionario']['funcionarios'];
					$this->loadModel('Funcionario');
					$compfunc = $this->Funcionario->find('list', array('conditions' => array("NOT" => array('Funcionario.funcionario_id' => $funcssel) ), 'fields' => array('Funcionario.funcionario_id')));
					$desalocados = count($compfunc);
					$desalocadosId = array_keys($compfunc);
					
					//SALVAR HISTÓRICO DA DESALOCAÇÃO DE MÃO DE OBRA
					for($i = 0; $i < $desalocados; $i++) {
						$this->loadModel('Lista_funcionario');
						$lista_func_id = $this->Lista_funcionario->find('first', array('conditions' => array('Lista_funcionario.funcionario_id' => $desalocadosId[$i], 'Lista_funcionario.obra_id' => $id)));
						
						if(count($lista_func_id) > 0){
							$this->loadModel('Lista_funcionario_historico');
							$ultimo = $this->Lista_funcionario_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_funcionario_historico.obra_id' => $id)));
							$andamento = $ultimo['Lista_funcionario_historico']['andamento'] + 1;
							
							$ultimoID = $this->Lista_funcionario_historico->find('first', array('order' => array('listas_funcionarios_historicos_id' => 'desc')));
							$ultimoID = $ultimoID['Lista_funcionario_historico']['listas_funcionarios_historicos_id'];
							$ultimoID++;
															
							$this->Lista_funcionario_historico->set(array(
								'listas_funcionarios_historicos_id' => $ultimoID,
								'funcionario_id' => $lista_func_id['Lista_funcionario']['funcionario_id'],
								'obra_id' => $id,
								'andamento' => $andamento,
								'qtd_horas' => $lista_func_id['Lista_funcionario']['qtd_horas'],
								'situacao' => "Desalocado"
							));
							
							if($this->Lista_funcionario_historico->save()) { // atualiza o histórico de mão de obra
								if($this->request->is('Ajax')){    // o ajax roda aqui
									$this->render('delete','ajax');
				                } 
							} else {
								$histerros++;
				                $this->render('delete','ajax');
							}
						}
					}
					
					$this->loadModel('Lista_funcionario');
					if ($this->Lista_funcionario->deleteAll(array('Lista_funcionario.obra_id' => $id, 'Lista_funcionario.funcionario_id' => $compfunc), true)) {								
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Alguns funcionários foram desalocados da obra em questão!','/obras/des_alocar_mao_de_obra');
							$this->redirect(array('action' => 'des_alocar_mao_de_obra'));
						}
					}
				}
				if($histsalvos > 0) {
					echo "<center>Histórico de alocação de Mão de Obra atualizado com sucesso!</center>";
				}
				if($histerros > 0) {
					echo "<center>Histórico de alocação de Mão de Obra não foi atualizado para alguns Funcionários!</center>";
				}
	        }
		}  
	}
	
	public function pega_mao_de_obra(){ //preenche multiselect com Funcionários
		$obraID = $this->params['url']['obra_id'];
				
		if($obraID!='-1'){ // checa se o fornecedor é válido
			$this->loadModel('Lista_funcionario');			
			$funcssel = $this->Lista_funcionario->find('all', array('order' => array('funcionario_nome' => 'asc'), 'conditions' => array('Lista_funcionario.obra_id' => $obraID)));
			$funcsel = '';
			foreach($funcssel as $M):
				$funcsel[$M['Lista_funcionario']['funcionario_id']]=$M['Funcionario']['funcionario_id'];
			endforeach;
						
			$this->loadModel('Funcionario');
			$funcsnsel = $this->Funcionario->find('all', array('order' => array('funcionario_nome' => 'asc'), 'conditions' => array('Area.area_descricao' => 'Construcao', "NOT" => array('Funcionario.funcionario_id' => $funcsel))));
		}
		
		$this->set('funcnsel', $funcsnsel);
		$this->set('funcsel', $funcssel);
		$this->Render('pega_mao_de_obra','ajax');
	}
	
	public function search_equipamentos() { //pesquisar obras para alocação de equipamentos
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
    }
	
	public function des_alocar_equipamentos($id = null) { //alocar e desalocar equipamentos para Obra		
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
		$obraNome = $obra['Obra']['obra_nome'];
		$this->set('obra', $obraNome);
		$this->set('obraId', $id);
		
		$this->loadModel('Lista_equipamento');
		if ($this->request->is('get')) {
			$this->request->data = $this->Lista_equipamento->read();
		} else {
	        if(!empty($this->data)){
				$histerros = 0;
				$histsalvos = 0;
				if( ($this->data['Lista_equipamento']['equipamentos'] == '') ) {
		            $equipssel = $this->data['Lista_equipamento']['equipamentos'];
					$this->loadModel('Estoque_equipamentos');
					$compequip = $this->Estoque_equipamentos->find('list', array('conditions' => array("NOT" => array('Estoque_equipamentos.equipamento_id' => $equipssel) ), 'fields' => array('Estoque_equipamentos.equipamento_id', 'Estoque_equipamentos.equipamento_id')));
					$desalocados = count($compequip);
					$desalocadosId = array_keys($compequip);
					
					//SALVAR HISTÓRICO DA DESALOCAÇÃO DE EQUIPAMENTOS
					for($i = 0; $i < $desalocados; $i++) {
						$this->loadModel('Lista_equipamento');
						$lista_equip_id = $this->Lista_equipamento->find('first', array('conditions' => array('Lista_equipamento.equipamento_id' => $desalocadosId[$i], 'Lista_equipamento.obra_id' => $id)));
						
						if(count($lista_equip_id) > 0){
							$this->loadModel('Lista_equipamento_historico');
							$ultimo = $this->Lista_equipamento_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_equipamento_historico.obra_id' => $id)));
							$andamento = $ultimo['Lista_equipamento_historico']['andamento'] + 1;
							
							$ultimoID = $this->Lista_equipamento_historico->find('first', array('order' => array('listas_equipamentos_historicos_id' => 'desc')));
							$ultimoID = $ultimoID['Lista_equipamento_historico']['listas_equipamentos_historicos_id'];
							$ultimoID++;
															
							$this->Lista_equipamento_historico->set(array(
								'listas_equipamentos_historicos_id' => $ultimoID,
								'equipamento_id' => $lista_equip_id['Lista_equipamento']['equipamento_id'],
								'obra_id' => $id,
								'andamento' => $andamento,
								'qtd' => $lista_equip_id['Lista_equipamento']['qtd'],
								'valor_hora' => $lista_equip_id['Lista_equipamento']['valor_hora'],
								'qtd_horas' => $lista_equip_id['Lista_equipamento']['qtd_hora'],
								'situacao' => "Desalocado"
							));
							
							if($this->Lista_equipamento_historico->save()) { // atualiza o histórico de mão de obra
								if($this->request->is('Ajax')){    // o ajax roda aqui
									$this->render('delete','ajax');
				                } 
							} else {
								$histerros++;
				                $this->render('delete','ajax');
							}
						}
					}
					
					$this->loadModel('Lista_equipamento');
					if ($this->Lista_equipamento->deleteAll(array('Lista_equipamento.obra_id' => $id, 'Lista_equipamento.equipamento_id' => $compequip), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Não há mais equipamentos alocados à obra em questão!','/obras/des_alocar_equipamentos');
							$this->redirect(array('action' => 'des_alocar_equipamentos'));
						}
						echo "<center>Não há mais equipamentos alocados à obra em questão!</center>";
					}
				} else {
					$contar = count($this->data['Lista_equipamento']['equipamentos']); 
					for($i = 0; $i < $contar; $i++) {
						$esteEquip = $this->data['Lista_equipamento']['equipamentos'][$i];
						if($esteEquip != ''){
							$this->loadModel('Estoque_equipamentos');
							$valorEquip = $this->Estoque_equipamentos->find('first', array('conditions' => array('Estoque_equipamentos.equipamento_id' => $esteEquip)));							
							$this->loadModel('Lista_equipamento');
							$listaID = $this->Lista_equipamento->find('first', array('conditions' => array('Lista_equipamento.equipamento_id' => $esteEquip)));
							
							$this->Lista_equipamento->set(array(
								'lista_equipamento_id' => $listaID['Lista_equipamento']['lista_equipamento_id'],
								'equipamento_id' => $esteEquip,
								'obra_id' => $this->data['Lista_equipamento']['oid'],
								'qtd' => $valorEquip['Estoque_equipamentos']['quantidade'],
								'valor_hora' => $valorEquip['Estoque_equipamentos']['valor_hora'],
								'qtd_hora' => $this->data['equipamentoHora'][$i],
								'alugado' => $valorEquip['Estoque_equipamentos']['alugado'],
								'dt_aluguel_ini' => $valorEquip['Estoque_equipamentos']['dt_aluguel_ini'],
								'dt_aluguel_fim' => $valorEquip['Estoque_equipamentos']['dt_aluguel_fim']
							));
							
							if($this->Lista_equipamento->save()) {
								//SALVAR HISTÓRICO DA ALOCAÇÃO DE EQUIPAMENTOS
								$this->loadModel('Lista_equipamento_historico');
								$ultimo = $this->Lista_equipamento_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_equipamento_historico.obra_id' => $id)));
								$andamento = $ultimo['Lista_equipamento_historico']['andamento'] + 1;
								
								$ultimoID = $this->Lista_equipamento_historico->find('first', array('order' => array('listas_equipamentos_historicos_id' => 'desc')));
								$ultimoID = $ultimoID['Lista_equipamento_historico']['listas_equipamentos_historicos_id'];
								$ultimoID++;
								
								$this->Lista_equipamento_historico->set(array(
									'listas_equipamentos_historicos_id' => $ultimoID,
									'equipamento_id' => $esteEquip,
									'obra_id' => $id,
									'andamento' => $andamento,
									'qtd' => $valorEquip['Estoque_equipamentos']['quantidade'],
									'qtd_horas' => $this->data['equipamentoHora'][$i],
									'valor_hora' => $valorEquip['Estoque_equipamentos']['valor_hora'],
									'situacao' => "Alocado"
								));
								
								if($this->Lista_equipamento_historico->save()) { // atualiza o histórico de mão de obra
									if($this->request->is('Ajax')){    // o ajax roda aqui
										$histsalvos++;
										$this->render('delete','ajax');
					                } 
					                else{              
					                    $histsalvos++;
					                }
								} else {
									$histerros++;
					                $this->render('delete','ajax');
								}
								
								if($this->request->is('Ajax')){    // o ajax roda aqui
				                    $this->set('dados',$this->request->data);
				                    $this->render('success','ajax');
				                } 
				                else{              
				                    $this->flash('Adicionado com sucesso!','des_alocar_equipamentos');
				                    $this->redirect(array('action' => 'des_alocar_equipamentos'));
				                }
							} else {
								echo "<center> A alocação do equipamento ".$valorEquip['Equipamento']['equipamento_nome']." falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
				                $this->render('delete','ajax');
							}
						}
					}
					$equipssel = $this->data['Lista_equipamento']['equipamentos'];
					$this->loadModel('Estoque_equipamentos');
					$compequip = $this->Estoque_equipamentos->find('list', array('conditions' => array("NOT" => array('Estoque_equipamentos.equipamento_id' => $equipssel) ), 'fields' => array('Estoque_equipamentos.equipamento_id', 'Estoque_equipamentos.equipamento_id')));
					$desalocados = count($compequip);
					$desalocadosId = array_keys($compequip);
					
					//SALVAR HISTÓRICO DA DESALOCAÇÃO DE EQUIPAMENTOS
					for($i = 0; $i < $desalocados; $i++) {
						$this->loadModel('Lista_equipamento');
						$lista_equip_id = $this->Lista_equipamento->find('first', array('conditions' => array('Lista_equipamento.equipamento_id' => $desalocadosId[$i], 'Lista_equipamento.obra_id' => $id)));
						
						if(count($lista_equip_id) > 0){
							$this->loadModel('Lista_equipamento_historico');
							$ultimo = $this->Lista_equipamento_historico->find('first', array('order' => array('andamento' => 'desc'), 'conditions' => array('Lista_equipamento_historico.obra_id' => $id)));
							$andamento = $ultimo['Lista_equipamento_historico']['andamento'] + 1;
							
							$ultimoID = $this->Lista_equipamento_historico->find('first', array('order' => array('listas_equipamentos_historicos_id' => 'desc')));
							$ultimoID = $ultimoID['Lista_equipamento_historico']['listas_equipamentos_historicos_id'];
							$ultimoID++;
															
							$this->Lista_equipamento_historico->set(array(
								'listas_equipamentos_historicos_id' => $ultimoID,
								'equipamento_id' => $lista_equip_id['Lista_equipamento']['equipamento_id'],
								'obra_id' => $id,
								'andamento' => $andamento,
								'qtd' => $lista_equip_id['Lista_equipamento']['qtd'],
								'valor_hora' => $lista_equip_id['Lista_equipamento']['valor_hora'],
								'qtd_horas' => $lista_equip_id['Lista_equipamento']['qtd_hora'],
								'situacao' => "Desalocado"
							));
							
							if($this->Lista_equipamento_historico->save()) { // atualiza o histórico de mão de obra
								if($this->request->is('Ajax')){    // o ajax roda aqui
									$this->render('delete','ajax');
				                } 
							} else {
								$histerros++;
				                $this->render('delete','ajax');
							}
						}
					}
					
					$this->loadModel('Lista_equipamento');
					if ($this->Lista_equipamento->deleteAll(array('Lista_equipamento.obra_id' => $id, 'Lista_equipamento.equipamento_id' => $compequip), true)) {
						if($this->request->is('Ajax')){    // o ajax roda aqui
			                $this->set('dados',$this->request->data);
			                $this->render('success','ajax');
			            } else {
							$this->flash('Alguns equipamentos foram desalocados da obra em questão!','/obras/des_alocar_equipamentos');
							$this->redirect(array('action' => 'des_alocar_equipamentos'));
						}
					}
				}
				if($histsalvos > 0) {
					echo "<center>Histórico de alocação de Equipamentos atualizado com sucesso!</center>";
				}
				if($histerros > 0) {
					echo "<center>Histórico de alocação de Equipamentos não foi atualizado para alguns Equipamentos!</center>";
				}
	        }
		}  
	}
	
	public function pega_equipamentos() { //preenche multiselect com Equipamentos
		$obraID = $this->params['url']['obra_id'];
				
		if($obraID!='-1'){ // checa se o fornecedor é válido
			$this->loadModel('Lista_equipamento');			
			$equipssel = $this->Lista_equipamento->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Lista_equipamento.obra_id' => $obraID)));
			$equipsel = '';
			foreach($equipssel as $M):
				$equipsel[$M['Lista_equipamento']['equipamento_id']]=$M['Equipamento']['equipamento_id'];
			endforeach;
						
			$this->loadModel('Estoque_equipamentos');
			$equipsnsel = $this->Estoque_equipamentos->find('all', array('order' => array('equipamento_nome' => 'asc'), 'conditions' => array('Estoque_equipamentos.quantidade >' => 0, "NOT" => array('Equipamento.equipamento_id' => $equipsel))));
		}
		
		$this->set('equipnsel', $equipsnsel);
		$this->set('equipsel', $equipssel);
		$this->Render('pega_equipamentos','ajax');
	}
	
	public function search_hist_mao_de_obra() { //pesquisar obras para visualização do histórico de alocação de mão de obra
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function hist_mao_de_obra($id = null) {
		$this->loadModel('Obra');
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
	
		$this->loadModel('Lista_funcionario_historico');
		$historico = $this->Lista_funcionario_historico->find('all', array('order' => 'andamento', 'conditions' => array('Lista_funcionario_historico.obra_id' => $id)));
		
		$custo = $this->Lista_funcionario_historico->find('all', array('conditions' => array('Lista_funcionario_historico.obra_id' => $id, 'Lista_funcionario_historico.situacao' => "Alocado")));
		$this->set(compact('historico', 'obra', 'custo'));
	}
	
	public function search_hist_equipamentos() { //pesquisar obras para visualização do histórico de alocação de equipamentos
		if (!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'obra_data_inicio' || $tipo == 'obra_data_fim') {
				//Data formatada como dd/mm/yyyy
				list($d, $m, $y) = preg_split('/\//', $pesquisa);
				
				$pesquisa = sprintf('%4d-%02d-%02d', $y, $m, $d);
			} 
			$results = $this->Obra->find('all', array('conditions' => array('Obra.'.$tipo.' LIKE' => "%$pesquisa%")));
		} 
		if (!empty($results)){
			$this->set(compact('results'));
        }
	}
	
	public function hist_equipamentos($id = null) {
		$this->loadModel('Obra');
		$obra = $this->Obra->find('first', array('conditions' => array('Obra.obra_id' => $id)));
	
		$this->loadModel('Lista_equipamento_historico');
		$historico = $this->Lista_equipamento_historico->find('all', array('order' => 'andamento', 'conditions' => array('Lista_equipamento_historico.obra_id' => $id)));
		
		$custo = $this->Lista_equipamento_historico->find('all', array('conditions' => array('Lista_equipamento_historico.obra_id' => $id, 'Lista_equipamento_historico.situacao' => "Alocado")));
		$this->set(compact('historico', 'obra', 'custo'));
	}
}
?>