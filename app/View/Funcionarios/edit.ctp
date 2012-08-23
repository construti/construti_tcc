<?php  
	echo $this->Html->script("validationFuncionario", false); 
	$this->pageTitle = 'Funcionários';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Funcionario'); ?> <!-- início do formulário -->
		<div id="camposdescricaoE"> <!-- div com a descrição dos campos da esquerda -->
			Nome: <br/><br/>
			
			Data de Nascimento: <br/><br/>
			
			Bairro: <br/><br/>
			
			Estado: <br/><br/>
			
			E-mail: <br/><br/>
			
			Área:
		</div>
		<div id="camposlacunasE"> <!-- div com os campos da esquerda a serem preenchidos -->
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('funcionario_nome', array('label' => '', 'id' => 'funcionario_nome', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_data_nasc', array('label' => '', 'id' => 'funcionario_data_nasc', 'minYear' => date('Y') - 70, 'maxYear' => date('Y') - 18, 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_bairro', array('label' => '', 'id' => 'funcionario_bairro', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_estado', array('label' => '', 'id' => 'funcionario_estado', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php echo $this->Form->input('funcionario_email', array('label' => '', 'id' => 'funcionario_email', 'class' => array('intexto'))); ?>
			<br/>
			
			<?php $opcoes_area = array('construcao' => 'Construção', 'administracao' => 'Administração' , 'tecnica' => 'Técnica');
				  echo $this->Form->select('funcionario_area', $opcoes_area, array('label' => '', 'id' => 'funcionario_area', 'class' => array('intexto'))); ?>
			<br/>
		</div>
		<div id="camposdescricaoD"> <!-- div com a descrição dos campos da direita -->
			CPF: <br/><br/>
			
			Endereço: <br/><br/>
			
			Cidade: <br/><br/>
			
			País: <br/><br/>
			
			Salário(R$): <br/><br/>
			
			Tipo: 
		</div>
		<div id="camposlacunasD"> <!-- div com os campos da direita a serem preenchidos -->
			<?php echo $this->Form->input('funcionario_cpf', array('label' => '', 'id' => 'funcionario_cpf', 'maxlength' => 11, 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('funcionario_endereco', array('label' => '', 'id' => 'funcionario_endereco', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('funcionario_cidade', array('label' => '', 'id' => 'funcionario_cidade', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('funcionario_pais', array('label' => '', 'id' => 'funcionario_pais', 'class' => array('intexto'))); ?>
			<br/>
			<?php echo $this->Form->input('funcionario_salario', array('label' => '', 'id' => 'funcionario_salario', 'class' => array('intexto'))); ?>
			<br/>
			<?php $opcoes_tipo = array('engjunior' => 'Engenheiro Júnior', 'engsenior' => 'Engenheiro Sênior' , 'engpleno' => 'Engenheiro Pleno',
									   'tecmedio' => 'Técnico Nível Médio', 'tecsuperior' => 'Técnico Nível Superior', 'tecjunior' => 'Técnico Júnior',
									   'tecsenior' => 'Técnico Sênior', 'tecpleno' => 'Técnico Pleno'
									   );
				  echo $this->Form->select('funcionario_tipo', $opcoes_tipo, array('label' => '', 'id' => 'funcionario_tipo', 'class' => array('intexto'))); ?>
			<br/>
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