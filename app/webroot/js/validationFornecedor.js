$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#fornecedor_nome').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_nome').attr('id'), value: $('#fornecedor_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		if(error.length > 2){
			if($('#fornecedor_nome_ERROR').length == 0){
				$('#fornecedor_nome').after('<div id="fornecedor_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_nome_ERROR').remove();
		}
		
	};		
	
	// CONTATO ---------------------------------------------
	$('#fornecedor_contato').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_contato').attr('id'), value: $('#fornecedor_contato').val() },
			verificaContato
		);
	});
	function verificaContato(error){
		if(error.length > 2){
			if($('#fornecedor_contato_ERROR').length == 0){
				$('#fornecedor_contato').after('<div id="fornecedor_contato_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_contato_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_contato_ERROR').remove();
		}
		
	};
	
	// EMAIL ---------------------------------------------
	$('#fornecedor_email').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_email').attr('id'), value: $('#fornecedor_email').val() },
			verificaEmail
		);
	});
	function verificaEmail(error){
		if(error.length > 2){
			if($('#fornecedor_email_ERROR').length == 0){
				$('#fornecedor_email').after('<div id="fornecedor_email_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_email_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_email_ERROR').remove();
		}
		
	};
	
	// TIPO ---------------------------------------------
	$('#fornecedor_tipo').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_tipo').attr('id'), value: $('#fornecedor_tipo').val() },
			verificaTipo
		);
	});
	function verificaTipo(error){
		if(error.length > 2){
			if($('#fornecedor_tipo_ERROR').length == 0){
				$('#fornecedor_tipo').after('<div id="fornecedor_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_tipo_ERROR').remove();
		}
		
	};
});

