<?php  
	$this->pageTitle = 'Tipos';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Tipo'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Pesquisar: </div>
			<div class="campos">Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos">
				<select name="tipo" class="intexto"/>
					<option value="funcionario" select="selected">Tipo</option>
					<option value="area_id">Área Relacionada</option>
					<option value="valor_hora">Valor/Hora</option>
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
			<th>Tipo</th>
			<th>Área Relacionada</th>
			<th>Valor/Hora</th>
			
			<th>Ações</th>
		</tr>
		
		<?php if(!empty($this->data['pesquisa'])) { foreach ($results as $result): ?>
		<tr>
			<td align="center"><?php echo $result['Tipo']['tipo_id']; ?></td>
			<td><?php echo $result['Tipo']['tipo_funcionario']; ?></td>
			<td><?php echo $result['Area']['area_descricao']; ?></td>
			<td><?php echo $result['Tipo']['tipo_valor_hora']; ?></td>
						
			<td align="center">
				<?php echo $this->Html->link('editar', array('action' => 'edit_tipo', $result['Tipo']['tipo_id'])); ?>
				<?php echo $this->Form->postLink('deletar', 
												array('action' => 'delete_tipo', $result['Tipo']['tipo_id']), 
												array('confirm' => 'Quer realmente deletar este tipo?')); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>