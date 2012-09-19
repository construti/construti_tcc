<?php  
	echo $this->Html->script("validationProjeto", false); 
	$this->pageTitle = 'Requisições';
?>
<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Materiais</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo"> <!-- corpo do formulário -->
	<?php echo $this->Form->create('Projeto', array('type' => 'file', 'controller' => 'projetos', 'action' => 'add', 'admin' => true)); ?> <!-- início do formulário -->
		<div class="legenda">* = Campos Obrigatórios </div>
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
		
			<div class="campos">Obra*: </div>
			<div class="campos">Tipo*: </div>
			<div class="campos">Projeto*: </div>
			<div class="campos">Custo: </div>
			<div class="campos">Descrição: </div>
			 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			

			<div class="campos">
			<?php  echo $this->Form->select('obra_id', $projeto_obras, array('label' => '', 'id' => 'projeto_obras', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			</div>

            
			<div class="campos">
			<?php $opcoes_tipo_obra = array('arquitetural' => 'Arquitetural', 'eletrico' => 'Elétrico' , 'estrutural' => 'Estrutural', 'fundacao' => 'Fundação', 'hidraulico' => 'Hidráulico', 'terraplenagem' => 'Terraplenagem');
				  echo $this->Form->input('projeto_tipo', array('label' => '', 'id' => 'projeto_tipo', 'type' => 'select', 'options' => $opcoes_tipo_obra , 'class' => array('intexto'), 'empty' => 'Escolha...'));
			?>
			</div>
			
			<div class="campos">
			<div id="file-uploader-demo1">
				<noscript>
				   <p>Por favor habilite o JavaScript para utilizar o uploader de arquivos.</p>
				   <!-- or put a simple form for upload here -->
				</noscript>
				<script type="text/javascript">
						function createUploader(){
								var uploader = new qq.FileUploader({
								element: document.getElementById('file-uploader-demo1'),
								action: '<?php echo $this->Html->url('/app/webroot/upload.php');?>',
								allowedExtensions: ['txt','pdf','docx','doc','jpg','png','gif'],
								debug: true
							});
						}
				 
						// in your app create uploader as soon as the DOM is ready
						// don't wait for the window to load
						window.onload = createUploader;
				</script>
			</div>
			</div>
			
			<?php echo $this->Form->hidden('arquivos', array('id' => 'arquivos')); ?>
			
			<div class="campos">
			<?php echo $this->Form->input('projeto_custo', array('label' => '', 'id' => 'projeto_custo', 'class' => array('intexto'))); ?>
			</div>
			
			<div class="campos">
			<?php echo $this->Form->input('projeto_descricao', array('type' => 'textarea', 'label' => '', 'id' => 'projeto_descricao', 'class' => array('descricao'))); ?>
			</div>
			
		</div>
		<div id="areaBotao">  <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Cadastrar', array(
                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
                    'update' => '#success'
                ));
                echo $this->Form->end(); 
            ?>
        </div>
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> 
<div id="formulariofim"></div> <!-- final do formulário -->                               