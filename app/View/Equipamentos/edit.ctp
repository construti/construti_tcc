<?php  
	echo $this->Html->script("validationEquipamento", false); 
	$this->pageTitle = 'Equipamentos';
?> 

<script>	 
		$(document).ready(function(){
			$("#equipamento_tipo").change(function(){  // quando mudar o valor do campo equipamento_tipo é atribuido o valor desse campo e passado como parametro GET para a action pega_valor_tipo
				tipo=$(this).val();
				txt_str="equipamento_tipo="+tipo;
				$.get("../equipamentos/pega_valor_tipo",txt_str,function(result){ 
					$("#equipamento_valor_hora").val(result); // o html renderizado na action pega_tipo_area é carregado no campo equipamento_tipo
				});
			});
		 });
</script>

<script type="text/javascript" language="javascript" >
		function popupTipoCad() {
		    window.open("popup_tipo","Tipo","resizable=no,status=no,scrollbars=no,height=285,width=375,left=490,top=320,menubar=no,addressbar=no");
		}
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Equipamento'); ?> <!-- início do formulário -->
		<div class="legenda">* = Campos Obrigatórios</div>
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			<div class="campos">Nome*: </div>
			<div class="campos">Tipo*: </div>
			<div class="campos">Valor/Hora*: </div>
			<div class="campos">Descrição: </div>
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			
			<div class="campos">
			<?php echo $this->Form->input('equipamento_nome', array('label' => '', 'id' => 'equipamento_nome', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->select('equipamento_tipo', $tipos, array('label' => '', 'id' => 'equipamento_tipo', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
				<div class="minibotoes">
					<a onclick="popupTipoCad()" title="Cadastrar Novo Tipo"><div class="botaocadastrar"></div></a>
				</div>
				<div class="minibotoes">
					<a href="<?php echo $this->params->base."/equipamentos/search_tipo"; ?>" title="Pesquisar Tipo" target="_blank"><div class="botaopesquisar"></div></a>
				</div>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('equipamento_valor_hora', array('label' => '', 'id' => 'equipamento_valor_hora', 'class' => array('intexto'))); ?> 
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('equipamento_descricao', array('label' => '', 'id' => 'equipamento_descricao', 'class' => array('descricao'))); ?>
			</div>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
        <?php 
            echo $this->Js->submit('Atualizar', array(
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