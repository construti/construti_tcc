<?php
$cakeDescription = __d('cake_dev', 'Construti');
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
		echo $this->Html->script(array('jquery', 'fileuploader')); 
		echo $this->Html->css(array('fileuploader', 'ui.multiselect', 'smoothness/jquery-ui', 'construti.padrao'));
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="corpo"> <!-- início do corpo -->
		<!-- <div id="cabecalho"> <!-- início do cabeçalho -->
		<!--	<h1></h1>
		</div> <!-- fim do cabeçalho -->
		<div id="menu"> <!-- início do menu -->
			
			<ul>
				<li><a href="<?php echo $this->params->base; ?>">Home</a></li>
				<li>Cadastros
					<ul>
						<li>Funcionários
							<ul>
								<li><a title="Cadastrar Funcionário" href="<?php echo $this->params->base."/funcionarios/add"; ?>">Cadastrar</a></li>
                                <li><a title="Pesquisar Funcionário" href="<?php echo $this->params->base."/funcionarios/search"; ?>">Pesquisar</a></li>
							</ul>
						</li>
						<li>Materiais
							<ul>
								<li><a title="Cadastrar Material" href="<?php echo $this->params->base."/materiais/add"; ?>">Cadastrar</a></li>
                                <li><a title="Pesquisar Material" href="<?php echo $this->params->base."/materiais/search"; ?>">Pesquisar</a></li>
							</ul>
						</li>
						<li>Equipamentos
							<ul>
								<li><a title="Cadastrar Equipamento" href="<?php echo $this->params->base."/equipamentos/add"; ?>">Cadastrar</a></li>
                                <li><a title="Pesquisar Equipamento" href="<?php echo $this->params->base."/equipamentos/search"; ?>">Pesquisar</a></li>
							</ul>
						</li>
						<!--<li>Terrenos
							<ul>
								<li><a href="<?php echo $this->params->base."/terrenos/add"; ?>">Cadastrar</a></li>
                                <li><a href="<?php echo $this->params->base."/terrenos/search"; ?>">Pesquisar</a></li>
							</ul>
						</li> -->
						<li>Projetos
							<ul>
								<li><a title="Cadastrar Projeto" href="<?php echo $this->params->base."/projetos/add"; ?>">Cadastrar</a></li>
                                <li><a title="Pesquisar Projeto" href="<?php echo $this->params->base."/projetos/search"; ?>">Pesquisar</a></li>
							</ul>
						</li>
						<li>Fornecedores
							<ul>
								<li><a title="Cadastrar Fornecedor" href="<?php echo $this->params->base."/fornecedores/add"; ?>">Cadastrar</a></li>
                                <li><a title="Pesquisar Fornecedor" href="<?php echo $this->params->base."/fornecedores/search"; ?>">Pesquisar</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li>Fornecedores
					<ul>
						<li>Relacionar
							<ul>
								<li><a title="Relacionar Materiais" href="<?php echo $this->params->base."/fornecedores/relmateriais"; ?>">Materiais</a></li>
                                <li><a title="Relacionar Equipamentos" href="<?php echo $this->params->base."/fornecedores/relequipamentos"; ?>">Equipamentos</a></li>								
							</ul>
						</li>
                    	<li><a title="Atualizar Necessidade de Materiais e/ou Equipamentos" href="<?php echo $this->params->base."/fornecedores/atnecessidade"; ?>">Necessidades</a></li>
						<li><a title="Requistar Orçamento" href="<?php echo $this->params->base."/fornecedores/orcamento"; ?>">Orçamento</a></li>
					</ul>
				</li>
				<li>Programas de Obra
					<ul>
						<li><a title="Cadastrar Programa de Obra" href="<?php echo $this->params->base."/obras/add"; ?>">Gerar Obra</a></li>
                    	<li><a title="Pesquisar Programa de Obra" href="<?php echo $this->params->base."/obras/search"; ?>">Pesquisar</a></li>
					</ul>
				</li>
				<li>Requisições
					<ul>
						<li><a title="Requisitar Equipamento" href="<?php echo $this->params->base."/requisicoes/reqequip"; ?>">Equipamento</a></li>
						<li><a title="Requisitar Material" href="<?php echo $this->params->base."/requisicoes/reqmat"; ?>">Material</a></li>
						<li><a title="Requisitar Ambos" href="<?php echo $this->params->base."/requisicoes/reqcomp"; ?>">Completa</a></li>
					</ul>
				</li>
				<li>Relatórios
					<ul>
						<li><a title="Gerar Relatório Analítico" href="<?php echo $this->params->base."/relatorios/analiticos"; ?>">Analíticos</a></li>
                        <li><a title="Gerar Relatório Sintético" href="<?php echo $this->params->base."/relatorios/sinteticos"; ?>">Sintéticos</a></li>
					</ul>
				</li>
				<li><a href="<?php echo $this->params->base."/usuarios/logout"; ?>">Sair</a></li> <!-- logoff do sistema -->
			</ul>
		</div> <!-- fim do menu -->
		<div id="transicaostatus"></div> <!-- imagem de transição -->
		<div id="status"> <!-- início da barra de status -->
			<div id="logo"></div>
			<div id="titulo"><?php echo "$this->pageTitle" ?></div> <!-- título da página atual -->
			<div id="identificacao"> <!-- identificação do usuário -->
				<?php
					$sessao = $this->Session->read();
					if ($sessao['Auth']['User'] != '') {
						echo "Olá ".$sessao['Auth']['User']['usuario_login'];
					}
				?>
			</div> 
		</div> <!-- fim da barra de status -->
		<div id="transicaocorpo"></div> <!-- imagem de transição -->
		<div id="conteudo"> <!-- conteúdo das páginas será inserido aqui -->

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
			
		</div> <!-- fim do conteúdo -->
		<div id="transicaorodape"></div> <!-- imagem de transição -->
		<div id="rodape"> <!-- início do rodapé -->
			<div id="certificaoCSS"> <!-- imagem certificação CSS -->
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img style="border:0;width:88px;height:31px"
					src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
					alt="CSS válido!" />
			</a>
			</div> <!-- fim da imagem -->
			<div id="assinatura">Construti - Sistema de Administração de Construção Civil</div>
		</div> <!-- fim do rodapé -->
	</div> <!-- fim do corpo -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<?php 
		echo $scripts_for_layout;
		if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
		//echo $this->Js->writeBuffer(array('cache' => false));
		//echo $this->element('sql_dump'); 
	?> 
</body>
</html>
