<?php  
	$this->pageTitle = 'Medidas';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Medida'); ?> <!--<form action="search" method="post" >--> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Pesquisar: <br/><br/>
			Por: 
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
			<th>Tipo</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Medida']['medida_id']; ?></td>
			<td><?php echo $result['Medida']['medida_tipo']; ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Medida']['medida_id'])); ?>
				<?php echo $this->Form->postLink('deletar',
												   array('action' => 'delete', $result['Medida']['medida_id']),
												   array('confirm' => 'Quer realmente deletar esta Medida?')); 
				?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>