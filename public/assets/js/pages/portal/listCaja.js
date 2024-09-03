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

    var subafiliado = $("#subafiliado").val();
    $('#entidad').html("<option></option>");
    $('#sucursal').html("<option></option>");
    $.ajax({
        url: base_url+"/listColaborador/searchEntidad/"+subafiliado,
        dataType: "json",
        success: function(respuesta){
            if (respuesta.rows.success == true) {
                for (var i = 0; i < respuesta.rows.entitiesResponse.length; i++) {
                    if (entitySelect == 0) {
                        $('#entidad').append($('<option >').val(respuesta.rows.entitiesResponse[i].idEntity).text(respuesta.rows.entitiesResponse[i].entityDescription));
                    }else if (entitySelect == respuesta.rows.entitiesResponse[i].idEntity) {
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

    if(entitySelect != '0' ){
        var subafiliado = $("#subafiliado").val();
        var entidad = $("#entidad").val();
        $('#sucursal').html("<option></option>");
        $.ajax({
            url: base_url+"/listColaborador/searchSucursal/"+subafiliado+'/'+entitySelect,
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
        $('#msg').html('');
        var countError = 0;
        /*if ($('#entidad').val() == '') {
            countError = countError+1;
            bootbox.alert({
                message: "Debes seleccionar una entidad.",
                locale: 'mx'
            });
        }
        if ($('#sucursal').val() == '') {
            countError = countError+1;
            bootbox.alert({
                message: "Debes seleccionar una sucursal.",
                locale: 'mx'
            });
        }*/
        //if (countError == 0) {
            var table = $('#example1').DataTable();
            table.clear().draw();
            $.ajax({
                url: base_url+"/listColaborador/searchResult",
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
                            var segmento = '';
                            var fondeo = '';
                            var data = Array();
                            for (var i=0; i < data1.rows.commerces.length ; i++) { 
                              if(idBusinessModel != 2){
                             segmento = '<li>'+
                                                '<a href="segmento?validate='+data1.rows.commerces[i].issueId+'&level=4&entitySonID='+data1.rows.commerces[i].entitySonID+'&name='+data1.rows.commerces[i].nameCommerce+'">'+
                                                  'Segmento'+
                                                '</a>'+
                                            '</li>';
                            fondeo = '<li>'+
                                                '<a href="fondeo?validate='+data1.rows.commerces[i].issueId+'&level=4&entitySonID='+data1.rows.commerces[i].entitySonID+'">'+
                                                  'Fondeo'+
                                                '</a>'+
                                            '</li>';
                          }
                                var datadni = [
                                        data1.rows.commerces[i].nameCommerce,
                                        data1.rows.commerces[i].email,
                                        data1.rows.commerces[i].phoneNumber,
                                        data1.rows.commerces[i].dateTimeCreated,
                                        '<div class="btn-group">'+
                                      '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                                          'Acciones'+
                                          '<span class="caret ml5"></span>'+
                                      '</button>'+
                                      '<ul class="dropdown-menu" role="menu">'+
                                            '<li>'+
                                                '<a href="editarCuenta?validate='+data1.rows.commerces[i].entitySonID+'&level=6">'+
                                                  'Editar Información'+
                                                '</a>'+
                                            '</li>'+
                                            segmento+
                                            fondeo+
                                            '<li>'+
                                                '<a title="Deshabilitar" href="">'+
                                                    'Deshabilitar '+
                                                '</a>'+
                                            '</li>'+
                                      '</ul>'+
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
        //}
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

function BootboxContent(){    
      var frm_str = '<form id="some-form">'
                      +'<div id="message"></div>'
                      + '<div class="row" >'
                        + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'
                              + '<label for="tasa">Comisión</label>'    
                              + '<input id="tasa" name="tasa" class="form-control monto" type="text">'
                            + '</div>'
                          + '</div>'
                        + '</div>'
                        + '</div>'
                  + '</form>';

            var object = $('<div/>').html(frm_str).contents();

             return object
        
        }

function editComision(id, entitySonID, event){
    bootbox.dialog({
        message: BootboxContent,
        title: "Actualizar comisión",
        buttons: {
           buttonName: {
              label: "Guardar",
              className: "btn-primary",
              callback: function () {
                event.preventDefault(); 
                $('#message').html('');
                var comision = $("#tasa").val();
                
                var numError = 0;

                if (comision == '') {
                  
                  $('#message').html('<div class="alert alert-danger" role="alert">Debes ingresar una comision.</div>');

                  numError =(numError+1);
                  return false;
                }
                            
                if (numError == 0) {
                  $('#message').html('');
                  $.ajax({
                    //url : "php/interesados/exportar.php",
                    url: base_url+"/listColaborador/updateComision/"+id+"/"+comision+"/"+entitySonID,
                    type : "GET",
                    dataType : "json",
                    success:function(respuesta){
                      if (respuesta.rows.success == true) { 
                        bootbox.alert('La comisón se actualizó con exito.');
                        location.href = base_url+'/listColaborador';
                      }else{
                        bootbox.alert('Algo salio mal, intentalo mas tarde.');
                        return false;
                      }
                         
                    }
                  });
                }
                  
               
              }
                  
            },
            cancel: {
                    label: 'Cancelar',
                    className: 'btn-dark'
                }
        }
    });

}