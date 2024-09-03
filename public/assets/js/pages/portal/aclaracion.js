                   /* event.preventDefault(); 
                                $('#message').html('');
                                // 07/24/2017

                                var contrasena = $("#contrasena").val();
                                
                                var numError = 0;

                                if (contrasena == '') {
                                    numError = numError+1;
                                }

                                
                                if (numError == 0) {
                                    $.ajax({
                                        url: base_url+"/login/searchAccount",
                                        data: $("#some-form").serialize(),
                                        type: "post",
                                        dataType: "json",
                                        success: function(respuesta){
                                            $('#cargando').html('');
                                            if(respuesta.success == true){
                                                if (respuesta.idStatus == 0) {
                                                    $.ajax({
                                                        url: base_url+"/aclaracion/add",
                                                        data: $("#form_aclaracion").serialize(),
                                                        type: "post",
                                                        dataType: "json",
                                                        success: function(respuesta){
                                                            if(respuesta.rows.success == true){
                                                                bootbox.alert({
                                                                    message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Aclaración exitosa.</h3> <p>Numero de autorizacion:"+respuesta.rows.printInfo.authorizationNumber+"</p>",
                                                                    locale: 'mx'
                                                                });
                                                                //setTimeout("window.location.href = '"+base_url+"/dashboard'", 3000);
                                                            }else{
                                                                bootbox.alert({
                                                                    message: respuesta.rows.error.message,
                                                                    locale: 'mx'
                                                                });
                                                            }
                                                            
                                                        }
                                                    });
                                                }else if(respuesta.idStatus == 1){
                                                    bootbox.alert({
                                                        title: 'Cuenta no verificada',
                                                        message: 'Primero debes verificar tu cuenta. KashPay envio un correo de verificación a tu correo <b>'+user+'</b>',
                                                        locale: 'mx'
                                                    });
                                                }
                                                
                                            }else{
                                                bootbox.alert({
                                                    message: respuesta.message,
                                                    locale: 'mx'
                                                });
                                            }
                                        }
                                    });
                                  $('#message').html('');
                                   
                                }
                                  
                               
                              }
                                  
                            },
                            cancel: {
                                    label: 'Cancelar',
                                    className: 'btn-dark'
                                }
                        }
                      });
                    
                }else{
                    bootbox.alert({
                        message: 'El monto ingresado es mayor al monto original de la transaccion',
                        locale: 'mx'
                    });
                }
                         
            }else{
                var frm_str = '<form id="some-form">'
                          +'<div id="message"></div>'
                          + '<div class="row" >'
                            + '<div class="form-group" style="width:100%;">'
                              +' <div class="col-md-12 section">'
                                  + '<label for="date">Debes validar tu contraseña para enviar la aclaracion</label>'    
                                  + '<input id="password_login" name="password_login" class="form-control" type="password">'
                                  + '<input value="'+userVal+'" name="user_login" id="user_login"class="form-control" type="hidden">'
                                  +'<h2 id="result1"></h2>'
                                + '</div>'
                              + '</div>'
                            + '</div>'
                      + '</form>';

                    bootbox.dialog({
                        message: frm_str,
                        title: "",
                        buttons: {
                           buttonName: {
                              label: "Validar",
                              className: "btn-primary",
                              callback: function () {
                                event.preventDefault(); 
                                $('#message').html('');
                                // 07/24/2017

                                var contrasena = $("#contrasena").val();
                                
                                var numError = 0;

                                if (contrasena == '') {
                                    numError = numError+1;
                                }

                                
                                if (numError == 0) {
                                    $.ajax({
                                        url: base_url+"/login/searchAccount",
                                        data: $("#some-form").serialize(),
                                        type: "post",
                                        dataType: "json",
                                        success: function(respuesta){
                                            $('#cargando').html('');
                                            if(respuesta.success == true){
                                                if (respuesta.idStatus == 0) {
                                                    $.ajax({
                                                        url: base_url+"/aclaracion/add",
                                                        data: $("#form_aclaracion").serialize(),
                                                        type: "post",
                                                        dataType: "json",
                      */


