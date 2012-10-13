<?php  
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização do Estoque de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Material_requisitado'); ?> <!-- início do formulário -->
		<div id="tabelaorc">
			<div id="titulosorc">
				<div id="tituloA">Material</div>
				<div id="tituloB">Fornecedor</div>
				<div id="tituloC">Quantidade</div>
				<div id="tituloD">Preço</div>
				<div id="tituloAD">Recebido</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('material_id', array('name' => 'material_id'.$k, 'type' => 'hidden', 'value' => $result['Material_requisitado']['material_id'])); ?>
					<div id="campoA"><?php echo $result[0]['Material__descricao'] ?></div>
					<div id="campoB"><?php echo $result['Fornecedor']['fornecedor_nome']; ?></div>
					<div id="campoC">
						<?php echo $this->Form->input('qnt'.$k, array('label' => '', 'id' => 'qnt', 'type' => 'hidden', 'value' => $result['Material_requisitado']['quantidade'])); ?>
						<?php echo $result['Material_requisitado']['quantidade']; ?>
					</div>
					<div id="campoD"><?php echo $result['Material_requisitado']['material_preco']; ?></div>
					<div id="campoAD">
						<?php echo $this->Form->checkbox('recebido'.$k, array('label' => '', 'id' => 'recebido', 'class' => array('checkbox'))); ?>
					</div>
					<?php $k++; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Estocar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success', 
				'confirm' => 'Quer realmente estocar os materiais selecionados?'
				
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->                            