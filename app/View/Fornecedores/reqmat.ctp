<?php  
	echo $this->Html->script("validationFornecedor", false); 
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização de Preços de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Orcamento_materiais'); ?> <!-- início do formulário -->
		<div id="tabelaorc">
			<div id="titulosorc">
				<div id="tituloA">Material</div>
				<div id="tituloB">Fornecedor</div>
				<div id="tituloC">Quantidade</div>
				<div id="tituloD">Preço</div>
				<div id="tituloAD">Prazo(dias)</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('orcamentos_materiais_id', array('name' => 'orcamentos_materiais_id'.$k, 'type' => 'hidden', 'value' => $result['Orcamento_materiais']['orcamentos_materiais_id'])); ?>
					<div id="campoA"><?php echo $result[0]['Material__descricao'] ?></div>
					<div id="campoB"><?php echo $result['Fornecedor']['fornecedor_nome']; ?></div>
					<div id="campoC"><?php echo $result['Orcamento_materiais']['quantidade']; ?></div>
					<div id="campoD">
						<?php echo $this->Form->input('material_preco'.$k, array('value'=>$result['Orcamento_materiais']['material_preco'], 'label' => '', 'id' => 'material_preco', 'class' => array('intextoOrc'))); ?>
					</div>
					<div id="campoAD">
						<?php echo $this->Form->input('prazo'.$k, array('value'=>$result['Orcamento_materiais']['prazo'],'label' => '', 'id' => 'prazo', 'class' => array('intextoOrc'))); ?>
					</div>
					<?php $k++; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Atualizar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success'
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->                            