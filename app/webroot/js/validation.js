$(document).ready(function(){
	$('#funcionario_nome').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_nome').attr('id'), value: $('#funcionario_nome').val() },
			handleNameValidation
		);
	});
	
	function handleNameValidation(error){
		//alert(error.length);
		if(error.length > 2){
			if($('#funcionario_nome_ERROR').length == 0){
				$('#funcionario_nome').after('<div id="funcionario_nome_ERROR" style="background-color: tomato;">' + error + '</div>');
				$('#funcionario_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_nome_ERROR').remove();
		}
	}
});

