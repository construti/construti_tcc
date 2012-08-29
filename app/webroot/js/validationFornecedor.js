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
	
	// ESTADO ---------------------------------------------
	$('#fornecedor_estado').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_estado').attr('id'), value: $('#fornecedor_estado').val() },
			verificaEstado
		);
	});
	function verificaEstado(error){
		if(error.length > 2){
			if($('#fornecedor_estado_ERROR').length == 0){
				$('#fornecedor_estado').after('<div id="fornecedor_estado_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_estado_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_estado_ERROR').remove();
		}
		
	};
	
	// CIDADE ---------------------------------------------
	$('#fornecedor_cidade').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_cidade').attr('id'), value: $('#fornecedor_cidade').val() },
			verificaCidade
		);
	});
	function verificaCidade(error){
		if(error.length > 2){
			if($('#fornecedor_cidade_ERROR').length == 0){
				$('#fornecedor_cidade').after('<div id="fornecedor_cidade_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_cidade_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_cidade_ERROR').remove();
		}
		
	};
	
	// BAIRRO ---------------------------------------------
	$('#fornecedor_bairro').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_bairro').attr('id'), value: $('#fornecedor_bairro').val() },
			verificaBairro
		);
	});
	function verificaBairro(error){
		if(error.length > 2){
			if($('#fornecedor_bairro_ERROR').length == 0){
				$('#fornecedor_bairro').after('<div id="fornecedor_bairro_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_bairro_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_bairro_ERROR').remove();
		}
		
	};
	
	// ENDEREÇO ---------------------------------------------
	$('#fornecedor_endereco').blur(function(){
		$.post(
			'/construti_oficial/fornecedores/validate_form',
			{ field: $('#fornecedor_endereco').attr('id'), value: $('#fornecedor_endereco').val() },
			verificaEndereco
		);
	});
	function verificaEndereco(error){
		if(error.length > 2){
			if($('#fornecedor_endereco_ERROR').length == 0){
				$('#fornecedor_endereco').after('<div id="fornecedor_endereco_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#fornecedor_endereco_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#fornecedor_endereco_ERROR').remove();
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

