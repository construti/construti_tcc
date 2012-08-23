$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#funcionario_nome').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_nome').attr('id'), value: $('#funcionario_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_nome_ERROR').length == 0){
				$('#funcionario_nome').after('<div id="funcionario_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_nome_ERROR').remove();
		}
		
	};	
	
	// CPF ---------------------------------------------
	$('#funcionario_cpf').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_cpf').attr('id'), value: $('#funcionario_cpf').val() },
			verificaCpf
		);
	});
	function verificaCpf(error){
		if(valida_cpf($('#funcionario_cpf').val())){
			if($('#funcionario_cpf_ERROR').length != 0){
				$('#funcionario_cpf_ERROR').remove();
			};
		}
		else{
			//alert($('#funcionario_cpf_ERROR').length);
			if($('#funcionario_cpf_ERROR').length == 0){
						$('#funcionario_cpf').after('<div id="funcionario_cpf_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
						$('#funcionario_cpf_ERROR').fadeTo(3000, 0.6);
			}	
		}
	};
	
	// DATA NASCIMENTO ---------------------------------------------
	$('#funcionario_data_nasc').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_data_nasc').attr('id'), value: $('#funcionario_data_nasc').val() },
			verificaDATA
		);
	});
	function verificaDATA(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_data_nasc_ERROR').length == 0){
				$('#funcionario_data_nasc').after('<div id="funcionario_data_nasc_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_data_nasc_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_data_nasc_ERROR').remove();
		}
		
	};	
	
	// ENDEREÇO ---------------------------------------------
	$('#funcionario_endereco').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_endereco').attr('id'), value: $('#funcionario_endereco').val() },
			verificaEndereco
		);
	});
	function verificaEndereco(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_endereco_ERROR').length == 0){
				$('#funcionario_endereco').after('<div id="funcionario_endereco_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_endereco_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_endereco_ERROR').remove();
		}
		
	};	
	// BAIRRO ---------------------------------------------
	$('#funcionario_bairro').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_bairro').attr('id'), value: $('#funcionario_bairro').val() },
			verificaBairro
		);
	});
	function verificaBairro(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_bairro_ERROR').length == 0){
				$('#funcionario_bairro').after('<div id="funcionario_bairro_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_bairro_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_bairro_ERROR').remove();
		}
		
	};
	
	// CIDADE ---------------------------------------------
	$('#funcionario_cidade').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_cidade').attr('id'), value: $('#funcionario_cidade').val() },
			verificaCidade
		);
	});
	function verificaCidade(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_cidade_ERROR').length == 0){
				$('#funcionario_cidade').after('<div id="funcionario_cidade_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_cidade_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_cidade_ERROR').remove();
		}
		
	};
	
	// ESTADO ---------------------------------------------
	$('#funcionario_estado').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_estado').attr('id'), value: $('#funcionario_estado').val() },
			verificaEstado
		);
	});
	function verificaEstado(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_estado_ERROR').length == 0){
				$('#funcionario_estado').after('<div id="funcionario_estado_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_estado_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_estado_ERROR').remove();
		}
		
	};
	
	// PAIS ---------------------------------------------
	$('#funcionario_pais').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_pais').attr('id'), value: $('#funcionario_pais').val() },
			verificaPais
		);
	});
	function verificaPais(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_pais_ERROR').length == 0){
				$('#funcionario_pais').after('<div id="funcionario_pais_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_pais_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_pais_ERROR').remove();
		}
		
	};
	
	// EMAIL ---------------------------------------------
	$('#funcionario_email').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_email').attr('id'), value: $('#funcionario_email').val() },
			verificaEmail
		);
	});
	function verificaEmail(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_email_ERROR').length == 0){
				$('#funcionario_email').after('<div id="funcionario_email_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_email_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_email_ERROR').remove();
		}
		
	};
	
	// SALARIO ---------------------------------------------
	$('#funcionario_salario').blur(function(){
		$.post(
			'/construti_oficial/funcionarios/validate_form',
			{ field: $('#funcionario_salario').attr('id'), value: $('#funcionario_salario').val() },
			verificaSalario
		);
	});
	function verificaSalario(error){
		//alert(error.length);
		if(error.length > 3){
			if($('#funcionario_salario_ERROR').length == 0){
				$('#funcionario_salario').after('<div id="funcionario_salario_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#funcionario_salario_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#funcionario_salario_ERROR').remove();
		}
		
	};
	
	//validação CPF
	function valida_cpf(cpf){
      var numeros, digitos, soma, i, resultado, digitos_iguais;
      digitos_iguais = 1;
      if (cpf.length < 11)
            return false;
      for (i = 0; i < cpf.length - 1; i++)
            if (cpf.charAt(i) != cpf.charAt(i + 1)){
                  digitos_iguais = 0;
                  break;
            }
      if (!digitos_iguais){
            numeros = cpf.substring(0,9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                  soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                  return false;
            numeros = cpf.substring(0,10);
            soma = 0;
            for (i = 11; i > 1; i--)
                  soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                  return false;
            return true;
        }
      else
            return false;
    }
	
	
});

