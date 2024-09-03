$(function(){
    
    $('#searchDate').hide();
    $('#searchDatefin').hide();
    $('#example1').hide();

    $("#busquedatype").change(function(event) {
       var tipo = $("#busquedatype").val();
       var combo = document.getElementById("busquedatype");
       if (tipo == 'fechas') {
           $("#searchComun").hide();
           $("#searchDate").show();
           $("#searchDatefin").show();
       }else{
            var selected = combo.options[combo.selectedIndex].text;
            $("#textBusqueda").html(selected);
            $("#searchComun").show();
            $("#searchDate").hide();
            $("#searchDatefin").hide();
       }
    });

    $("#fechaInicio").datepicker({
        maxDate: hoy,
        dateFormat: "yy-mm-dd"
    });
    $("#fechaFin").datepicker({
        maxDate: hoy,
        dateFormat: "yy-mm-dd"
    });
    $(".limpiar").click(function(event) {
       $("#form_filtro")[0].reset();
       
    });
    $(".buscar").click(function(event) {
        var table = $('#example1').DataTable();
        table.clear().draw();
        $.ajax({
            url: base_url+"/listComisionista/searchResult",
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
                    //if (data1.rows != null) {                    
                        var rows = '';
                        var data = Array();
                        console.log(data1.rows.commerces.length);
                        for (var i=0; i < data1.rows.commerces.length; i++) { 

                            var datadni = [
                                    data1.rows.commerces[i].nameCommerce,
                                    data1.rows.commerces[i].businessName,
                                    data1.rows.commerces[i].rfc,
                                    data1.rows.commerces[i].email,
                                    data1.rows.commerces[i].fiscalRegime,
                                    data1.rows.commerces[i].phoneNumber,
                                    data1.rows.commerces[i].dateTimeCreated,
                                    '<div class="btn-group text-center">'+
                                        '<a title="Editar Información" href="editarCuenta?validate='+data1.rows.commerces[i].entityID+'&level=7" class="btn btn-primary">'+
                                            '<i class="fas fa-user-edit"></i>'+
                                        '</a>'+
                                    '</div>'
                                ];
                            data.push (datadni); 
                        }
                        table.rows.add(data).draw();    
                    //}                
                }else{
                    bootbox.alert({
                        message: respuesta.rows.error.message,
                        locale: 'mx'
                    });
                }
            }
        });
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

    
});