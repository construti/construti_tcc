<?php  
	$this->pageTitle = 'Fornecedores';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Histórico do Galpão de Equipamentos</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<table class="tabela2">
		<tr>
			<th>Nome</th>
			<th>Tipo</th>
			<th>Interesse</th>
			<th>Quantidade Atual</th>
			<th>Última Estocagem</th>
		</tr>
		
		<tr>
			<td><?php echo $estoque['Equipamento']['equipamento_nome']; ?></td>
			<td align="center"><?php echo $estoque['Equipamento']['Equipamentos_tipo']['tipo_equipamento']; ?></td>
			<td align="center">
				<?php if($estoque['Estoque_equipamentos']['alugado'] == 'C') {
						echo "Comprado";
					} else {
						echo "Alugado";
					} ?>
			</td>
			<td align="center"><?php echo $estoque['Estoque_equipamentos']['quantidade']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($estoque['Estoque_equipamentos']['modified'])); ?></td>
		</tr>
	</table>
	<br/>
	<div id="historico"> <!-- div com Histórico do Galpão de Equipamento -->
		<h1>Histórico</h1>
	
		<table id="tabela3">
			<tr>
				<th id="t1">Andamento</th>
				<th id="t2">Quantidade Guardada</th>
				<th id="t3">Quantidade Total</th>
				<th id="t4">Atualização</th>
			</tr>
			
			<?php foreach ($historico as $h): ?>
			<tr>
				<td id="c1"><?php echo $h['Estoque_equipamentos_historico']['andamento']; ?></td>
				<td id="c2_1"><?php echo $h['Estoque_equipamentos_historico']['quantidade_estocada']; ?></td>
				<td id="c3_1"><?php echo $h['Estoque_equipamentos_historico']['quantidade']; ?></td>
				<td id="c4"><?php echo date("d/m/Y", strtotime($h['Estoque_equipamentos_historico']['created'])); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<div id="formulariofim"></div> <!-- final do formulário -->