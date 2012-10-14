<?php  
	$this->pageTitle = 'Fornecedores';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Requisição de Equipamentos</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Equipamento_requisitado'); ?> <!-- início do formulário -->
		<div id="tabelaorcB">
			<div id="titulosorc">
				<div id="tituloE">Equipamento</div>
				<div id="tituloF">Fornecedor</div>
				<div id="tituloG">Interesse</div>
				<div id="tituloH">Quantidade</div>
				<div id="tituloI">Valor/Hora</div>
				<div id="tituloEI">Requisitar</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('equipamento_id', array('name' => 'equipamento_id'.$k, 'type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['equipamento_id'])); ?>
					<?php echo $this->Form->input('fornecedor_id'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['fornecedor_id'])); ?>
					<?php echo $this->Form->input('equipamento_preco'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['equipamento_preco'])); ?>
					<?php echo $this->Form->input('dt_aluguel_ini'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['dt_aluguel_ini'])); ?>
					<?php echo $this->Form->input('dt_aluguel_fim'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['dt_aluguel_fim'])); ?>
					<?php echo $this->Form->input('prazo'.$k, array('type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['prazo'])); ?>
					<?php echo $this->Form->input('orcamento_id'.$k, array('label' => '', 'id' => 'orcamento_id', 'type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['orcamento_id'])); ?>
					<div id="campoE"><?php echo $result['Equipamento']['equipamento_nome'] ?></div>
					<div id="campoF"><?php echo $result['Fornecedor']['fornecedor_nome']; ?></div>
					<div id="campoG">
						<?php echo $this->Form->input('alug'.$k, array('label' => '', 'id' => 'alug', 'type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['alugado'])); ?>
						<?php 
							if ($result['Orcamento_equipamentos']['alugado'] == 'A'){
								echo "Alugar";
							} else {
								echo "Comprar";
							}
						?></div>
					<div id="campoH">
						<?php echo $this->Form->input('qnt'.$k, array('label' => '', 'id' => 'qnt', 'type' => 'hidden', 'value' => $result['Orcamento_equipamentos']['quantidade'])); ?>
						<?php echo $result['Orcamento_equipamentos']['quantidade']; ?>
					</div>
					<div id="campoI"><?php echo $result['Orcamento_equipamentos']['equipamento_preco']; ?></div>
					<div id="campoEI">
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
				'confirm' => 'Quer realmente requisitar os equipamentos selecionados?'
				
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->                            