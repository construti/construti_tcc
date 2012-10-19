<?php  
	echo $this->Html->script("validationTaxas", false); 
	$this->pageTitle = 'Obras';
?>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Registro de Taxas de Obra Pagas</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Obra_taxa'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Obra: </div>
			<div class="campos">Taxa: </div>
			<div class="campos">Custo: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos">
				<?php echo $this->Form->input('obra_id', array('label' => '', 'id' => 'obra_id', 'value' => $obraId, 'type' => 'hidden')); ?>
				<?php echo $this->Form->input('obra', array('label' => '', 'id' => 'obra', 'value' => $obra, 'readonly', 'class' => array('intextoDes'))); ?>
            </div>
            <div class="campos">
				<?php $opcoes_tipo = array(
					'Água' => 'Água', 
					'Alimentação' => 'Alimentação',
					'COFINS' => 'COFINS',
					'Esgoto' => 'Esgoto',
					'ISS' => 'ISS',
					'Luz' => 'Luz' ,
					'PASEP' => 'PASEP',
					'PIS' => 'PIS',
					'Telefone' => 'Telefone',
					'Transporte' => 'Transporte',
					'Xerox' => 'Xerox'
				);
				  echo $this->Form->select('descricao', $opcoes_tipo, array('label' => '', 'id' => 'descricao', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
			</div>
			<div class="campos">
				<?php echo $this->Form->input('custo', array('label' => '', 'id' => 'custo', 'class' => array('intexto'))); ?>
			</div>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Registrar', array(
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