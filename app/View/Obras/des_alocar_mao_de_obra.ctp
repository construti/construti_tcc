<?php  
	echo $this->Html->script("validationFornecedor", false);
	echo $this->Html->script('jquery-ui', array('inline' => false));
	echo $this->Html->script('plugins/localisation/jquery.localisation-min', array('inline' => false));
	echo $this->Html->script('plugins/scrollTo/jquery.scrollTo-min', array('inline' => false));
	echo $this->Html->script('ui.multiselect', array('inline' => false));
	$this->pageTitle = 'Obras';
	
	$funcionarios = '';
?> 

<script>	
	$(document).ready(function(){
		obraID=$("#oid").val();
		if(obraID=='') obraID='-1';
		
		txt_str="obra_id="+obraID;
		$.get("../pega_mao_de_obra",txt_str,function(result){ 
			$("#funcionarios").html(result); // o html renderizado, na action pega_mao_de_obra, é carregado no campo funcionarios
		});
	});
	
	$(document).ready(function(){
		$("#funcionarios").change(function () {
			  var cont = 0;
	          var str = "";
	          $("select option:selected").each(function () {
	                str += '<div style="margin: 0 0 5px;">'+$(this).text() +' - Horas a Trabalhar: <input name="funcionarioSel['+cont+']" id="funcionarioSel['+cont+']" class="intexto" /></div>';
					cont++;
	              });
	          $("#funcSel").html(str);
	        })
	        .change();
	});

	$(function(){
		$.localise('ui-multiselect', {/*language: 'en', */path: 'js/locale/'});
		$("#funcionarios").multiselect();
	});
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Alocar/Desalocar Mão de Obra</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Lista_funcionario'); ?> <!-- início do formulário -->
		<div id="camposdescricao2"> <!-- div com a descrição dos campos -->
			<div class="campos">Obra: </div>
			
			<div class="campos">Mão de Obra: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('oid', array('label' => '', 'id' => 'oid', 'value' => $obraId, 'type' => 'hidden')); ?>
            <div class="campos">
			<?php echo $this->Form->input('obra', array('label' => '', 'id' => 'obra', 'value' => $obra, 'readonly', 'class' => array('intextoDes'))); ?>
            </div>
			
			<div class="campos">
			<?php echo $this->Form->select('funcionarios', $funcionarios, array('label' => '', 'id' => 'funcionarios', 'class' => array('multiselect'), 'multiple' => 'multiple')); ?>
            </div>
		</div>
		<div id="itensSel">
			<div style="margin: 0 0 10px; font-weight: bold;">Após selecionar todos Funcionários preencha a quantidade de horas que cada um trabalhará.</div>
			<div id="funcSel"></div>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
			echo $this->Js->submit('(Des)Alocar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success',
				'confirm' => 'Quer realmente alocar/desalocar os funcionários selecionados?'
            ));
            echo $this->Form->end(); //fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->   