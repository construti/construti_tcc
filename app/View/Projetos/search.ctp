<?php  
	$this->pageTitle = 'Projetos';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Projeto'); ?> <!--<form action="search" method="post" >--> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Pesquisar: <br/><br/>
			Por: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<input type="text" name="pesquisa" class="intexto"/><br/><br/>
			<select name="tipo" class="intexto"/>
				<option value="nome" select="selected">Titulo</option>
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
			<th>Título</th>
            <th>Arquivo</th>
			<th>Descrição</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Projeto']['projeto_id']; ?></td>
			<td><?php echo $result['Projeto']['projeto_nome']; ?></td>
            <td><?php echo $result['Projeto']['projeto_arquivo']; ?></td>
			<td align="center"><?php echo $result['Projeto']['projeto_descricao']; ?></td>
			
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit', $result['Projeto']['projeto_id'])); ?>
				<?php echo $this->Form->postLink('deletar',
												   array('action' => 'delete', $result['Projeto']['projeto_id']),
												   array('confirm' => 'Quer realmente deletar este Projeto?')); 
				?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>