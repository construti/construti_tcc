$(document).ready(function(){
	
	// NOME ---------------------------------------------
	$('#obra_nome').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_nome').attr('id'), value: $('#obra_nome').val() },
			verificaNome
		);
	});
	function verificaNome(error){
		if(error.length > 2){
			if($('#obra_nome_ERROR').length == 0){
				$('#obra_nome').after('<div id="obra_nome_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_nome_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_nome_ERROR').remove();
		}
		
	};		
	
	// RESPONSÁVEL ---------------------------------------------
	$('#obra_responsavel').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_responsavel').attr('id'), value: $('#obra_responsavel').val() },
			verificaResponsavel
		);
	});
	function verificaResponsavel(error){
		if(error.length > 2){
			if($('#obra_responsavel_ERROR').length == 0){
				$('#obra_responsavel').after('<div id="obra_responsavel_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_responsavel_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_responsavel_ERROR').remove();
		}
		
	};
	
	// FUNCIONÁRIOS ---------------------------------------------
	$('#obra_funcionarios').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_funcionarios').attr('id'), value: $('#obra_funcionarios').val() },
			verificaFuncionarios
		);
	});
	function verificaFuncionarios(error){
		if(error.length > 2){
			if($('#obra_funcionarios_ERROR').length == 0){
				$('#obra_funcionarios').after('<div id="obra_funcionarios_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_funcionarios_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_funcionarios_ERROR').remove();
		}
		
	};
	
	// TERRENO ---------------------------------------------
	$('#terreno_id').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#terreno_id').attr('id'), value: $('#terreno_id').val() },
			verificaTerreno
		);
	});
	function verificaTerreno(error){
		if(error.length > 2){
			if($('#terreno_id_ERROR').length == 0){
				$('#terreno_id').after('<div id="terreno_id_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#terreno_id_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#terreno_id_ERROR').remove();
		}
		
	};
	
	// PROJETO ---------------------------------------------
	$('#projeto_id').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#projeto_id').attr('id'), value: $('#projeto_id').val() },
			verificaProjeto
		);
	});
	function verificaProjeto(error){
		if(error.length > 2){
			if($('#projeto_id_ERROR').length == 0){
				$('#projeto_id').after('<div id="projeto_id_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#projeto_id_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#projeto_id_ERROR').remove();
		}
		
	};
	
	// MATERIAIS ---------------------------------------------
	$('#material_obra_id').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#material_obra_id').attr('id'), value: $('#material_obra_id').val() },
			verificaMateriais
		);
	});
	function verificaMateriais(error){
		if(error.length > 2){
			if($('#material_obra_id_ERROR').length == 0){
				$('#material_obra_id').after('<div id="material_obra_id_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#material_obra_id_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#material_obra_id_ERROR').remove();
		}
		
	};	
	
	// EQUIPAMENTOS ---------------------------------------------
	$('#equipamento_obra_id').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#equipamento_obra_id').attr('id'), value: $('#equipamento_obra_id').val() },
			verificaEquipamentos
		);
	});
	function verificaEquipamentos(error){
		if(error.length > 2){
			if($('#equipamento_obra_id_ERROR').length == 0){
				$('#equipamento_obra_id').after('<div id="equipamento_obra_id_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#equipamento_obra_id_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#equipamento_obra_id_ERROR').remove();
		}
		
	};	
	
	// CUSTO ---------------------------------------------
	$('#obra_custo').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_custo').attr('id'), value: $('#obra_custo').val() },
			verificaCusto
		);
	});
	function verificaCusto(error){
		if(error.length > 2){
			if($('#obra_custo_ERROR').length == 0){
				$('#obra_custo').after('<div id="obra_custo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_custo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_custo_ERROR').remove();
		}
		
	};	
	
	// DATA DE INÍCIO ---------------------------------------------
	$('#obra_data_inicio').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_data_inicio').attr('id'), value: $('#obra_data_inicio').val() },
			verificaDataInicio
		);
	});
	function verificaDataInicio(error){
		if(error.length > 2){
			if($('#obra_data_inicio_ERROR').length == 0){
				$('#obra_data_inicio').after('<div id="obra_data_inicio_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_data_inicio_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_data_inicio_ERROR').remove();
		}
		
	};	
	
	// DATA DE TÉRMINO ---------------------------------------------
	$('#obra_data_fim').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_data_fim').attr('id'), value: $('#obra_data_fim').val() },
			verificaDataTermino
		);
	});
	function verificaDataTermino(error){
		if(error.length > 2){
			if($('#obra_data_fim_ERROR').length == 0){
				$('#obra_data_fim').after('<div id="obra_data_fim_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_data_fim_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_data_fim_ERROR').remove();
		}
		
	};	
	
	// STATUS ---------------------------------------------
	$('#obra_status').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_status').attr('id'), value: $('#obra_status').val() },
			verificaStatus
		);
	});
	function verificaStatus(error){
		if(error.length > 2){
			if($('#obra_status_ERROR').length == 0){
				$('#obra_status').after('<div id="obra_status_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_status_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_status_ERROR').remove();
		}
		
	};	
	
	// TIPO ---------------------------------------------
	$('#obra_tipo').blur(function(){
		$.post(
			'/construti_oficial/obras/validate_form',
			{ field: $('#obra_tipo').attr('id'), value: $('#obra_tipo').val() },
			verificaTipo
		);
	});
	function verificaTipo(error){
		if(error.length > 2){
			if($('#obra_tipo_ERROR').length == 0){
				$('#obra_tipo').after('<div id="obra_tipo_ERROR" style="position: absolute; z-index: 4; background-color: tomato;">' + error + '</div>');
				$('#obra_tipo_ERROR').fadeTo(3000, 0.6);
			}
		}
		else{
			$('#obra_tipo_ERROR').remove();
		}
		
	};	
});

