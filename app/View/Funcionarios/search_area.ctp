<?php  
	$this->pageTitle = 'Funcionários';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa de Áreas de Funcionários</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Area'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Área: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
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
			<th>Área</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Area']['area_id']; ?></td>
			<td><?php echo $result['Area']['area_descricao']; ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit_area', $result['Area']['area_id'])); ?>
				<?php echo $this->Form->postLink('deletar', 
												array('action' => 'delete_area', $result['Area']['area_id']), 
												array('confirm' => 'Quer realmente deletar esta área?')); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>