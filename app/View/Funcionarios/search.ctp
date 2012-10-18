<?php  
	$this->pageTitle = 'Funcionários';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Funcionario'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Termo de Pesquisa: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="nome" select="selected">Nome</option>
					<option value="cpf">CPF</option>
					<option value="data_nasc">Data de Nascimento(dd/mm/aaaa)</option>
					<option value="endereco">Endereço</option>
					<option value="bairro">Bairro</option>
					<option value="cidade">Cidade</option>
					<option value="estado">Estado</option>
					<option value="pais">País</option>
					<option value="email">E-mail</option>
					<option value="salario">Salário</option>
					<option value="area">Área</option>
					<option value="tipo">Tipo</option>
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
			<th>Nome</th>
			<th>CPF</th>
			<th>Nascimento</th>
			<th>Endereço</th>
			<th>Bairro</th>
			<th>Cidade</th>
			<th>Estado</th>
			<th>País</th>
			<th>E-mail</th>
			<th>Salário</th>
			<th>Área</th>
			<th>Tipo</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Funcionario']['funcionario_id']; ?></td>
			<td><?php echo $result['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo $result['Funcionario']['funcionario_cpf']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Funcionario']['funcionario_data_nasc'])); ?></td>
			<td><?php echo $result['Funcionario']['funcionario_endereco']; ?></td>
			<td><?php echo $result['Funcionario']['funcionario_bairro']; ?></td>
			<td align="center"><?php echo $result['Funcionario']['funcionario_cidade']; ?></td>
			<td align="center"><?php echo $result['Funcionario']['funcionario_estado']; ?></td>
			<td align="center"><?php echo $result['Funcionario']['funcionario_pais']; ?></td>
			<td><?php echo $result['Funcionario']['funcionario_email']; ?></td>
			<td align="center"><?php echo $result['Funcionario']['funcionario_salario']; ?></td>
			<td><?php echo $result['Area']['area_descricao']; ?></td>
			<td><?php echo $result['Funcionario']['funcionario_tipo']; ?></td> 
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Funcionario']['funcionario_id'])); ?>
				<?php echo $this->Form->postLink('deletar', 
												array('action' => 'delete', $result['Funcionario']['funcionario_id']), 
												array('confirm' => 'Quer realmente deletar este funcionário?')); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>