<?php  
	echo $this->Html->script("validationRequisicao", false); 
	$this->pageTitle = 'Requisições';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Requisição de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Requisicao', array( 'enctype' => 'multipart/form-data')); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Para: <br/><br/>
			Arquivo: <br/><br/>
			Mensagem:
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->select('requisicao_email', $fornecedores, array('label' => '', 'id' => 'requisicao_email', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			<br/><br/>
			<?php echo $this->Form->input('Document.submittedfile' ,array('label' => '', 'type' => 'file' , 'id' => 'requisicao_arquivo')); ?>
            </br>
            <?php echo $this->Form->input('requisicao_mensagem', array('label' => '', 'id' => 'requisicao_mensagem', 'class' => array('intexto'))); ?>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php			
            echo $this->Form->end('Enviar'); //fim do formulário
        ?>
    </div> 
	<div id="success" style="text-align: center;"><?php echo $this->Session->flash('msg'); ?>  </div> <!-- mensagem de sucesso no cadastro -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->   