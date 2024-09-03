$(function(){
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
            url: base_url+"/addColaborador/searchSucursal/"+subafiliado+'/'+entiSelect,
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
            url: base_url+"/addColaborador/searchSucursal/"+subafiliado+'/'+entidad,
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