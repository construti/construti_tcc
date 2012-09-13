<?php  
	echo $this->Html->script("validationMaterial", false); 
	$this->pageTitle = 'Materiais';
?>
 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Nome: <br/><br/>
			Tipo: <br/><br/>
			<div style="color: #ee0;">Preço(R$):</div> <br/>
			<div style="color: #ee0;">Descrição:</div> <br/><br/>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('material_nome', array('label' => '', 'id' => 'material_nome', 'class' => array('intexto'))); ?>
			<br/>
			<?php $opcoes_tipo = array('aco' => 'Aço', 'cal' => 'Cal' , 'cimento' => 'Cimento',
									   'madeira' => 'Madeira', 'parafuso' => 'Parafuso', 'prego' => 'Prego',
									   'telha' => 'Telha', 'tijolo' => 'Tijolo', 'viga' => 'Viga'
									   );
				  echo $this->Form->select('material_tipo', $opcoes_tipo, array('label' => '', 'id' => 'material_tipo', 'class' => array('intexto'))) ?>
			<br/><br/>
			<?php echo $this->Form->input('material_ultimo_preco', array('label' => '', 'id' => 'material_ultimo_preco', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('material_descricao', array('type' => 'textarea', 'escape' => false,'label' => '', 'id' => 'material_descricao', 'class' => array('descricao'))); ?>
		</div>
		<div class="legenda">
			<div style="font-size: 120%;">Legenda</div>
			<div style="text-align: justify; padding: 0 0 0 30%;">Itens Obrigatórios</div>
			<div style="text-align: justify; padding: 0 0 0 30%; color: #ee0">Itens Opcionais</div>
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