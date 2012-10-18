<?php  
	$this->pageTitle = 'Obras';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Histórico de Alocação/Desalocação de Mão de Obra</div> <!-- título do formulário -->
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
				<th id="t1">Andamento</th>
				<th id="t2">Funcionário</th>
				<th id="t3">Horas a Trabalhar</th>
				<th id="t3">Situação</th>
				<th id="t4">Atualização</th>
			</tr>
			
			<?php foreach ($historico as $h): ?>
			<tr>
				<td id="c1"><?php echo $h['Lista_funcionario_historico']['andamento']; ?></td>
				<td id="c3"><?php echo $h['Funcionario']['funcionario_nome']; ?></td>
				<td id="c3_1"><?php echo $h['Lista_funcionario_historico']['qtd_horas']; ?></td>
				<td id="c3_1"><?php echo $h['Lista_funcionario_historico']['situacao']; ?></td>
				<td id="c4"><?php echo date("d/m/Y", strtotime($h['Lista_funcionario_historico']['created'])); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div style="margin: 10px 0 0; text-align: center;">
		<?php 
			$total = 0;
			foreach ($custo as $c):			
				$total +=  $c['Lista_funcionario_historico']['qtd_horas']*$c['Funcionario']['funcionario_salario'];
			endforeach; ?>
		Custo Total = R$<?php echo $total; ?>,00
	</div>
</div>
<div id="formulariofim"></div> <!-- final do formulário -->