<?php  
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Requisição de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Materiais_requisitado'); ?> <!-- início do formulário -->
		<div id="tabelaorc">
			<div id="titulosorc">
				<div id="tituloA">Material</div>
				<div id="tituloB">Fornecedor</div>
				<div id="tituloC">Quantidade</div>
				<div id="tituloD">Preço</div>
				<div id="tituloAD">Requisitar</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('material_id', array('name' => 'material_id'.$k, 'type' => 'hidden', 'value' => $result['Orcamento_materiais']['material_id'])); ?>
					<?php echo $this->Form->input('fornecedor_id'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_materiais']['fornecedor_id'])); ?>
					<?php echo $this->Form->input('material_preco'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_materiais']['material_preco'])); ?>
					<?php echo $this->Form->input('prazo'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_materiais']['prazo'])); ?>
					<?php echo $this->Form->input('orcamento_id'.$k, array('label' => '', 'id' => 'orcamento_id', 'type' => 'hidden', 'value' => $result['Orcamento_materiais']['orcamento_id'])); ?>
					<div id="campoA"><?php echo $result['Material']['material_nome']." (".$result['Material']['Embalagem']['embalagem_tipo']." - ".$result['Material']['material_qtd_base']." - ".$result['Material']['Medida']['medida_tipo'].")"; ?></div>
					<div id="campoB"><?php echo $result['Fornecedor']['fornecedor_nome']; ?></div>
					<div id="campoC">
						<?php echo $this->Form->input('qnt'.$k, array('label' => '', 'id' => 'qnt', 'type' => 'hidden', 'value' => $result['Orcamento_materiais']['quantidade'])); ?>
						<?php echo $result['Orcamento_materiais']['quantidade']; ?>
					</div>
					<div id="campoD"><?php echo $result['Orcamento_materiais']['material_preco']; ?></div>
					<div id="campoAD">
						<?php echo $this->Form->checkbox('requisitar'.$k, array('label' => '', 'id' => 'requisitar', 'class' => array('checkbox'))); ?>
					</div>
					<?php $k++; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Confirmar Requisição', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success', 
				'confirm' => 'Quer realmente requisitar os materiais selecionados?'
				
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->                            