$(function(){
    $('.divElemento').show();
    $('.divCuentaFuera').hide();
    $('.divCuentaOtra').hide();
    $('.adiFac').hide();
    $('#divMonFac').hide();

    $('.tipoF').on('change', function() {
        var valTipo = $('input[name=facturacion]:checked', '#form-wizard').val();
        if(valTipo == 'facturacion') {
            $('.adiFac').show();
            $('#divMonFac').hide();
        }else{
            $('.adiFac').hide();
            $('#divMonFac').hide();
            $('#perFac').val('');
            document.querySelectorAll('input[name=diasFac]', '#form-wizard').forEach(function(checkElement) {
                checkElement.checked = false;
            });
            //$('#perFac').val('');
        }
    });
    $('.facTransa').on('change', function() {
        var valTipo = $('input[name=facTrans]:checked', '#form-wizard').val();
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
        var valTipo = $('input[name=modelo]:checked', '#form-wizard').val();
        switch(valTipo) {
            case '2': //Adquirente
                $('.divElemento').show();
                $('#cuentaDes').html($('<option>').val('CONC_ADQUI').text('Cuenta Adquirente'));
                $('.divCuentaFuera').hide();
                $('.divCuentaOtra').hide();
                break;
            case '1': //Emisor
                $('.divElemento').show();
                $('#cuentaDes').html($('<option>').val('CONC_EMI').text('Cuenta Emisor'));
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
        var valTipo = $('input[name=dispersion]:checked', '#form-wizard').val();
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
    
    var subafiliado = $("#subafiliado").val();
    $.ajax({
            url: base_url+"/addSucursal/searchEntidad/"+subafiliado,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        if (entiSelect == 0) {
                            $('#entidad').append($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }else if (entiSelect == respuesta.rows.entitiesResponse[i].idEntity) {
                            $('#entidad').html($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
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

    $("#subafiliado").change(function(event){
        var subafiliado = $("#subafiliado").val();
       $('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/addSucursal/searchEntidad/"+subafiliado,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        if (entiSelect == 0) {
                            $('#entidad').append($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }else if (entiSelect == respuesta.rows.entitiesResponse[i].idEntity) {
                            $('#entidad').html($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
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

    $('.copiarInfo').click(function(event){
        if( $('.copiarInfo').prop('checked') ) {
            $('#tasaVisaTPC').val($('#tasaVisaTP').val());
            $('#tasaMCTPC').val($('#tasaMCTP').val());
            $('#tasaAMEXTPC').val($('#tasaAMEXTP').val());
            $('#tasaValesTPC').val($('#tasaValesTP').val());
            $('#tasaInterTPC').val($('#tasaInterTP').val());

            $('#tasaVisaEC').val($('#tasaVisaE').val());
            $('#tasaMCEC').val($('#tasaMCE').val());
            $('#tasaAMEXEC').val($('#tasaAMEXE').val());
            $('#tasaValesEC').val($('#tasaValesE').val());
            $('#tasaInterEC').val($('#tasaInterE').val());
        }else{
            $('#tasaVisaTPC').val('');
            $('#tasaMCTPC').val('');
            $('#tasaAMEXTPC').val('');
            $('#tasaValesTPC').val('');
            $('#tasaInterTPC').val('');

            $('#tasaVisaEC').val('');
            $('#tasaMCEC').val('');
            $('#tasaAMEXEC').val('');
            $('#tasaValesEC').val('');
            $('#tasaInterEC').val('');
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