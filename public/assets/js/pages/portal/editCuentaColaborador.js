$(function(){
        /*$.ajax({
            url: base_url+"/addColaborador/searchEntidad/"+$("#subafiliado").val(),
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        if (respuesta.rows.entitiesResponse[i].idEntity == entiSelect) {
                            $('#entidad').append($('<option selected>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }else{
                            $('#entidad').append($('<option>').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                        }
                    }
                }else{
                    bootbox.alert({
                        message: "El subafiliado seleccionado no tiene entidades relacionadas.",
                        locale: 'mx'
                    });
                }
                
            }
        }); */

        /*$.ajax({
            url: base_url+"/addColaborador/searchSucursal/"+$("#subafiliado").val()+'/'+entiSelect,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.success == true) {
                    for (var i = 0; i < respuesta.rows.branchOfficeResponse.length; i++) {
                        if (respuesta.rows.branchOfficeResponse[i].idTerminal == sucSelect) {
                             $('#sucursal').append($('<option selected>').val(respuesta.rows.branchOfficeResponse[i].idTerminal).text(respuesta.rows.branchOfficeResponse[i].businessName));
                        }else{
                             $('#sucursal').append($('<option>').val(respuesta.rows.branchOfficeResponse[i].idTerminal).text(respuesta.rows.branchOfficeResponse[i].businessName));
                        }
                       
                    }
                }else{
                    bootbox.alert({
                        message: "La entidad seleccionada no tiene sucursales relacionadas.",
                        locale: 'mx'
                    });
                }
            }
        }); */

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

	$('#btn-add').click(function(event) {
        /*bootbox.alert({
            message: 'Solo se consulta información',
            locale: 'mx'
        });*/
        var countError = 0;

    	
    	$('#nombreHelp').html('');
    	$('#aPaternoHelp').html('');
    	$('#aMaternoHelp').html('');
       	$('#rfcHelp').html('');
    	
    	$('#telHelp').html('');
    	
        

        
        var nombre = $('#nombre').val();
        var aPaterno = $('#aPaterno').val();
        var aMaterno = $('#aMaterno').val();
        var rfc = $('#rfc').val();
       
        var tel = $('#tel').val();

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
 
        if (tel == '') {
        	countError = countError+1;
        	$('#telHelp').html('Campo obligatorio.');
        }

        if (countError == 0) {
            var formData = new FormData(document.getElementById("form_addColaborador"));
            formData.append("dato", "valor");
        	$.ajax({
	            url: base_url+"/editarCuenta/updateCuenta",
	            type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
	            success: function(respuesta){
	                //alert(respuesta);
	                if(respuesta.rows.success == true){
	                    bootbox.alert({
	                        message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Caja modificada exitosamente.</h3>",
	                        locale: 'mx'
	                    });
                     setTimeout("window.location.href = '"+base_url+"/editarCuenta?validate="+validate+"&level="+level+"'", 3000);
	                }else{
	                    bootbox.alert({
	                        message: respuesta.rows.error.message,
	                        locale: 'mx'
	                    });
	                }
	            }
	        });
        }
        
    });
    
});