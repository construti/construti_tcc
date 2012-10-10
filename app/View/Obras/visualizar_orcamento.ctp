<?php  
	$this->pageTitle = 'Obras';
?> 
<style type="text/css">
h1 {
	text-align: center;
}
hr{
	width: 90%;
}
</style>
<div id="orcamento"> <!-- resultados da pesquisa -->
	<h1>Orçamento</h1>
	
	<h2>Obra</h2>
	
	<table class="tabela">
		<tr>
			<th>Título</th>
			<th>Responsável</th>
			<th>Custo(R$)</th>
			<th>Data Início</th>
			<th>Data Fim</th>
			<th>Situação</th>
			<th>Tipo</th>
		</tr>
		
		<tr>
			<td><?php echo $obra['Obra']['obra_nome']; ?></td>
			<td><?php echo $obra['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo $obra['Obra']['obra_custo']; ?></td>
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
			<td align="center"><?php echo $p['Projeto']['projeto_custo']; ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>Total Projetos</td>
			<td></td>
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
		<tr>
			<td align="center"><?php echo $f['Funcionario']['Area']['area_descricao']; ?></td>
			<td align="center"><?php echo $f['Funcionario']['funcionario_tipo']; ?></td>
			<td><?php echo $f['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo $f['Funcionario']['funcionario_salario']; ?></td>
			<td align="center"><?php echo $f['Lista_funcionario']['qtd_horas']; ?></td>
			<td align="center"></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>Total Mão de Obra</td>
			<td></td>
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
			<td align="center"><?php echo $e['Lista_equipamento']['dt_aluguel_ini']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['dt_aluguel_fim']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['qtd']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['qtd_hora']; ?></td>
			<td align="center"><?php echo $e['Lista_equipamento']['valor_hora']; ?></td>
			<td align="center"></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>Total Equipamentos</td>
			<td></td>
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
		<tr>
			<td align="center"><?php echo $m['Material']['Material_tipo']['material_tipo_nome']; ?></td>
			<td align="center"><?php echo $m['Material']['descricao']; ?></td>
			<td align="center"><?php echo $m['Lista_material']['qtd']; ?></td>
			<td align="center"><?php echo $m['Lista_material']['preco_unitario']; ?></td>
			<td align="center"></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>Total Materiais</td>
			<td></td>
		</tr>
	</table>
</div>