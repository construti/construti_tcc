<?php  
	echo $this->Html->script("validationFornecedor", false);
	echo $this->Html->script('jquery-ui', array('inline' => false));
	echo $this->Html->script('plugins/localisation/jquery.localisation-min', array('inline' => false));
	echo $this->Html->script('plugins/scrollTo/jquery.scrollTo-min', array('inline' => false));
	echo $this->Html->script('ui.multiselect', array('inline' => false));
	$this->pageTitle = 'Fornecedores';
	
	$fornecedores = '';
?> 

<script>	
	function deldivM(k) {
		$(function(){
			$('#nomeM'+k).remove();
			$('#qtdM'+k).remove();
			$('#fornM'+k).remove();
			$('#acaoM'+k).remove();
		})
	}
	
	function deldivE(k) {
		$(function(){
			$('#nomeE'+k).remove();
			$('#qtdE'+k).remove();
			$('#alugE'+k).remove();
			$('#fornE'+k).remove();
			$('#acaoE'+k).remove();
		})
	}
	
	$(document).ready(function(){
		$("#material").change(function(){  // quando mudar o valor do campo material, é atribuido o valor desse campo, e passado como parametro GET para a action pega_fornecedores_mat_equip
			matID=$(this).val();
			txt_str="material_id="+matID;
			$.get("../fornecedores/pega_fornecedores_mat_equip",txt_str,function(result){ 
				$("#forns").html(result); // o html renderizado, na action pega_fornecedores_mat_equip, é carregado no campo forns
				$('.remove-all').trigger('click');
			});
		});
	});
	
	
	$(function(){
		var i = 0;
		
		$("#adicionarLista").click(function() {
		
			var materialID = $("#material").val();
			var materialNOME = $('#material option:selected').html();
			var materialQTD = $("#qtd_material").val();
			
			var equipamentoID = $("#equip").val();
			var equipamentoNOME = $('#equip option:selected').html();
			var equipamentoQTD = $("#qtd_equip").val();
			var equipamentoAL = $("input[@name=equip_al]:checked").val();
			
			var fornecedores = $('select#forns').val();
			
			if(fornecedores!=''){
				
				$.each(fornecedores, function(key, forn) { 
				  	var fornec = $('#forns option:eq('+key+')').html(); // pega o nome do fornecedor
					//alert('idM: '+ materialID + ' qtdM: ' + materialQTD + ' idE: ' + equipamentoID + ' qtdE: ' + equipamentoQTD + ' alugE:  ' + equipamentoAL);
					if (materialID != '' && materialQTD!=''){
						
					$('#inputsmat').append('<div class="nomeM" id="nomeM'+i+'">'+materialNOME+'<input value='+materialID+' name="materialid'+i+'" type="hidden" readonly></input></div>');
					$('#inputsmat').append('<div class="qtdM" id="qtdM'+i+'">'+materialQTD+'<input value='+materialQTD+' name="materialqtd'+i+'" type="hidden" readonly></input></div>');
					$('#inputsmat').append('<div class="fornM" id="fornM'+i+'">'+fornec+'<input value='+forn+' name="materialforn'+i+'" type="hidden" readonly></input></div>');
					$('#inputsmat').append('<div class="acaoM" id="acaoM'+i+'"><input value="X" class="deldiv" name="botao" type="button" id="botao'+i+'" onclick="deldivM('+i+')" readonly></input></div>');
					
					}
					
					if (equipamentoID != '' && equipamentoQTD!='' && typeof equipamentoAL!='undefined'){
						$('#inputsequip').append('<div class="nomeE" id="nomeE'+i+'">'+equipamentoNOME+'<input value='+equipamentoID+' name="equipamentoid'+i+'" type="hidden" readonly></input></div>');
						$('#inputsequip').append('<div class="qtdE" id="qtdE'+i+'">'+equipamentoQTD+'<input value='+equipamentoQTD+' name="equipamentoqtd'+i+'" type="hidden" readonly></input></div>');
						$('#inputsequip').append('<div class="alugE" id="alugE'+i+'">'+equipamentoAL+'<input value='+equipamentoAL+' name="equipamentoal'+i+'" type="hidden" readonly></input></div>');
						$('#inputsequip').append('<div class="fornE" id="fornE'+i+'">'+fornec+'<input value='+forn+' name="equipamentoforn'+i+'" type="hidden" readonly></input></div>');
						$('#inputsequip').append('<div class="acaoE" id="acaoE'+i+'"><input value="X" class="deldiv" name="botao" type="button" id="botao'+i+'" onclick="deldivE('+i+')" readonly></input></div>');
					}
				
					$("#material").val('');
					$("#qtd_material").val('');
					
					$("#equip").val('');
					$("#qtd_equip").val('');
					$("input[@name=equip_al]:checked").prop('checked', false);;
				});
			}	
								
			i++;
		})
	});
	
	$(function(){
		//$.localise('ui-multiselect', {/*language: 'en', */path: 'js/locale/'});
		$("#forns").multiselect();
	});	
	
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Requisitar Orçamento</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
		<div id="camposdescricaoorc"> <!-- div com a descrição dos campos -->
			<div class="campos">Material: </div>
			
			<div class="campos">Equipamento: </div>
			
			<div class="campos">Fornecedores: </div>
		</div>
		<div id="camposlacunasorc"> <!-- div com os campos a serem preenchidos -->
			<div class="campos">
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0 5px 0;">Nome:</div>
					<div style="margin: 0 5px 0;">
						<?php echo $this->Form->select('material', $materiais_array, array('label' => '', 'id' => 'material', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				<div style="margin: 0 10px 0 5px; float: left;">
					<div style="margin: 0 5px 0;">Qtd:</div>
					<div style="margin: 0 5px 0;">
						<?php echo $this->Form->input('qtd_material', array('label' => '', 'id' => 'qtd_material', 'size' => '5', 'class' => array('intexto')));  ?>
					</div>
				</div>
            </div>
			<div class="campos">
				<div style="margin: 5px 10px 0 5px; float: left;">
					<div style="margin: 0 5px 0;">Nome:</div>
					<div style="margin: 0 5px 0;">
						<?php echo $this->Form->select('equip', $equipamentos, array('label' => '', 'id' => 'equip', 'empty' => 'Escolha...', 'class' => array('selecionar'))); ?>
					</div>
				</div>
				<div style="margin: 5px 10px 0 5px; float: left;">
					<div style="margin: 0 5px 0;">Qtd:</div>
					<div style="margin: 0 5px 0;">
						<?php echo $this->Form->input('qtd_equip', array('label' => '', 'id' => 'qtd_equip', 'size' => '5', 'class' => array('intexto')));  ?>
					</div>
				</div>
				<div style="margin: 5px 10px 0 5px; float: left;">
					<div style="margin: 15px 5px 0;">
					<?php 
						$opcoes_alugado = array('A' => 'Alugar', 'C' => 'Comprar');
						$atributos_alugado = array('label' => '', 'legend' => false, 'id' => 'equip_al', 'class' => array('intexto'));
						echo $this->Form->radio('equip_al', $opcoes_alugado, $atributos_alugado);
					?>
					</div>
				</div>
            </div>
			
			<div style="margin: 40px 0 0 0;">
				<?php echo $this->Form->select('forns', $fornecedores, array('label' => '', 'id' => 'forns', 'class' => array('multiselect'), 'multiple' => 'multiple')); ?>
			</div>
		</div>
	<div id="areaBotao"> <!-- botão para adicionar à lista -->
        <?php 
			 echo $this->Form->input('Adicionar', array('label' => '', 'type' => 'button' , 'id' => 'adicionarLista'));
        ?>
    </div>	
	<?php echo $this->Form->create('Orcamento_materiais'); ?> <!-- início do formulário -->
	<div id="lista">
		<div id="sublistaA">
			<div id="listatitulo">Materiais</div>
			<div id="lacunas">
				<div id="nome">Nome</div>
				<div id="qtd">Quantidade</div>
				<div id="forn">Fornecedor</div>
				<div id="acao">Ação</div>
			</div>
			<div id="inputsmat">
				
			</div>
		</div>
		<div style="height: 1px; clear: both;"></div>
		<div id="sublistaB">
			<div id="listatitulo">Equipamento</div>
			<div id="lacunas">
				<div id="nome">Nome</div>
				<div id="qtd">Quantidade</div>
				<div id="nec">Necessidade</div>
				<div id="forn">Fornecedor</div>
				<div id="acao">Ação</div>
			</div>
			<div id="inputsequip">
				
			</div>
		</div>	
	</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Cadastrar', array(
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