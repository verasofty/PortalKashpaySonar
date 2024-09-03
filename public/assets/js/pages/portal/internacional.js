$(function(){
    bootbox.alert({
        title: '¡Importante!',
        message: '<p class="text-center negritas">TRANSFERENCIA INTERNACIONAL</p><br>'+
        'Tener a la mano los siguientes datos:<br><br>'+
        '1.- Nombre Beneficiario.<br> 2.- Dirección del Beneficiario.<br> 3.- Ciudad,País.<br> 4.- Número de celular. <br> 5.- Cuenta Beneficiario.<br> 6.- Banco Beneficiario. <br> 7.- Dirección del Banco.<br> 8.- Número de ruta Bancaria ABA.<br> 9.- SWIFT.<br><br<br><br>><p style="color:red;font-size: 13px;">Para finalizar el envío, recibirás un TOKEN de confirmación al Teléfono '+telS+' que fue registrado a esta cuenta</p>',
        locale: 'mx'
     });

    var idOrigin = '';
    var numCuenta = '';
    var isRow = 0;
    var saldoD = 0;
    var saldoD2 = 0;
     //balance
      $.ajax({ 
          async:false,
          dataType: "json", 
          url: base_url+"/login/getSaldo/"+idSaldo,
          success:function(resultado){ 
              saldoD = resultado.rows.balance.toFixed(2);        
              saldoD2 = resultado.rows.balance.toFixed(2);        
          } 
      });
      
          
    //USA

    $(".btn_addCuenta_usa" ).click(function(event){
      isRow = 0;
        event.preventDefault();
        $(this).hide();
        $('.btn_addCuenta').hide();
        $('.monto_mx').hide();
        $('.monto_mx').html('');
        $('.monto_usa').html('<div class="form-group">'+
                              '<label for="institucion">Moneda</label>'+
                              '<select class="form-control" id="moneda" name="moneda">'+
                              '<option value="USD">Dolar</option>'+
                              '</select>'+
                            '</div>'+
                            '<p class="text-center"><b>¿Cuánto vas a transferir?</b></p>'+
                            '<div class="panel row" style="padding: 10px;text-align: justify;">'+
                              '<p id="">Saldo disponible para transferir $<span id="saldoD2">'+saldoD2+'</span></p>'+
                              '<p id="">Ingresa el monto que deseas enviar y calcula lo que podrán recibir</p>'+
                              '<div class="col-md-6">'+
                                '<p><b>Enviar</b></p>'+
                                '<div class="section mb10">'+
                                  '<label for="">Enviar</label>'+
                                  '<label class="field append-icon">'+
                                    '<input type="text" name="monto" id="monto" class="gui-input monto divisa" value="0.00" placeholder="Monto">'+
                                    '<label for="firstname" class="field-icon">'+
                                      '$ MXN'+
                                    '</label>'+
                                  '</label>'+
                                  '<small id="montoHelp" class="error form-text text-muted"></small>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p><b>El destinatario recibe</b></p>'+
                                '<div class="section mb10">'+
                                  '<label for="">Recibir</label>'+
                                  '<label class="field append-icon">'+
                                    '<input type="text" name="recibe" id="recibe" disabled="true" class="gui-input monto" value="0.00" placeholder="0.00">'+
                                    '<label for="firstname" class="field-icon">'+
                                      '$ USD'+
                                   ' </label>'+
                                  '</label>'+
                                  '<small id="montoHelp" class="error form-text text-muted"></small>'+
                                '</div>'+
                              '</div>'+
                             ' <div class="row">'+
                                '<div class="col-md-12">'+
                                  '<p style="color: #c7924b;" id="descEnvio"></p>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                  '<p style="font-size: 11px; color: #c7924b;" id="valueCurrency"></p>'+
                                '</div>'+
                               ' <div class="col-md-6">'+
                                   '<p style="font-size: 11px; color: #c7924b;" id="dateCurrency"></p>'+
                                '</div>'+
                              '</div>'+ 
                            '</div>');
        $(".new_cuenta" ).html('');
        $('#textInfo').html('Ingresa una Cuenta Destino');
         $(".new_cuenta" ).show();
        $('.entrega_usa').html('<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<div class="form-group">'+
                                      '<label for="paisDes">País de destino*</label>'+
                                      '<select class="form-control" id="paisDes" name="paisDes">'+
                                        '<option value="USA">Estados Unidos</option>'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<label for="swift">Código SWIFT / BIC de Banco*</label>'+
                                    '<input minlength="8" type="text" class="form-control btn_searchCuenta_usa" id="swift" name="swift">'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<label for="cuenta">Cuenta Interbancaria*</label>'+
                                    '<input type="text" class="form-control soloNum btn_searchCuenta_usa" id="cuenta" name="cuenta">'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12 cuentaEncontrada">'+
                                  '<div class="form-group">'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<input type="hidden" class="form-control" id="nameIns" name="nameIns">'+
                                    '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
                                    '<input type="hidden" value="'+numCuenta+'"  class="form-control wizard-required" id="accountNumber" name="accountNumber">'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="form-group">'+
                                        '<label class="text-dorado" for="calle">Dirección del Banco*</label>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="calleB">Calle*</label>'+
                                    '<input type="text" class="form-control" id="calleB" name="calleB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numExtB">No. Exterior</label>'+
                                    '<input type="text" class="form-control" id="numExtB" name="numExtB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numIntB">No. Interior</label>'+
                                    '<input type="text" class="form-control" id="numIntB" name="numIntB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="cpB">Zip Code*</label>'+
                                    '<input type="text" class="form-control" id="cpB" name="cpB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="ciudadB">Ciudad*</label>'+
                                    '<input type="text" class="form-control" id="ciudadB" name="ciudadB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="estadoB">Estado*</label>'+
                                    '<input type="text" class="form-control" id="estadoB" name="estadoB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="bancoInter">Nombre del Banco Intermediario</label>'+
                                    '<input type="text" class="form-control" id="bancoInter" name="bancoInter">'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="form-group">'+
                                        '<label class="text-dorado" for="">Información Adicional*</label>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numRefB">Número de referencia</label>'+
                                    '<input type="text" class="form-control" id="numRefB" name="numRefB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="refAdiB">Referencia Adicional</label>'+
                                    '<input type="text" class="form-control" id="refAdiB" name="refAdiB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="descAdiB">Descripción Adicional</label>'+
                                    '<input type="text" class="form-control" id="descAdiB" name="descAdiB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label class="control-label">Guardar cuenta</label>'+
                                    '<div class="switch switch-info round switch-inline">'+
                                      '<input id="exampleCheckboxSwitch6_usa" type="checkbox">'+
                                      '<label for="exampleCheckboxSwitch6_usa"></label>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="col-md-12 panel">'+
                                      '<p>Los giros no se envían los fines de semana y días festivos.</p>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>');

        var frm_str = '<div id="message_usa"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'+
                          '<div class="row">'+
                            '<div class="col-md-12 panel">'+
                              '<p>Verifique siempre las transacciones de pago nuevas o actualizadas y la información de cuenta bancaria con una llamada telefónica o una fuente confiable antes de enviar una transacción bancaria.</p>'+
                            '</div>'+
                          '</div>'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12 cuentaEncontrada2">'+
                                '<div class="form-group">'+
                                  '<label for="titular">Nombre del Beneficiario*</label>'+
                                  '<input type="text" class="form-control" id="titular" name="titular">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="alias">Alias del Beneficiario*</label>'+
                                  '<input type="text" class="form-control" id="alias" name="alias">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="email">Correo electrónico*</label>'+
                                  '<input type="email" class="form-control" id="email" name="email">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="tel">Número móvil*</label>'+
                                  '<input type="tel" maxlength="10" class="form-control soloNum" id="tel" name="tel">'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="form-group">'+
                                        '<label class="text-dorado" for="calle">Dirección del Beneficiario*</label>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="calle">Calle*</label>'+
                                  '<input type="text" class="form-control" id="calle" name="calle">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="numExt">No. Exterior</label>'+
                                  '<input type="text" class="form-control" id="numExt" name="numExt">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="numInt">No. Interior</label>'+
                                  '<input type="text" class="form-control" id="numInt" name="numInt">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="cp">Zip Code*</label>'+
                                  '<input type="text" class="form-control" id="cp" name="cp">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="ciudad">Ciudad*</label>'+
                                  '<input type="text" class="form-control" id="ciudad" name="ciudad">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="estado">Estado*</label>'+
                                  '<input type="text" class="form-control" id="estado" name="estado">'+
                                '</div>'+
                              '</div>'+
                            '</div>'
                      + '</div>'
                    + '</div>'
                + '</div';
        $(".new_cuenta" ).html(frm_str);
        $("#contact_div" ).hide();
        $(".cuentaEncontrada" ).hide();
        $('.soloNum').on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });

        $('.btn_searchCuenta_usa').keyup(function(event){
            if ($('#cuenta').val().length > 9 ) {
                $.ajax({
                    url: base_url+"/spei/searchInstitucionUSA",
                    data: $("#form-wizard").serialize(),
                    type: "post",
                    dataType: "json",
                    success: function(respuesta){
                        console.log(respuesta.institutionResponse.institutions);
                        if (respuesta.institutionResponse.institutions.length == 1) {
                            $("#showCuenta" ).html($('#cuenta').val());
                            $(".cuentaEncontrada" ).show();
                            $('#institucion').html($('<option>').val(respuesta.institutionResponse.institutions[0].key).text(respuesta.institutionResponse.institutions[0].name));
                            $('#nameIns').val(respuesta.institutionResponse.institutions[0].name);
                            $('#idIns').val(respuesta.institutionResponse.institutions[0].key);
                        }else{
                            $('#institucion').html('<option></option>');
                            $("#showCuenta" ).html($('#cuenta').val());
                            $(".cuentaEncontrada" ).show();
                            for (var i = 0; i < respuesta.institutionResponse.institutions.length; i++) {
                                $('#institucion').append($('<option>').val(respuesta.institutionResponse.institutions[i].key).text(respuesta.institutionResponse.institutions[i].name));
                            }
                        }
                    }
                });  
            }/*else{
                bootbox.alert({
                    message: 'La cuenta debe tener 9 dígitos .',
                    locale: 'mx'
                });
            }*/
            $(".btn_addCuenta" ).hide();
        });

        $('#institucion').change(function(event){
            var comboIns = document.getElementById("institucion");
            var selectedIns = comboIns.options[comboIns.selectedIndex].text;
            $('#nameIns').val(selectedIns);
            $('#idIns').val($('#institucion').val());
        });

        $('#exampleCheckboxSwitch6_usa').click(function(event){
            if( $('#exampleCheckboxSwitch6_usa').prop('checked') ) {
                console.log('si');
                $.ajax({
                    url: base_url+"/internacional/addContactoUSA",
                    data: $("#form-wizard").serialize(),
                    type: "post",
                    dataType: "json",
                    success: function(respuesta){
                        if (respuesta.success == true) {
                            bootbox.alert({
                                message: 'Contacto guardado exitosamente.',
                                locale: 'mx'
                            });
                        }else{
                            bootbox.alert({
                                message: 'El contacto no pudo ser guardado.',
                                locale: 'mx'
                            });
                        }
                    }
                });
            }else{
                console.log('no');
            }
        });

        $("#cp").keyup(function(){
            var cp = $("#cp").val();
            if (cp.length == 5) {
                $('#col').html("<option></option>");
                $.ajax({
                    url: base_url+"/spei/searchLocalidad/"+cp,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta.rows.locationResponse.locations.length > 0){
                            for (var i = 0; i < respuesta.rows.locationResponse.locations.length; i++) {
                                $('#ciudad').val(respuesta.rows.locationResponse.locations[i].city)
                                $('#estado').val(respuesta.rows.locationResponse.locations[i].state)
                          }
                        }else{
                            $('#ciudad').val('');
                            $('#estado').val('');
                            bootbox.alert({
                                title: 'Busqueda sin datos',
                                message: 'Zip Code solicitado no cuenta con entidades relacionadas.',
                                locale: 'mx'
                            });
                        }
                    }
                }); 
            }
        });

        $("#cpB").keyup(function(){
          var cp = $("#cpB").val();
          if (cp.length == 5) {
              $('#col').html("<option></option>");
              $.ajax({
                  url: base_url+"/internacional/searchLocalidad/"+cp,
                  dataType: "json",
                  success: function(respuesta){
                      if(respuesta.rows.locationResponse.locations.length > 0){
                          for (var i = 0; i < respuesta.rows.locationResponse.locations.length; i++) {
                              $('#ciudadB').val(respuesta.rows.locationResponse.locations[i].city)
                              $('#estadoB').val(respuesta.rows.locationResponse.locations[i].state)
                        }
                      }else{
                          $('#ciudadB').val('');
                          $('#estadoB').val('');
                          bootbox.alert({
                              title: 'Busqueda sin datos',
                              message: 'Zip Code solicitado no cuenta con entidades relacionadas.',
                              locale: 'mx'
                          });
                      }
                  }
              }); 
          }
        });

        $(".divisa").keyup(function(){
            $.ajax({
                url: base_url+"/spei/tipoCambio/"+'mx',
                dataType: "json",
                success: function(respuesta){
                    if (respuesta.rows.success == true) {
                        var valMoneda = respuesta.rows.currencyExchangeResponse.value;
                        var TotalDevengado = $('#monto').val().replace(/,/g, "");
                        var comisionSpei = ((parseFloat(TotalDevengado) * 5) / 100).toFixed(2);
                        var envioSinComision = (parseFloat(TotalDevengado) - comisionSpei).toFixed(2);
                        var valEnvio = (envioSinComision / valMoneda ).toFixed(2);
                        valorDolar = valMoneda;
                        fechaDolar = respuesta.rows.currencyExchangeResponse.date;
                        comisionDolar = comisionSpei;
                        $('#recibe').val(valEnvio);
                        $('#descEnvio').html('Le enviaremos $'+valEnvio+' dolares ($'+$('#monto').val()+' pesos menos $'+comisionSpei+' pesos de comisión)');
                        $('#valueCurrency').html('Tipo de Cambio peso/dólar $ '+valMoneda);
                        $('#dateCurrency').html('Fecha de valor: '+respuesta.rows.currencyExchangeResponse.date);
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
       
    });

    $('.rowsContact_usa').click(function(event){
      isRow =1;
        $(".new_cuenta" ).html('');
        $('.monto_mx').hide();
        $('.entrega_usa').html('<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<div class="form-group">'+
                                      '<label for="paisDes">País de destino*</label>'+
                                      '<select class="form-control" id="paisDes" name="paisDes">'+
                                        '<option value="USA">Estados Unidos</option>'+
                                      '</select>'+
                                      '<input type="hidden" class="form-control" id="titular" name="titular">'+
                                      '<input type="hidden" class="form-control" id="calle" name="calle">'+
                                      '<input type="hidden" class="form-control" id="numExt" name="numExt">'+
                                      '<input type="hidden" class="form-control" id="numInt" name="numInt">'+
                                      '<input type="hidden" class="form-control" id="cp" name="cp">'+
                                      '<input type="hidden" class="form-control" id="estado" name="estado">'+
                                      '<input type="hidden" class="form-control" id="ciudad" name="ciudad">'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<label for="swift">Código SWIFT / BIC de Banco*</label>'+
                                    '<input minlength="8" type="text" class="form-control btn_searchCuenta_usa" id="swift" name="swift">'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<div class="form-group">'+
                                    '<label for="cuenta">Cuenta Interbancaria*</label>'+
                                    '<input type="text" class="form-control soloNum btn_searchCuenta_usa" id="cuenta" name="cuenta">'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-md-12 cuentaEncontrada2">'+
                                  '<div class="form-group">'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Nombre del Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<input type="hidden" class="form-control" id="nameIns" name="nameIns">'+
                                    '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
                                    '<input type="hidden" value="'+numCuenta+'"  class="form-control wizard-required" id="accountNumber" name="accountNumber">'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="form-group">'+
                                        '<label class="text-dorado" for="calle">Dirección del Banco*</label>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="calleB">Calle*</label>'+
                                    '<input type="text" class="form-control" id="calleB" name="calleB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numExtB">No. Exterior</label>'+
                                    '<input type="text" class="form-control" id="numExtB" name="numExtB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numIntB">No. Interior</label>'+
                                    '<input type="text" class="form-control" id="numIntB" name="numIntB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="cpB">Zip Code*</label>'+
                                    '<input type="text" class="form-control" id="cpB" name="cpB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="ciudadB">Ciudad*</label>'+
                                    '<input type="text" class="form-control" id="ciudadB" name="ciudadB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="estadoB">Estado*</label>'+
                                    '<input type="text" class="form-control" id="estadoB" name="estadoB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="bancoInter">Nombre del Banco Intermediario</label>'+
                                    '<input type="text" class="form-control" id="bancoInter" name="bancoInter">'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="form-group">'+
                                        '<label class="text-dorado" for="">Información Adicional*</label>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="numRefB">Número de referencia</label>'+
                                    '<input type="text" class="form-control" id="numRefB" name="numRefB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="refAdiB">Referencia Adicional</label>'+
                                    '<input type="text" class="form-control" id="refAdiB" name="refAdiB">'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="descAdi">Descripción Adicional</label>'+
                                    '<input type="text" class="form-control" id="descAdiB" name="descAdiB">'+
                                  '</div>'+
                                  '<div class="row">'+
                                    '<div class="col-md-12 panel">'+
                                      '<p>Los giros no se envían los fines de semana y días festivos.</p>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>');

        $('.monto_mx').html('');
        $('.monto_usa').html('<div class="form-group">'+
                                '<label for="institucion">Moneda</label>'+
                                '<select class="form-control" id="moneda" name="moneda">'+
                                '<option value="USD">Dolar</option>'+
                                '</select>'+
                              '</div>'+
                              '<p><b>¿Cuánto vas a transferir?</b></p>'+
                              '<div class="panel row" style="padding: 10px;text-align: justify;">'+
                              '<p id="">Saldo disponible para transferir $<span id="saldoD">'+saldoD+'</span></p>'+
                              '<p id="">Ingresa el monto que deseas enviar y calcula lo que podrán recibir:</p>'+
                              '<div class="col-md-6">'+
                                '<p><b>Enviar</b></p>'+
                                '<div class="section mb10">'+
                                  '<label for="">Peso compra</label>'+
                                  '<label class="field append-icon">'+
                                    '<input type="text" name="monto" id="monto" class="gui-input monto divisa" value="0.00" placeholder="Monto">'+
                                    '<label for="firstname" class="field-icon">'+
                                      '$ MXN'+
                                    '</label>'+
                                  '</label>'+
                                  '<small id="montoHelp" class="error form-text text-muted"></small>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p><b>El destinatario recibe</b></p>'+
                                '<div class="section mb10">'+
                                  '<label for="">Dolar Venta</label>'+
                                  '<label class="field append-icon">'+
                                    '<input type="text" name="recibe" id="recibe" disabled="true" class="gui-input monto" value="0.00" placeholder="0.00">'+
                                    '<label for="firstname" class="field-icon">'+
                                      '$ USD'+
                                   ' </label>'+
                                  '</label>'+
                                  '<small id="montoHelp" class="error form-text text-muted"></small>'+
                                '</div>'+
                              '</div>'+
                             ' <div class="row">'+
                                '<div class="col-md-12">'+
                                  '<p style="color: #c7924b;" id="descEnvio"></p>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                  '<p style="font-size: 11px; color: #c7924b;" id="valueCurrency"></p>'+
                                '</div>'+
                               ' <div class="col-md-6">'+
                                   '<p style="font-size: 11px; color: #c7924b;" id="dateCurrency"></p>'+
                                '</div>'+
                              '</div>'+ 
                            '</div>');

      $('.rowsContact_usa').css('border', '0px');
        $(this).css('border', '3px solid #c7924b');
        event.preventDefault();
        $(".new_cuenta" ).hide();

        $('#titular').val($(this).data("name"));
        $('#alias').val($(this).data("alias"));
        var accuenta = $(this).data("cuentas");
        //alert(accuenta);
        $('#cuenta').val(accuenta);
        $('#swift').val($(this).data("swift"));
        $('#cuenta').val($(this).data("cuentas"));
        //$('#institucion').val($(this).data("nameinst"));
        //$('#institucion').append($('<option>').val($(this).data("idins")).text($(this).data("nameinst")));
        $('#nameIns').val($(this).data("nameinst"));
        $('#idIns').val($(this).data("idins"));
        $('#calle').val($(this).data("calle"));
        $('#numExt').val($(this).data("numext"));
        $('#numInt').val($(this).data("numint"));
        $('#cp').val($(this).data("cp"));
        $('#estado').val($(this).data("estado"));
        $('#ciudad').val($(this).data("ciudad"));

        let partRef = $(this).data("refadi").split('-'); 

        $('#calleB').val($(this).data("calleb"));
        $('#numExtB').val($(this).data("numextb"));
        $('#numIntB').val($(this).data("numintb"));
        $('#cpB').val($(this).data("cpb"));
        $('#estadoB').val($(this).data("estadob"));
        $('#ciudadB').val($(this).data("ciudadb"));
        $('#bancoInter').val($(this).data("bancointer"));
        $('#numRefB').val(partRef[0]);
        $('#refAdiB').val(partRef[1]);
        $('#descAdiB').val(partRef[2]);


              $.ajax({
                  url: base_url+"/internacional/searchInstitucionUSA",
                  data: $("#form-wizard").serialize(),
                  type: "post",
                  dataType: "json",
                  success: function(respuesta){
                      console.log(respuesta.institutionResponse.institutions);
                      if (respuesta.institutionResponse.institutions.length == 1) {
                          $("#showCuenta" ).html($('#cuenta').val());
                          $(".cuentaEncontrada" ).show();
                          $('#institucion').html($('<option>').val(respuesta.institutionResponse.institutions[0].key).text(respuesta.institutionResponse.institutions[0].name));
                          $('#nameIns').val(respuesta.institutionResponse.institutions[0].name);
                          $('#idIns').val(respuesta.institutionResponse.institutions[0].key);
                      }else{
                          $('#institucion').html('<option></option>');
                          $("#showCuenta" ).html($('#cuenta').val());
                          $(".cuentaEncontrada" ).show();
                          for (var i = 0; i < respuesta.institutionResponse.institutions.length; i++) {
                              $('#institucion').append($('<option>').val(respuesta.institutionResponse.institutions[i].key).text(respuesta.institutionResponse.institutions[i].name));
                          }
                      }
                  }
              });  
         



        $("#cp").keyup(function(){
            var cp = $("#cp").val();
            if (cp.length == 5) {
                $('#col').html("<option></option>");
                $.ajax({
                    url: base_url+"/spei/searchLocalidad/"+cp,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta.rows.locationResponse.locations.length > 0){
                            for (var i = 0; i < respuesta.rows.locationResponse.locations.length; i++) {
                                $('#ciudad').val(respuesta.rows.locationResponse.locations[i].city)
                                $('#estado').val(respuesta.rows.locationResponse.locations[i].state)
                          }
                        }else{
                            $('#ciudad').val('');
                            $('#estado').val('');
                            bootbox.alert({
                                title: 'Busqueda sin datos',
                                message: 'Zip Code solicitado no cuenta con entidades relacionadas.',
                                locale: 'mx'
                            });
                        }
                    }
                }); 
            }
        });

        $("#cpB").keyup(function(){
          var cp = $("#cpB").val();
          if (cp.length == 5) {
              $('#col').html("<option></option>");
              $.ajax({
                  url: base_url+"/internacional/searchLocalidad/"+cp,
                  dataType: "json",
                  success: function(respuesta){
                      if(respuesta.rows.locationResponse.locations.length > 0){
                          for (var i = 0; i < respuesta.rows.locationResponse.locations.length; i++) {
                              $('#ciudadB').val(respuesta.rows.locationResponse.locations[i].city)
                              $('#estadoB').val(respuesta.rows.locationResponse.locations[i].state)
                        }
                      }else{
                          $('#ciudadB').val('');
                          $('#estadoB').val('');
                          bootbox.alert({
                              title: 'Busqueda sin datos',
                              message: 'Zip Code solicitado no cuenta con entidades relacionadas.',
                              locale: 'mx'
                          });
                      }
                  }
              }); 
          }
        });


        $(".divisa").keyup(function(){
            $.ajax({
                url: base_url+"/internacional/tipoCambio/"+'mx',
                dataType: "json",
                success: function(respuesta){
                    if (respuesta.rows.success == true) {
                        var valMoneda = respuesta.rows.currencyExchangeResponse.value;
                        var TotalDevengado = $('#monto').val().replace(/,/g, "");
                        var comisionSpei = ((parseFloat(TotalDevengado) * 5) / 100).toFixed(2);
                        var envioSinComision = (parseFloat(TotalDevengado) - comisionSpei).toFixed(2);
                        var valEnvio = (envioSinComision / valMoneda ).toFixed(2);

                        valorDolar = valMoneda;
                        fechaDolar = respuesta.rows.currencyExchangeResponse.date;
                        comisionDolar = comisionSpei;

                        $('#recibe').val(valEnvio);
                        $('#descEnvio').html('Le enviaremos $'+valEnvio+' dolares ($'+$('#monto').val()+' pesos menos $'+comisionSpei+' pesos de comisión)');
                        $('#valueCurrency').html('Tipo de Cambio peso/dólar $ '+valMoneda);
                        $('#dateCurrency').html('Fecha de valor: '+respuesta.rows.currencyExchangeResponse.date);
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
       
    });
    
});