<?php

App::uses('AppController', 'Controller');

class TiposController extends AppController {
 
	public $name = 'Tipos';
	    
    public function getTipos($area_id = 1) {
		pr($this->request->data);
		
		$this->layout = 'ajax';
		
		$this->set('tipos', $this->Tipo->find('list', array(
	    'conditions' => array(
	      'Tipo.area_id' => $area_id     
	     ),
	    'fields' => array(
	      'id', 'nome'
	     ),
	   ))
	  );
		
		/*$area_id = $this->request->data['Funcionario']['funcionario_area'];
		 
		$tipos = $this->Tipos->find('list', array(
			'conditions' => array('Tipo.area_id' => $area_id),
			'recursive' => -1
			));
 
		$this->set('tipos', $tipos);*/
		
	}
    
}
?>