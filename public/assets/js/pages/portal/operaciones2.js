$(function(){ 
    $('.dataTables_paginate ').hide(); 
    $('.dataTables_info ').hide(); 

    $('.buscar').click(function(event) {
        event.preventDefault();
        
        var type = '';
        var status = '';
        var fechaInicio = '';
        var fechaFin = ''; 
        var urlDate = ''; 
        var idContext = ''; 
        var idEntiti = ''; 
        var idTerminal = ''; 
        var idTerminalUser = ''; 
        var urlEntidad = ''; 
        var countError = 0;

        if ($('#typeOperacion').val() != null) {
            type = $('#typeOperacion').val();
        }else{
            countError = countError+1;
            type = '1,10007,10008';
        }
        if ($('#estatus').val() != null) {
            status = $('#estatus').val();
        }else{
            status = '15,31';
            countError = countError+1;
        }
        if ($('#datetimepicker1').val() != '') {
            var splitString = $('#datetimepicker1').val().split(" ");
            fechaInicio = splitString[0]+' '+splitString[1];
            urlDate += '&dateInit='+fechaInicio;
        }else{
            countError = countError+1;
        }
        if ($('#datetimepicker2').val() != '') {
            var splitString = $('#datetimepicker2').val().split(" ");
            fechaFin = splitString[0]+' '+splitString[1];
            urlDate += '&dateFinish='+fechaFin;
        }else{
            countError = countError+1;
        }

        if ($('#subafiliado').val() != '') {
            idContext = '&subafiliado='+$('#subafiliado').val();
            urlEntidad = idContext;
        }else{
            countError = countError+1;
        }
        /*if(obligarEntidad == 1){
            if ($('#entidad').val() != '') {
                idEntiti = '&entidad='+$('#entidad').val();
                urlEntidad = idContext+idEntiti;

            }else{
                countError = countError+1;
            }
        }else{
            if ($('#entidad').val() != '') {
                idEntiti = '&entidad='+$('#entidad').val();
                urlEntidad = idContext+idEntiti;

            }else{
                idEntiti = '&entidad=0';
                urlEntidad = idContext+idEntiti;
            }

        }*/
        if ($('#entidad').val() != '') {
            idEntiti = '&entidad='+$('#entidad').val();
            urlEntidad = idContext+idEntiti;

        }else{
            idEntiti = '&entidad=0';
            urlEntidad = idContext+idEntiti;
        }

        if ($('#sucursal').val() != '') {
            idTerminal = '&sucursal='+$('#sucursal').val();
            urlEntidad = idContext+idEntiti+idTerminal;

        }else{
            idTerminal = '&sucursal=0';
            urlEntidad = idContext+idEntiti+idTerminal;

            //countError = countError+1;
        }

        if ($('#caja').val() != '') {
            idTerminalUser = '&caja='+$('#caja').val();
            urlEntidad = idContext+idEntiti+idTerminal+idTerminalUser;
            
        }else{
            idTerminalUser = '&caja=0';
            urlEntidad = idContext+idEntiti+idTerminal+idTerminalUser;
        
            //countError = countError+1;
        }

        if (countError == 0) {
            location.href = base_url+'/operaciones?type='+type+'&status='+status+'&page=1'+urlDate+urlEntidad;
        }else{
            bootbox.alert({
                message: "Debe llenar todos los parametros del filtro de busqueda. Campos obligatorios *",
                locale: 'mx'
            });
        }
        
       
    });
    $(".limpiar").click(function(event) {
        event.preventDefault();
       $("#form_filtro")[0].reset();
       $("form select").each(function() { this.selectedIndex = 0 });  
       var type = $('#typeOperacion').val();
        var status = $('#estatus').val();
       location.href = base_url+'/operaciones?type=10007,1&status=15&page=1';
    });
    $(".select2-multiple").select2({
        placeholder: "",
        allowClear: true
    });
    $('#datetimepicker1').datetimepicker();
    

    $('#datetimepicker2').datetimepicker();



    if (subAfSelect != '0') {
        $.ajax({
            url: base_url+"/operaciones/searchEntidad/"+subAfSelect,
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
            url: base_url+"/operaciones/searchSucursal/"+subAfSelect+'/'+entidadSelect,
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
            url: base_url+"/operaciones/searchCaja/"+sucursalSelect,
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

    $("#subafiliado").change(function(event){
        var subafiliado = $("#subafiliado").val();
       $('#entidad').html("<option></option>");
        $.ajax({
            url: base_url+"/operaciones/searchEntidad/"+subafiliado,
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
            url: base_url+"/operaciones/searchSucursal/"+subafiliado+'/'+entidad,
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
            url: base_url+"/operaciones/searchCaja/"+sucursal,
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