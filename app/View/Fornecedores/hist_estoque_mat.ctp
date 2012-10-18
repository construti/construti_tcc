<?php  
	$this->pageTitle = 'Fornecedores';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Histórico do Estoque de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<table class="tabela2">
		<tr>
			<th>Nome</th>
			<th>Tipo</th>
			<th>Quantidade Atual</th>
			<th>Última Estocagem</th>
		</tr>
		
		<tr>
			<td><?php echo $estoque['Material']['material_nome']." (".$estoque['Material']['Embalagem']['embalagem_tipo']." - ".$estoque['Material']['material_qtd_base']." - ".$estoque['Material']['Medida']['medida_tipo'].")"; ?></td>
			<td align="center"><?php echo $estoque['Material']['Material_tipo']['material_tipo_nome']; ?></td>
			<td align="center"><?php echo $estoque['Estoque_materiais']['quantidade']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($estoque['Estoque_materiais']['modified'])); ?></td>
		</tr>
	</table>
	<br/>
	<div id="historico"> <!-- div com Histórico do Estoque de Material -->
		<h1>Histórico</h1>
	
		<table id="tabela3">
			<tr>
				<th id="t1">Andamento</th>
				<th id="t2">Quantidade Estocada</th>
				<th id="t3">Quantidade Total</th>
				<th id="t4">Atualização</th>
			</tr>
			
			<?php foreach ($historico as $h): ?>
			<tr>
				<td id="c1"><?php echo $h['Estoque_materiais_historico']['andamento']; ?></td>
				<td id="c2_1"><?php echo $h['Estoque_materiais_historico']['quantidade_estocada']; ?></td>
				<td id="c3_1"><?php echo $h['Estoque_materiais_historico']['quantidade']; ?></td>
				<td id="c4"><?php echo date("d/m/Y", strtotime($h['Estoque_materiais_historico']['created'])); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<div id="formulariofim"></div> <!-- final do formulário -->