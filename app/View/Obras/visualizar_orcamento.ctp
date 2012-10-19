<?php  
	$this->pageTitle = 'Obras';
	$tproj = 0;
	$tmaoobra = 0;
	$tequip = 0;
	$tmat = 0;
	$ttaxa = 0;
?> 
<style type="text/css">
h1, h2 {
	text-align: center;
}
hr{
	width: 90%;
}
#orcamento{
	width: 98% ;
	margin: 0 auto;
}
#tproj, #tmaoobra, #tequip, #tmat {
	border-top: solid 1px #aaa;
	font-weight: bold;
}
#botao {
	text-align: center;
	margin: 0 auto;
}
.tabela {
	margin: 0 auto;
}
.tabela tr th {
	padding: 0 6px;
}
.tabela tr td {
	padding: 0 6px;
}
</style>
<div id="orcamento"> <!-- resultados da pesquisa -->
	<h1>Orçamento</h1>
	
	<h2>Obra</h2>
	
	<table class="tabela">
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
	
	<hr>
	<h2>Projetos</h2>
	<table class="tabela">
		<tr>
			<th>Tipo</th>
			<th>Custo(R$)</th>
		</tr>
		
		<?php foreach ($projetos as $p): ?>
		<tr>
			<td align="center"><?php echo $p['Previsao_projeto']['tipo']; ?></td>
			<td align="right"><?php echo $p['Previsao_projeto']['custo']; ?></td>
		</tr>
		<?php $tproj += $p['Previsao_projeto']['custo']; ?>
		<?php endforeach; ?>
		<tr>
			<td id="tproj">Total Projetos</td>
			<td style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tproj ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Mão de Obra</h2>
	<table class="tabela">
		<tr>
			<th>Tipo</th>
			<th>Quantidade</th>
			<th>Salário/Hora</th>
			<th>Qtd Horas</th>
			
			<th>SubTotal</th>
		</tr>
		
		<?php foreach ($listafuncs as $f): ?>
		<?php $submao = 0; ?>
		<tr>
			<td align="center"><?php echo $f['Tipo']['tipo_funcionario']; ?></td>
			<td><?php echo $f['Previsao_funcionario']['qtd']; ?></td>
			<td align="center"><?php echo $f['Previsao_funcionario']['salario']; ?></td>
			<td align="center"><?php echo $f['Previsao_funcionario']['qtd_horas']; ?></td>
			
			<td align="right"><?php echo $submao = $f['Previsao_funcionario']['salario'] * $f['Previsao_funcionario']['qtd_horas']; ?></td>
			<?php $tmaoobra += $submao; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tmaoobra">Total Mão de Obra</td>
			<td colspan="4" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tmaoobra ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Equipamentos</h2>
	<table class="tabela">
		<tr>
			<th>Tipo</th>
			<th>Quantidade</th>
			<th>Valor/Hora</th>
			<th>Qtd Horas</th>
			
			<th>SubTotal</th>
		</tr>
		
		<?php foreach ($listaequips as $e): ?>
		<?php $subequip = 0; ?>
		<tr>
			<td align="center"><?php echo $e['Equipamentos_tipo']['tipo_equipamento']; ?></td>
			<td align="center"><?php echo $e['Previsao_equipamento']['qtd']; ?></td>
			<td align="center"><?php echo $e['Previsao_equipamento']['valor_hora']; ?></td>
			<td align="center"><?php echo $e['Previsao_equipamento']['qtd_horas']; ?></td>
			
			<td align="right"><?php echo $subequip = $e['Previsao_equipamento']['qtd'] * $e['Previsao_equipamento']['qtd_horas'] * $e['Previsao_equipamento']['valor_hora']; ?></td>
			<?php $tequip += $subequip; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tequip">Total Equipamentos</td>
			<td colspan="4" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tequip ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Materiais</h2>
	<table class="tabela">
		<tr>
			<th>Tipo</th>
			<th>Descrição</th>
			<th>Quantidade</th>
			<th>Valor</th>
			
			<th>SubTotal</th>
		</tr>
		
		<?php foreach ($listamats as $m): ?>
		<?php $submat = 0; ?>
		<tr>
			<td align="center"><?php echo $m['Material']['Material_tipo']['material_tipo_nome']; ?></td>
			<td align="center"><?php echo $m['Material']['material_nome']." (".$m['Material']['Embalagem']['embalagem_tipo']." - ".$m['Material']['material_qtd_base']." - ".$m['Material']['Medida']['medida_tipo'].")"; ?></td>
			<td align="center"><?php echo $m['Previsao_material']['qtd']; ?></td>
			<td align="center"><?php echo $m['Previsao_material']['custo']; ?></td>
			
			<td align="right"><?php echo $submat = $m['Previsao_material']['qtd'] * $m['Previsao_material']['custo']; ?></td>
			<?php $tmat += $submat; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tmat">Total Materiais</td>
			<td colspan="4" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tmat ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Taxas</h2>
	<table class="tabela">
		<tr>
			<th>Descrição</th>
			<th>Custo</th>
		</tr>
		
		<?php foreach ($listataxas as $lt): ?>
		<tr>
			<td align="center"><?php echo $lt['Previsao_taxa']['descricao']; ?></td>
			<td align="right"><?php echo $lt['Previsao_taxa']['custo']; ?></td>
		</tr>
		<?php $ttaxa += $lt['Previsao_taxa']['custo']; ?>
		<?php endforeach; ?>
		<tr>
			<td id="tproj">Total Taxas</td>
			<td style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $ttaxa ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>TOTAL</h2>
	<h1>R$ <?php echo $TOTAL = $tproj + $tmaoobra + $tequip + $tmat + $ttaxa; ?></h1>
	<br/>
	<div id="botao"><input type="button" value="Imprimir" onclick=javascript:window.print()></div>
</div>