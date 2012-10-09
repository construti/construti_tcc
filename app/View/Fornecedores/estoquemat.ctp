﻿<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisar Requisições de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material_requisitado'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Pesquisar: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="fornecedor_id" select="selected">Fornecedor</option>
					<option value="created">Data de Requisição(dd/mm/aaaa)</option>
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
			<th>Requisição ID</th>
			<th>Fornecedor</th>
			<th>Data de Requisição</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td><?php echo $result['Material_requisitado']['requisicao_id']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_nome']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Material_requisitado']['created'])); ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('estocar', array('action' => 'atestoquemat', $result['Material_requisitado']['requisicao_id'])); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>