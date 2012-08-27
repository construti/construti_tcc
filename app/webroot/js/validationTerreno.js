$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#terreno_nome').blur(function(){
		$.post(
			'/construti_oficial/terrenos/validate_form',
			{ field: $('#terreno_nome').attr('id'), value: $('#terreno_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		if(error.length > 2){
			if($('#terreno_nome_ERROR').length == 0){
				$('#terreno_nome').after('<div id="terreno_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#terreno_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#terreno_nome_ERROR').remove();
		}
		
	};		
	
	// ENDERECO ---------------------------------------------
	$('#terreno_endereco').blur(function(){
		$.post(
			'/construti_oficial/terrenos/validate_form',
			{ field: $('#terreno_endereco').attr('id'), value: $('#terreno_endereco').val() },
			verificaEndereco
		);
	});
	function verificaEndereco(error){
		if(error.length > 2){
			if($('#terreno_endereco_ERROR').length == 0){
				$('#terreno_endereco').after('<div id="terreno_endereco_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#terreno_endereco_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#terreno_endereco_ERROR').remove();
		}
		
	};
	
	// TAMANHO ---------------------------------------------
	$('#terreno_tamanho').blur(function(){
		$.post(
			'/construti_oficial/terrenos/validate_form',
			{ field: $('#terreno_tamanho').attr('id'), value: $('#terreno_tamanho').val() },
			verificaTamanho
		);
	});
	function verificaTamanho(error){
		if(error.length > 2){
			if($('#terreno_tamanho_ERROR').length == 0){
				$('#terreno_tamanho').after('<div id="terreno_tamanho_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#terreno_tamanho_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#terreno_tamanho_ERROR').remove();
		}
		
	};
});

