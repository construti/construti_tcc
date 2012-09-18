<?php  
	$this->pageTitle = 'Obras';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Obra'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Pesquisar: <br/><br/>
			Por: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<input type="text" name="pesquisa" class="intexto"/><br/><br/>
			<select name="tipo" class="intexto"/>
				<option value="obra_nome" select="selected">Título</option>
				<option value="obra_responsavel">Responsável</option>
				<option value="obra_custo">Custo</option>
				<option value="obra_data_inicio">Data de Início</option>
				<option value="obra_data_fim">Data de Término</option>
				<option value="obra_status">Status</option>
				<option value="obra_tipo">Tipo</option>
				<option value="obra_descricao">Descrição</option>
			</select>
		</div>
		<div id="areaBotao"> <!-- botão de cadastro -->
			<?php echo $this->Form->end('Pesquisar'); ?> <!-- fim do formulário -->
		</div> 
</div>
<div id="formulariofim"></div> <!-- final do formulário -->
<div id="resultados"> <!-- resultados da pesquisa -->
	<h1>Resultados Obtidos</h1>
	
	<table class="tabela">
		<tr>
			<th>ID</th>
			<th>Título</th>
			<th>Responsável</th>
			<th>Custo(R$)</th>
			<th>Data Início</th>
			<th>Data Fim</th>
			<th>Status</th>
			<th>Tipo</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Obra']['obra_id']; ?></td>
			<td><?php echo $result['Obra']['obra_nome']; ?></td>
			<td><?php echo $result['Obra']['obra_responsavel']; ?></td>
			<td><?php echo $result['Obra']['obra_custo']; ?></td>
			<td><?php echo $result['Obra']['obra_data_inicio']; ?></td>
			<td><?php echo $result['Obra']['obra_data_fim']; ?></td>
			<td><?php echo $result['Obra']['obra_status']; ?></td>
			<td><?php echo $result['Obra']['obra_tipo']; ?></td> 
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Obra']['obra_id'])); ?>
				<?php echo $this->Form->postLink('deletar', 
												array('action' => 'delete', $result['Obra']['obra_id']), 
												array('confirm' => 'Quer realmente deletar esta obra?')); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>