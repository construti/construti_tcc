<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa de Solicitações de Orçamentos de Equipamentos</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Orcamento_equipamentos'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Termo de Pesquisa: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="fornecedor_id" select="selected">Fornecedor</option>
					<option value="created">Data de Solicitação(dd/mm/aaaa)</option>
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
			<th>Orçamento ID</th>
			<th>Fornecedor</th>
			<th>Data de Solicitação</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td><?php echo $result['Orcamento_equipamentos']['orcamento_id']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_nome']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Orcamento_equipamentos']['created'])); ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('atualizar', array('action' => 'atprecosequip', $result['Orcamento_equipamentos']['orcamento_id'], $result['Orcamento_equipamentos']['fornecedor_id'])); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>