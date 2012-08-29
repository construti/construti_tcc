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
		
	// TIPO ---------------------------------------------
	$('#material_tipo').blur(function(){
		$.post(
			'/construti_oficial/materiais/validate_form',
			{ field: $('#material_tipo').attr('id'), value: $('#material_tipo').val() },
			verificaTipo
		);
	});
	function verificaTipo(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#material_tipo_ERROR').length == 0){
				$('#material_tipo').after('<div id="material_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#material_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#material_tipo_ERROR').remove();
		}
		
	};	
	
	
	
});

