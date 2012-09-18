<?php


App::uses('AppController', 'Controller');



class Materiais_tiposController extends AppController {
                                        
    public $helpers = array('Form','Js');
    public $components = array('RequestHandler');
	public $name = 'Materiais_tipos';
	var $uses = array('Material_tipo');
 	
    public function index(){
		
        $this->render('add');
    } 
               
    public function add(){
				
        if(!empty($this->data)){
						
            if($this->Material_tipo->save($this->data)){
                
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
            $this->request->data['Material_tipo'][$this->request->data['field']] = $this->request->data['value']; 
            //pr($this->request->data);  
            $error = '';
           			
			if($this->request->data['field'] == 'material_tipo_nome' ) {
                if(empty($this->data['Material_tipo']['material_tipo_nome'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			           
            $this->set('error', $error);
            
        }
   } 
   
   public function search(){
       
       if(!empty($this->data['pesquisa'])){
            $pesquisa = $this->data['pesquisa']; //guarda a palavra a ser pesquisada
            //$tipo = $this->data['tipo']; //guarda o tipo da palavra a ser pesquisada
            
            $results = $this->Material_tipo->find('all', array('conditions' => array('Material_tipo.material_tipo_nome LIKE' => "%$pesquisa%")));
       } 
       if (!empty($results)){
            $this->set(compact('results'));
        }
        $this->render('search','construtilayout');
    }
    
    public function delete($id) { //deletar um Projeto
		   if (!$this->request->is('post')) {
				   throw new MethodNotAllowedException();
		   }
		   if ($this->Material_tipo->delete($id)) {
			   if($this->request->is('Ajax')){    // o ajax roda aqui
				   $this->set('dados',$this->request->data);
				   $this->render('success','ajax');
				} 
				else {
				   $this->flash('O tipo de material de ID '.$id.' foi deletado.','/materiais_tipos/search');
				   $this->redirect(array('action' => 'search'));
			   }
		   }                
   }
    
    public function edit($id = null){   
        $this->Material_tipo->id = $id;
        if ($this->request->is('get')) {
           $this->request->data = $this->Material_tipo->read(); 
        } else {                    
            if ($this->Material_tipo->save($this->request->data)) {
                if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } else {
                    $this->flash('Tipo de Material atualizado.','/embalagens/search');
                    $this->redirect(array('action' => 'search'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }
    }
   
    
}

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     