$(function(){
    $('#datetimepicker1').datetimepicker();
    var dialog;

    $(".save").click(function(event) {
        //obligatorios
        var errorcount = 0;
        $('#tyc1Help').html('');
        $('#tyc2Help').html('');
        $('#montoHelp').html('');
        $('#motivoHelp').html('');


        if ($("#tyc1").is(":checked")) {
        } else {
            $('#tyc1Help').html('Campos obligatorios.');
            errorcount = errorcount+1;
        }

        if ($("#tyc2").is(":checked")) {
        } else {
            $('#tyc2Help').html('Campos obligatorios.');

            errorcount = errorcount+1;
        }

        if ($('#monto').val() == '') {
            $('#montoHelp').html('Campo obligatorio.');

            errorcount = errorcount+1;
        }
        if ($('#motivo').val() == '') {
            $('#motivoHelp').html('Campo obligatorio.');

            errorcount = errorcount+1;
        }
        //console.log('errorcount = '+errorcount);
        if (errorcount == 0) {
            if($('input[name=tipo]:checked', '#form_aclaracion').val() != 'D'){
                if (parseFloat($('#monto').val()) <= parseFloat($('#montoHiddenR').val())) {
                    var frm_str = '<form id="some-form">'
                          +'<div id="message"></div>'
                          + '<div class="row" >'
                            + '<div class="form-group" style="width:100%;">'
                              +' <div class="col-md-12 section">'
                                  + '<label for="date">Debes validar tu contraseña para enviar la aclaracion</label>'
                                  + '<input id="password_login" name="password_login" class="form-control" type="password">'
                                  + '<input value="'+userVal+'" name="user_login" id="user_login"class="form-control" type="hidden">'
                                  +'<h2 id="result1"></h2>'
                                + '</div>'
                              + '</div>'
                            + '</div>'
                      + '</form>';

                    bootbox.dialog({
                        message: frm_str,
                        title: "",
                        buttons: {
                           buttonName: {
                              label: "Validar",
                              className: "btn-primary",
                              callback: function () {
                                event.preventDefault();
                                $('#message').html('');
                                // 07/24/2017

                                var contrasena = $("#contrasena").val();

                                var numError = 0;

                                if (contrasena == '') {
                                    numError = numError+1;
                                }


                                if (numError == 0) {
                                    $.ajax({
                                        url: base_url+"/login/searchAccount",
                                        data: $("#some-form").serialize(),
                                        type: "post",
                                        dataType: "json",
                                        success: function(respuesta){
                                            $('#cargando').html('');
                                            if(respuesta.success == true){
                                                if (respuesta.idStatus == 0) {
                                                    $.ajax({
                                                        url: base_url+"/aclaracion/add",
                                                        data: $("#form_aclaracion").serialize(),
                                                        type: "post",
                                                        dataType: "json",
                                                        beforeSend: function () {
                                                           dialog =  bootbox.dialog({
					                   message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Enviando aclaración...</h6><p>Espere un momento</p></div>',
								closeButton: false
                                                            });
                                                        },
							success: function(respuesta){
                                                            dialog.modal('hide');
							    if(respuesta.rows.success == true){
                                                                bootbox.alert({
                                                                    message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Aclaración exitosa.</h3> <p>Numero de autorizacion:"+respuesta.rows.printInfo.authorizationNumber+"</p>",
                                                                    locale: 'mx'
                                                                });
                                                                                                                                                                         window.history.back();
                                                            }else{
                                                                bootbox.alert({
                                                                    message: respuesta.rows.error.message,
                                                                    locale: 'mx'
                                                                });
                                                            }

                                                        }
                                                    });
                                                }else if(respuesta.idStatus == 1){
                                                    bootbox.alert({
                                                        title: 'Cuenta no verificada',
                                                        message: 'Primero debes verificar tu cuenta. KashPay envio un correo de verificación a tu correo <b>'+user+'</b>',
                                                        locale: 'mx'
                                                    });
                                                }

                                            }else{
                                                bootbox.alert({
                                                    message: respuesta.message,
                                                    locale: 'mx'
                                                });
                                            }
                                        }
                                    });
                                  $('#message').html('');

                                }


                              }

                            },
                            cancel: {
                                    label: 'Cancelar',
                                    className: 'btn-dark'
                                }
                        }
                      });

                }else{
                    bootbox.alert({
                        message: 'El monto ingresado es mayor al monto original de la transaccion',
                        locale: 'mx'
                    });
                }

            }else{
                var frm_str = '<form id="some-form">'
                          +'<div id="message"></div>'
                          + '<div class="row" >'
                            + '<div class="form-group" style="width:100%;">'
                              +' <div class="col-md-12 section">'
                                  + '<label for="date">Debes validar tu contraseña para enviar la aclaracion</label>'
                                  + '<input id="password_login" name="password_login" class="form-control" type="password">'
                                  + '<input value="'+userVal+'" name="user_login" id="user_login"class="form-control" type="hidden">'
                                  +'<h2 id="result1"></h2>'
                                + '</div>'
                              + '</div>'
                            + '</div>'
                      + '</form>';

                    bootbox.dialog({
                        message: frm_str,
                        title: "",
                        buttons: {
                           buttonName: {
                              label: "Validar",
                              className: "btn-primary",
                              callback: function () {
                                event.preventDefault();
                                $('#message').html('');
                                // 07/24/2017

                                var contrasena = $("#contrasena").val();

                                var numError = 0;

                                if (contrasena == '') {
                                    numError = numError+1;
                                }


                                if (numError == 0) {
                                    $.ajax({
                                        url: base_url+"/login/searchAccount",
                                        data: $("#some-form").serialize(),
                                        type: "post",
                                        dataType: "json",
                                        success: function(respuesta){
                                            $('#cargando').html('');
                                            if(respuesta.success == true){
                                                if (respuesta.idStatus == 0) {
                                                    $.ajax({
                                                        url: base_url+"/aclaracion/add",
                                                        data: $("#form_aclaracion").serialize(),
                                                        type: "post",
                                                        dataType: "json",
						        beforeSend: function () {
                                                           dialog =  bootbox.dialog({
					                   message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Enviando aclaración...</h6><p>Espere un momento</p></div>',
								closeButton: false
                                                            });
                                                        },
                                                        success: function(respuesta){
						                                                                                                                     dialog.modal('hide');
                                                            if(respuesta.rows.success == true){
                                                                bootbox.alert({
                                                                    message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Aclaración exitosa.</h3> <p>Numero de autorizacion:"+respuesta.rows.printInfo.authorizationNumber+"</p>",
                                                                    locale: 'mx'
                                                                });                                                                                                      window.history.back();
                                                            }else{
                                                                bootbox.alert({
                                                                    message: respuesta.rows.error.message,
                                                                    locale: 'mx'
                                                                });
                                                            }

                                                        }
                                                    });
                                                }else if(respuesta.idStatus == 1){
                                                    bootbox.alert({
                                                        title: 'Cuenta no verificada',
                                                        message: 'Primero debes verificar tu cuenta. KashPay envio un correo de verificación a tu correo <b>'+user+'</b>',
                                                        locale: 'mx'
                                                    });
                                                }

                                            }else{
                                                bootbox.alert({
                                                    message: respuesta.message,
                                                    locale: 'mx'
                                                });
                                            }
                                        }
                                    });
                                  $('#message').html('');

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
        }

    });

    $('.tipoAclaracion').on('change', function() {
        var valTipo = $('input[name=tipo]:checked', '#form_aclaracion').val();
        switch(valTipo) {
            case 'D':
                $('#monto').val(montoAcla);
                $('#montoHidden').val(montoAcla);
                $("#monto").prop('disabled', true);
                break;
            case 'DP':
                $('#monto').val('');
                $("#monto").prop('disabled', false);
                break;
            case 'CC':
                $('#monto').val('');
                $("#monto").prop('disabled', true);
                break;
        }
        $('#motivo').html($('<option>').val('').text(''));
        $.ajax({
            url: base_url+"/aclaracion/searchMotivo/"+valTipo,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.success == true) {
                    for (var i = 0; i < respuesta.rows.length; i++) {
                        $('#motivo').append($('<option>').val(respuesta.rows[i].idCatClarification).text(respuesta.rows[i].description));
                    }
                }else{

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

