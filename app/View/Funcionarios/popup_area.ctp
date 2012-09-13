<?php  
	echo $this->Html->script("validationArea", false); 
	$this->pageTitle = 'Áreas';
?>

<div id="tituloform">Cadastro de Área</div> <!-- título do formulário -->
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Area'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Área:
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->input('area_descricao', array('label' => '', 'id' => 'area_descricao', 'class' => array('intexto'))); ?>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Cadastrar', array(
                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
                    'update' => '#success',
					'complete' => 
                ));
                echo $this->Form->end(); 
            ?>
        </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 