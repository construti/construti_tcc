$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#medida_tipo').blur(function(){
		$.post(
			'/construti_oficial/medidas/validate_form',
			{ field: $('#medida_tipo').attr('id'), value: $('#medida_tipo').val() },
			verificaMedida
		);
	});
	function verificaMedida(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#medida_tipo_ERROR').length == 0){
				$('#medida_tipo').after('<div id="medida_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#medida_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#medida_tipo_ERROR').remove();
		}
		
	};	
	
});

