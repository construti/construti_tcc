<?php  
	echo $this->Html->script("validationTerreno", false); 
	$this->pageTitle = 'Terrenos';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Cadastro</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Terreno'); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
			Nome: <br/><br/>
			Endereço: <br/><br/>
			Tamanho(m²): <br/><br/>
			Descrição: 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
            <?php echo $this->Form->input('terreno_nome', array('label' => '', 'id' => 'terreno_nome', 'class' => array('intexto'))); ?>
			</br>
			<?php echo $this->Form->input('terreno_endereco', array('label' => '', 'id' => 'terreno_endereco', 'class' => array('intexto'))); ?>
			</br>
			<?php echo $this->Form->input('terreno_tamanho', array('label' => '', 'id' => 'terreno_tamanho', 'class' => array('intexto'))); ?>
			</br>
			<?php echo $this->Form->input('terreno_descricao', array('label' => '', 'id' => 'terreno_descricao', 'class' => array('descricao'))); ?>
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