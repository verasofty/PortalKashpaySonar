$(function(){
    bootbox.alert({
        title: '¡Importante!',
        message: 'TRASPASOS A CUENTAS DE TERCEROS Y CUENTAS PROPIAS NACIONALES DE MEXICO: <br><br> '+
        '1.- Número de Celular Vinculado a su Cuenta.<br>3.- Número de Tarjeta Vinculada a la APP KASHPAY.<br><br>'+
        'TRANSFERENCIAS INTERBANCARIAS A OTRAS CUENTAS O BANCOS NACIONALES DE MEXICO:<br><br>'+
        '1.- Clabe Interbancaria - 18 dÍgitos.<br> 2.- Número de Tarjeta de Débito - 16 dígitos. <br><br>'+
        'TRANSFERENCIA INTERNACIONAL<br><br>'+
        'Tener a la mano los siguientes datos:<br><br>'+
        '1.- Nombre Beneficiario.<br> 2.- Dirección del Beneficiario.<br> 3.- Ciudad,País.<br> 4.- Número de celular. <br> 5.- Cuenta Beneficiario.<br> 6.- Banco Beneficiario. <br> 7.- Dirección del Banco.<br> 8.- Número de ruta Bancaria ABA.<br> 9.- SWIFT / BIC.',
        locale: 'mx'
     });

    var idOrigin = '';
    var numCuenta = '';
    $( ".btn_addCuenta" ).click(function(event){
        event.preventDefault();
        $(this).hide();
         $('.btn_addCuenta_usa').hide();
        $(".new_cuenta" ).html('');
        $('#textInfo').html('Ingresa una Cuenta Destino');
        $(".new_cuenta" ).show();

        var frm_str = '<div id="message"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="cuenta">Cuenta*</label>'+
                                  '<input maxlength="18" type="text" class="form-control soloNum" id="cuenta" name="cuenta">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  ' <button type="button" class="btn btn-primary btn-block btn_searchCuenta">Buscar</button>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12 cuentaEncontrada">'+
                                '<div class="form-group">'+
                                  '<p><b>Cuenta encontrada.</b></p>'+
                                  '<div class="panel" style="padding: 10px;text-align: center;">'+
                                    '<p>Cuenta</p>'+
                                    '<p id="showCuenta"></p>'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="titular">Nombre Titular*</label>'+
                                  '<input type="text" class="form-control" id="titular" name="titular">'+
                                  '<input type="hidden" class="form-control" id="nameIns" name="nameIns">'+
                                  '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
                                  '<input type="hidden" value="'+numCuenta+'"  class="form-control" id="accountNumber" name="accountNumber">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="alias">Alias*</label>'+
                                  '<input type="text" class="form-control" id="alias" name="alias">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Guardar cuenta</label>'+
                                    '<div class="switch switch-info round switch-inline">'+
                                        '<input id="exampleCheckboxSwitch6" type="checkbox">'+
                                        '<label for="exampleCheckboxSwitch6"></label>'+
                                    '</div>'+
                                '</div>'+
                              '</div>'+                              
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<p>Debe ingresar una cuenta clabe de cualquier banco.</p>'+
                                  '<p>Número de cuenta CLABE Interbancaria - 18 dígitos.</p>'+
                                '</div>'+
                              '</div>'+
                            '</div>'
                      + '</div>'
                    + '</div>'
                + '</div';
        $(".new_cuenta" ).html(frm_str);
        $("#contact_div" ).hide();
        $(".cuentaEncontrada" ).hide();
        $('.monto_mx').show();
        $('.monto_mx').html('<label for="monto">Monto de la transferencia*</label>'+
                            '<input type="text" class="form-control monto " id="monto" name="monto">');
        $('.soloNum').on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });

        $('.btn_searchCuenta').click(function(event){
            if ($('#cuenta').val().length == 16 || $('#cuenta').val().length == 18 || $('#cuenta').val().length == 10) {
                $.ajax({
                    url: base_url+"/spei/searchInstitucion",
                    data: $("#form-wizard").serialize(),
                    type: "post",
                    dataType: "json",
                    success: function(respuesta){
                        if (respuesta.success == true) {
                            console.log('ok = '+respuesta.institutionResponse.institutions);
                            if (respuesta.institutionResponse.institutions.length == 1) {
                                $("#showCuenta" ).html($('#cuenta').val());
                                $(".cuentaEncontrada" ).show();
                                $('#institucion').html($('<option selected="true" >').val(respuesta.institutionResponse.institutions[0].key+'-'+respuesta.institutionResponse.idEntity).text(respuesta.institutionResponse.institutions[0].name));
                                $('#idIns').val(respuesta.institutionResponse.institutions[0].key);
                                $('#nameIns').val(respuesta.institutionResponse.institutions[0].name);
                                numCuenta = respuesta.institutionResponse.idEntity;
                            }else{
                                $('#institucion').html('<option></option>');
                                $("#showCuenta" ).html($('#cuenta').val());
                                $(".cuentaEncontrada" ).show();
                                for (var i = 0; i < respuesta.institutionResponse.institutions.length; i++) {
                                    $('#institucion').append($('<option>').val(respuesta.institutionResponse.institutions[i].key+'-'+respuesta.institutionResponse.idEntity).text(respuesta.institutionResponse.institutions[i].name));
                                }
                            }
                        }else{
                             bootbox.alert({
                                message: respuesta.error.message,
                                locale: 'mx'
                            });
                        }

                        
                    }
                });  
            }else{
                bootbox.alert({
                    message: 'La cuenta debe tener 16 dígitos para tarjeta o 18 dígitos para cuenta clabe o 10 dígitos para numero de teléfono.',
                    locale: 'mx'
                });
            }
            $(".btn_addCuenta" ).hide();
        });

        $('#institucion').change(function(event){
            var comboIns = document.getElementById("institucion");
            var selectedIns = comboIns.options[comboIns.selectedIndex].text;
            let arr = $('#institucion').val().split('-');

            $('#nameIns').val(selectedIns);
            $('#idIns').val(arr[0]);

            $('#accountNumber').val(arr[1]);
            numCuenta = arr[1];
        });
        $('#exampleCheckboxSwitch6').click(function(event){
            if( $('#exampleCheckboxSwitch6').prop('checked') ) {
                console.log('si');
                $.ajax({
                    url: base_url+"/spei/addContacto",
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
                                message: respuesta.error.message,
                                locale: 'mx'
                            });
                        }
                    }
                });
            }else{
                console.log('no');
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
       
    });
    
    $('.rowsContact').click(function(event){
        /*var item = document.getElementById("Nombre");
        var hasClase2 = item.classList.contains( 'clase2' );
        document.write( '<br>', 'Tiene la clase "clase2": ', hasClase2 );*/

        $(".new_cuenta" ).html('');
        $('.monto_mx').show();
        $('.monto_mx').html('<label for="monto">Monto de la transferencia*</label>'+
                            '<input type="text" class="form-control monto " id="monto" name="monto">');
        $('.monto_usa').html('');

        $('.rowsContact').css('border', '0px');
        $(this).css('border', '3px solid #c7924b');
        event.preventDefault();
        var frm_str = '<div id="message"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="cuenta">Cuenta*</label>'+
                                  '<input maxlength="18" type="text" class="form-control soloNum" id="cuenta" name="cuenta">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  ' <button type="button" class="btn btn-primary btn-block btn_searchCuenta">Buscar</button>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12 cuentaEncontrada">'+
                                '<div class="form-group">'+
                                  '<p><b>Cuenta encontrada.</b></p>'+
                                  '<div class="panel" style="padding: 10px;text-align: center;">'+
                                    '<p>Cuenta</p>'+
                                    '<p id="showCuenta"></p>'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="titular">Nombre Titular*</label>'+
                                  '<input type="text" class="form-control" id="titular" name="titular">'+
                                  '<input type="hidden" class="form-control" id="nameIns" name="nameIns">'+
                                  '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
                                  '<input type="hidden" value="'+numCuenta+'"  class="form-control wizard-required" id="accountNumber" name="accountNumber">'+

                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="alias">Alias*</label>'+
                                  '<input type="text" class="form-control" id="alias" name="alias">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Guardar cuenta</label>'+
                                    '<div class="switch switch-info round switch-inline">'+
                                        '<input id="exampleCheckboxSwitch6" type="checkbox">'+
                                        '<label for="exampleCheckboxSwitch6"></label>'+
                                    '</div>'+
                                '</div>'+
                              '</div>'+                              
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<p>Debe ingresar una cuenta clabe de cualquier banco.</p>'+
                                  '<p>Número de cuenta CLABE Interbancaria - 18 dígitos.</p>'+
                                '</div>'+
                              '</div>'+
                            '</div>'
                      + '</div>'
                    + '</div>'
                + '</div';
        $(".new_cuenta" ).html(frm_str);
        $(".new_cuenta" ).hide();

        $('#titular').val($(this).data("name"));
        $('#alias').val($(this).data("alias"));
        $('#cuenta').val($(this).data("cuenta"));
        $('#nameIns').val($(this).data("nameinst"));
        $('#idIns').val($(this).data("idins"));
        $('#accountNumber').val($(this).data("accountnumber"));
        
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

    //USA

    $(".btn_addCuenta_usa" ).click(function(event){
        event.preventDefault();
        $(this).hide();
        $('.btn_addCuenta').hide();
        $('.monto_mx').hide();
        $('.monto_mx').html('');
        $('.monto_usa').html('<p><b>¿Cuanto quieres enviar?</b></p>'+
                            '<div class="panel row" style="padding: 10px;text-align: justify;">'+
                              '<p id="">Ingresa el monto que deseas enviar y calcula lo que podras recibir:</p>'+
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
        $(".new_cuenta" ).html('');
        $('#textInfo').html('Ingresa una Cuenta Destino');
         $(".new_cuenta" ).show();

        var frm_str = '<div id="message_usa"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="swift">Código SWIFT / BIC de Banco*</label>'+
                                  '<input maxlength="11" type="text" class="form-control" id="swift" name="swift">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="cuenta">Cuenta Interbancaria*</label>'+
                                  '<input maxlength="18" type="text" class="form-control soloNum" id="cuenta" name="cuenta">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  ' <button type="button" class="btn btn-primary btn-block btn_searchCuenta_usa">Buscar</button>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12 cuentaEncontrada">'+
                                '<div class="form-group">'+
                                  '<p><b>Cuenta encontrada.</b></p>'+
                                  '<div class="panel" style="padding: 10px;text-align: center;">'+
                                    '<p>Cuenta</p>'+
                                    '<p id="showCuenta"></p>'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="titular">Nombre del Beneficiario*</label>'+
                                  '<input type="text" class="form-control" id="titular" name="titular">'+
                                  '<input type="hidden" class="form-control" id="nameIns" name="nameIns">'+
                                  '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
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
                                        '<label for="calle">Dirección del Beneficiario*</label>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="calle">Calle*</label>'+
                                  '<input type="text" class="form-control" id="calle" name="calle">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="numExt">No. Exterior*</label>'+
                                  '<input type="text" class="form-control" id="numExt" name="numExt">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="numInt">No. Interior</label>'+
                                  '<input type="text" class="form-control" id="numInt" name="numInt">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="refAdi">Referencia Adicional</label>'+
                                  '<input type="text" class="form-control" id="refAdi" name="refAdi">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="cp">Código Postal*</label>'+
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
                                '<div class="form-group">'+
                                    '<label class="control-label">Guardar cuenta</label>'+
                                    '<div class="switch switch-info round switch-inline">'+
                                        '<input id="exampleCheckboxSwitch6_usa" type="checkbox">'+
                                        '<label for="exampleCheckboxSwitch6_usa"></label>'+
                                    '</div>'+
                                '</div>'+
                              '</div>'+                              
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<p>Debe ingresar una cuenta clabe de cualquier banco.</p>'+
                                  '<p>Número de cuenta CLABE Interbancaria - 18 dígitos.</p>'+
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

        $('.btn_searchCuenta_usa').click(function(event){
            if ($('#swift').val().length == 8 || $('#swift').val().length == 11) {
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
            }else{
                bootbox.alert({
                    message: 'La cuenta debe tener 8 o 11 dígitos .',
                    locale: 'mx'
                });
            }
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
                    url: base_url+"/spei/addContactoUSA",
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
                                message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
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
        /*var item = document.getElementById("Nombre");
        var hasClase2 = item.classList.contains( 'clase2' );
        document.write( '<br>', 'Tiene la clase "clase2": ', hasClase2 );*/

        $(".new_cuenta" ).html('');
        $('.monto_mx').hide();
        $('.monto_mx').html('');
        $('.monto_usa').html('<p><b>¿Cuanto quieres enviar?</b></p>'+
                            '<div class="panel row" style="padding: 10px;text-align: justify;">'+
                              '<p id="">Ingresa el monto que deseas enviar y calcula lo que podras recibir:</p>'+
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
        var frm_str = '<div id="message"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="cuenta">Cuenta*</label>'+
                                  '<input maxlength="18" type="text" class="form-control soloNum" id="cuenta" name="cuenta">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  ' <button type="button" class="btn btn-primary btn-block btn_searchCuenta">Buscar</button>'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-12 cuentaEncontrada">'+
                                '<div class="form-group">'+
                                  '<p><b>Cuenta encontrada.</b></p>'+
                                  '<div class="panel" style="padding: 10px;text-align: center;">'+
                                    '<p>Cuenta</p>'+
                                    '<p id="showCuenta"></p>'+
                                    '<div class="form-group">'+
                                      '<label for="institucion">Banco*</label>'+
                                      '<select class="form-control" id="institucion" name="institucion">'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="titular">Nombre Titular*</label>'+
                                  '<input type="text" class="form-control" id="titular" name="titular">'+
                                  '<input type="text" class="form-control" id="nameIns" name="nameIns">'+
                                  '<input type="hidden" class="form-control" id="idIns" name="idIns">'+
                                  '<input type="text" class="form-control" id="cp" name="cp">'+
                                  '<input type="text" class="form-control" id="estado" name="estado">'+
                                  '<input type="text" class="form-control" id="ciudad" name="ciudad">'+
                                  '<input type="text" class="form-control" id="calle" name="calle">'+
                                  '<input type="text" class="form-control" id="numExt" name="numExt">'+
                                  '<input type="text" class="form-control" id="numInt" name="numInt">'+
                                  '<input type="text" class="form-control" id="refAdi" name="refAdi">'+
                                '</div>'+
                                '<div class="form-group">'+
                                  '<label for="alias">Alias*</label>'+
                                  '<input type="text" class="form-control" id="alias" name="alias">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Guardar cuenta</label>'+
                                    '<div class="switch switch-info round switch-inline">'+
                                        '<input id="exampleCheckboxSwitch6" type="checkbox">'+
                                        '<label for="exampleCheckboxSwitch6"></label>'+
                                    '</div>'+
                                '</div>'+
                              '</div>'+                              
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<p>Debe ingresar una cuenta clabe de cualquier banco.</p>'+
                                  '<p>Número de cuenta CLABE Interbancaria - 18 dígitos.</p>'+
                                '</div>'+
                              '</div>'+
                            '</div>'
                      + '</div>'
                    + '</div>'
                + '</div';
        $(".new_cuenta" ).html(frm_str);
        $(".new_cuenta" ).hide();

        $('#titular').val($(this).data("name"));
        $('#alias').val($(this).data("alias"));
        $('#cuenta').val($(this).data("cuenta"));
        $('#nameIns').val($(this).data("nameinst"));
        $('#idIns').val($(this).data("idins"));
        $('#calle').val($(this).data("calle"));
        $('#numExt').val($(this).data("numext"));
        $('#numInt').val($(this).data("numint"));
        $('#cp').val($(this).data("cp"));
        $('#refAdi').val($(this).data("refadi"));
        $('#estado').val($(this).data("estado"));
        $('#ciudad').val($(this).data("ciudad"));

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
                                message: 'Código Postal solicitado no cuenta con entidades relacionadas.',
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
    
});