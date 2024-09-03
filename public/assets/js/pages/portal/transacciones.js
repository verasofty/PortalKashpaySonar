$(function(){
    $('#example1').hide();
    
    /*$('#datetimepicker1').datetimepicker();
    

    $('#datetimepicker2').datetimepicker();*/
    $('#datetimepicker1').datetimepicker({ 
        maxDate: new Date(),
        minDate: new Date(mesLim)
    });
    

    $('#datetimepicker2').datetimepicker({ 
        maxDate: new Date(),
        minDate: new Date(mesLim)
    });


    if (subAfSelect != '0') {
        $.ajax({
            url: base_url+"/transacciones/searchEntidad/"+subAfSelect,
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
            url: base_url+"/transacciones/searchSucursal/"+subAfSelect+'/'+entidadSelect,
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
            url: base_url+"/transacciones/searchCaja/"+sucursalSelect,
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
        var urlSearch = 'transacciones?rango=';
       
        location.href = urlSearch+'&estatus=&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&type=&mood=&page=1&size=10';
       
    });

    /*$(".buscar").click(function(event) {
        var urlSearch = 'transacciones?rango=';
        if ($('#datetimepicker1').val() != '' && $('#datetimepicker1').val() != '') {
            var myArray = $('#datetimepicker1').val().split(" ");
            var myArray2 = $('#datetimepicker2').val().split(" ");
            urlSearch+=myArray[0]+' '+myArray[1]+' / '+myArray2[0]+' '+myArray2[1];
            console.log(urlSearch);
        }

        location.href = urlSearch+'&estatus='+$('#edoTransaccion').val()+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&monto='+$('#monto').val()+'&typeOperation='+$('#operacion').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&bin='+$('#bin').val()+'&numTarjeta='+$('#numTarjeta').val()+'&type=&mood=&page=1&size=10';
    });*/
    
    $(".buscar").click(function(event) {
        var urlSearch = 'transacciones?rango=';
        $('#message').html('');
        if (rolId == 2 || rolId == 3) {
            if ($('#datetimepicker1').val() == '' && $('#datetimepicker1').val() == '') {
                $('#message').html('<div class="alert alert-danger" role="alert">Para poder hacer una busqueda necesitas seleccionar un rango de fecha.</div>');
            }else{
                $('#message').html('');
                if ($('#datetimepicker1').val() != '' && $('#datetimepicker1').val() != '') {
                    var myArray = $('#datetimepicker1').val().split(" ");
                    var myArray2 = $('#datetimepicker2').val().split(" ");
                    urlSearch+=myArray[0]+' '+myArray[1]+' / '+myArray2[0]+' '+myArray2[1];
                    console.log(urlSearch);
                }
        
                location.href = urlSearch+'&estatus='+$('#edoTransaccion').val()+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&monto='+$('#monto').val()+'&typeOperation='+$('#operacion').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&bin='+$('#bin').val()+'&numTarjeta='+$('#numTarjeta').val()+'&type=&mood=&page=1&size=10';

            }
        }else{
            $('#message').html('');

            if ($('#datetimepicker1').val() != '' && $('#datetimepicker1').val() != '') {
                var myArray = $('#datetimepicker1').val().split(" ");
                var myArray2 = $('#datetimepicker2').val().split(" ");
                urlSearch+=myArray[0]+' '+myArray[1]+' / '+myArray2[0]+' '+myArray2[1];
                console.log(urlSearch);
            }
    
            location.href = urlSearch+'&estatus='+$('#edoTransaccion').val()+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&monto='+$('#monto').val()+'&typeOperation='+$('#operacion').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&bin='+$('#bin').val()+'&numTarjeta='+$('#numTarjeta').val()+'&type=&mood=&page=1&size=10';
        }
        
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
            url: base_url+"/transacciones/searchEntidad/"+subafiliado,
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
            url: base_url+"/transacciones/searchSucursal/"+subafiliado+'/'+entidad,
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
            url: base_url+"/transacciones/searchCaja/"+sucursal,
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
    




    $(".buscar2").click(function(event) {
        $('#example1').hide();
        var table = $('#example1').DataTable();
        table.clear().draw();
        $.ajax({
            url: base_url+"/transacciones/searchTransaccion",
            data: $("#form_filtro").serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
            },
            success: function(data1){
                $('#example1').show();
                $('#rowsTrasnsacciones').html('');
                $("#caja21").html('');
                if(data1.rows.success == true){
                    
                    var rows = '';
                    var data = Array();
                    for (var i=0; i < data1.rows.operations.length ; i++) {
                        var btn_imp = '';
                        var com1 = 0;
                        var com2 = 0;
                        var com3 = 0;
                        var iva = 0;
                        var transactionType = 0.00;
                        var transactionSubType = 0.00;
                        var transactionID = 0.00;
                        var timestamp = 0.00;
                        var systemTraceAudit = 0.00;
                        var settleAmount = 0.00;

                        if (data1.rows.operations[i].operationSirio != null) {
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.systemSource != null) {
                                iva = data1.rows.operations[i].operationSirio.acquiringOperation.systemSource;
                            }
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.transactionType != null) {
                                transactionType = data1.rows.operations[i].operationSirio.acquiringOperation.transactionType;
                            }
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.transactionSubType != null) {
                                transactionSubType = data1.rows.operations[i].operationSirio.acquiringOperation.transactionSubType;
                            } 
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.transactionID != null) {
                                transactionID = data1.rows.operations[i].operationSirio.acquiringOperation.transactionID;
                            }
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.timestamp != null) {
                                timestamp = data1.rows.operations[i].operationSirio.acquiringOperation.timestamp;
                            }
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.systemTraceAuditNumber != null) {
                                systemTraceAudit = data1.rows.operations[i].operationSirio.acquiringOperation.systemTraceAuditNumber;
                            }
                            if (data1.rows.operations[i].operationSirio.acquiringOperation.settleAmount != null) {
                                settleAmount = data1.rows.operations[i].operationSirio.acquiringOperation.settleAmount;
                            }
                        }
                        
                        if (data1.rows.operations[i].status == 'Aprobada') {
                            btn_imp +='<div class="btn-group">'+
                                        '<a target="_blank" href="'+urlTi+data1.rows.operations[i].authorizationRrcext+data1.rows.operations[i].authorizationNumber+'.pdf" class="btn btn-primary">'+
                                            '<i class="fas fa-print"></i>'+
                                        '</a>'+
                                       '</div>';    
                        }else{
                            btn_imp +='<div class="btn-group">'+
                                       '</div>';    
                        }

                        switch(rolId) {
                            //admin
                            case '2':
                                com1 = 0;
                                com2 = 0;
                                com3 = 0;
                                break;
                            //suba
                            case '3':
                                com1 = (parseFloat(transactionType) + parseFloat(transactionSubType));
                                com2 = transactionID;
                                com3 = (parseFloat(timestamp) + parseFloat(systemTraceAudit));
                                break;
                            //enti
                            case '4':
                                com1 = (transactionType + transactionSubType + transactionID);
                                com2 = timestamp;
                                com3 = systemTraceAudit;
                                break;
                            //sucu
                            case '5':
                                com1 = (transactionType + transactionSubType + transactionID + timestamp);
                                com2 = systemTraceAudit;
                                com3 = 0;
                                break;
                            //caja
                            case '6':
                                com1 = settleAmount;
                                com2 = 0;
                                com3 = 0;
                                break;
                        }

                        var datadni = [
                                //data1.rows.operations[i].idOperation,
                                data1.rows.operations[i].amount.toFixed(2),
                                data1.rows.operations[i].authorizationNumber,
                                data1.rows.operations[i].card,
                                data1.rows.operations[i].authorizationRrcext,
                                data1.rows.operations[i].authorizationDate,
                                data1.rows.operations[i].status,
                                data1.rows.operations[i].institution,
                                data1.rows.operations[i].brand,
                                data1.rows.operations[i].nature,
                                data1.rows.operations[i].entityName,
                                data1.rows.operations[i].terminalName,
                                data1.rows.operations[i].transactiontype,
                                data1.rows.operations[i].entryMode,
                                data1.rows.operations[i].feeAmount.toFixed(2),
                                data1.rows.operations[i].responseDescription,
                                data1.rows.operations[i].qtPay,
                                data1.rows.operations[i].planId,
                                data1.rows.operations[i].graceNumber,
                                data1.rows.operations[i].concept,
                                data1.rows.operations[i].bin,
                                data1.rows.operations[i].sendSirio,
                                iva,
                                com1,
                                com2,
                                com3,
                                data1.rows.operations[i].entityOperationId,
                                data1.rows.operations[i].transactionBuilder,
                                data1.rows.operations[i].liquidation_id,
                                data1.rows.operations[i].statusSirio,
                                btn_imp
                            ];
                        data.push (datadni); 
                    }
                    table.rows.add(data).draw();                    
                }else{
                    bootbox.alert({
                        message: respuesta.rows.error.message,
                        locale: 'mx'
                    });
                }
            }
        });
    });
});