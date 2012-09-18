<?php
$cakeDescription = __d('cake_dev', 'Construti - Cadastro');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('construti.popup');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="corpo"> <!-- início do corpo -->
		<div id="conteudo"> <!-- conteúdo das páginas será inserido aqui -->

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div> <!-- fim do conteúdo -->
		
	</div> <!-- fim do corpo -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<?php 
		echo $scripts_for_layout;
		if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
		//echo $this->element('sql_dump');
	?> 
</body>
</html>
