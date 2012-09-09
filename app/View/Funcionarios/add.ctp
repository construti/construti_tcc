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
 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Funcionario'); ?> <!-- início do formulário -->
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			Nome: <br/><br/>
			
			CPF: <br/><br/>
			
			<div style="color: #ee0;">RG:</div> <br/>
			
			Data de Nascimento: <br/><br/>
			
			Endereço: <br/><br/>
			
			Bairro: <br/><br/>
			
			Cidade: 
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
            <?php echo $this->Form->input('funcionario_nome', array('label' => '', 'id' => 'funcionario_nome', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_cpf', array('label' => '', 'id' => 'funcionario_cpf', 'maxlength' => 11, 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_rg', array('label' => '', 'id' => 'funcionario_rg', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_data_nasc', array('label' => '', 'id' => 'funcionario_data_nasc', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') - 18, 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_endereco', array('label' => '', 'id' => 'funcionario_endereco', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_bairro', array('label' => '', 'id' => 'funcionario_bairro', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_cidade', array('label' => '', 'id' => 'funcionario_cidade', 'class' => array('intexto'))); ?>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			Estado: <br/><br/>
			
			País: <br/><br/>
			
			E-mail: <br/><br/>
			
			<div style="color: #ee0;">Telefone:</div> <br/>
			
			Área: <br/><br/>
			
			Tipo: <br/><br/>
			
			Salário(R$): 
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<?php echo $this->Form->input('funcionario_estado', array('label' => '', 'id' => 'funcionario_estado', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_pais', array('label' => '', 'id' => 'funcionario_pais', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_email', array('label' => '', 'id' => 'funcionario_email', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_telefone', array('label' => '', 'id' => 'funcionario_telefone', 'class' => array('intexto'))); ?>
			<br/>
			
			<div style="margin: 3px 0 0;">
				<?php $opcoes_area = array('construcao' => 'Construção', 'administracao' => 'Administração' , 'tecnica' => 'Técnica');
					echo $this->Form->input('funcionario_area', array('label' => '', 'id' => 'funcionario_area', 'type' => 'select', 'options' => $opcoes_area , 'class' => array('intexto'), 'empty' => 'Escolha...'));	?>
				<br/>	
				
				<?php echo $this->Form->select('funcionario_tipo', $funcionario_tipo, array('label' => '', 'id' => 'funcionario_tipo', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
				<br/><br/>
				
				<?php echo $this->Form->input('funcionario_salario', array('label' => '', 'id' => 'funcionario_salario', 'class' => array('intexto'))); ?>
			</div>
		</div>
		<div class="botoescadastrar">
			
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