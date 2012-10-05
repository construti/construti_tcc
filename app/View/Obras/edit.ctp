<?php  
	echo $this->Html->script("validationObra", false); 
	$this->pageTitle = 'Obras';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Obra'); ?> <!-- início do formulário -->
		<div class="legenda">* = Campos Obrigatórios</div>
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			<div class="campos">Título*: </div>
			
			<div class="campos">Responsável*: </div>
			
			<div class="campos">Início previsto*: </div>
			
			<div class="campos">Estado*: </div>
			
			<div class="campos">Bairro*: </div>
			
			<div class="campos">Descrição: </div>
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="campos">
			<?php echo $this->Form->input('obra_nome', array('label' => '', 'id' => 'obra_nome', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->select('obra_responsavel', $responsavel, array('label' => '', 'id' => 'responsavel', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_data_inicio', array('label' => '', 'id' => 'obra_data_inicio', 'minYear' => date('Y') - 10, 'maxYear' => date('Y') + 20, 'dateFormat' => 'DMY', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_estado', array('label' => '', 'id' => 'obra_estado', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_bairro', array('label' => '', 'id' => 'obra_bairro', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_descricao', array('label' => '', 'id' => 'obra_descricao', 'class' => array('descricao'))); ?>
			</div>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			<div class="campos">Tipo*: </div>
			
			<div class="campos">Situação*: </div>
			
			<div class="campos">Término previsto*: </div>
			
			<div class="campos">Cidade*: </div>
			
			<div class="campos">Endereço*: </div>
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<div class="campos">
			<?php $opcoes_tipo = array('R' => 'Residencial', 'C' => 'Comercial' ,'I' => 'Industrial');
				  echo $this->Form->select('obra_tipo', $opcoes_tipo, array('label' => '', 'id' => 'obra_tipo', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
			</div>
			
			<div class="campos">
			<?php 
				  echo $this->Form->select('obra_status', $status, array('label' => '', 'id' => 'obra_status', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_data_fim', array('label' => '', 'id' => 'obra_data_fim', 'minYear' => date('Y') - 10, 'maxYear' => date('Y') + 30, 'dateFormat' => 'DMY', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_cidade', array('label' => '', 'id' => 'obra_cidade', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('obra_endereco', array('label' => '', 'id' => 'obra_endereco', 'class' => array('intexto'))); ?>
			</div>
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