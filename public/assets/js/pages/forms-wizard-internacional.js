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
                email: {
                    required: "#email"
                },
                tel: {
                    required: "#tel"
                },
                calle: {
                    required: "#calle"
                },
                cp: {
                    required: "#cp"
                },
                ciudad: {
                    required: "#ciudad"
                },
                estado: {
                    required: "#estado"
                },
                calleB: {
                    required: "#calle"
                },
                paisDes: {
                    required: "#paisDes"
                },
                swift: {
                    required: "#swift"
                },
                cpB: {
                    required: "#cpB"
                },
                institucion: {
                    required: "#institucion"
                },
                ciudadB: {
                    required: "#ciudadB"
                },
                estadoB: {
                    required: "#estadoB"
                },
                moneda: {
                    required: "#moneda"
                },
                monto: {
                    required: "#monto"
                },
                tyc1: {
                    required: "#tyc1"
                },
                tyc2: {
                    required: "#tyc2"
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
               //console.log('cuenta = '+cuenta);
                    $('#showDestino2').html($('#titular').val());
                    $('.cuentaDestino').html('**** '+$('#cuenta').val().substr(-4));
                    $('.instDestino').html($('#nameIns').val());
                    $('.montoEnvio').html('$'+$('#monto').val());
                    $('.concepto').html($('#concepto').val());
                    $('#nBene').html($('#titular').val());
                    if ($('#concepto').val() == '') {
                        $('.conceptodiv').hide();
                    }else{
                        $('.conceptodiv').show();
                    }

                    if (valorDolar != '') {
                        //var rec = $('#monto').val()
                        $('.montoEnvio').html('');
                        var divConcep = '<div class="col-md-12">';
                        if ($('#concepto').val() != '') {
                            divConcep += '<p class="text-16">Concepto: '+$('#concepto').val()+'</p>'; 
                        }
                        divConcep += '</div>';
                        $('.usadiv').html('<div class="row">'+
                              divConcep+
                              '<div class="col-md-12">'+
                                '<p class="text-dorado">Tipo de cambio peso/dólar $'+valorDolar+' </p>'+
                                '<p style="color: #c7924b;">Fecha de valor: '+fechaDolar+' </p>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p class="text-16">Monto a envíar</p>'+
                                '<p class="text-18">$'+$('#monto').val()+'</p>'+
                                '<p class="text-dorado">$'+comisionDolar+' Intereses </p>'+
                                '<p class="text-16">Monto a recibir</p>'+
                                '<p class="text-18 negritas">$'+$('#recibe').val()+'</p>'+
                              '</div>'+
                              '<div class="col-md-6">'+
                                '<p><br></p>'+
                                '<p class="negritas text-16">Peso</p>'+
                                '<p><br></p>'+
                                '<p><br></p>'+
                                '<p class="negritas text-16">Dólar</p>'+
                              '</div>'+
                            '</div>');
                    }else{
                        $('.usadiv').html('');
                    }

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();                
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
                    /*bootbox.alert({
                        message: 'holi.',
                        locale: 'mx'
                    });  */ 
                    $.ajax({
                        url: base_url+"/internacional/makeSpei",
                        data: $("#form-wizard").serialize(),
                        type: "post",
                        dataType: "json",
                        success: function(respuesta){
                              if(respuesta.success == '1'){
                                if(respuesta.rows.responseCode == '00'){
                                    var msg = '<div>'+                                 
                                    '<div id="figuras" class="row p-3 border rounded m-10">'+
                                    '<div class="col-md-12">'+
                                        '<div  class="row ">'+
                                            '<div class="col-md-2" ></div>'+
                                            '<div class="col-md-8" >'+
                                                '<div class="row">'+
                                                    '<div class="col-md-6">';
                                                        var mes='';
                                                        var fechaComT = respuesta.rows.createdAt.split('T');
                                                        var fecha = fechaComT[0].split('-'); 
                                                        var hora = fechaComT[1].split('.'); 
                                                        switch (fecha[1]) {
                                                        case '01':
                                                            mes='Enero';
                                                            break;
                                                        case '02':
                                                            mes='Febrero';
                                                            break;
                                                        case '03':
                                                            mes='Marzo';
                                                            break;
                                                        case '04':
                                                            mes='Abril';
                                                            break;
                                                        case '05':
                                                            mes='Mayo';
                                                            break;
                                                        case '06':
                                                            mes='Junio';
                                                            break;
                                                        case '07':
                                                            mes='Julio';
                                                            break;
                                                        case '08':
                                                            mes='Agosto';
                                                            break;
                                                        case '09':
                                                            mes='Septiembre';
                                                            break;
                                                        case '10':
                                                            mes='Octubre';
                                                            break;
                                                        case '11':
                                                            mes='Noviembre';
                                                            break;
                                                        case '12':
                                                            mes='Diciembre';
                                                            break;                                                                                                                                                   
                                                        default:
                                                            break;
                                                        }
                                                        
                                                 msg += '<p>'+fecha[2]+' de '+mes+' '+fecha[0]+'</p>'+
                                                        '<p>'+hora[0]+' hrs.'+'</p>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row">'+
                                                    '<div class="col-md-12 text-center">'+
                                                        '<p class="text-24 negritas">$ '+respuesta.rows.amount.toFixed(2)+'</p>'+
                                                        '<img style="width: 5%;" src="'+base_url+'/public/assets/img/iconos/Iconos/Para Movimientos-Comprobante/spei.png" >'+
                                                        '<hr>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row">'+
                                                    '<div class="col-md-12">'+
                                                        '<table class="table">'+
                                                            '<tr>'+
                                                                '<td>Tipo de pago</td>'+
                                                                '<td class="negritas">Transferencia Internacional</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Estatus</td>'+
                                                                '<td class="negritas">Aprobada</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Envio a cuenta</td>'+
                                                                '<td class="negritas">'+
                                                                    '<p>'+$('#titular').val()+'</p>'+
                                                                    '<p>**** '+$('#cuenta').val().substr(-4)+'</p>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Dirección</td>'+
                                                                '<td class="negritas">'+
                                                                    '<p>'+$('#calle').val()+' '+$('#numExt').val()+', '+$('#ciudad').val()+'</p>'+
                                                                    '<p>'+$('#estado').val()+' '+$('#pais').val()+'</p>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Descripción</td>'+
                                                                '<td class="negritas">'+respuesta.rows.description+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Cuenta Origen</td>'+
                                                                '<td class="negritas">ONSIGNA KASH</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Referencia</td>'+
                                                                '<td class="negritas">'+respuesta.rows.numericReference+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Autorización</td>'+
                                                                '<td class="negritas">'+respuesta.rows.id+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>Global ID</td>'+
                                                                '<td class="negritas"></td>'+
                                                            '</tr>'+
                                                        '</table>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div style="height:60px;"></div>'+
                                                '<div class="row">'+
                                                    '<div class="col-md-12">'+
                                                        '<p class="text-center text-dorado">Esté vinculo se activará a más tardar dentro de los 15 minutos siguientes a la aceptación de la operación.</p>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div style="height:60px;"></div>'+                    
                                            '</div>'+
                                            '<div class="col-md-2 text-center" ></div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                         '</div>';
                              
                                        bootbox.dialog({
                                            title: "",
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
                                                    setTimeout("window.location.href = '"+base_url+"/internacional'", 3000);
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Ok',
                                                    className: 'btn-success',
                                                    callback: function(){
                                                        bootbox.hideAll();
                                                        setTimeout("window.location.href = '"+base_url+"/internacional'", 3000);
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

})(jQuery);
