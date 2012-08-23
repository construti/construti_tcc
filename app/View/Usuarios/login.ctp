<?php $this->pageTitle = 'Login'; ?>
<div id="fundo"> <!-- imagem de fundo -->
	<?php echo $this->Session->flash('auth') ?>
	<?php 
		echo $this->Form->create('Usuario', array('action' => 'login'));
			echo $this->Form->input('usuario_login', array('label' => 'Usuário: ', 'id' => 'usuario_login', 'class' => array('intexto')));
			echo '<br/>';
			echo $this->Form->input('usuario_senha', array('label' => 'Senha: ', 'id' => 'usuario_senha', 'type' => 'password', 'class' => array('intexto')));
			echo '<br/>';
		echo $this->Form->end('ENTRAR');
	?>
</div>
