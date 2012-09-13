<?php  
	echo $this->Html->script("validationFornecedor", false); 
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Fornecedor'); ?> <!-- início do formulário -->
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			<div class="campos">Nome: </div>
			
			<div class="campos"><div style="color: #ee0;">CNPJ:</div></div>
			
			<div class="campos">Estado: </div>
			
			<div class="campos">Cidade: </div>
			
			<div class="campos"><div style="color: #ee0;">Descrição: </div></div>						
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
            <div class="campos">
			<?php echo $this->Form->input('fornecedor_nome', array('label' => '', 'id' => 'fornecedor_nome', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_cnpj', array('label' => '', 'id' => 'fornecedor_cnpj', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_estado', array('label' => '', 'id' => 'fornecedor_estado', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_cidade', array('label' => '', 'id' => 'fornecedor_cidade', 'class' => array('intexto'))); ?>
            </div>			
            
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_descricao', array('label' => '', 'id' => 'fornecedor_descricao', 'class' => array('descricao'))); ?>
			</div>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			<div class="campos">Bairro: </div>
			
			<div class="campos">Endereço: </div>
			
			<div class="campos"><div style="color: #ee0;">Telefone: </div></div>
			
			<div class="campos">E-mail: </div>
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_bairro', array('label' => '', 'id' => 'fornecedor_bairro', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_endereco', array('label' => '', 'id' => 'fornecedor_endereco', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_contato', array('label' => '', 'id' => 'fornecedor_contato', 'class' => array('intexto'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->input('fornecedor_email', array('label' => '', 'id' => 'fornecedor_email', 'class' => array('intexto'))); ?>
			</div>
		</div>
	<div class="legenda">
		<div style="font-size: 120%;">Legenda</div>
		<div style="text-align: justify; padding: 0 0 0 30%;">Itens Obrigatórios</div>
		<div style="text-align: justify; padding: 0 0 0 30%; color: #ee0">Itens Opcionais</div>
	</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Cadastrar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success'
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->   