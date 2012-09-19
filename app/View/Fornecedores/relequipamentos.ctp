<?php  
	echo $this->Html->script("validationFornecedor", false);
	echo $this->Html->script('jquery-ui', array('inline' => false));
	echo $this->Html->script('plugins/localisation/jquery.localisation-min', array('inline' => false));
	echo $this->Html->script('plugins/scrollTo/jquery.scrollTo-min', array('inline' => false));
	echo $this->Html->script('ui.multiselect', array('inline' => false));
	$this->pageTitle = 'Fornecedores';
?> 

<script>	
	$(function(){
		$.localise('ui-multiselect', {/*language: 'en', */path: 'js/locale/'});
		$("#equipamento_id").multiselect();
	});
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Relacionar Equipamentos</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Fornecedor_equipamentos'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Fornecedor: </div>
			
			<div class="campos">Equipamentos: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <div class="campos">
			<?php echo $this->Form->select('fornecedor_id', $fornecedores, array('label' => '', 'id' => 'fornecedor_id', 'empty' => 'Escolha...')); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->select('equipamento_id', $equipamentos, array('label' => '', 'id' => 'equipamento_id', 'class' => array('multiselect'), 'multiple' => 'multiple')); ?>
            </div>
			<?php  ?> 
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