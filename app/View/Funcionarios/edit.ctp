<?php  
	echo $this->Html->script("validationFuncionario", false); 
	$this->pageTitle = 'Funcionários';
	$funcionario_tipo = '';
?> 

<script>
		$(document).ready(function(){
			$("#funcionario_area").change(function(){  // quando mudar o valor do campo funcionario_area é atribuido o valor desse campo e passado como parametro GET para a action pega_tipo_area
				area=$(this).val();
				txt_str="funcionario_area="+area;
				$.get("../funcionarios/pega_tipo_area",txt_str,function(result){ 
					$("#funcionario_tipo").html(result); // o html renderizado na action pega_tipo_area é carregado no campo funcionario_tipo
				});
			});
		 });

		$(document).ready(function(){
			$("#funcionario_tipo").change(function(){  // quando mudar o valor do campo funcionario_tipo é atribuido o valor desse campo e passado como parametro GET para a action pega_valor_tipo
				tipo=$(this).val();
				txt_str="funcionario_tipo="+tipo;
				$.get("../funcionarios/pega_valor_tipo",txt_str,function(result){ 
					$("#funcionario_salario").val(result); // o html renderizado na action pega_tipo_area Ã© carregado no campo funcionario_tipo
				});
			});
		 });
</script>

<script type="text/javascript" language="javascript" >
		function popupAreaCad() {
		    window.open("popup_area","Area","resizable=no,status=no,scrollbars=no,height=223,width=375,left=490,top=320,menubar=no,addressbar=no");
		}
		
		/*function popupAreaPesq() {
		    window.open("popup_area_pesq","Area","resizable=no,status=no,scrollbars=no,height=223,width=330,left=490,top=320,menubar=no,addressbar=no");
		}*/
		
		function popupTipoCad() {
		    window.open("popup_tipo","Tipo","resizable=no,status=no,scrollbars=no,height=303,width=375,left=490,top=320,menubar=no,addressbar=no");
		}
		
		/*function popupTipoPesq() {
		    window.open("popup_tipo_pesq","Tipo","resizable=no,status=no,scrollbars=no,height=303,width=330,left=490,top=320,menubar=no,addressbar=no");
		}*/
</script>

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Funcionario'); ?> <!-- início do formulário -->
		<div class="legenda">* = Campos Obrigatórios</div>
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			<div class="campos">Nome*: </div>
			
			<div class="campos">CPF*: </div>
 			
			<div class="campos">RG: </div>
 			
			<div class="campos">Data de Nascimento*: </div>
 			
			<div class="campos">Endereço*: </div>
 			
			<div class="campos">Bairro*: </div>
 			
			<div class="campos">Cidade*: </div>
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<div class="campos">
			<?php echo $this->Form->input('funcionario_nome', array('label' => '', 'id' => 'funcionario_nome', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_cpf', array('label' => '', 'id' => 'funcionario_cpf', 'maxlength' => 11, 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_rg', array('label' => '', 'id' => 'funcionario_rg', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_data_nasc', array('label' => '', 'id' => 'funcionario_data_nasc', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') - 18, 'dateFormat' => 'DMY', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_endereco', array('label' => '', 'id' => 'funcionario_endereco', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_bairro', array('label' => '', 'id' => 'funcionario_bairro', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_cidade', array('label' => '', 'id' => 'funcionario_cidade', 'class' => array('intexto'))); ?>
			</div>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			<div class="campos">Estado*: </div>
 			
			<div class="campos">País*: </div>
 			
			<div class="campos">E-mail*: </div>
 			
			<div class="campos">Telefone: </div>
 			
			<div class="campos">Área*: </div>
 			
			<div class="campos">Tipo*: </div>
 			
			<div class="campos">Salário*: </div>
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<div class="campos">
			<?php echo $this->Form->input('funcionario_estado', array('label' => '', 'id' => 'funcionario_estado', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_pais', array('label' => '', 'id' => 'funcionario_pais', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_email', array('label' => '', 'id' => 'funcionario_email', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_telefone', array('label' => '', 'id' => 'funcionario_telefone', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php 
				echo $this->Form->input('funcionario_area', array('label' => '', 'id' => 'funcionario_area', 'type' => 'select', 'options' => $areas , 'class' => array('selecionar'), 'empty' => 'Escolha...'));	
			?>
				<div class="minibotoes">
					<a onclick="popupAreaCad()" title="Cadastrar Nova Ãrea"><div class="botaocadastrar"></div></a>
				</div>
				<div class="minibotoes">
					<a href="<?php echo $this->params->base."/funcionarios/search_area"; ?>" title="Pesquisar Ãrea" target="_blank"><div class="botaopesquisar"></div></a>
				</div>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->select('funcionario_tipo', $funcionario_tipo, array('label' => '', 'id' => 'funcionario_tipo', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
				<div class="minibotoes">
					<a onclick="popupTipoCad()" title="Cadastrar Novo Tipo"><div class="botaocadastrar"></div></a>
				</div>
				<div class="minibotoes">
					<a href="<?php echo $this->params->base."/funcionarios/search_tipo"; ?>" title="Pesquisar Tipo" target="_blank"><div class="botaopesquisar"></div></a>
				</div>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('funcionario_salario', array('label' => '', 'id' => 'funcionario_salario', 'class' => array('intexto'))); ?>
			</div>
		</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
		<?php 
            echo $this->Js->submit('Atualizar', array(
                'before' => $this->Js->get('#sending')->effect('fadeIn'),
                'success' => $this->Js->get('#sending')->effect('fadeOut'),
                'update' => '#success'
            ));
            echo $this->Form->end(); // fim do formulário
        ?>
    </div> 
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->