 <?php 
	if(!empty($this->data['Embalagem']['embalagem_id'])) { ?>
		 <script>
			$(document).ready(function() {
				$('#embalagem_id').val('<?php echo $this->data['Embalagem']['embalagem_id'] ?>');
			});
		 </script>
 <?php } ?>

<?php  
	echo $this->Html->script("validationEmbalagem", false);
	$this->pageTitle = 'Embalagens';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Embalagem', array('type' => 'file', 'controller' => 'embalagens', 'action' => 'add', 'admin' => true)); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Embalagem: <br/><br/>
			Nome: <br/><br/>
						 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('embalagem_tipo', array('label' => '', 'id' => 'embalagem_tipo', 'class' => array('intexto'))); ?>
			<br/>
			
		</div>
		<div id="areaBotao">  <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Salvar', array(
                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
                    'update' => '#success'
                ));
                echo $this->Form->end(); 
            ?>
        </div>
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> <!-- corpo do formulário -->
<div id="formulariofim"></div> <!-- final do formulário -->                               