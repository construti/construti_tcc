<?php  
	echo $this->Html->script("validationFornecedor", false);
	echo $this->Html->script('jquery-ui', array('inline' => false));
	echo $this->Html->script('plugins/localisation/jquery.localisation-min', array('inline' => false));
	echo $this->Html->script('plugins/scrollTo/jquery.scrollTo-min', array('inline' => false));
	echo $this->Html->script('ui.multiselect', array('inline' => false));
	$this->pageTitle = 'Obras';
	
	$equipamentos = '';
?> 

<script>	
	$(document).ready(function(){
		obraID=$("#oid").val();
		if(obraID=='') obraID='-1';
		
		txt_str="obra_id="+obraID;
		$.get("../pega_equipamentos",txt_str,function(result){ 
			$("#equipamentos").html(result); // o html renderizado, na action pega_equipamentos, é carregado no campo equipamentos
		});
	});
	
	$(document).ready(function(){
		$("#equipamentos").change(function () {
			  var cont = 0;
	          var str = "";
	          $("select option:selected").each(function () {
	                str += '<div style="margin: 0 0 5px;">'+$(this).text() +' - Horas a Utilizar: <input name="equipamentoHora['+cont+']" id="equipamentoHora['+cont+']" class="intexto" /></div>';
					cont++;
	              });
	          $("#equipSel").html(str);
	        })
	        .change();
	});

	$(function(){
		$.localise('ui-multiselect', {/*language: 'en', */path: 'js/locale/'});
		$("#equipamentos").multiselect({dividerLocation: 0.5});
	});
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Alocar/Desalocar Equipamentos à Obra</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Lista_equipamento'); ?> <!-- início do formulário -->
		<div id="camposdescricao2"> <!-- div com a descrição dos campos -->
			<div class="campos">Obra: </div>
			
			<div class="campos">Equipamentos: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('oid', array('label' => '', 'id' => 'oid', 'value' => $obraId, 'type' => 'hidden')); ?>
            <div class="campos">
			<?php echo $this->Form->input('obra', array('label' => '', 'id' => 'obra', 'value' => $obra, 'readonly', 'class' => array('intextoDes'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->select('equipamentos', $equipamentos, array('label' => '', 'id' => 'equipamentos', 'class' => array('multiselect'), 'multiple' => 'multiple')); ?>
            </div>
		</div>
		<div id="itensSel">
			<div style="margin: 0 0 10px; font-weight: bold;">Após selecionar todos Equipamentos preencha a quantidade de horas que cada um será utilizado.</div>
			<div id="equipSel"></div>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('Atualizar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success',
				'confirm' => 'Quer realmente alocar/desalocar os equipamentos selecionados?'
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->   