<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Fornecedor'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Pesquisar: <br/><br/>
			Por: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<input type="text" name="pesquisa" class="intexto"/><br/><br/>
			<select name="tipo" class="intexto"/>
				<option value="nome" select="selected">Nome</option>
				<option value="contato">Contato</option>
				<option value="email">E-mail</option>
				<option value="tipo">Tipo</option>
				<option value="descricao">Descrição</option>
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
			<th>Nome</th>
			<th>Contato</th>
			<th>E-mail</th>
			<th>Tipo</th>
			<th>Descrição</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Fornecedor']['fornecedor_id']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_nome']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_contato']; ?></td>
			<td align="center"><?php echo $result['Fornecedor']['fornecedor_email']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_tipo']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_descricao']; ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Fornecedor']['fornecedor_id'])); ?>
				<?php echo $this->Form->postLink('deletar', 
												array('action' => 'delete', $result['Fornecedor']['fornecedor_id']), 
												array('confirm' => 'Quer realmente deletar este fornecedor?')); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>