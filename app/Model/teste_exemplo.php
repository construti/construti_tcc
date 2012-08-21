<?php
class Teste extends AppModel{
    var $name = 'Teste';
    
       var $validate = array(
        'fieldName1' => array(
            'rule' => 'ruleName', // ou: array('ruleName', 'param1', 'param2' ...)
            'required' => true,
            'allowEmpty' => false,
            'on' => 'create', // ou: 'update'
            'message' => 'Sua mensagem de erro'
        ) ,
        'fieldName2' => array(
            'rule' => 'ruleName', // ou: array('ruleName', 'param1', 'param2' ...)
            'required' => true,
            'allowEmpty' => false,
            'on' => 'create', // ou: 'update'
            'message' => 'Sua mensagem de erro'
        )
    );

}
?>