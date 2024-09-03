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
    /*$('#fechaFin').datetimepicker({
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#fechaInicio').datetimepicker({
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });*/
    $(".limpiar").click(function(event) {
       $("#form_filtro")[0].reset();
       
    });
    $(".buscar").click(function(event) {
        var table = $('#example1').DataTable();
        table.clear().draw();
        $.ajax({
            url: base_url+"/listSubAfiliado/searchResult",
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
                console.log(data1.rows.success);
                if(data1.rows.success){
                    var rows = '';
                    var fondeo = '';
                    var segmento = '';
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
                                data1.rows.commerces[i].businessName,
                                data1.rows.commerces[i].rfc,
                                data1.rows.commerces[i].email,
                                data1.rows.commerces[i].fiscalRegime,
                                data1.rows.commerces[i].phoneNumber,
                                data1.rows.commerces[i].dateTimeCreated,
                                '<div class="btn-group">'+
                                      '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                                          'Acciones'+
                                          '<span class="caret ml5"></span>'+
                                      '</button>'+
                                      '<ul class="dropdown-menu" role="menu">'+
                                            '<li>'+
                                                '<a href="editarCuenta?validate='+data1.rows.commerces[i].entitySonID+'&level=3">'+
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