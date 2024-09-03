$(function(){
    $('.divElemento').hide();
    $('.divCuentaFuera').hide();
    $('.divCuentaOtra').hide();
    $('.adiFac').hide();


    $('.tipoF').on('change', function() {
        var valTipo = $('input[name=facturacion]:checked', '#form-wizard-subafiliado').val();
        switch(valTipo) {
            case 'facturacion':
                $('.adiFac').show();
                break;
        }
    });

    $('.tipoDis').on('change', function() {
        var valTipo = $('input[name=dispersion]:checked', '#form-wizard-subafiliado').val();
        switch(valTipo) {
            case 'en':
                $('.divElemento').show();
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').hide();
                break;
            case 'fuera':
                $('.divElemento').hide();
                $('.divCuentaFuera').show();
                $('.divCuentaOtra').hide();
                break;
            case 'otra':
                $('.divElemento').hide();
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').show();
                break;
        }
    });
  var cpSelect = '';
        $.ajax({
            url: base_url+"/editarCuenta/searchDireccion/"+idLocalidadSelected,
            dataType: "json",
            success: function(respuesta){
                if(respuesta.rows != null){
                    $('#cp').val(respuesta.rows.dCodigo);
                    
                    $.ajax({
                        url: base_url+"/addEntidad/searchLocalidad/"+respuesta.rows.dCodigo,
                        dataType: "json",
                        success: function(respuesta1){
                            if(respuesta1.rows.catLocalidadesResponse.length > 0){
                                for (var i = 0; i < respuesta1.rows.catLocalidadesResponse.length; i++) {
                                    if (respuesta.rows.idLocalidad == respuesta1.rows.catLocalidadesResponse[i].idLocalidad) {
                                        $('#col').append($('<option selected >').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].colonia));
                                        $('#del').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].municipio));
                                        $('#edo').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].estado));
                                    }else{
                                        $('#col').append($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].colonia));
                                        $('#del').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].municipio));
                                        $('#edo').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].estado));
                                    }
                                    
                                }
                            }else{
                                $('#del').html('<option></option>');
                                $('#edo').html('<option></option>');
                                bootbox.alert({
                                    title: 'Busqueda sin datos',
                                    message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
                                    locale: 'mx'
                                });
                            }
                        }
                    });
                }else{
                    bootbox.alert({
                        title: 'Busqueda sin datos',
                        message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
                        locale: 'mx'
                    });
                }
            }
        }); 
    
    $("#cp").keyup(function(){
        var cp = $("#cp").val();
        if (cp.length == 5) {
            $('#col').html("<option></option>");
            $.ajax({
                url: base_url+"/addSubAfiliado/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#col').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#del').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edo').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#del').html('<option></option>');
                        $('#edo').html('<option></option>');
                        bootbox.alert({
                            title: 'Busqueda sin datos',
                            message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
                            locale: 'mx'
                        });
                    }
                    
                }
            }); 
        }
    });
    
});