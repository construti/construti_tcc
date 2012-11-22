<?php  
	$this->pageTitle = 'Obras';
	$tproj = 0;
	$tmaoobra = 0;
	$tequip = 0;
	$tmat = 0;
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
	<h1>Acompanhamento de Custos de Obra</h1>
	
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
			<th>Descrição</th>
			<th>Custo(R$)</th>
		</tr>
		
		<?php foreach ($projetos as $p): ?>
		<tr>
			<td align="center"><?php echo $p['Projeto']['projeto_tipo']; ?></td>
			<td><?php echo $p['Projeto']['projeto_descricao']; ?></td>
			<td align="right"><?php echo $p['Projeto']['projeto_custo']; ?></td>
		</tr>
		<?php $tproj += $p['Projeto']['projeto_custo']; ?>
		<?php endforeach; ?>
		<tr>
			<td id="tproj">Total Projetos</td>
			<td colspan="2" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tproj ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Mão de Obra</h2>
	<table class="tabela">
		<tr>
			<th>Área</th>
			<th>Tipo</th>
			<th>Nome</th>
			<th>Custo/Hora</th>
			<th>Qtd Horas</th>
			<th>SubTotal</th>
		</tr>
		
		<?php foreach ($listafuncs as $f): ?>
		<?php $submao = 0; ?>
		<tr>
			<td align="center"><?php echo $f['Funcionario']['Area']['area_descricao']; ?></td>
			<td align="center"><?php echo $f['Funcionario']['funcionario_tipo']; ?></td>
			<td><?php echo $f['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo $f['Funcionario']['funcionario_salario']; ?></td>
			<td align="center"><?php echo $f['Lista_funcionario']['qtd_horas']; ?></td>
			<td align="right"><?php echo $submao = $f['Funcionario']['funcionario_salario'] * $f['Lista_funcionario']['qtd_horas']; ?></td>
			<?php $tmaoobra += $submao; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tmaoobra">Total Mão de Obra</td>
			<td colspan="5" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tmaoobra ?></td>
		</tr>
	</table>
	
	<hr>
	<h2>Equipamentos</h2>
	<table class="tabela">
		<tr>
			<th>Tipo</th>
			<th>Nome</th>
			<th>Interesse</th>
			<th>Data de Aluguel</th>
			<th>Data de Devolução</th>
			<th>Quantidade</th>
			<th>Tempo de Aluguel(horas)</th>
			<th>Valor/Hora</th>
			<th>SubTotal</th>
		</tr>
		
		<?php foreach ($listaequips as $e): ?>
		<?php $subequip = 0; ?>
		<tr>
			<td align="center"><?php echo $e['Equipamento']['Equipamentos_tipo']['tipo_equipamento']; ?></td>
			<td><?php echo $e['Equipamento']['equipamento_nome']; ?></td>
			<td align="center"><?php 
									if($e['Lista_equipamento']['alugado'] == 'C'){
										echo "Comprado";
									} else {
										echo "Alugado";
									}
								?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($e['Lista_equipamento']['dt_aluguel_ini'])); ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($e['Lista_equipamento']['dt_aluguel_fim'])); ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['qtd']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['qtd_hora']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['valor_hora']; ?></td>
			<td align="right"><?php echo $subequip = $e['Lista_equipamento']['qtd'] * $e['Lista_equipamento']['qtd_hora'] * $e['Lista_equipamento']['valor_hora']; ?></td>
			<?php $tequip += $subequip; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tequip">Total Equipamentos</td>
			<td colspan="8" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $tequip ?></td>
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
			<td align="center"><?php echo $m['Lista_material']['qtd']; ?></td>
			<td align="center"><?php echo $m['Lista_material']['preco_unitario']; ?></td>
			<td align="right"><?php echo $submat = $m['Lista_material']['qtd'] * $m['Lista_material']['preco_unitario']; ?></td>
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
			<th>Taxa</th>
			<th>Custo</th>
		</tr>
		<?php $totalTax = 0; ?>
		<?php foreach ($listaTaxas as $lt): ?>
		<?php $totalTax += $lt['Obra_taxa']['custo']; ?>
		<tr>
			<td align="center"><?php echo $lt['Obra_taxa']['descricao']; ?></td>
			<td align="center"><?php echo $lt['Obra_taxa']['custo']; ?></td>
			
		</tr>
		<?php endforeach; ?>
		<tr>
			<td id="tmat">Total Taxas</td>
			<td colspan="4" style="text-align:right; border-top: solid 1px #aaa; font-weight: bold;"><?php echo $totalTax ?></td>
		</tr>
	</table>
	<hr>
	<h2>TOTAL</h2>
	<h1>R$ <?php echo $TOTAL = $tproj + $tmaoobra + $tequip + $tmat + $totalTax; ?></h1>
	<br/>
	<div id="botao"><input type="button" value="Imprimir" onclick=javascript:window.print()></div>
</div>