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
                    minlength: "6"
                },
                nombre: {
                    required: "#nombre"
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
                    required: "#email"
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
                tasaVisaTP: {
                    required: "#tasaVisaTP"
                },
                tasaMCTP: {
                    required: "#tasaMCTP"
                },
                tasaAMEXTP: {
                    required: "#tasaAMEXTP"
                },
                tasaValesTP: {
                    required: "#tasaValesTP"
                },
                tasaInterTP: {
                    required: "#tasaInterTP"
                },
                tasaVisaE: {
                    required: "#tasaVisaE"
                },
                tasaMCE: {
                    required: "#tasaMCE"
                },
                tasaAMEXE: {
                    required: "#tasaAMEXE"
                },
                tasaValesE: {
                    required: "#tasaValesE"
                },
                tasaInterE: {
                    required: "#tasaInterE"
                },
                tasaVisaTPC: {
                    required: "#tasaVisaTPC"
                },
                tasaMCTPC: {
                    required: "#tasaMCTPC"
                },
                tasaAMEXTPC: {
                    required: "#tasaAMEXTPC"
                },
                tasaValesTPC: {
                    required: "#tasaValesTPC"
                },
                tasaInterTPC: {
                    required: "#tasaInterTPC"
                },
                tasaVisaEC: {
                    required: "#tasaVisaEC"
                },
                tasaMCEC: {
                    required: "#tasaMCEC"
                },
                tasaAMEXEC: {
                    required: "#tasaAMEXEC"
                },
                tasaValesEC: {
                    required: "#tasaValesEC"
                },
                tasaInterEC: {
                    required: "#tasaInterEC"
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
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                //alert("Submitted!");
                //window.location.href = base_url+'/successOnbording';
                var nombre = $("#nombre").val();
                var rfc = $("#rfc").val();
                var tel = $("#tel").val();
                var email = $("#email").val();
                var contrasena = $("#contrasena").val();
                var tasa = $("#tasa").val();
                var calle = $("#calle").val();
                var numExt = $("#numExt").val();
                var numInt = $("#numInt").val();
                var col = $("#col").val();
                var nombreCont = $("#nombreCont").val();
                var aPaternoCont = $("#aPaternoCont").val();
                var aMaternoCont = $("#aMaternoCont").val();
                var telCont = $("#telCont").val();
                var telAdiCont = $("#telAdiCont").val();
                var emailCont = $("#emailCont").val();

                if (numInt == "") {
                    numInt = "na";
                }
                if (nombreCont == "") {
                    nombreCont = "na";
                }
                if (aPaternoCont == "") {
                    aPaternoCont = "na";
                }
                if (aMaternoCont == "") {
                    aMaternoCont = "na";
                }
                if (telCont == "") {
                    telCont = "na";
                }
                if (telAdiCont == "") {
                    telAdiCont = "na";
                }
                if (emailCont == "") {
                    emailCont = "na";
                }
                var formData = new FormData(document.getElementById("form-wizard"));
                formData.append("dato", "valor");

                $.ajax({
                    url: base_url+"/addSubAfiliado/registrar",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
                        if(respuesta.rows.success == true){
                            bootbox.alert({
                                message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> SubAfiliado agregado exitosamente.</h3>",
                                locale: 'mx'
                            });
                            //setTimeout("window.location.href = '"+base_url+"/addSubAfiliado'", 3000);
                        }else{
                            bootbox.alert({
                                message: respuesta.rows.error.message,
                                locale: 'mx'
                            });
                        }
                    }
                });

                /*$.ajax({
                    url: base_url+"/addSubAfiliado/registrar/"+nombre+"/"+rfc+"/"+tel+"/"+email+"/"+contrasena+"/"+tasa+"/"+calle+"/"+numExt+"/"+numInt+"/"+col+"/"+nombreCont+"/"+aPaternoCont+"/"+aMaternoCont+"/"+telCont+"/"+telAdiCont+"/"+emailCont,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta.rows.success == true){
                            bootbox.alert({
                                message: "SubAfiliado agregado exitosamente.",
                                locale: 'mx'
                            });
                        }else{
                            bootbox.alert({
                                message: respuesta.rows.error.message,
                                locale: 'mx'
                            });
                        }
                    }
                });*/ 
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
