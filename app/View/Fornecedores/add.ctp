<?php  
	echo $this->Html->script("validationFornecedor", false); 
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Fornecedor'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Nome: <br/><br/>
			Contato: <br/><br/>
			E-mail: <br/><br/>
			Tipo: <br/><br/>
			Descrição: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->input('fornecedor_nome', array('label' => '', 'id' => 'fornecedor_nome', 'class' => array('intexto'))); ?>
            </br>
			<?php echo $this->Form->input('fornecedor_contato', array('label' => '', 'id' => 'fornecedor_contato', 'class' => array('intexto'))); ?>
            </br>
			<?php echo $this->Form->input('fornecedor_email', array('label' => '', 'id' => 'fornecedor_email', 'class' => array('intexto'))); ?>
			</br>
			<?php $opcoes_tipo = array('equipamento' => 'Equipamento', 
									   'material' => 'Material', 
									   'completo' => 'Completo'
									   );
				  echo $this->Form->select('fornecedor_tipo', $opcoes_tipo, array('label' => '', 'id' => 'fornecedor_tipo', 'class' => array('intexto'))); ?>
			<br/><br/>
            <?php echo $this->Form->input('fornecedor_descricao', array('label' => '', 'id' => 'fornecedor_descricao', 'class' => array('descricao'))); ?>
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