/*'use strict';
//  Author: ThemeREX.com
//  forms-wizard.html scripts
//

(function($) {

    $(document).ready(function() {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Form Wizard
        var form = $("#form-wizard");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                cuenta: {
                    required: "#cuenta"
                },
                titular: {
                    required: "#titular"
                },
                alias: {
                    required: "#alias"
                },
                nameIns: {
                    required: "#nameIns"
                },
                monto: {
                    required: "#monto"
                }
            }
        });
        form.children(".wizard").steps({
            headerTag: ".wizard-section-title",
            bodyTag: ".wizard-section",
            onStepChanging: function(event, currentIndex, newIndex) {
                
                var cuenta = $('#cuenta').val();
                console.log('cuenta = '+cuenta);
                if (cuenta != undefined) {

                    $('#showDestino2').html($('#titular').val());
                    $('.cuentaDestino').html($('#cuenta').val());
                    $('.instDestino').html($('#nameIns').val());
                    $('.montoEnvio').html('$'+$('#monto').val());
                    $('.referencia').html($('#referencia').val());
                    $('.concepto').html($('#concepto').val());

                    if ($('#concepto').val() == '') {
                        $('.conceptodiv').hide();
                    }else{
                        $('.conceptodiv').show();
                    }

                    if ($('#referencia').val() == '') {
                        $('.referenciadiv').hide();
                    }else{
                        $('.referenciadiv').show();
                    }

                    if (valorDolar != '') {
                        //var rec = $('#monto').val()
                        $('.montoEnvio').html('');
                        var divConcep = '<div class="col-md-12">';
                        if ($('#concepto').val() != '') {
                            divConcep += '<p>Concepto: '+$('#concepto').val()+'</p>'; 
                        }
                        if ($('#referencia').val() != '') {
                            divConcep += '<p>Referencia: '+$('#referencia').val()+'</p>'; 
                        }
                        divConcep += '</div>';
                        $('.usadiv').html('<div class="row">'+
                              divConcep+
                              '<div class="col-md-6">'+
                                '<p style="color: #c7924b;">Tipo de cambio peso/dólar $'+valorDolar+' </p>'+
                                '<p class="">Cantidad que envías</p>'+
                                '<label>$'+$('#monto').val()+' <b>Peso</b></label>'+
                                '<p style="color: #c7924b;">$'+comisionDolar+' de Comisión </p>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p style="color: #c7924b;">Fecha de valor: '+fechaDolar+' </p>'+
                                '<p>Total a recibir</p>'+
                                '<p>$'+$('#recibe').val()+' <b>Dólar</b></p>'+
                              '</div>'+
                            '</div>');
                    }else{
                        $('.usadiv').html('');
                    }

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }else{
                    bootbox.alert({
                        message: 'Ingresa una nueva cuenta o selecciona un contacto.',
                        locale: 'mx'
                    });
                }
                
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                //alert("Submitted!");
                
                var montoTest = $('#monto').val().replace(",", "" );
                console.log(montoTest+' <= '+saldoSession);
                if (montoTest <= saldoSession) { 
                    
                    $.ajax({
                        url: base_url+"/spei/makeSpei",
                        data: $("#form-wizard").serialize(),
                        type: "post",
                        dataType: "json",
                        success: function(respuesta){
                            if(respuesta.success == '1'){
                                var msg = '<div>'+
                                            '<div style="background:#c7924b; border-radius:10px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                                                '<h4 style="color:#fff">Envío realizado</h4>'+
                                                '<p>'+respuesta.rows.createdAt+'</p>'+
                                                '<p><b>$'+respuesta.rows.amount.toFixed(2)+'</b></p>'+
                                            '</div>'+
                                            '<div style="text-align: center;">'+
                                                '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                                            '</div>'+
                                            '<div style="text-align: left;">'+
                                                '<p>Envío a cuenta</p>'+
                                                '<p>'+respuesta.rows.targetName+'</p>'+
                                                '<p>'+respuesta.rows.targetID+'</p>'+
                                                '<p>'+$('#nameIns').val()+'</p>'+
                                                '<p>Concepto:'+respuesta.rows.description+'</p>'+
                                                '<br>'+
                                                '<p>Cuenta origen</p>'+
                                                '<p>Cuenta Débito Onsigna</p>';
                                                if (respuesta.rows.id != null) {
                                                    msg += '<p>Autorización:'+respuesta.rows.id+'</p>';
                                                }else{
                                                    msg += '<p>Autorización:</p>';
                                                }
                                                
                                                msg += '<p>Referencia:'+respuesta.rows.numericReference+'</p>'+
                                                '<p style="text-align: center;">Verifica el estatus de tu operación <br> www.banxico.org.mx/cep</p>'+
                                            '</div>'+
                                         '</div>';
                       
                                bootbox.dialog({
                                title: "Spei Exitoso",
                                message: msg,
                                onEscape: true,
                                backdrop: true,
                                buttons: {
                                    confirm: {
                                        label: 'Imprimir',
                                        className: 'btn-primary',
                                        callback: function(){
                                          var printContents = document.getElementById("divName").innerHTML;
                                          var document_html = window.open("");
                                         document_html.document.write( "<html>"+msg+"</html>" );
                                         document_html.document.write( printContents );
                                         document_html.document.write( "</body></html>" );
                                         //setTimeout(function () {
                                               document_html.print();
                                          // }, 3000);
                                          setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                        }
                                    },
                                    cancel: {
                                        label: 'Ok',
                                        className: 'btn-success',
                                        callback: function(){
                                             bootbox.hideAll();
                                             setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                        }
                                    }
                                }
                            });
                            //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                            }else{
                                bootbox.alert({
                                    message: 'Algo salio mal, verifica los datos o reintetnte mas tarde.',
                                    locale: 'mx'
                                });
                            }
                        }
                    });
                }else{
                    bootbox.alert({
                        message: 'El monto del spei es mayor al saldo disponible.',
                        locale: 'mx'
                    });
                }
            }
        });

        // Init Wizard
        var formWizard = $('.wizard');
        var formSteps = formWizard.find('.steps');

        $('.wizard-options .holder-style').on('click', function(e) {
            e.preventDefault();

            var stepStyle = $(this).data('steps-style');

            var stepRight = $('.holder-style[data-steps-style="steps-right"]');
            var stepLeft = $('.holder-style[data-steps-style="steps-left"]');
            var stepJustified = $('.holder-style[data-steps-style="steps-justified"]');

            if (stepStyle === "steps-left") {
                stepRight.removeClass('holder-active');
                stepJustified.removeClass('holder-active');
                formWizard.removeClass('steps-right steps-justified');
            }
            if (stepStyle === "steps-right") {
                stepLeft.removeClass('holder-active');
                stepJustified.removeClass('holder-active');
                formWizard.removeClass('steps-left steps-justified');
            }
            if (stepStyle === "steps-justified") {
                stepLeft.removeClass('holder-active');
                stepRight.removeClass('holder-active');
                formWizard.removeClass('steps-left steps-right');
            }

            if ($(this).hasClass('holder-active')) {
                formWizard.removeClass(stepStyle);
            } else {
                formWizard.addClass(stepStyle);
            }

            $(this).toggleClass('holder-active');
        });
    });

})(jQuery);*/





