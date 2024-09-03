$(function(){

    var cpSelect = '';
        $.ajax({
            url: base_url+"/editarCuenta/searchDireccion/"+idLocalidadSelected,
            dataType: "json",
            success: function(respuesta){
                if(respuesta.rows != null){
                    $('#cp').val(respuesta.rows.dCodigo);
                    
                    $.ajax({
                        url: base_url+"/editarCuenta/searchLocalidad/"+respuesta.rows.dCodigo,
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
        if(idLocalidadSelectedLeg != ''){
            $.ajax({
                url: base_url+"/editarCuenta/searchDireccion/"+idLocalidadSelectedLeg,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows != null){
                        $('#cpRep').val(respuesta.rows.dCodigo);
                        
                        $.ajax({
                            url: base_url+"/editarCuenta/searchLocalidad/"+respuesta.rows.dCodigo,
                            dataType: "json",
                            success: function(respuesta1){
                                if(respuesta1.rows.catLocalidadesResponse.length > 0){
                                    for (var i = 0; i < respuesta1.rows.catLocalidadesResponse.length; i++) {
                                        if (respuesta.rows.idLocalidad == respuesta1.rows.catLocalidadesResponse[i].idLocalidad) {
                                            $('#colRep').append($('<option selected >').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].colonia));
                                            $('#delRep').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].municipio));
                                            $('#edoRep').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].estado));
                                        }else{
                                            $('#colRep').append($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].colonia));
                                            $('#delRep').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].municipio));
                                            $('#edoRep').html($('<option>').val(respuesta1.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta1.rows.catLocalidadesResponse[i].estado));
                                        }
                                        
                                    }
                                }else{
                                    $('#delRep').html('<option></option>');
                                    $('#edoRep').html('<option></option>');
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
         
        }

    if (cpSelectedCon != '') {
        var cpRep = $("#cpRep").val();
        $('#colRep').html("<option></option>");
        $.ajax({
            url: base_url+"/editarCuenta/searchLocalidad/"+cpSelectedCon,
            dataType: "json",
            success: function(respuesta){
                if(respuesta.rows.catLocalidadesResponse.length > 0){
                    for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                        if (respuesta.rows.catLocalidadesResponse[i].idLocalidad == idLocalidadSelected) {
                            $('#colRep').append($('<option selected>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delRep').html($('<option selected>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoRep').html($('<option selected>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }else{
                            $('#colRep').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }
                }else{
                    $('#delRep').html('<option></option>');
                    $('#edoRep').html('<option></option>');
                    bootbox.alert({
                        title: 'Busqueda sin datos',
                        message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
                        locale: 'mx'
                    });
                }
            }
        });
    }
     
        
    $("#cp").keyup(function(){
        var cp = $("#cp").val();
        if (cp.length == 5) {
            $('#col').html("<option></option>");
            $.ajax({
                url: base_url+"/editarCuenta/searchLocalidad/"+cp,
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
    $("#cpRep").keyup(function(){
        var cp = $("#cpRep").val();
        if (cp.length == 5) {
            $('#colRep').html("<option></option>");
            $.ajax({
                url: base_url+"/editarCuenta/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#colRep').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#delRep').html('<option></option>');
                        $('#edoRep').html('<option></option>');
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
    $('#inicio').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#fin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioCom').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finCom').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioFin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finFin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioSop').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finSop').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
});