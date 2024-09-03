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
            url: base_url+"/addColaborador/searchEntidad/"+subafiliado,
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

    if(entiSelect != '0' ){
        var subafiliado = $("#subafiliado").val();
        var entidad = $("#entidad").val();
        $('#sucursal').html("<option></option>");
        $.ajax({
            url: base_url+"/addCaja/searchSucursal/"+subafiliado+'/'+entiSelect,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.branchOfficeResponse.length; i++) {
                        if (terminalSelect == 0) {
                            $('#sucursal').append($('<option>').val(respuesta.rows.branchOfficeResponse[i].idTerminal).text(respuesta.rows.branchOfficeResponse[i].businessName));
                        }else if (terminalSelect == respuesta.rows.branchOfficeResponse[i].idTerminal) {
                            $('#sucursal').html($('<option>').val(respuesta.rows.branchOfficeResponse[i].idTerminal).text(respuesta.rows.branchOfficeResponse[i].businessName));
                        }
                    }
                }else{
                    bootbox.alert({
                        message: "La entidad seleccionada no tiene sucursales relacionadas.",
                        locale: 'mx'
                    });
                }
            }
        }); 
    }
    
    $("#subafiliado").change(function(event){
        var subafiliado = $("#subafiliado").val();
       $('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/addColaborador/searchEntidad/"+subafiliado,
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
    $("#entidad").change(function(event){
        var subafiliado = $("#subafiliado").val();
        var entidad = $("#entidad").val();
       $('#sucursal').html("<option></option>");
        $.ajax({
            url: base_url+"/addCaja/searchSucursal/"+subafiliado+'/'+entidad,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.branchOfficeResponse.length; i++) {
                        $('#sucursal').append($('<option>').val(respuesta.rows.branchOfficeResponse[i].idTerminal).text(respuesta.rows.branchOfficeResponse[i].businessName));
                    }
                }else{
                    bootbox.alert({
                        message: "La entidad seleccionada no tiene sucursales relacionadas.",
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

	$('#btn-add').click(function(event) {

        console.log('hdhdh');

        var countError = 0;

    	$('#subafiliadoHelp').html('');
    	$('#entidadHelp').html('');
    	$('#sucursalHelp').html('');
    	$('#nombreHelp').html('');
    	$('#aPaternoHelp').html('');
    	$('#aMaternoHelp').html('');
       	$('#rfcHelp').html('');
    	$('#emailHelp').html('');
    	$('#emailConfirmHelp').html('');
    	$('#telHelp').html('');
    	$('#contrasenaHelp').html('');
        $('#confPassHelp').html('');

        $('#tasaVisaTPHelp').html('');
        $('#tasaMCTPHelp').html('');
        $('#tasaAMEXTPHelp').html('');
        $('#tasaValesTPHelp').html('');
    	$('#tasaInterTPHelp').html('');

        $('#tasaVisaEHelp').html('');
        $('#tasaMCEHelp').html('');
        $('#tasaAMEXEHelp').html('');
        $('#tasaValesEHelp').html('');
        $('#tasaInterEHelp').html('');

        $('#tasaVisaTPCHelp').html('');
        $('#tasaMCTPCHelp').html('');
        $('#tasaAMEXTPCHelp').html('');
        $('#tasaValesTPCHelp').html('');
        $('#tasaInterTPCHelp').html('');

        $('#tasaVisaECHelp').html('');
        $('#tasaMCECHelp').html('');
        $('#tasaAMEXECHelp').html('');
        $('#tasaValesECHelp').html('');
        $('#tasaInterECHelp').html('');

        

        var subafiliado = $('#subafiliado').val();
        var entidad = $('#entidad').val();
        var sucursal = $('#sucursal').val();
        var nombre = $('#nombre').val();
        var aPaterno = $('#aPaterno').val();
        var aMaterno = $('#aMaterno').val();
        var rfc = $('#rfc').val();
        var email = $('#email').val();
        var emailConfirm = $('#emailConfirm').val();
        var tel = $('#tel').val();
        var contrasena = $('#contrasena').val();
        var contrasenaConfirm = $('#confPass').val();

        var tasaVTP = $('#tasaVisaTP').val();
        var tasaMTP = $('#tasaMCTP').val();
        var tasaATP = $('#tasaAMEXTP').val();
        var tasaVlTP = $('#tasaValesTP').val();
        var tasaITP = $('#tasaInterTP').val();

        var tasaVE = $('#tasaVisaE').val();
        var tasaME = $('#tasaMCE').val();
        var tasaAE = $('#tasaAMEXE').val();
        var tasaVlE = $('#tasaValesE').val();
        var tasaIE = $('#tasaInterE').val();

        var tasaVTPC = $('#tasaVisaTPC').val();
        var tasaMTPC = $('#tasaMCTPC').val();
        var tasaATPC = $('#tasaAMEXTPC').val();
        var tasaVlTPC = $('#tasaValesTPC').val();
        var tasaITPC = $('#tasaInterTPC').val();

        var tasaVEC = $('#tasaVisaEC').val();
        var tasaMEC = $('#tasaMCEC').val();
        var tasaAEC = $('#tasaAMEXEC').val();
        var tasaVlEC = $('#tasaValesEC').val();
        var tasaIEC = $('#tasaInterEC').val();

        if (subafiliado == '') {
        	countError = countError+1;
        	$('#subafiliadoHelp').html('Campo obligatorio.');
        }
        if (entidad == '') {
        	countError = countError+1;
        	$('#entidadHelp').html('Campo obligatorio.');
        }
        if (sucursal == '') {
        	countError = countError+1;
        	$('#sucursalHelp').html('Campo obligatorio.');
        }
        if (nombre == '') {
        	countError = countError+1;
        	$('#nombreHelp').html('Campo obligatorio.');
        }
        if (aPaterno == '') {
        	countError = countError+1;
        	$('#aPaternoHelp').html('Campo obligatorio.');
        }
        if (aMaterno == '') {
        	countError = countError+1;
        	$('#aMaternoHelp').html('Campo obligatorio.');
        }
        if (rfc == '') {
        	countError = countError+1;
        	$('#rfcHelp').html('Campo obligatorio.');
        }
        if (email == '') {
        	countError = countError+1;
        	$('#emailHelp').html('Campo obligatorio.');
        }
        if (emailConfirm == '') {
        	countError = countError+1;
        	$('#emailConfirmHelp').html('Campo obligatorio.');
        }
        if (tel == '') {
        	countError = countError+1;
        	$('#telHelp').html('Campo obligatorio.');
        }
        if (contrasena == '') {
        	countError = countError+1;
        	$('#contrasenaHelp').html('Campo obligatorio.');
        }
        if (contrasenaConfirm == '') {
        	countError = countError+1;
        	$('#confPassHelp').html('Campo obligatorio.');
        }

        if (contrasena != contrasenaConfirm) {
        	countError = countError+1;
        	$('#confPassHelp').html('Por favor, introduzca el mismo valor de nuevo.');
        }
        if (email != emailConfirm) {
        	countError = countError+1;
        	$('#emailConfirmHelp').html('Por favor, introduzca el mismo valor de nuevo.');
        }

        
        $('#contrasenaHelp').html('');
        if ($('#contrasena').val().split(' ').length>=2){
            $('#contrasenaHelp').html('Hay espacios en blanco');
            countError = countError+1;
        }


        if (countError == 0) {
          $('#contrasenaHelp').html('');
            var formData = new FormData(document.getElementById("form_addColaborador"));
            formData.append("dato", "valor");

        	$.ajax({
	            url: base_url+"/addColaborador/registrar",
	            type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
	            success: function(respuesta){
	                if(respuesta.rows.success == true){
	                    bootbox.alert({
	                        message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Caja agregada exitosamente.</h3>",
	                        locale: 'mx'
	                    });
                        setTimeout("window.location.href = '"+base_url+"/addColaborador'", 3000);
	                }else{
	                    bootbox.alert({
	                        message: respuesta.rows.error.message,
	                        locale: 'mx'
	                    });
	                }
	            }
	        });
        }else{
              bootbox.alert({
	                        message: 'Algo salio mal',
	                        locale: 'mx'
	                    });
        }
        
        
    });
    
});