<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa de Materiais no Estoque</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material'); ?> <!--<form action="search" method="post" >--> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Termo de Pesquisa: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="nome" select="selected">Nome</option>
					<option value="tipo" select="selected">Tipo</option>
					<option value="descricao">Descrição</option>
				</select>
			</div>
		</div>
		<div id="areaBotao"><?php echo $this->Form->end('Pesquisar'); ?></div> <!-- botão de cadastro -->
</div>
<div id="formulariofim"></div> <!-- final do formulário -->
<div id="resultados"> <!-- resultados da pesquisa -->
	<h1>Resultados Obtidos</h1>
	
	<table class="tabela">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Tipo</th>
			<th>Descrição</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Material']['material_id']; ?></td>
			<td><?php echo $result['Material']['material_nome']." (".$result['Embalagem']['embalagem_tipo']." - ".$result['Material']['material_qtd_base']." - ".$result['Medida']['medida_tipo'].")"; ?></td>		
			<td align="center"><?php echo $result['Material_tipo']['material_tipo_nome']; ?></td>
			<td align="center"><?php echo $result['Material']['material_descricao']; ?></td>			
						
			<td align="center">
				<?php echo $this->Html->link('visualizar histórico', array('action' => 'hist_estoque_mat', $result['Material']['material_id'])); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>