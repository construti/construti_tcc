$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#embalagem_tipo').blur(function(){
		$.post(
			'/construti_oficial/embalagens/validate_form',
			{ field: $('#embalagem_tipo').attr('id'), value: $('#embalagem_tipo').val() },
			verificaEmbalagem
		);
	});
	function verificaEmbalagem(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#embalagem_tipo_ERROR').length == 0){
				$('#embalagem_tipo').after('<div id="embalagem_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#embalagem_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#embalagem_tipo_ERROR').remove();
		}
		
	};	
	
});

