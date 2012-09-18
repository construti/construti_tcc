<?php  
	echo $this->Html->script("validationArea", false); 
	$this->pageTitle = 'Áreas de Funcionários';
?>

<div id="tituloform">Cadastro de Área de Funcionários</div> <!-- título do formulário -->
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Area'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Área:</div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <div class="campos">
			<?php echo $this->Form->input('area_descricao', array('label' => '', 'id' => 'area_descricao', 'class' => array('intexto'))); ?>
			</div>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Cadastrar', array(
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