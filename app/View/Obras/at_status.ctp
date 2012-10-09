<?php  
	$this->pageTitle = 'Situação de Obras';
?> 

<script type="text/javascript" language="javascript">
		$(document).ready(function(){
			$("#obra_status").change(function(){  // se status for Cancelada ou Paralisada mostra o campo de Motivo
				if($('#obra_status option:selected').html() == "Cancelada" || $('#obra_status option:selected').html() == "Paralisada"){
					$("#motivo1").show();
					$("#motivo2").show();
				} else {
					$("#motivo1").hide();
					$("#motivo2").hide();
				}
			});
		 });
		
		function exibirHistorico() {
		    if ($('#historico').is(':visible')){
				$("#historico").hide();
			} else {
				$("#historico").show();
			}
		}
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualizar Situação</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<table class="tabela2">
		<tr>
			<th>Título</th>
			<th>Responsável</th>
			<th>Data Início</th>
			<th>Data Fim</th>
			<th>Situação Atual</th>
		</tr>
		
		<tr>
			<td><?php echo $obra['Obra']['obra_nome']; ?></td>
			<td><?php echo $obra['Funcionario']['funcionario_nome']; ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($obra['Obra']['obra_data_inicio'])); ?></td>
			<td align="center"><?php echo date("d/m/Y", strtotime($obra['Obra']['obra_data_fim'])); ?></td>
			<td align="center"><?php echo $obra['Obras_status']['status_obra']; ?></td>
		</tr>
	</table>
	
	<div style="width: 120px; margin: 5px auto;">
		<?php echo $this->Form->input('Exibir Histórico', array('label' => '', 'id' => 'botaoHistorico', 'type' => 'button', 'onclick' => 'exibirHistorico()', 'class' => array('botao'))); ?>
	</div>
	<div style="display: none" id="historico"> <!-- div com Histórico da Obra -->
		<h1>Histórico</h1>
	
		<table id="tabela3">
			<tr>
				<th id="t1">Andamento</th>
				<th id="t2">Situação</th>
				<th id="t3">Motivo</th>
				<th id="t4">Atualização</th>
			</tr>
			
			<?php foreach ($historico as $h): ?>
			<tr>
				<td id="c1"><?php echo $h['Obras_historico']['andamento']; ?></td>
				<td id="c2"><?php echo $h['Obras_status']['status_obra']; ?></td>
				<td id="c3"><?php echo $h['Obras_historico']['motivo']; ?></td>
				<td id="c4"><?php echo $h['Obras_historico']['created']; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div id="historicoForm"> <!-- div com formulário para atualizar Situação -->
		<h1>Formulário de Atualização</h1>
		<?php echo $this->Form->create('Obras_historico'); ?> <!-- início do formulário -->
			<div style="float: left;
						width: 150px;
						margin: 0 auto 10px;
						text-align: right;
						font-size: 14px;
						padding: 0 0 0 6%;"> <!-- div com a descrição dos campos -->
				<div class="campos">Situação:</div>
				<div style="height: 20px; margin: 0 0 20px;	padding: 0; display: none;" id="motivo1">Motivo:</div>
			</div>
			<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
	            <div class="campos">
				<?php echo $this->Form->select('obra_status', $status, array('label' => '', 'id' => 'obra_status', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
				</div>
				<div style="height: 20px; margin: 0 0 20px;	padding: 0; display: none;" id="motivo2">
				<?php echo $this->Form->input('motivo', array('label' => '', 'id' => 'motivo', 'class' => array('descricao'))); ?>
				</div>
			</div>
			<div id="areaBotao"> <!-- botão de cadastro -->
	            <?php 
	                echo $this->Js->submit('Atualizar Situação', array(
	                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
	                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
	                    'update' => '#success',
						'confirm' => 'Quer realmente atualizar a Situação desta Obra?'
	                ));
	                echo $this->Form->end(); 
	            ?>
	        </div> 
		<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
		<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
	</div>
</div>
<div id="formulariofim"></div> <!-- final do formulário -->