'use strict';
//  Author: ThemeREX.com
//  forms-wizard.html scripts
//

(function($) {

    $(document).ready(function() {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Form Wizard
        var form = $("#form-wizard");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                cuenta: {
                    required: "#cuenta"
                },
                titular: {
                    required: "#titular"
                },
                alias: {
                    required: "#alias"
                },
                nameIns: {
                    required: "#nameIns"
                },
                monto: {
                    required: "#monto"
                },
                cuentaOr: {
                    required: "#cuentaOr"
                }
            }
        });
        form.children(".wizard").steps({
            headerTag: ".wizard-section-title",
            bodyTag: ".wizard-section",
            onStepChanging: function(event, currentIndex, newIndex) {

                var cuenta = $('#cuenta').val();
                console.log('cuenta = '+cuenta);
                if (cuenta != undefined) {

                    $('#showDestino2').html($('#titular').val());
                    $('.cuentaDestino').html($('#cuenta').val());
                    $('.instDestino').html($('#nameIns').val());
                    $('.montoEnvio').html('$'+$('#monto').val());
                    $('.referencia').html($('#referencia').val());
                    $('.concepto').html($('#concepto').val());

                    if ($('#concepto').val() == '') {
                        $('.conceptodiv').hide();
                    }else{
                        $('.conceptodiv').show();
                    }

                    if ($('#referencia').val() == '') {
                        $('.referenciadiv').hide();
                    }else{
                        $('.referenciadiv').show();
                    }

                    if (valorDolar != '') {
                        //var rec = $('#monto').val()
                        $('.montoEnvio').html('');
                        var divConcep = '<div class="col-md-12">';
                        if ($('#concepto').val() != '') {
                            divConcep += '<p>Concepto: '+$('#concepto').val()+'</p>';
                        }
                        if ($('#referencia').val() != '') {
                            divConcep += '<p>Referencia: '+$('#referencia').val()+'</p>';
                        }
                        divConcep += '</div>';
                        $('.usadiv').html('<div class="row">'+
                              divConcep+
                              '<div class="col-md-6">'+
                                '<p style="color: #c7924b;">Tipo de cambio peso/dólar $'+valorDolar+' </p>'+
                                '<p class="">Cantidad que envías</p>'+
                                '<label>$'+$('#monto').val()+' <b>Peso</b></label>'+
                                '<p style="color: #c7924b;">$'+comisionDolar+' de Comisión </p>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p style="color: #c7924b;">Fecha de valor: '+fechaDolar+' </p>'+
                                '<p>Total a recibir</p>'+
                                '<p>$'+$('#recibe').val()+' <b>Dólar</b></p>'+
                              '</div>'+
                            '</div>');
                    }else{
                        $('.usadiv').html('');
                    }

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }else{
                    bootbox.alert({
                        message: 'Ingresa una nueva cuenta o selecciona un contacto.',
                        locale: 'mx'
                    });
                }

            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                //alert("Submitted!");
                var dialog;
                var montoTest = $('#monto').val().replace(",", "" );
                console.log(parseFloat(montoTest)+' <= '+saldoSession);
                if (parseFloat(montoTest) <= parseFloat(saldoSession)) {
                    //envio Token
                    $.ajax({
                        url: base_url+"/spei/envioSMS",
                        data: $("#form-wizard").serialize(),
                        type: "post",
                        dataType: "json",
                        beforeSend: function () {
                            dialog =  bootbox.dialog({
                                message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Enviando token...</h6><p>Espere un momento</p></div>',
                                closeButton: false
                            });
                        },
                        success: function(respuesta){
                            dialog.modal('hide');
                            if(respuesta.success){
                                var frm_str = '<form id="some-form">'
                                                +'<div id="message"></div>'
                                                + '<div class="row" >'
                                                    + '<div class="form-group" style="width:100%;">'
                                                    +' <div class="col-md-12 section">'
                                                        + '<label for="date">Ingresa en token enviado al telefono <span class="error">'+telS+'</span></label>'
                                                        + '<input id="token" name="token" class="form-control" type="text">'
                                                        + '<input value="'+contextSearch+'" name="sirio" id="sirio"class="form-control" type="hidden">'
                                                        +'<h2 id="result1"></h2>'
                                                        + '</div>'
                                                    + '</div>'
                                                    + '</div>'
                                            + '</form>';

                                bootbox.dialog({
                                    message: frm_str,
                                    title: "",
                                    buttons: {
                                        confirm: {
                                            label: 'Validar',
                                            className: 'btn-primary',
                                            callback: function(){
                                                //validar token
                                                $.ajax({
                                                    url: base_url+"/spei/validarToken",
                                                    data: $("#some-form").serialize(),
                                                    type: "post",
                                                    dataType: "json",
                                                    beforeSend: function () {
                                                        dialog =  bootbox.dialog({
                                                            message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Validando token...</h6><p>Espere un momento</p></div>',
                                                            closeButton: false
                                                        });
                                                    },
                                                    success: function(respuesta){
                                                        dialog.modal('hide');
                                                        if(respuesta.success){
                                                            //envio spei                    
                                                            $.ajax({
                                                                url: base_url+"/spei/makeSpei",
                                                                data: $("#form-wizard").serialize(),
                                                                type: "post",
                                                                dataType: "json",
                                                                success: function(respuesta){
                                                                    if(respuesta.success == '1'){
                                                                        if(respuesta.rows.responseCode == '00'){

                                                                            var msg = '<div>'+
                                                                                    '<div style="background:#c7924b; border-radius:10px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                                                                                        '<h4 style="color:#fff">Envío realizado</h4>'+
                                                                                        '<p>'+respuesta.rows.createdAt+'</p>'+
                                                                                        '<p><b>$'+respuesta.rows.amount.toFixed(2)+'</b></p>'+
                                                                                    '</div>'+
                                                                                    '<div style="text-align: center;">'+
                                                                                        '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                                                                                    '</div>'+
                                                                                    '<div style="text-align: left;">'+
                                                                                        '<p>Envío a cuenta</p>'+
                                                                                        '<p>'+respuesta.rows.targetName+'</p>'+
                                                                                        '<p>'+respuesta.rows.targetID+'</p>'+
                                                                                        '<p>'+$('#nameIns').val()+'</p>'+
                                                                                        '<p>Concepto:'+respuesta.rows.description+'</p>'+
                                                                                        '<br>'+
                                                                                        '<p>Cuenta origen</p>'+
                                                                                        '<p>Cuenta Débito Onsigna</p>';
                                                                                        if (respuesta.rows.id != null) {
                                                                                            msg += '<p>Autorización:'+respuesta.rows.id+'</p>';
                                                                                        }else{
                                                                                            msg += '<p>Autorización:</p>';
                                                                                        }

                                                                                        msg += '<p>Referencia:'+respuesta.rows.numericReference+'</p>'+
                                                                                        '<p style="text-align: center;">Verifica el estatus de tu operación <br> www.banxico.org.mx/cep</p>'+
                                                                                    '</div>'+
                                                                                '</div>';
                                                                        
                                                                        bootbox.dialog({
                                                                          title: "Spei Exitoso",
                                                                          message: msg,
                                                                          onEscape: true,
                                                                          backdrop: true,
                                                                          buttons: {
                                                                            confirm: {
                                                                                label: 'Imprimir',
                                                                                className: 'btn-primary',
                                                                                callback: function(){
                                                                                var printContents = document.getElementById("divName").innerHTML;
                                                                                var document_html = window.open("");
                                                                                document_html.document.write( "<html>"+msg+"</html>" );
                                                                                document_html.document.write( printContents );
                                                                                document_html.document.write( "</body></html>" );
                                                                                //setTimeout(function () {
                                                                                    document_html.print();
                                                                                // }, 3000);
                                                                                setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                }
                                                                            },
                                                                            cancel: {
                                                                                label: 'Ok',
                                                                                className: 'btn-success',
                                                                                callback: function(){
                                                                                    bootbox.hideAll();
                                                                                    setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                }
                                                                            }
                                                                        }
                                                                    });
                                                                        }else{
                                                                                    bootbox.alert({
                                                                                        message: 'Spei rechazado, verifique los datos.',
                                                                                        locale: 'mx'
                                                                                    });
                                                                        }
                                                                    }else{
                                                                        bootbox.alert({
                                                                            message: 'Algo salio mal, verifica los datos o reintente mas tarde.',
                                                                            locale: 'mx'
                                                                        });
                                                                    }
                                                                }
                                                            });
                                                        }else{
                                                            bootbox.dialog({
                                                                message: respuesta.error.message,
                                                                buttons: {
                                                                   buttonName: {
                                                                      label: "Reenviar token",
                                                                      className: "btn-primary",
                                                                      callback: function () {
                                                                        //Reenvio de token
                                                                        bootbox.dialog({
                                                                            message: respuesta.error.message,
                                                                            buttons: {
                                                                               buttonName: {
                                                                                  label: "Reenviar token",
                                                                                  className: "btn-primary",
                                                                                  callback: function () {
                                                                                    //envio Token
                                                                                    $.ajax({
                                                                                        url: base_url+"/spei/envioSMS",
                                                                                        data: $("#form-wizard").serialize(),
                                                                                        type: "post",
                                                                                        dataType: "json",
                                                                                        beforeSend: function () {
                                                                                            dialog =  bootbox.dialog({
                                                                                                message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Enviando token...</h6><p>Espere un momento</p></div>',
                                                                                                closeButton: false
                                                                                            });
                                                                                        },
                                                                                        success: function(respuesta){
                                                                                            dialog.modal('hide');
                                                                                            if(respuesta.success){
                                                                                                var frm_str = '<form id="some-form">'
                                                                                                                +'<div id="message"></div>'
                                                                                                                + '<div class="row" >'
                                                                                                                    + '<div class="form-group" style="width:100%;">'
                                                                                                                    +' <div class="col-md-12 section">'
                                                                                                                        + '<label for="date">Ingresa en token enviado al telefono <span class="error">'+telS+'</span></label>'
                                                                                                                        + '<input id="token" name="token" class="form-control" type="text">'
                                                                                                                        + '<input value="'+contextSearch+'" name="sirio" id="sirio"class="form-control" type="hidden">'
                                                                                                                        +'<h2 id="result1"></h2>'
                                                                                                                        + '</div>'
                                                                                                                    + '</div>'
                                                                                                                    + '</div>'
                                                                                                            + '</form>';
                                                                
                                                                                                bootbox.dialog({
                                                                                                    message: frm_str,
                                                                                                    title: "",
                                                                                                    buttons: {
                                                                                                        confirm: {
                                                                                                            label: 'Validar',
                                                                                                            className: 'btn-primary',
                                                                                                            callback: function(){
                                                                                                                //validar token
                                                                                                                $.ajax({
                                                                                                                    url: base_url+"/spei/validarToken",
                                                                                                                    data: $("#some-form").serialize(),
                                                                                                                    type: "post",
                                                                                                                    dataType: "json",
                                                                                                                    beforeSend: function () {
                                                                                                                        dialog =  bootbox.dialog({
                                                                                                                            message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Validando token...</h6><p>Espere un momento</p></div>',
                                                                                                                            closeButton: false
                                                                                                                        });
                                                                                                                    },
                                                                                                                    success: function(respuesta){
                                                                                                                        dialog.modal('hide');
                                                                                                                        if(respuesta.success){
                                                                                                                            //envio spei                    
                                                                                                                            $.ajax({
                                                                                                                                url: base_url+"/spei/makeSpei",
                                                                                                                                data: $("#form-wizard").serialize(),
                                                                                                                                type: "post",
                                                                                                                                dataType: "json",
                                                                                                                                success: function(respuesta){
                                                                                                                                    if(respuesta.success == '1'){
                                                                                                                                        if(respuesta.rows.responseCode == '00'){
                                                                
                                                                                                                                            var msg = '<div>'+
                                                                                                                                                    '<div style="background:#c7924b; border-radius:10px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                                                                                                                                                        '<h4 style="color:#fff">Envío realizado</h4>'+
                                                                                                                                                        '<p>'+respuesta.rows.createdAt+'</p>'+
                                                                                                                                                        '<p><b>$'+respuesta.rows.amount.toFixed(2)+'</b></p>'+
                                                                                                                                                    '</div>'+
                                                                                                                                                    '<div style="text-align: center;">'+
                                                                                                                                                        '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                                                                                                                                                    '</div>'+
                                                                                                                                                    '<div style="text-align: left;">'+
                                                                                                                                                        '<p>Envío a cuenta</p>'+
                                                                                                                                                        '<p>'+respuesta.rows.targetName+'</p>'+
                                                                                                                                                        '<p>'+respuesta.rows.targetID+'</p>'+
                                                                                                                                                        '<p>'+$('#nameIns').val()+'</p>'+
                                                                                                                                                        '<p>Concepto:'+respuesta.rows.description+'</p>'+
                                                                                                                                                        '<br>'+
                                                                                                                                                        '<p>Cuenta origen</p>'+
                                                                                                                                                        '<p>Cuenta Débito Onsigna</p>';
                                                                                                                                                        if (respuesta.rows.id != null) {
                                                                                                                                                            msg += '<p>Autorización:'+respuesta.rows.id+'</p>';
                                                                                                                                                        }else{
                                                                                                                                                            msg += '<p>Autorización:</p>';
                                                                                                                                                        }
                                                                
                                                                                                                                                        msg += '<p>Referencia:'+respuesta.rows.numericReference+'</p>'+
                                                                                                                                                        '<p style="text-align: center;">Verifica el estatus de tu operación <br> www.banxico.org.mx/cep</p>'+
                                                                                                                                                    '</div>'+
                                                                                                                                                '</div>';
                                                                                                                                        
                                                                                                                                        bootbox.dialog({
                                                                                                                                          title: "Spei Exitoso",
                                                                                                                                          message: msg,
                                                                                                                                          onEscape: true,
                                                                                                                                          backdrop: true,
                                                                                                                                          buttons: {
                                                                                                                                            confirm: {
                                                                                                                                                label: 'Imprimir',
                                                                                                                                                className: 'btn-primary',
                                                                                                                                                callback: function(){
                                                                                                                                                var printContents = document.getElementById("divName").innerHTML;
                                                                                                                                                var document_html = window.open("");
                                                                                                                                                document_html.document.write( "<html>"+msg+"</html>" );
                                                                                                                                                document_html.document.write( printContents );
                                                                                                                                                document_html.document.write( "</body></html>" );
                                                                                                                                                //setTimeout(function () {
                                                                                                                                                    document_html.print();
                                                                                                                                                // }, 3000);
                                                                                                                                                setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                                                                                }
                                                                                                                                            },
                                                                                                                                            cancel: {
                                                                                                                                                label: 'Ok',
                                                                                                                                                className: 'btn-success',
                                                                                                                                                callback: function(){
                                                                                                                                                    bootbox.hideAll();
                                                                                                                                                    setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    });
                                                                                                                                        }else{
                                                                                                                                                    bootbox.alert({
                                                                                                                                                        message: 'Spei rechazado, verifique los datos.',
                                                                                                                                                        locale: 'mx'
                                                                                                                                                    });
                                                                                                                                        }
                                                                                                                                    }else{
                                                                                                                                        bootbox.alert({
                                                                                                                                            message: 'Algo salio mal, verifica los datos o reintente mas tarde.',
                                                                                                                                            locale: 'mx'
                                                                                                                                        });
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            });
                                                                                                                        }else{
                                                                                                                            bootbox.dialog({
                                                                                                                                message: respuesta.error.message,
                                                                                                                                buttons: {
                                                                                                                                   buttonName: {
                                                                                                                                      label: "Cancelar",
                                                                                                                                      className: "btn-primary",
                                                                                                                                      callback: function () {
                                                                                                                                        bootbox.hideAll();
                                                                                                                                        setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                                                                      }
                                                                                                        
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            });
                                                                                                                        }
                                                                                                                    }
                                                                                                                });
                                                                                                            }
                                                                                                        },
                                                                                                        cancel: {
                                                                                                            label: 'Cancelar',
                                                                                                            className: 'btn-success'
                                                                                                        }
                                                                                                    }
                                                                                                });
                                                                
                                                                
                                                                                            }else{
                                                                                                bootbox.dialog({
                                                                                                    message: respuesta.error.message,
                                                                                                    buttons: {
                                                                                                       buttonName: {
                                                                                                          label: "Cancelar",
                                                                                                          className: "btn-primary",
                                                                                                          callback: function () {
                                                                                                            bootbox.hideAll();
                                                                                                            setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                                          }
                                                                            
                                                                                                        }
                                                                                                    }
                                                                                                });
                                                                                            }
                                                                                        }
                                                                                    });
                                        
                                                                                  }
                                                    
                                                                                },
                                                                                cancel: {
                                                                                    label: 'Cancelar',
                                                                                    className: 'btn-dark'
                                                                                }
                                                                            }
                                                                        });
                                                                        
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
                                            }
                                        },
                                        cancel: {
                                            label: 'Cancelar',
                                            className: 'btn-success'
                                        }
                                    }
                                });


                            }else{
                                //Reenvio de token
                                bootbox.dialog({
                                    message: respuesta.error.message,
                                    buttons: {
                                       buttonName: {
                                          label: "Reenviar token",
                                          className: "btn-primary",
                                          callback: function () {
                                            //envio Token
                                            $.ajax({
                                                url: base_url+"/spei/envioSMS",
                                                data: $("#form-wizard").serialize(),
                                                type: "post",
                                                dataType: "json",
                                                beforeSend: function () {
                                                    dialog =  bootbox.dialog({
                                                        message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Enviando token...</h6><p>Espere un momento</p></div>',
                                                        closeButton: false
                                                    });
                                                },
                                                success: function(respuesta){
                                                    dialog.modal('hide');
                                                    if(respuesta.success){
                                                        var frm_str = '<form id="some-form">'
                                                                        +'<div id="message"></div>'
                                                                        + '<div class="row" >'
                                                                            + '<div class="form-group" style="width:100%;">'
                                                                            +' <div class="col-md-12 section">'
                                                                                + '<label for="date">Ingresa en token enviado al telefono <span class="error">'+telS+'</span></label>'
                                                                                + '<input id="token" name="token" class="form-control" type="text">'
                                                                                + '<input value="'+contextSearch+'" name="sirio" id="sirio"class="form-control" type="hidden">'
                                                                                +'<h2 id="result1"></h2>'
                                                                                + '</div>'
                                                                            + '</div>'
                                                                            + '</div>'
                                                                    + '</form>';
                        
                                                        bootbox.dialog({
                                                            message: frm_str,
                                                            title: "",
                                                            buttons: {
                                                                confirm: {
                                                                    label: 'Validar',
                                                                    className: 'btn-primary',
                                                                    callback: function(){
                                                                        //validar token
                                                                        $.ajax({
                                                                            url: base_url+"/spei/validarToken",
                                                                            data: $("#some-form").serialize(),
                                                                            type: "post",
                                                                            dataType: "json",
                                                                            beforeSend: function () {
                                                                                dialog =  bootbox.dialog({
                                                                                    message: '<div style="text-align:center;"><img style="width: 20%;margin: 0 auto; text-align: center;" src="'+base_url+'/public/assets/img/loading.gif"><br><h6>Validando token...</h6><p>Espere un momento</p></div>',
                                                                                    closeButton: false
                                                                                });
                                                                            },
                                                                            success: function(respuesta){
                                                                                dialog.modal('hide');
                                                                                if(respuesta.success){
                                                                                    //envio spei                    
                                                                                    $.ajax({
                                                                                        url: base_url+"/spei/makeSpei",
                                                                                        data: $("#form-wizard").serialize(),
                                                                                        type: "post",
                                                                                        dataType: "json",
                                                                                        success: function(respuesta){
                                                                                            if(respuesta.success == '1'){
                                                                                                if(respuesta.rows.responseCode == '00'){
                        
                                                                                                    var msg = '<div>'+
                                                                                                            '<div style="background:#c7924b; border-radius:10px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                                                                                                                '<h4 style="color:#fff">Envío realizado</h4>'+
                                                                                                                '<p>'+respuesta.rows.createdAt+'</p>'+
                                                                                                                '<p><b>$'+respuesta.rows.amount.toFixed(2)+'</b></p>'+
                                                                                                            '</div>'+
                                                                                                            '<div style="text-align: center;">'+
                                                                                                                '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/assets/img/logo_kashpay_black.png'+'">'+
                                                                                                            '</div>'+
                                                                                                            '<div style="text-align: left;">'+
                                                                                                                '<p>Envío a cuenta</p>'+
                                                                                                                '<p>'+respuesta.rows.targetName+'</p>'+
                                                                                                                '<p>'+respuesta.rows.targetID+'</p>'+
                                                                                                                '<p>'+$('#nameIns').val()+'</p>'+
                                                                                                                '<p>Concepto:'+respuesta.rows.description+'</p>'+
                                                                                                                '<br>'+
                                                                                                                '<p>Cuenta origen</p>'+
                                                                                                                '<p>Cuenta Débito Onsigna</p>';
                                                                                                                if (respuesta.rows.id != null) {
                                                                                                                    msg += '<p>Autorización:'+respuesta.rows.id+'</p>';
                                                                                                                }else{
                                                                                                                    msg += '<p>Autorización:</p>';
                                                                                                                }
                        
                                                                                                                msg += '<p>Referencia:'+respuesta.rows.numericReference+'</p>'+
                                                                                                                '<p style="text-align: center;">Verifica el estatus de tu operación <br> www.banxico.org.mx/cep</p>'+
                                                                                                            '</div>'+
                                                                                                        '</div>';
                                                                                                
                                                                                                bootbox.dialog({
                                                                                                  title: "Spei Exitoso",
                                                                                                  message: msg,
                                                                                                  onEscape: true,
                                                                                                  backdrop: true,
                                                                                                  buttons: {
                                                                                                    confirm: {
                                                                                                        label: 'Imprimir',
                                                                                                        className: 'btn-primary',
                                                                                                        callback: function(){
                                                                                                        var printContents = document.getElementById("divName").innerHTML;
                                                                                                        var document_html = window.open("");
                                                                                                        document_html.document.write( "<html>"+msg+"</html>" );
                                                                                                        document_html.document.write( printContents );
                                                                                                        document_html.document.write( "</body></html>" );
                                                                                                        //setTimeout(function () {
                                                                                                            document_html.print();
                                                                                                        // }, 3000);
                                                                                                        setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                                        }
                                                                                                    },
                                                                                                    cancel: {
                                                                                                        label: 'Cancelar',
                                                                                                        className: 'btn-success'
                                                                                                    }
                                                                                                }
                                                                                            });
                                                                                                }else{
                                                                                                            bootbox.alert({
                                                                                                                message: 'Spei rechazado, verifique los datos.',
                                                                                                                locale: 'mx'
                                                                                                            });
                                                                                                }
                                                                                            }else{
                                                                                                bootbox.alert({
                                                                                                    message: 'Algo salio mal, verifica los datos o reintente mas tarde.',
                                                                                                    locale: 'mx'
                                                                                                });
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                }else{
                                                                                    bootbox.dialog({
                                                                                        message: respuesta.error.message,
                                                                                        buttons: {
                                                                                           buttonName: {
                                                                                              label: "Cancelar",
                                                                                              className: "btn-primary",
                                                                                              callback: function () {
                                                                                                bootbox.hideAll();
                                                                                                setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                                              }
                                                                
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                }
                                                                            }
                                                                        });
                                                                    }
                                                                },
                                                                cancel: {
                                                                    label: 'Cancelar',
                                                                    className: 'btn-success'
                                                                }
                                                            }
                                                        });
                        
                        
                                                    }else{
                                                        bootbox.dialog({
                                                            message: respuesta.error.message,
                                                            buttons: {
                                                               buttonName: {
                                                                  label: "Cancelar",
                                                                  className: "btn-primary",
                                                                  callback: function () {
                                                                    bootbox.hideAll();
                                                                    setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                                                                  }
                                    
                                                                }
                                                            }
                                                        });
                                                    }
                                                }
                                            });

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
                        
                }else{
                    bootbox.alert({
                        message: 'El monto del spei es mayor al saldo disponible.',
                        locale: 'mx'
                    });
                }
                
            }
        });

        // Init Wizard
        var formWizard = $('.wizard');
        var formSteps = formWizard.find('.steps');

        $('.wizard-options .holder-style').on('click', function(e) {
            e.preventDefault();

            var stepStyle = $(this).data('steps-style');

            var stepRight = $('.holder-style[data-steps-style="steps-right"]');
            var stepLeft = $('.holder-style[data-steps-style="steps-left"]');
            var stepJustified = $('.holder-style[data-steps-style="steps-justified"]');

            if (stepStyle === "steps-left") {
                stepRight.removeClass('holder-active');
                stepJustified.removeClass('holder-active');
                formWizard.removeClass('steps-right steps-justified');
            }
            if (stepStyle === "steps-right") {
                stepLeft.removeClass('holder-active');
                stepJustified.removeClass('holder-active');
                formWizard.removeClass('steps-left steps-justified');
            }
            if (stepStyle === "steps-justified") {
                stepLeft.removeClass('holder-active');
                stepRight.removeClass('holder-active');
                formWizard.removeClass('steps-left steps-right');
            }

            if ($(this).hasClass('holder-active')) {
                formWizard.removeClass(stepStyle);
            } else {
                formWizard.addClass(stepStyle);
            }

            $(this).toggleClass('holder-active');
        });
    });

})(jQuery);

