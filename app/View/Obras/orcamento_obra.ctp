<?php  
	echo $this->Html->script("validationFornecedor", false);
		
	$this->pageTitle = 'Obras';
	
?> 

<script>	
	function deldivP(k) {
		$(function(){
			$('#nomeP'+k).remove();
			$('#custoP'+k).remove();
			$('#acaoP'+k).remove();
		})
	}
	
	function deldivM(k) {
		$(function(){
			$('#tipoM'+k).remove();
			$('#qtdM'+k).remove();
			$('#horasM'+k).remove();
			$('#salM'+k).remove();
			$('#acaoM'+k).remove();
		})
	}
	
	function deldivMt(k) {
		$(function(){
			$('#descMt'+k).remove();
			$('#qtdMt'+k).remove();
			$('#custoMt'+k).remove();
			$('#acaoMt'+k).remove();
		})
	}
	
	function deldivE(k) {
		$(function(){
			$('#tipoE'+k).remove();
			$('#qtdE'+k).remove();
			$('#valhoraE'+k).remove();
			$('#horasE'+k).remove();
			$('#acaoE'+k).remove();
		})
	}
	
	function deldivT(k) {
		$(function(){
			$('#tipoT'+k).remove();
			$('#custoT'+k).remove();
			$('#acaoT'+k).remove();
		})
	}
	
	$(document).ready(function(){
		$("#mao_cargo").change(function(){  // quando mudar o valor do campo funcionario_tipo é atribuido o valor desse campo e passado como parametro GET para a action pega_valor_tipo
			tipo=$(this).val();
			txt_str="funcionario_tipo="+tipo;
			$.get("../funcionarios/pega_valor_tipo_obra",txt_str,function(result){ 
				$("#mao_sal").val(result); // o html renderizado na action pega_tipo_area Ã© carregado no campo funcionario_tipo
			});
		});
	 });
	 
	 $(document).ready(function(){
		$("#mat_desc").change(function(){  // quando mudar o valor do campo funcionario_tipo é atribuido o valor desse campo e passado como parametro GET para a action pega_valor_tipo
			tipo=$(this).val();
			txt_str="material_tipo="+tipo;
			$.get("../obras/pega_valor_material",txt_str,function(result){ 
				$("#mat_custo").val(result); // o html renderizado na action pega_tipo_area Ã© carregado no campo funcionario_tipo
			});
		});
	 });
	 
	 $(document).ready(function(){
		$("#equip_tipo").change(function(){  // quando mudar o valor do campo funcionario_tipo é atribuido o valor desse campo e passado como parametro GET para a action pega_valor_tipo
			tipo=$(this).val();
			txt_str="equipamento_tipo="+tipo;
			$.get("../obras/pega_valor_equipamento",txt_str,function(result){ 
				$("#equip_valor").val(result); // o html renderizado na action pega_tipo_area Ã© carregado no campo funcionario_tipo
			});
		});
	 });
	
	
	$(function(){
		var i = 0;
		
		$("#adicionarProj").click(function() {
		
			var projetoNOME = $("#projetos_nome").val();
			var projetoCUSTO = $("#projetos_custo").val();
				
			if (projetoNOME != '' && projetoCUSTO!=''){
				
				$('#inputsproj').append("<div class='nomeP' id=nomeP"+i+">"+projetoNOME+"<input value="+projetoNOME+" name=data[proj]["+i+"][Previsao_projeto][tipo] type=hidden readonly></input></div>");
				$('#inputsproj').append("<div class='custoP' id=custoP"+i+">"+projetoCUSTO+"<input value="+projetoCUSTO+" name=data[proj]["+i+"][Previsao_projeto][custo] type=hidden readonly></input></div>");
				$('#inputsproj').append("<div class='acaoT' id='acaoP"+i+"'><input value='X' class='deldiv' name='botaoP' type='button' id='botaoP"+i+"' onclick='deldivP("+i+")' readonly></input></div>");
				i++;
			}
		
			$("#projetos_nome").val('');
			$("#projetos_custo").val('');
		})
	});
	
	$(function(){
		var k = 0;
		
		$("#adicionarMao").click(function() {
		
			var maoID = $("#mao_cargo").val();
			var maoTIPO = $('#mao_cargo option:selected').html();
			var maoQTD = $("#mao_qtd").val();
			var maoHORAS = $("#mao_horas").val();
			var maoSAL = $("#mao_sal").val();
				
			if (maoID != '' && maoQTD!='' && maoHORAS!='' && maoSAL!=''){
				
				$('#inputsmao').append("<div class='tipoM' id=tipoM"+k+">"+maoTIPO+"<input value="+maoID+" name=data[mao]["+k+"][Previsao_funcionario][tipo_id] type=hidden readonly></input></div>");
				$('#inputsmao').append("<div class='horasM' id=qtdM"+k+">"+maoQTD+"<input value="+maoQTD+" name=data[mao]["+k+"][Previsao_funcionario][qtd] type=hidden readonly></input></div>");
				$('#inputsmao').append("<div class='horasM' id=horasM"+k+">"+maoHORAS+"<input value="+maoHORAS+" name=data[mao]["+k+"][Previsao_funcionario][qtd_horas] type=hidden readonly></input></div>");
				$('#inputsmao').append("<div class='salM' id=salM"+k+">"+maoSAL+"<input value="+maoSAL+" name=data[mao]["+k+"][Previsao_funcionario][salario] type=hidden readonly></input></div>");
				$('#inputsmao').append("<div class='acaoT' id='acaoM"+k+"'><input value='X' class='deldiv' name='botaoM' type='button' id='botaoM"+k+"' onclick='deldivM("+k+")' readonly></input></div>");
				k++;
			}
		
			$("#mao_cargo").val('');
			$("#mao_qtd").val('');
			$("#mao_horas").val('');
			$("#mao_sal").val('');
		})
	});
	
	$(function(){
		var m = 0;
		
		$("#adicionarMat").click(function() {
		
			var matID = $("#mat_desc").val();
			var matDESC = $('#mat_desc option:selected').html();
			var matQTD = $("#mat_qtd").val();
			var matCUSTO = $("#mat_custo").val();
				
			if (matID != '' && matQTD!='' && matCUSTO!=''){
				
				$('#inputsmat').append("<div class='descM' id=descMt"+m+">"+matDESC+"<input value="+matID+" name=data[mat]["+m+"][Previsao_material][material_id] type=hidden readonly></input></div>");
				$('#inputsmat').append("<div class='horasM' id=qtdMt"+m+">"+matQTD+"<input value="+matQTD+" name=data[mat]["+m+"][Previsao_material][qtd] type=hidden readonly></input></div>");
				$('#inputsmat').append("<div class='salM' id=custoMt"+m+">"+matCUSTO+"<input value="+matCUSTO+" name=data[mat]["+m+"][Previsao_material][custo] type=hidden readonly></input></div>");
				$('#inputsmat').append("<div class='acaoT' id='acaoMt"+m+"'><input value='X' class='deldiv' name='botaoMt' type='button' id='botaoMt"+m+"' onclick='deldivMt("+m+")' readonly></input></div>");
				m++;
			}
		
			$("#mat_desc").val('');
			$("#mat_qtd").val('');
			$("#mat_custo").val('');
		})
	});
	
	$(function(){
		var n = 0;
		
		$("#adicionarEquip").click(function() {
		
			var equipID = $("#equip_tipo").val();
			var equipTIPO = $('#equip_tipo option:selected').html();
			var equipQTD = $("#equip_qtd").val();
			var equipVALHORA = $("#equip_valor").val();
			var equipHORAS = $("#equip_horas").val();
				
			if (equipID != '' && equipQTD!='' && equipVALHORA!='' && equipHORAS!=''){
				
				$('#inputsequip').append("<div class='tipoM' id=tipoE"+n+">"+equipTIPO+"<input value="+equipID+" name=data[equip]["+n+"][Previsao_equipamento][tipo_id] type=hidden readonly></input></div>");
				$('#inputsequip').append("<div class='horasM' id=qtdE"+n+">"+equipQTD+"<input value="+equipQTD+" name=data[equip]["+n+"][Previsao_equipamento][qtd] type=hidden readonly></input></div>");
				$('#inputsequip').append("<div class='horasM' id=valhoraE"+n+">"+equipVALHORA+"<input value="+equipVALHORA+" name=data[equip]["+n+"][Previsao_equipamento][valor_hora] type=hidden readonly></input></div>");
				$('#inputsequip').append("<div class='salM' id=horasE"+n+">"+equipHORAS+"<input value="+equipHORAS+" name=data[equip]["+n+"][Previsao_equipamento][qtd_horas] type=hidden readonly></input></div>");
				$('#inputsequip').append("<div class='acaoT' id='acaoE"+n+"'><input value='X' class='deldiv' name='botaoE' type='button' id='botaoE"+n+"' onclick='deldivE("+n+")' readonly></input></div>");
				n++;
			}
		
			$("#equip_tipo").val('');
			$("#equip_qtd").val('');
			$("#equip_valor").val('');
			$("#equip_horas").val('');
		})
	});
	
	$(function(){
		var p = 0;
		
		$("#adicionarTaxa").click(function() {
		
			var taxaTIPO = $("#taxa_tipo").val();
			var taxaCUSTO = $("#taxa_custo").val();
				
			if (taxaTIPO != '' && taxaCUSTO!=''){
				
				$('#inputstaxa').append("<div class='nomeP' id=tipoT"+p+">"+taxaTIPO+"<input value="+taxaTIPO+" name=data[taxa]["+p+"][Previsao_taxa][descricao] type=hidden readonly></input></div>");
				$('#inputstaxa').append("<div class='custoP' id=custoT"+p+">"+taxaCUSTO+"<input value="+taxaCUSTO+" name=data[taxa]["+p+"][Previsao_taxa][custo] type=hidden readonly></input></div>");
				$('#inputstaxa').append("<div class='acaoT' id='acaoT"+p+"'><input value='X' class='deldiv' name='botaoT' type='button' id='botaoT"+p+"' onclick='deldivT("+p+")' readonly></input></div>");
				p++;
			}
		
			$("#taxa_tipo").val('');
			$("#taxa_custo").val('');
		})
	});
