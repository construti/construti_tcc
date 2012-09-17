<?php  
	echo $this->Html->script("validationObra", false); 
	$this->pageTitle = 'Obras';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Obra'); ?> <!-- início do formulário -->
	
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			Título: <br/><br/>
			
			Responsável: <br/><br/>
			
			Data de Início: <br/><br/>
			
			Estado: <br/><br/>
			
			Bairro: <br/><br/>
			
			Descrição: <br/><br/>
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
            <?php echo $this->Form->input('obra_nome', array('label' => '', 'id' => 'obra_nome', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->select('obra_responsavel', $responsavel, array('label' => '', 'id' => 'responsavel', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			<br><br>
			<?php echo $this->Form->input('obra_data_inicio', array('label' => '', 'id' => 'obra_data_inicio', 'minYear' => date('Y') - 10, 'maxYear' => date('Y') + 20, 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('obra_estado', array('label' => '', 'id' => 'obra_estado', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('obra_bairro', array('label' => '', 'id' => 'obra_bairro', 'class' => array('intexto'))); ?>
			<br/>
			 <?php echo $this->Form->input('obra_descricao', array('label' => '', 'id' => 'obra_descricao', 'class' => array('descricao'))); ?>
			 <br>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			Tipo: <br/><br/>
			
			Status: <br/><br/>
			
			Data de Término: <br/><br/>
			
			Cidade: <br/><br/>
			
			Endereço: <br/><br/>
			
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<?php $opcoes_tipo = array('R' => 'Residencial', 'C' => 'Comercial' ,'I' => 'Industrial');
				  echo $this->Form->select('obra_tipo', $opcoes_tipo, array('label' => '', 'id' => 'obra_tipo', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			<br/><br/>
			<?php $opcoes_status = array('AI' => 'A Iniciar', 'EA' => 'Em Andamento' , 'PA' => 'Parada');
				  echo $this->Form->select('obra_status', $opcoes_status, array('label' => '', 'id' => 'obra_status', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			<br/><br/>
			<?php echo $this->Form->input('obra_data_fim', array('label' => '', 'id' => 'obra_data_fim', 'minYear' => date('Y') - 10, 'maxYear' => date('Y') + 30, 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('obra_cidade', array('label' => '', 'id' => 'obra_cidade', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('obra_endereco', array('label' => '', 'id' => 'obra_endereco', 'class' => array('intexto'))); ?>
			<br/>
			
		</div>
				
		<div id="areaBotao"> <!-- botão de cadastro -->
		<?php 
            echo $this->Js->submit('Cadastrar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success'
            ));
            echo $this->Form->end(); // fim do formulário
        ?>
		</div> 
		<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
		<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
		

</div> 
<div id="formulariofim"></div> <!-- final do formulário -->