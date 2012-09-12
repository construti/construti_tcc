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

	</script>
	
	<script type="text/javascript" language="javascript" >
		function popupAreaCad() {
		    window.open("popup_area","Area","resizable=no,status=no,scrollbars=no,height=223,width=330,left=490,top=320,menubar=no,addressbar=no");
		}
		
		function popupAreaPesq() {
		    window.open("popup_area_pesq","Area","resizable=no,status=no,scrollbars=no,height=223,width=330,left=490,top=320,menubar=no,addressbar=no");
		}
		
		function popupTipoCad() {
		    window.open("popup_tipo","Tipo","resizable=no,status=no,scrollbars=no,height=303,width=330,left=490,top=320,menubar=no,addressbar=no");
		}
		
		function popupTipoPesq() {
		    window.open("popup_tipo_pesq","Tipo","resizable=no,status=no,scrollbars=no,height=303,width=330,left=490,top=320,menubar=no,addressbar=no");
		}
	</script>
 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Funcionario'); ?> <!-- início do formulário -->
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			<div class="campos">Nome: </div>
			
			<div class="campos">CPF: </div>
			
			<div class="campos"><div style="color: #ee0;">RG:</div> </div>
			
			<div class="campos">Data de Nascimento: </div>
			
			<div class="campos">Endereço: </div>
			
			<div class="campos">Bairro: </div>
			
			<div class="campos">Cidade: </div>
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
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
			<?php echo $this->Form->input('funcionario_data_nasc', array('label' => '', 'id' => 'funcionario_data_nasc', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') - 18, 'class' => array('intexto'))); ?>
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
			<div class="campos">Estado: </div>
			
			<div class="campos">País: </div>
			
			<div class="campos">E-mail: </div>
			
			<div class="campos"><div style="color: #ee0;">Telefone:</div> </div>
			
			<div class="campos">Área: </div>
			
			<div class="campos">Tipo: </div>
			
			<div class="campos">Salário(R$): </div>
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
				<div style="margin: 2px 0 0 5px; float: left;">
					<a onclick="popupAreaCad()" title="Cadastrar Nova Área"><div class="botaocadastrar"></div></a>
				</div>
				<div style="margin: 2px 0 0 5px; float: left;">
					<a onclick="popupAreaPesq()" title="Pesquisar Área"><div class="botaopesquisar"></div></a>
				</div>
			</div>
				
			<div class="campos">
			<?php echo $this->Form->select('funcionario_tipo', $funcionario_tipo, array('label' => '', 'id' => 'funcionario_tipo', 'class' => array('selecionar'), 'empty' => 'Escolha...')); ?>
				<div style="margin: 2px 0 0 5px; float: left;">
					<a onclick="popupTipoCad()" title="Cadastrar Novo Tipo"><div class="botaocadastrar"></div></a>
				</div>
				<div style="margin: 2px 0 0 5px; float: left;">
					<a onclick="popupTipoPesq()" title="Pesquisar Tipo"><div class="botaopesquisar"></div></a>
				</div>
			</div>
				
			<div class="campos">
			<?php echo $this->Form->input('funcionario_salario', array('label' => '', 'id' => 'funcionario_salario', 'class' => array('intexto'))); ?>
			</div>
		</div>
	<div class="legenda">
		<div style="font-size: 120%;">Legenda</div>
		<div style="text-align: justify; padding: 0 0 0 30%;">Itens Obrigatórios</div>
		<div style="text-align: justify; padding: 0 0 0 30%; color: #ee0;">Itens Opcionais</div>
	</div>
	<div id="areaBotao"> <!-- botão de cadastro -->
		<?php 
            echo $this->Js->submit('Cadastrar', array(
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