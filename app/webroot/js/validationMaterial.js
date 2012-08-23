$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#material_nome').blur(function(){
		$.post(
			'/construti_oficial/materiais/validate_form',
			{ field: $('#material_nome').attr('id'), value: $('#material_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#material_nome_ERROR').length == 0){
				$('#material_nome').after('<div id="material_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#material_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#material_nome_ERROR').remove();
		}
		
	};	
		
	// DESCRICAO ---------------------------------------------
	$('#material_descricao').blur(function(){
		$.post(
			'/construti_oficial/materiais/validate_form',
			{ field: $('#material_descricao').attr('id'), value: $('#material_descricao').val() },
			verificaDescricao
		);
	});
	function verificaDescricao(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#material_descricao_ERROR').length == 0){
				$('#material_descricao').after('<div id="material_descricao_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#material_descricao_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#material_descricao_ERROR').remove();
		}
		
	};	
	
	
	
});

