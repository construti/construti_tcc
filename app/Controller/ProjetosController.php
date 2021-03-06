<?php


App::uses('AppController', 'Controller');



class ProjetosController extends AppController {
                                        
    public $helpers = array('Form','Js');
    public $components = array('RequestHandler');
	public $name = 'Projetos';
	//var $uses = array('Projeto');
 	
    public function index(){
		
        $this->render('add');
    } 
               
    public function add(){
		$this->loadModel('Obra');
				
		$projeto_obras = $this->Obra->find('list', array('order' => array('obra_nome' => 'asc'), 'fields' => array('Obra.obra_nome')));
		$this->set('projeto_obras',$projeto_obras);
		
        if(!empty($this->data)){
			// TRATANDO ARQUIVOS
			$arquivos = explode(";",$this->data["Projeto"]["arquivos"]);
			$string = "";
            $separador = "";
            for($i=0;$i < count($arquivos)-1;$i++){
                $string .= $separador."files/arquivos_projetos/".$arquivos[$i];
                $separador = ";";
            }
 
            $img_thumb = explode(";", $string);
            //$this->data["Trabalho"]["img_thumb"] = "../".$img_thumb[0];
			//pr($string);
			//pr($this->data["Projeto"]["projeto_arquivo"]);
            $this->request->data["Projeto"]["projeto_arquivo"] = $string;
			// FIM --- TRATANDO ARQUIVOS
			
			$projeto_nome = $this->Obra->find('first', array('fields' => array('Obra.obra_nome'), 'conditions' => $this->request->data["Projeto"]["obra_id"]));
			$this->request->data["Projeto"]["projeto_nome"] = $projeto_nome['Obra']['obra_nome'];
			
            if($this->Projeto->save($this->data)){
                
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
            $this->request->data['Projeto'][$this->request->data['field']] = $this->request->data['value']; 
            $error = '';
            if($this->request->data['field'] == 'obra_id' ) {
                if(empty($this->data['Projeto']['obra_id'])) {
                    $error = 'este campo não pode ser vazio!';
                }
            }
			
			if($this->request->data['field'] == 'projeto_tipo' ) {
                if(empty($this->data['Projeto']['projeto_tipo'])) {
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
            
            $results = $this->Projeto->find('all', array('conditions' => array('Projeto.projeto_'.$tipo.' LIKE' => "%$pesquisa%")));
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
		   if ($this->Projeto->delete($id)) {
			   if($this->request->is('Ajax')){    // o ajax roda aqui
				   $this->set('dados',$this->request->data);
				   $this->render('success','ajax');
				} 
				else {
				   $this->flash('O Projeto de ID '.$id.' foi deletado.','/projetos/search');
				   $this->redirect(array('action' => 'search'));
			   }
		   }                
   }
    
    public function edit($id = null){   
        $this->Projeto->id = $id;
		$this->loadModel('Obra');		
		$projeto_obras = $this->Obra->find('list', array('order' => array('obra_nome' => 'asc'), 'fields' => array('Obra.obra_nome')));
		$this->set('projeto_obras',$projeto_obras);
        if ($this->request->is('get')) {
           $this->request->data = $this->Projeto->read(); 
        } else {                    
            if ($this->Projeto->save($this->request->data)) {
                if($this->request->is('Ajax')){    // o ajax roda aqui
                    $this->set('dados',$this->request->data);
                    $this->Render('success','ajax');
                } else {
                    $this->flash('Projeto atualizado.','/projetos/search');
                    $this->redirect(array('action' => 'search'));
                }
            } else {
				echo "<center> O cadastro falhou, verifique se todos os campos obrigatórios foram preenchidos! </center>";
                $this->render('delete','ajax');
			}
        }
    }
   
    
}

     