<?php  
	echo $this->Html->script("validationTipo", false); 
	$this->pageTitle = 'Tipos de Equipamentos';
?>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Equipamentos_tipo'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Tipo: </div>
			<div class="campos">Valor/Hora:</div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?> 
            <div class="campos">
			<?php echo $this->Form->input('tipo_equipamento', array('label' => '', 'id' => 'tipo_equipamento', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('tipo_valor_hora', array('label' => '', 'id' => 'tipo_valor_hora', 'class' => array('intexto'))); ?>
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