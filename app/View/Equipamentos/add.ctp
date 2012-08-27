<?php  
	echo $this->Html->script("validationEquipamento", false); 
	$this->pageTitle = 'Equipamentos';
?> 
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Equipamento'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Nome: <br/><br/>
			Alugado: <br/><br/>
			Tipo: <br/><br/>
			Descrição:  
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->input('equipamento_nome', array('label' => '', 'id' => 'equipamento_nome', 'class' => array('intexto'))); ?>
			<br/>
			<?php 
				$opcoes_alugado = array('S' => 'Sim', 'N' => 'Não');
				$atributos_alugado = array('label' => '', 'legend' => false, 'id' => 'equipamento_alugado', 'class' => array('intexto'));
				echo $this->Form->radio('equipamento_alugado', $opcoes_alugado, $atributos_alugado);
			?>
			<br/><br/>
			<?php $opcoes_tipo = array('betoneira' => 'Betoneira', 'caminhao' => 'Caminhão' , 'escavadeira' => 'Escavadeira',
										'parafusadeira' => 'Parafusadeira', 'perfuradora' => 'Perfuradora', 'soldador' => 'Soldador',
										'trator' => 'Trator'
									  );
				  echo $this->Form->select('equipamento_tipo', $opcoes_tipo, array('label' => '', 'id' => 'equipamento_tipo', 'class' => array('intexto'))); ?>
			<br/><br/>
			<?php echo $this->Form->input('equipamento_descricao', array('label' => '', 'id' => 'equipamento_descricao', 'class' => array('descricao'))); ?>
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