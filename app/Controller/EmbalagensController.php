<?php


App::uses('AppController', 'Controller');



class EmbalagensController extends AppController {
                                        
    public $helpers = array('Form','Js');
    public $components = array('RequestHandler');
	public $name = 'Embalagens';
	var $uses = array('Embalagem');
 	
    public function index(){
		
        $this->render('add');
    } 
               
    public function add(){
				
        if(!empty($this->data)){
						
            if($this->Embalagem->save($this->data)){
                
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
            $this->request->data['Embalagem'][$this->request->data['field']] = $this->request->data['value']; 
            //pr($this->request->data);  
            $error = '';
           			
			if($this->request->data['field'] == 'embalagem_tipo' ) {
                if(empty($this->data['Embalagem']['embalagem_tipo'])) {
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
            
            $results = $this->Embalagem->find('all', array('conditions' => array('Embalagem.embalagem_tipo LIKE' => "%$pesquisa%")));
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
		   if ($this->Embalagem->delete($id)) {
			   if($this->request->is('Ajax')){    // o ajax roda aqui
				   $this->set('dados',$this->request->data);
				   $this->render('success','ajax');
				} 
				else {
				   $this->flash('A Embalagem de ID '.$id.' foi deletado.','/embalagens/search');
				   $this->redirect(array('action' => 'search'));
			   }
		   }                
   }
    
    public function edit($id = null){   
        $this->Embalagem->id = $id;
        if ($this->request->is('get')) {
           $this->request->data = $this->Embalagem->read(); 
        } else {                    
            if ($this->Embalagem->save($this->request->data)) {
                if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } else {
                    $this->flash('Embalagem atualizada.','/embalagens/search');
                    $this->redirect(array('action' => 'search'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }
    }
   
    
}

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     