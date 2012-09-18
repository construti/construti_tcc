 <?php 
	if(!empty($this->data['Material_tipo']['material_tipo_id'])) { ?>
		 <script>
			$(document).ready(function() {
				$('#material_tipo_id').val('<?php echo $this->data['Material_tipo']['material_tipo_id'] ?>');
			});
		 </script>
 <?php } ?>

<?php  
	echo $this->Html->script("validationMaterial_tipo", false);
	$this->pageTitle = 'Tipos de Materiais';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material_tipo', array('type' => 'file', 'controller' => 'materiais_tipos', 'action' => 'add', 'admin' => true)); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Tipo Material: <br/><br/>
			Nome: <br/><br/>
						 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('material_tipo_nome', array('label' => '', 'id' => 'material_tipo_nome', 'class' => array('intexto'))); ?>
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