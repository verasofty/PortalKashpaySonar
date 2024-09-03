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
                emailConfirm: {
                    equalTo: "#email"
                },
                confPass: {
                    equalTo: "#contrasena",
                    minlength: "4"
                },
                namecommerce: {
                    required: "#namecommerce"
                },
                rfc: {
                    required: "#rfc",
                     minlength: "12"
                },
                safiliacion: {
                    required: "#safiliacion"
                },
                tel: {
                    required: "#tel",
                    maxlength: "10"
                },
                email: {
                    required: "#email",
                    minlength: "10"
                },
                cp: {
                    required: "#cp",
                    maxlength: "5"
                },
                col: {
                    required: "#col"
                },
                calle: {
                    required: "#calle"
                },
                numExt: {
                    required: "#numExt"
                },
                contrasena: {
                    required: "#contrasena",
                    minlength: "4"
                },
                safiliacion: {
                    required: "#safiliacion"
                },
                giro: {
                    required: "#giro"
                },
                actividad: {
                    required: "#actividad"
                },
                razonSFiscal:{
                    required: "#actividad"
                },
                regFiscal:{
                    required: "#regFiscal"
                },
                cuentaKash:{
                    required: "#cuentaKash"
                },
                clabeInt:{
                    required: '#clabeInt'
                },
                ine:{
                    required: '#ine'
                },
                acta:{
                    required: '#acta'
                },
                cfe:{
                    required: '#cfe'
                }
            }
        });
        form.children(".wizard").steps({
            headerTag: ".wizard-section-title",
            bodyTag: ".wizard-section",
            onStepChanging: function(event, currentIndex, newIndex) {
                $('#contrasenaHelp').html('');
                var countError = 0;
                if ($('#contrasena').val().split(' ').length>=2){
                    $('#contrasenaHelp').html('Hay espacios en blanco');
                    countError = countError+1;
                }
                if (countError == 0) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                //event.preventDefault();
                //alert("Submitted!");
                //window.location.href = base_url+'/successOnbording';
                var formData = new FormData(document.getElementById("form-wizard"));
                formData.append("dato", "valor");
                $.ajax({
                    url: base_url+"/addEntidad/registrar",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
                        if(respuesta.rows.success == true){
                            bootbox.alert({
                                message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Entidad agregada exitosamente.</h3>"+
                                "<h5>El usuario para iniciar sesion es: "+respuesta.rows.accountResponse.email+"</h5>",
                                locale: 'mx'
                            });
                            setTimeout("window.location.href = '"+base_url+"/addEntidad'", 3000);
                        }else{
                            bootbox.alert({
                                message: respuesta.rows.error.message,
                                locale: 'mx'
                            });
                        }
                    }
                });
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
