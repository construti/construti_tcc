<?php  
	$this->pageTitle = 'Materiais';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material'); ?> <!--<form action="search" method="post" >--> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Pesquisar: <br/><br/>
			Por: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<input type="text" name="pesquisa" class="intexto"/><br/><br/>
			<select name="tipo" class="intexto"/>
				<option value="nome" select="selected">Nome</option>
				<option value="descricao">Descrição</option>
			</select>
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
			<!--<th>Embalagem</th>
			<th>Qtd. Base</th>			
			<th>Medida</th>-->
			<th>Tipo</th>
			<th>Descrição</th>
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Material']['material_id']; ?></td>
			<td><?php echo $result['Material']['material_nome']; ?></td>
			<!--<td align="center"><?php echo $result['Embalagem']['embalagem_tipo']; ?></td>
			<td align="center"><?php echo $result['Material']['material_qtd_base']; ?></td>
			<td align="center"><?php echo $result['Medida']['medida_tipo']; ?></td>-->			
			<td align="center"><?php echo $result['Material_tipo']['material_tipo_nome']; ?></td>
			<td align="center"><?php echo $result['Material']['material_descricao']; ?></td>
			
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Material']['material_id'])); ?>
				<?php echo $this->Form->postLink('deletar',
												   array('action' => 'delete', $result['Material']['material_id']),
												   array('confirm' => 'Quer realmente deletar este Material?')); 
				?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>