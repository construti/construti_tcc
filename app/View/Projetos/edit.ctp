 <?php 
	if(!empty($this->data['Projeto']['projeto_id'])) { ?>
		 <script>
			$(document).ready(function() {
				$('#projeto_id').val('<?php echo $this->data['Projeto']['projeto_id'] ?>');
			});
		 </script>
 <?php } ?>

<?php  
	echo $this->Html->script("validationProjeto", false);
	$this->pageTitle = 'Projetos';
?> 

<div id="formulariotopo"> <!-- topo do formulário -->
	<div id="tituloform">Atualização</div> <!-- título do formulário -->
</div>
<div id="formulariocorpo">
	<?php echo $this->Form->create('Projeto', array('type' => 'file', 'controller' => 'projetos', 'action' => 'add', 'admin' => true)); ?> <!-- início do formulário -->
		<div id="camposdescricao"> <!-- div com a descrição dos campos -->
		
			Obra:* <br/><br/>
			Tipo:* <br/><br/>
			Projeto:* <br/><br/>
			Custo: <br/><br/>
			Descrição: <br/><br/>
			 
		</div>
		<div id="camposlacunas"> <!-- div com os campos a serem preenchidos -->
			

			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <?php $projeto_obras=''; echo $this->Form->select('obra_id', $projeto_obras, array('label' => '', 'id' => 'projeto_obras', 'class' => array('intexto'), 'empty' => 'Escolha...')); ?>
			<br><br>
            
			<?php $opcoes_tipo_obra = array('arquitetural' => 'Arquitetural', 'eletrico' => 'Elétrico' , 'estrutural' => 'Estrutural', 'fundacao' => 'Fundação', 'hidraulico' => 'Hidráulico', 'terraplenagem' => 'Terraplenagem');
				  echo $this->Form->input('projeto_tipo', array('label' => '', 'id' => 'projeto_tipo', 'type' => 'select', 'options' => $opcoes_tipo_obra , 'class' => array('intexto'), 'empty' => 'Escolha...'));
			?>
			<br>
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
			<?php echo $this->Form->hidden('arquivos', array('id' => 'arquivos')); ?>
			
			<?php echo $this->Form->input('projeto_custo', array('label' => '', 'id' => 'projeto_custo', 'class' => array('intexto'))); ?>
			<br>
			<?php echo $this->Form->input('projeto_descricao', array('type' => 'textarea', 'label' => '', 'id' => 'projeto_descricao', 'class' => array('descricao'))); ?>
            
		</div>
		<div id="areaBotao">  <!-- botão de cadastro -->
            <?php 
                echo $this->Js->submit('Atualizar', array(
                    'before' => $this->Js->get('#sending')->effect('fadeIn'),
                    'success' => $this->Js->get('#sending')->effect('fadeOut'),
                    'update' => '#success'
                ));
                echo $this->Form->end(); 
            ?>
        </div>
	<div id="success"></div> <!-- mensagem de sucesso no cadastro -->
	<div id="sending"> Enviando... </div> <!-- mensagem para envio dos dados -->
</div> <!-- corpo do formulário -->
<div id="formulariofim"></div> <!-- final do formulário -->                               