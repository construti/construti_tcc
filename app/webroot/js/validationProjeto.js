$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#projeto_nome').blur(function(){
		$.post(
			'/construti_oficial/projetos/validate_form',
			{ field: $('#projeto_nome').attr('id'), value: $('#projeto_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#projeto_nome_ERROR').length == 0){
				$('#projeto_nome').after('<div id="projeto_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#projeto_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#projeto_nome_ERROR').remove();
		}
		
	};	
		
	// DESCRICAO ---------------------------------------------
	$('#projeto_descricao').blur(function(){
		$.post(
			'/construti_oficial/projetos/validate_form',
			{ field: $('#projeto_descricao').attr('id'), value: $('#projeto_descricao').val() },
			verificaDescricao
		);
	});
	function verificaDescricao(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#projeto_descricao_ERROR').length == 0){
				$('#projeto_descricao').after('<div id="projeto_descricao_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#projeto_descricao_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#projeto_descricao_ERROR').remove();
		}
		
	};	
	
	
	
});

