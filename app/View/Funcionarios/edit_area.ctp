<?php  
	echo $this->Html->script("validationArea", false); 
	$this->pageTitle = 'Funcionários';
?>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização de Áreas de Funcionários</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Area'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Área:</div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?> 
            <div class="campos">
			<?php echo $this->Form->input('area_descricao', array('label' => '', 'id' => 'area_descricao', 'class' => array('intexto'))); ?>
			</div>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Atualizar', array(
                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
                    'update' => '#success'
                ));
                echo $this->Form->end(); 
            ?>
        </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div>
<div id="formulariofim"></div> <!-- final do formulário -->