<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Checar Estoque de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Teste'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Pesquisar: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="" select="selected">Escolha...</option>
					<option value="completo" select="selected">COMPLETO</option>
					<option value="material_id">Material</option>
				</select>
			</div>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->	
			<?php echo $this->Form->end('Pesquisar'); ?> <!-- fim do formulário -->
		</div> 
</div>
<div id="formulariofim"></div> <!-- final do formulário -->
<div id="resultados"> <!-- resultados da pesquisa -->
	<?php echo $this->Form->create('Estoque_materiais', array( 'url' => array('controller' => 'fornecedores', 'action' => 'atestoque'))); ?> <!-- início do formulário -->
		<div id="tabelaest">
			<div id="titulosorc">
				<div id="tituloJ">Material</div>
				<div id="tituloK">Qtd. Base</div>
			</div>
			
			<?php $k = 0; ?>
			<?php foreach ($results as $result): ?>
				<div>
					<?php echo $this->Form->input('estoques_materiais_id', array('name' => 'estoques_materiais_id'.$k, 'type' => 'hidden', 'value' => $result['Estoque_materiais']['estoques_materiais_id'])); ?>
					<div id="campoJ"><?php /*echo $result[0]['Material__descricao']*/ echo $result['Material']['descricao'] ?></div>
					<div id="campoK">
						<?php echo $this->Form->input('quantidade'.$k, array('label' => '', 'id' => 'quantidade', 'class' => array('intextoOrc'))); ?>
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