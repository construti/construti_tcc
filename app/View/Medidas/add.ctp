<?php  
	echo $this->Html->script("validationMedida", false); 
	$this->pageTitle = 'Medidas';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Medida', array('type' => 'file', 'controller' => 'medidas', 'action' => 'add', 'admin' => true)); ?> <!-- início do formulário -->
		* = Campos Obrigatórios 
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Tipo:* <br/><br/>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('medida_tipo', array('label' => '', 'id' => 'medida_tipo', 'class' => array('intexto'))); ?>
			<br>
		</div>
		<div id="areaBotao">  <!-- botão de cadastro -->
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
<div id="formulariofim"></div> <!-- final do formulário -->                               