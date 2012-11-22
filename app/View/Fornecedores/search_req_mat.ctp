<script>	
		
	$(document).ready(function(){
		$('input[name=tipo_pesq]').click(function(){
			var valor = $('input[name=tipo_pesq]:checked').val();
			
			if(valor == 1){
				$('#pesqMat1').show();
				$('#pesqMat2').show();
				
				$('#termo1').hide();
				$('#termo2').hide();
				
				$('#por1').hide();
				$('#por2').hide();
				
			}
			else if(valor ==2){
				$('#pesqMat1').hide();
				$('#pesqMat2').hide();
				
				$('#termo1').show();
				$('#termo2').show();
				
				$('#por1').show();
				$('#por2').show();
			}		
		});
	})
	
</script>
<?php  
	$this->pageTitle = 'Fornecedores';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Pesquisa de Solicitações de Orçamentos de Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Orcamento_materiais'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Tipo Pesquisa: </div>
			<div class="campos" id="pesqMat1" style="display:none" >Material: </div>
			<div class="campos" id="termo1" style="display:none" >Termo de Pesquisa: </div>
			<div class="campos" id="por1" style="display:none" >Por: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<div class="campos"><input style="margin-left:5px" type="radio" value="1" name="tipo_pesq" id="tipo_pesq" class="intexto"/>Material <input style="margin-left:5px" type="radio" value="2" name="tipo_pesq" id="tipo_pesq" class="intexto"/>Fornecedor</div> 
			<div class="campos" id="pesqMat2" style="display:none" > 
				<?php 
					$materiais = array(); 
					foreach($tiposMat as $tm):
						$materiais[$tm['materiais']['material_id']] = $tm[0]['descricao'];
					endforeach;						
					
					echo $this->Form->select('mat_desc', $materiais, array('label' => '', 'id' => 'mat_desc', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
			</div>
			<div class="campos" id="termo2" style="display:none" ><input type="text" name="pesquisa" class="intexto"/></div>
			<div class="campos" id="por2" style="display:none" >
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
			<td><?php echo $result['Orcamento_materiais']['orcamento_id']; ?></td>
			<td><?php echo $result['Fornecedor']['fornecedor_nome']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($result['Orcamento_materiais']['created'])); ?></td>
						
			<td align="center">
				<a href="<?php echo $this->params->base.'/fornecedores/reqmat/'.$result['Orcamento_materiais']['orcamento_id'].'/'.$result['Orcamento_materiais']['fornecedor_id'] ?>">Requisitar</a>
				<?php //echo $this->Html->link('requisitar', array('action' => 'reqmat', $result['Orcamento_materiais']['orcamento_id'])); ?>
			</td>
		</tr>
		<?php endforeach; } ?>
	</table>
</div>