</script>
<style>
#ttipo {
	float: left;
	text-align: left;
	width: 72%;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #f4f4f4;
}
#tcargo {
	float: left;
	text-align: left;
	width: 56%;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #f4f4f4;
}
#tequip {
	float: left;
	text-align: left;
	width: 40%;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #f4f4f4;
}
#tcusto {
	float: left;
	text-align: center;
	width: 16%;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #f4f4f4;
}
#tacao {
	float: left;
	text-align: center;
	width: 11%;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	border-right: 1px #008 solid;
	background: #f4f4f4;
}
.nomeP {
	float: left;
	text-align: left;
	width: 72%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
.custoP{
	float: left;
	text-align: center;
	width: 16%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
.acaoT{
	float: left;
	text-align: center;
	width: 11%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	border-right: 1px solid #008;
	background: #fff;
}
.tipoM {
	float: left;
	text-align: left;
	width: 40%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
.horasM {
	float: left;
	text-align: center;
	width: 16%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
.salM {
	float: left;
	text-align: center;
	width: 16%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
.descM {
	float: left;
	text-align: left;
	width: 56%;
	height: 20px;
	border-left-width: 1px;
	border-left-color: #008;
	border-left-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: #008;
	border-bottom-style: solid;
	background: #fff;
}
</style>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Previsão de Orçamento de Obra</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
		<?php echo $this->Form->create('Previsao_obra'); ?> <!-- início do formulário -->
		<div style="float: left; width: 800px;	margin: 0 0 10px; text-align: right; font-size: 14px; padding: 20px 0 0 10%;"> <!-- div com a descrição dos campos -->
			<div style="width: 800px; height: 25px ; margin: 0; padding: 0; float: left; text-align: center;">
				<div style="float: left; padding: 0 0 0 35%;">Obra: </div>
				<div style="float: left;"><?php echo $this->Form->select('obra_id', $obras, array('label' => '', 'id' => 'obra_id', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?></div>
			</div>
			
			<div style="height: 20px ; margin: 18px 0 5px; padding: 0; float: left;">Projetos: </div>
			<div style="height: 40px ; margin: 0 0 5px; padding: 0; float: left;">				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Tipo:</div>
					<div style="margin: 0;">
						<?php $projetos= array('arquitetural' => 'Arquitetural', 'eletrico' => 'Elétrico' , 'estrutural' => 'Estrutural', 'fundacao' => 'Fundação', 'hidraulico' => 'Hidráulico', 'terraplenagem' => 'Terraplenagem');
						echo $this->Form->select('projetos_nome', $projetos, array('label' => '', 'id' => 'projetos_nome', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Custo:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('projetos_custo', array('label' => '', 'id' => 'projetos_custo', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 15px 10px 0 5px; float: left;"> <!-- botão para adicionar à lista -->
			        <?php 
						 echo $this->Form->button('+', array('label' => '', 'type' => 'button' , 'id' => 'adicionarProj'));
			        ?>
			    </div>	
			</div>
            
			<div style="width: 800px; backgroung: #a00; float: left;">
				<div id="lista" >
					<div id="sublistaA" >
						<div id="listatitulo">Projetos</div>
						<div id="lacunas">
							<div id="ttipo">Tipo</div>
							<div id="tcusto">Custo</div>
							<div id="tacao">Remover</div>
						</div>
						<div id="inputsproj">
					
						</div>
					</div>
				</div>
			</div>
			
			<div style="height: 20px; margin: 28px 0 5px; padding: 0; float: left;">Mão de Obra: </div>
			<div style="height: 20px; margin: 10px 0 5px; padding: 0; float: left; ">				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Cargo:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->select('mao_cargo', $tiposFunc, array('label' => '', 'id' => 'mao_cargo', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Quantidade:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('mao_qtd', array('label' => '', 'id' => 'mao_qtd', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Horas a Trabalhar:</div>
					<div style="margin: 0; text-align: left;">
						<?php echo $this->Form->input('mao_horas', array('label' => '', 'id' => 'mao_horas', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Salário/Hora:</div>
					<div style="margin: 0; text-align: left;">
						<?php echo $this->Form->input('mao_sal', array('label' => '', 'id' => 'mao_sal', 'size' => '10', 'readonly', 'class' => array('intextoDes'))); ?>
					</div>
				</div>
				
				<div style="margin: 15px 10px 0 5px; float: left;"> <!-- botão para adicionar à lista -->
			        <?php 
						 echo $this->Form->button('+', array('label' => '', 'type' => 'button' , 'id' => 'adicionarMao'));
			        ?>
			    </div>
			</div>
            
			<div style="width: 800px; backgroung: #a00; float: left;">
				<div id="lista">
					<div id="sublistaA">
						<div id="listatitulo">Mão de Obra</div>
						<div id="lacunas">
							<div id="tequip">Cargo</div>
							<div id="tcusto">Quantidade</div>
							<div id="tcusto">Horas a Trabalhar</div>
							<div id="tcusto">Salário/Hora</div>
							<div id="tacao">Remover</div>
						</div>
						<div id="inputsmao">
					
						</div>
					</div>
				</div>
			</div>
			
			<div style="height: 20px ;margin: 28px 0 5px; padding: 0; float: left; ">Materiais: </div>
			<div style="height: 20px ;margin: 10px 0 5px; padding: 0; float: left; ">
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Descrição:</div>
					<div style="margin: 0;">
						<?php 
						$materiais = array(); 
						foreach($tiposMat as $tm):
							$materiais[$tm['materiais']['material_id']] = $tm[0]['descricao'];
						endforeach;						
						
						echo $this->Form->select('mat_desc', $materiais, array('label' => '', 'id' => 'mat_desc', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Quantidade:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('mat_qtd', array('label' => '', 'id' => 'mat_qtd', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Custo:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('mat_custo', array('label' => '', 'id' => 'mat_custo', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 15px 10px 0 5px; float: left;"> <!-- botão para adicionar à lista -->
			        <?php 
						 echo $this->Form->button('+', array('label' => '', 'type' => 'button' , 'id' => 'adicionarMat'));
			        ?>
			    </div>
			</div>
            
			<div style="width: 800px; backgroung: #a00; float: left;">
				<div id="lista">
					<div id="sublistaA">
						<div id="listatitulo">Materiais</div>
						<div id="lacunas">
							<div id="tcargo">Descrição</div>
							<div id="tcusto">Quantidade</div>
							<div id="tcusto">Custo</div>
							<div id="tacao">Remover</div>
						</div>
						<div id="inputsmat">
					
						</div>
					</div>
				</div>
			</div>
			
			<div style="height: 20px ;margin: 28px 0 5px; padding: 0; float: left; ">Equipamentos: </div>
			<div style="height: 20px ;margin: 10px 0 5px; padding: 0; float: left; ">
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Tipo:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->select('equip_tipo', $tiposEquip, array('label' => '', 'id' => 'equip_tipo', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Quantidade:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('equip_qtd', array('label' => '', 'id' => 'equip_qtd', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Valor/Hora:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('equip_valor', array('label' => '', 'id' => 'equip_valor', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Horas a Utilizar:</div>
					<div style="margin: 0; text-align: left;">
						<?php echo $this->Form->input('equip_horas', array('label' => '', 'id' => 'equip_horas', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 15px 10px 0 5px; float: left;"> <!-- botão para adicionar à lista -->
			        <?php 
						 echo $this->Form->button('+', array('label' => '', 'type' => 'button' , 'id' => 'adicionarEquip'));
			        ?>
			    </div>
			</div>
            
			<div style="width: 800px; backgroung: #a00; float: left;">
				<div id="lista">
					<div id="sublistaA">
						<div id="listatitulo">Equipamentos</div>
						<div id="lacunas">
							<div id="tequip">Tipo</div>
							<div id="tcusto">Quantidade</div>
							<div id="tcusto">Valor/hora</div>
							<div id="tcusto">Horas a Utilizar</div>
							<div id="tacao">Remover</div>
						</div>
						<div id="inputsequip">
					
						</div>
					</div>
				</div>
			</div>
			
			<div style="height: 20px ; margin: 28px 0 5px; padding: 0; float: left;">Taxas: </div>
			<div style="height: 40px ; margin: 10px 0 5px; padding: 0; float: left;">				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Tipo:</div>
					<div style="margin: 0;">
						<?php 
						$opcoes_tipo = array(
							'Água' => 'Água', 
							'Alimentação' => 'Alimentação',
							'COFINS' => 'COFINS',
							'Esgoto' => 'Esgoto',
							'ISS' => 'ISS',
							'Luz' => 'Luz' ,
							'PASEP' => 'PASEP',
							'PIS' => 'PIS',
							'Telefone' => 'Telefone',
							'Transporte' => 'Transporte',
							'Xerox' => 'Xerox'
						);
						
						echo $this->Form->select('taxa_tipo', $opcoes_tipo, array('label' => '', 'id' => 'taxa_tipo', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0; text-align: left;">Custo:</div>
					<div style="margin: 0;">
						<?php echo $this->Form->input('taxa_custo', array('label' => '', 'id' => 'taxa_custo', 'size' => '10', 'class' => array('intexto')));  ?>
					</div>
				</div>
				
				<div style="margin: 15px 10px 0 5px; float: left;"> <!-- botão para adicionar à lista -->
			        <?php 
						 echo $this->Form->button('+', array('label' => '', 'type' => 'button' , 'id' => 'adicionarTaxa'));
			        ?>
			    </div>
			</div>
            
			<div style="width: 800px; backgroung: #a00; float: left;">
				<div id="lista" >
					<div id="sublistaA" >
						<div id="listatitulo">Taxas</div>
						<div id="lacunas">
							<div id="ttipo">Tipo</div>
							<div id="tcusto">Custo</div>
							<div id="tacao">Remover</div>
						</div>
						<div id="inputstaxa">
					
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Gerar Orçamento', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success'
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->   