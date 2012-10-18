<?php  
	$this->pageTitle = 'Obras';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa de Obras</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Obra'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Termo de Pesquisa: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="obra_nome" select="selected">Título</option>
					<option value="obra_responsavel">Responsável</option>
					<option value="obra_custo">Custo</option>
					<option value="obra_data_inicio">Data de Início(dd/mm/aaaa)</option>
					<option value="obra_data_fim">Data de Término(dd/mm/aaaa)</option>
					<option value="obra_status">Situação</option>
					<option value="obra_tipo">Tipo</option>
					<option value="obra_descricao">Descrição</option>
				</select>
			</div>
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
			<th>Situação</th>
			<th>Tipo</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Obra']['obra_id']; ?></td>
			<td><?php echo $result['Obra']['obra_nome']; ?></td>
			<td><?php echo $result['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo $result['Obra']['obra_custo']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Obra']['obra_data_inicio'])); ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Obra']['obra_data_fim'])); ?></td>
			<td align="center"><?php echo $result['Obras_status']['status_obra']; ?></td>
			<td align="center">
				<?php 
					if ($result['Obra']['obra_tipo'] == 'R'){
						echo "Residencial";
					} elseif ($result['Obra']['obra_tipo'] == 'C') {
						echo "Comercial";
					} else {
						echo "Industrial";
					}
				?>
			</td> 
						
			<td align="center">
				<?php echo $this->Html->link('registrar taxa', array('action' => 'add_taxa', $result['Obra']['obra_id'])); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>