<?php  
	echo $this->Html->script("validationMaterial", false); 
	$this->pageTitle = 'Materiais';
?>
 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material'); ?> <!-- início do formulário -->
		<div class="legenda">* = Campos Obrigatórios</div>
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Nome*: </div> 
			<div class="campos">Tipo*: </div> 
			<div class="campos">Preço: </div> 
			<div class="campos">Descrição: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<div class="campos">
			<?php echo $this->Form->input('material_nome', array('label' => '', 'id' => 'material_nome', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php $opcoes_tipo = array('aco' => 'Aço', 'cal' => 'Cal' , 'cimento' => 'Cimento',
									   'madeira' => 'Madeira', 'parafuso' => 'Parafuso', 'prego' => 'Prego',
									   'telha' => 'Telha', 'tijolo' => 'Tijolo', 'viga' => 'Viga'
									   );
				  echo $this->Form->select('material_tipo', $opcoes_tipo, array('label' => '', 'id' => 'material_tipo', 'class' => array('intexto'))) ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('material_ultimo_preco', array('label' => '', 'id' => 'material_ultimo_preco', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('material_descricao', array('type' => 'textarea', 'escape' => false,'label' => '', 'id' => 'material_descricao', 'class' => array('descricao'))); ?>
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
</div> <!-- corpo do formulário -->
<div id="formulariofim"></div> <!-- final do formulário -->                               