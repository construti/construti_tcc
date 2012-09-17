<?php  
	$this->pageTitle = 'Tipos de Material';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Material_tipo'); ?> <!--<form action="search" method="post" >--> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Tipo Material: <br/><br/>
			 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<input type="text" name="pesquisa" class="intexto"/><br/><br/>
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
		</tr>
		
		<?php if(!empty($results)) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Material_tipo']['material_tipo_id']; ?></td>
			<td><?php echo $result['Material_tipo']['material_tipo_nome']; ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Material_tipo']['material_tipo_id'])); ?>
				<?php echo $this->Form->postLink('deletar',
												   array('action' => 'delete', $result['Material_tipo']['material_tipo_id']),
												   array('confirm' => 'Quer realmente deletar este tipo de Material?')); 
				?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>