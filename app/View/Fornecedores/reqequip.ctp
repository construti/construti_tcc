<?php  
	echo $this->Html->script("validationFornecedor", false); 
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização de Preços de Equipamentos</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Orcamento_equipamentos'); ?> <!-- início do formulário -->
		<div id="tabelaorcB">
			<div id="titulosorc">
				<div id="tituloE">Equipamento</div>
				<div id="tituloF">Fornecedor</div>
				<div id="tituloG">Interesse</div>
				<div id="tituloH">Quantidade</div>
				<div id="tituloI">Valor/Hora</div>
				<div id="tituloEI">Prazo(dias)</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('orcamentos_equipamentos_id', array('name' => 'orcamentos_equipamentos_id'.$k, 'type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['orcamentos_equipamentos_id'])); ?>
					<div id="campoE"><?php echo $result['Equipamento']['equipamento_nome'] ?></div>
					<div id="campoF"><?php echo $result['Fornecedor']['fornecedor_nome']; ?></div>
					<div id="campoG">
					<?php 
						if ($result['Orcamento_equipamentos']['alugado'] == 'A'){
							echo "Alugar";
						} else {
							echo "Comprar";
						}
					?></div>
					<div id="campoH"><?php echo $result['Orcamento_equipamentos']['quantidade']; ?></div>
					<div id="campoI">
						<?php echo $this->Form->input('equipamento_preco'.$k, array('value'=>$result['Orcamento_equipamentos']['equipamento_preco'],'label' => '', 'id' => 'equipamento_preco', 'class' => array('intextoOrc'))); ?>
					</div>
					<div id="campoEI">
						<?php echo $this->Form->input('prazo'.$k, array('value'=>$result['Orcamento_equipamentos']['prazo'],'label' => '', 'id' => 'prazo', 'class' => array('intextoOrc'))); ?>
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