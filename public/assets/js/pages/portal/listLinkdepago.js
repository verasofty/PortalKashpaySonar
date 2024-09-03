$(function(){
    $('#example1').hide();
    
    $("#fechaInicio").datepicker({
        maxDate: hoy,
        dateFormat: "yy-mm-dd"
    });
    $('#entidad').html("<option></option>");
    $('#sucursal').html("<option></option>");
    $('#caja').html("<option></option>");
    if (subAfSelect != '0') {
        $.ajax({
            url: base_url+"/listLinkPago/searchEntidad/"+subAfSelect,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                        console.log(entidadSelect +'=='+ respuesta.rows.entitiesResponse[i].idEntity);
                        if (entidadSelect == respuesta.rows.entitiesResponse[i].idEntity) {
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
        }); 
    }
    if (entidadSelect != '0') {
        $.ajax({
            url: base_url+"/listLinkPago/searchSucursal/"+subAfSelect+'/'+entidadSelect,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.branchOfficeResponse.length; i++) {
                        if (sucursalSelect == respuesta.rows.branchOfficeResponse[i].idTerminal) {
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
        });
    }
    if (sucursalSelect != '0') {
        $.ajax({
            url: base_url+"/listLinkPago/searchCaja/"+sucursalSelect,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.collaborators.length; i++) {
                        if (respuesta.rows.collaborators[i].idTerminalUser == cajaSelect) {
                            $('#caja').append($('<option selected>').val(respuesta.rows.collaborators[i].idTerminalUser).text(respuesta.rows.collaborators[i].tuName));
                        }else{
                            $('#caja').append($('<option>').val(respuesta.rows.collaborators[i].idTerminalUser).text(respuesta.rows.collaborators[i].tuName));
                        }
                        
                    }
                }else{
                    bootbox.alert({
                        message: "La sucursal seleccionada no tiene cajas relacionadas.",
                        locale: 'mx'
                    });
                }
            }
        }); 
    }
    
    $(".limpiar").click(function(event) {
        $("#form_filtro")[0].reset();
        
     });
   $(".buscar").click(function(event) {
        location.href = base_url+'/listLinkPago?idContext='+$('#subafiliado').val()+'&idEntity='+$('#entidad').val()+'&idTerminal='+$('#sucursal').val()+'&idTerminalUser='+$('#caja').val()+'&amount='+$('#monto').val()+'&reference='+$('#referencia').val()+'&date='+$('#fechaInicio').val()+'&status='+$('#estatus').val()+'&page=1';
    });
    $("#monto").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });               
    $("#subafiliado").change(function(event){
        var subafiliado = $("#subafiliado").val();
       $('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/listLinkPago/searchEntidad/"+subafiliado,
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
            url: base_url+"/listLinkPago/searchSucursal/"+subafiliado+'/'+entidad,
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

    $("#sucursal").change(function(event){
        var sucursal = $("#sucursal").val();
       $('#caja').html("<option></option>");
        $.ajax({
            url: base_url+"/listLinkPago/searchCaja/"+sucursal,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success == true) {
                    for (var i = 0; i < respuesta.rows.collaborators.length; i++) {
                        $('#caja').append($('<option>').val(respuesta.rows.collaborators[i].idTerminalUser).text(respuesta.rows.collaborators[i].tuName));
                    }
                }else{
                    bootbox.alert({
                        message: "La sucursal seleccionada no tiene cajas relacionadas.",
                        locale: 'mx'
                    });
                }
            }
        }); 
    });


 });
