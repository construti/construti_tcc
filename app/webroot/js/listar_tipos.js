$(document).ready(function() {
    
    if($('#funcionario_area').val().length != 0) {
        $.getJSON("funcionarios/listarTipos",{
            areaId: $('#funcionario_area').val()
        }, function(tipos) {
            if(tipos != null)
                popularListaDeTipos(tipos, $('#id-tipo').val());
        });
    }
        
    $('#funcionario_area').live('change', function() {
        if($(this).val().length != 0) {
            $.getJSON("funcionarios/listarTipos",{
                areaId: $(this).val()
            }, function(tipos) {
                if(tipos != null)
                    popularListaDeTipos(tipos);
            });
        } else
            popularListaDeTipos(null);
    });
});

function popularListaDeTipos(tipos, idTipo) {
    var options = '<option value>selecione...</option>';
    if(tipos != null) {
        $.each(tipos, function(index, tipo){
            if(idTipo == index)
                options += '<option selected="selected" value="' + index + '">' + tipo + '</option>';
            else
                options += '<option value="' + index + '">' + tipo + '</option>';
        });
    }
    $('#tipos').html(options);
}