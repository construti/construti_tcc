<?php

App::uses('AppModel', 'Model');

class Area extends AppModel{
    var $name = 'Area';
	
	var $primaryKey = 'area_id';
	
	var $displayField = 'area_descricao';
		
}

?>