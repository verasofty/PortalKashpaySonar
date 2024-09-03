$(function(){
    $('.divElemento').show();
    $('.divCuentaFuera').hide();
    $('.divCuentaOtra').hide();
    $('.adiFac').hide();
    $('#divMonFac').hide();

    
    var valTipo = $('input[name=facturacion]:checked', '#form-wizard-sucursal').val();
    console.log('valTipo = '+valTipo);
    if(valTipo == 'facturacion') {
        console.log('if = '+valTipo);
        $('.adiFac').show();
        $('#divMonFac').hide();
    }else{
        console.log('else = '+valTipo);

        $('.adiFac').hide();
        $('#divMonFac').hide();
        $('#perFac').val('');
        document.querySelectorAll('input[name=diasFac]', '#form-wizard-sucursal').forEach(function(checkElement) {
            checkElement.checked = false;
        });
        //$('#perFac').val('');
    }


    var valTipoF = $('input[name=facTrans]:checked', '#form-wizard-sucursal').val();
    console.log('val'+valTipoF);
    if(valTipoF == '0') {
        console.log('val IF '+valTipoF);
        $('#divMonFac').css('display','block'); 
    }else{
        $('#divMonFac').hide();
        $('#monto').val('');

    }



    var valTipoM = $('input[name=modelo]:checked', '#form-wizard-sucursal').val();
    switch(valTipoM) {
        case '1': //Emisor
            $('.divElemento').show();
            $('#cuentaDes').html($('<option>').val('CONC_ADQUI').text('Cuenta Emisor'));
            $('.divCuentaFuera').hide();
            $('.divCuentaOtra').hide();
            break;
        case '2': //Adquirente
            $('.divElemento').show();
            $('#cuentaDes').html($('<option>').val('CONC_EMI').text('Cuenta Adquirente'));
            $('.divCuentaFuera').hide();
            $('.divCuentaOtra').hide();
        break;
        case '3': //Mixto    
            $('.divElemento').show();
            $('#cuentaDes').html($('<option>').val('CONC_ADQUI').text('Cuenta Adquirente'));
            $('#cuentaDes').append($('<option>').val('CONC_EMI').text('Cuenta Emisor'));
            $('.divCuentaFuera').hide();
            $('.divCuentaOtra').hide();
            break;
    }



    var valTipoD = $('input[name=dispersion]:checked', '#form-wizard-sucursal').val();
    switch(valTipoD) {
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

    $('.tipoF').on('change', function() {
        var valTipo = $('input[name=facturacion]:checked', '#form-wizard-sucursal').val();
        if(valTipo == 'facturacion') {
            $('.adiFac').show();
            $('#divMonFac').hide();
        }else{
            $('.adiFac').hide();
            $('#divMonFac').hide();
            $('#perFac').val('');
            document.querySelectorAll('input[name=diasFac]', '#form-wizard-sucursal').forEach(function(checkElement) {
                checkElement.checked = false;
            });
            //$('#perFac').val('');
        }
    });
    $('.facTransa').on('change', function() {
        var valTipo = $('input[name=facTrans]:checked', '#form-wizard-sucursal').val();
        console.log('val'+valTipo);
        if(valTipo == '0') {
            console.log('val IF '+valTipo);
            $('#divMonFac').css('display','block'); 
        }else{
            $('#divMonFac').hide();
            $('#monto').val('');

        }
    });

    $('.tipoModelo').on('change', function() {
        var valTipo = $('input[name=modelo]:checked', '#form-wizard-sucursal').val();
        switch(valTipo) {
            case '1': //Emisor
                $('.divElemento').show();
                $('#cuentaDes').html($('<option>').val('CONC_ADQUI').text('Cuenta Emisor'));
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').hide();
                break;
            case '2': //Adquirente
                $('.divElemento').show();
                $('#cuentaDes').html($('<option>').val('CONC_EMI').text('Cuenta Adquirente'));
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').hide();
            break;
            case '3': //Mixto    
                $('.divElemento').show();
                $('#cuentaDes').html($('<option>').val('CONC_ADQUI').text('Cuenta Adquirente'));
                $('#cuentaDes').append($('<option>').val('CONC_EMI').text('Cuenta Emisor'));
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').hide();
                break;
        }
    });

    $('.tipoDis').on('change', function() {
        var valTipo = $('input[name=dispersion]:checked', '#form-wizard-sucursal').val();
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

    var giro = $("#giro").val();
    //console.log(actividadesGiros);
    for (var i = 0; i < actividadesGiros.length; i++) {
        if (actividadesGiros[i].idGiro == giro) {
            for (var iAct = 0; iAct < actividadesGiros[i].listActividades.length; iAct++) {
                if (actividadesGiros[i].listActividades[iAct].idcat_actividades == actividadSelected) {
                    $('#actividad').append($('<option selected>').val(actividadesGiros[i].listActividades[iAct].idcat_actividades).text(actividadesGiros[i].listActividades[iAct].actividad));
                }else{
                    $('#actividad').append($('<option>').val(actividadesGiros[i].listActividades[iAct].idcat_actividades).text(actividadesGiros[i].listActividades[iAct].actividad));
                }
                
            }
        }
    }
    var subafiliado = $("#subafiliado").val();
       //$('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/addSucursal/searchEntidad/"+subafiliado,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        if (respuesta.rows.entitiesResponse[i].idEntity == entiSelect) {
                            $('#entidad').append($('<option selected>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }else{
                            //$('#entidad').append($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }
                        
                    }
                }else{
                    bootbox.alert({
                        message: "El subafiliado seleccionado no tiene entidades relacionadas.",
                        locale: 'mx'
                    });
                }
                
            }
        });

    var cp2 = '';
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
        $.ajax({
            url: base_url+"/addEntidad/searchLocalidad/"+cpSelect,
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
    console.log('cpCon = '+$('#localidadCon').val());
    if ($('#localidadCon').val() != '') {
        var cpRep = $("#cpRep").val();
        $('#colRep').html("<option></option>");
        $.ajax({
            url: base_url+"/editarCuenta/searchDireccion/"+$('#localidadCon').val(),
            dataType: "json",
            success: function(respuesta){
                if(respuesta.rows != null){
                    $('#cpRep').val(respuesta.rows.dCodigo);
                    //alert('respuesta.rows.dCodigo'+respuesta.rows.dCodigo);
                    $.ajax({
                        url: base_url+"/addEntidad/searchLocalidad/"+respuesta.rows.dCodigo,
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
    

    $("#giro").change(function(event){
        var giro = $("#giro").val();
       $('#actividad').html("<option></option>");

        for (var i = 0; i < actividadesGiros.length; i++) {
            if (actividadesGiros[i].idGiro == giro) {
                for (var iAct = 0; iAct < actividadesGiros[i].listActividades.length; iAct++) {
                    $('#actividad').append($('<option>').val(actividadesGiros[i].listActividades[iAct].idcat_actividades).text(actividadesGiros[i].listActividades[iAct].actividad));
                }
            }
        }
    });
    
    
    $("#subafiliado").change(function(event){
        var subafiliado = $("#subafiliado").val();
       $('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/addSucursal/searchEntidad/"+subafiliado,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        $('#entidad').append($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                    }
                }else{
                    bootbox.alert({
                        message: "El subafiliado seleccionado no tiene entidades relacionadas.",
                        locale: 'mx'
                    });
                }
                
            }
        }); 
    });
    
    $("#cp").keyup(function(){
        var cp = $("#cp").val();
        if (cp.length == 5) {
            $('#col').html("<option></option>");
            $.ajax({
                url: base_url+"/addEntidad/searchLocalidad/"+cp,
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
                url: base_url+"/addEntidad/searchLocalidad/"+cp,
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
    $( ".btn_addPromo" ).click(function(event){
        event.preventDefault();
        bootbox.dialog({
            message: BootboxContent,
            title: "Agregar Promociones",
            buttons: {
                buttonName: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function () {
                   
                    }
                      
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-dark'
                }
            }
        });
    });


    $( ".btn_addAfiliacion" ).click(function(event){
        event.preventDefault();
        bootbox.dialog({
            message: BootboxContentAfiliacion,
            title: "Agregar Afiliación",
            buttons: {
                buttonName: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function () {
                   
                    }
                      
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-dark'
                }
            }
        });
    });
});