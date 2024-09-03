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
        var form = $("#form-wizard-caja");
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
                    minlength: "6"
                },
                namecommerce: {
                    required: "#namecommerce"
                },
                rfc: {
                    required: "#rfc",
                    minlength: "12"
                },
                tasa: {
                    required: "#tasa"
                },
                tel: {
                    required: "#tel",
                    minlength: "10"
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
                    minlength: "6"
                },
                safiliacion: {
                    required: "#safiliacion"
                },
                giro: {
                    required: "#giro"
                },
                actividad: {
                    required: "#actividad"
                }
            }
        });
        form.children(".wizard").steps({
            headerTag: ".wizard-section-title",
            bodyTag: ".wizard-section",
            onStepChanging: function(event, currentIndex, newIndex) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
               var formData = new FormData(document.getElementById("form-wizard-caja"));
                formData.append("dato", "valor");

                $.ajax({
                    url: base_url+"/editarCuenta/updateCuenta",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
                        //alert(respuesta);
                        if(respuesta.success == true){
                            bootbox.alert({
                                message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Caja modificada exitosamente.</h3>",
                                locale: 'mx'
                            });
                            setTimeout("window.location.href = '"+base_url+"/editarCuenta?validate="+validate+"&level="+level+"'", 3000);
                        }else{
                            bootbox.alert({
                                message: respuesta.error.message,
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
