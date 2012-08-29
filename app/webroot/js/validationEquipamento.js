$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#equipamento_nome').blur(function(){
		$.post(
			'/construti_oficial/equipamentos/validate_form',
			{ field: $('#equipamento_nome').attr('id'), value: $('#equipamento_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		if(error.length > 2){
			if($('#equipamento_nome_ERROR').length == 0){
				$('#equipamento_nome').after('<div id="equipamento_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#equipamento_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#equipamento_nome_ERROR').remove();
		}
		
	};		
	
	// ALUGADO ---------------------------------------------
	$('#equipamento_alugado').blur(function(){
		$.post(
			'/construti_oficial/equipamentos/validate_form',
			{ field: $('#equipamento_alugado').attr('id'), value: $('#equipamento_alugado').val() },
			verificaAlugado
		);
	});
	function verificaAlugado(error){
		if(error.length > 2){
			if($('#equipamento_alugado_ERROR').length == 0){
				$('#equipamento_alugado').after('<div id="equipamento_alugado_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#equipamento_alugado_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#equipamento_alugado_ERROR').remove();
		}
		
	};
	
	// TIPO ---------------------------------------------
	$('#equipamento_tipo').blur(function(){
		$.post(
			'/construti_oficial/equipamentos/validate_form',
			{ field: $('#equipamento_tipo').attr('id'), value: $('#equipamento_tipo').val() },
			verificaTipo
		);
	});
	function verificaTipo(error){
		if(error.length > 2){
			if($('#equipamento_tipo_ERROR').length == 0){
				$('#equipamento_tipo').after('<div id="equipamento_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#equipamento_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#equipamento_tipo_ERROR').remove();
		}
		
	};
	
});

