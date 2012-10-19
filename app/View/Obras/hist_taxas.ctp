<?php  
	$this->pageTitle = 'Obras';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Histórico de Taxas Pagas</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<table class="tabela2">
		<tr>
			<th>Título</th>
			<th>Responsável</th>
			<th>Data Início</th>
			<th>Data Fim</th>
			<th>Situação</th>
			<th>Tipo</th>
		</tr>
		
		<tr>
			<td><?php echo $obra['Obra']['obra_nome']; ?></td>
			<td><?php echo $obra['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($obra['Obra']['obra_data_inicio'])); ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($obra['Obra']['obra_data_fim'])); ?></td>
			<td align="center"><?php echo $obra['Obras_status']['status_obra']; ?></td>
			<td align="center">
				<?php 
					if ($obra['Obra']['obra_tipo'] == 'R'){
						echo "Residencial";
					} elseif ($obra['Obra']['obra_tipo'] == 'C') {
						echo "Comercial";
					} else {
						echo "Industrial";
					}
				?>
			</td> 
		</tr>
	</table>
	<br/>
	<div id="historico"> <!-- div com Histórico do Estoque de Material -->
		<h1>Histórico</h1>
	
		<table id="tabela3">
			<tr>
				<th id="t1">Taxa</th>
				<th id="t2">Custo</th>
				<th id="t4">Registrada</th>
			</tr>
			
			<?php $tot = 0; 
				foreach ($historico as $h): ?>
			<tr>
				<td id="c1"><?php echo $h['Obra_taxa']['descricao']; ?></td>
				<td id="c2">R$ <?php echo $h['Obra_taxa']['custo']; ?>,00</td>
				<td id="c4"><?php echo date("d/m/Y", strtotime($h['Obra_taxa']['created'])); ?></td>
			</tr>
			<?php $tot += $h['Obra_taxa']['custo'];
				endforeach; ?>
			<tr>
				<td id="c1"><b>Total:</b></td>
				<td id="c2">R$ <?php echo $tot; ?>,00</td>
				<td id="c4"></td>
			</tr>
		</table>
	</div>
</div>
<div id="formulariofim"></div> <!-- final do formulário -->