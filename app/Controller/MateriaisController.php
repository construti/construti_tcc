<?php


App::uses('AppController', 'Controller');



class MateriaisController extends AppController {
                                        
    public $helpers = array('Form','Js');
    public $components = array('RequestHandler');
	public $name = 'Materiais';
	var $uses = array('Material');
 	
    public function index(){
        $this->render('add');
    } 
               
    public function add(){
		$Embalagem = $this->loadModel('Embalagem');
		$embalagens = $this->Embalagem->find('list', array('fields' => array('embalagem_tipo'),'order' => array('embalagem_tipo' => 'asc'	)));
		$Medida = $this->loadModel('Medida');
		$medidas = $this->Medida->find('list', array('fields' => array('medida_tipo'),'order' => array('medida_tipo' => 'asc')));
		
		$this->set(compact('medidas','embalagens')); 
		
        if(!empty($this->data)){
            if($this->Material->save($this->data)){
				$this->loadModel('Estoque_materiais');
				$this->Estoque_materiais->set(array( 
						'material_id' => $this->Material->id
					));
					
				if($this->Estoque_materiais->save()) { //atualizar tabela de estoque de Materiais com ID do novo Material
					if($this->request->is('Ajax')){    // o ajax roda aqui
						echo "<center> ID do Material adicionado ao estoque! </center>";
						$this->render('delete','ajax');
	                } 
	                else{              
	                    $this->flash('ID do Material adicionado ao estoque!','add');
	                }
				} else {
					echo "<center> ID do Material não foi adicionado ao estoque! </center>";
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
   
   public function validate_form(){
       $this->layout = 'ajax';
        if($this->request->is('Ajax')){  
            $this->request->data['Material'][$this->request->data['field']] = $this->request->data['value']; 
            $error = '' ;
			
            if($this->request->data['field'] == 'material_nome' ) {
                if(empty($this->data['Material']['material_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'material_tipo' ) {
                if(empty($this->data['Material']['material_tipo'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
            
            $this->set('error', $error);
            
        }
   } 
   
   public function search(){
       if(!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            $tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
			
			if ($tipo == 'tipo') {
				$this->loadModel('Material_tipo');
				$tipoIds = $this->Material_tipo->find('list', array('conditions' => array('Material_tipo.material_tipo_nome LIKE' => "%$pesquisa%"), 'fields' => array('Material_tipo.material_tipo_id')));
				$results = $this->Material->find('all', array('conditions' => array('Material.material_tipo' => $tipoIds)));				
			} else {
            	$results = $this->Material->find('all', array('conditions' => array('Material.material_'.$tipo.' LIKE' => "%$pesquisa%")));
			}
       } 
       if (!empty($results)){
            $this->set(compact('results'));
        }
        $this->render('search','construtilayout');
    }
    
    public function delete($id) { //deletar um material
		   if (!$this->request->is('post')) {
				   throw new MethodNotAllowedException();
		   }
		   if ($this->Material->delete($id)) {
			   if($this->request->is('Ajax')){    // o ajax roda aqui
				   $this->set('dados',$this->request->data);
				   $this->render('success','ajax');
				} 
				else {
				   $this->flash('O Material de ID '.$id.' foi deletado.','/materiais/search');
				   $this->redirect(array('action' => 'search'));
			   }
		   }                
   }
    
    public function edit($id = null){   
        $this->Material->id = $id;
		
		$Embalagem = $this->loadModel('Embalagem');
		$embalagens = $this->Embalagem->find('list', array('fields' => array('embalagem_tipo'),'order' => array('embalagem_tipo' => 'asc'	)));
		$Medida = $this->loadModel('Medida');
		$medidas = $this->Medida->find('list', array('fields' => array('medida_tipo'),'order' => array('medida_tipo' => 'asc')));
		
		$this->set(compact('medidas','embalagens')); 
		
        if ($this->request->is('get')) {
           $this->request->data = $this->Material->read(); 
        } else {                    
            if ($this->Material->save($this->request->data)) {
                if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } else {
                    $this->flash('Material atualizado.','/materiais/search');
                    $this->redirect(array('action' => 'search'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }
    }
   
    
}

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     