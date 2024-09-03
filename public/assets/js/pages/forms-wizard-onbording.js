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
                nombre: {
                    required: "#nombre"
                },
                rfcSub: {
                    required: "#rfcSub",
                    maxlength: "13"
                },
                cpSub: {
                    required: "#cpSub",
                    maxlength: "5"
                },
                colSub: {
                    required: "#colSub"
                },
                calleSub: {
                    required: "#calleSub"
                },
                numExtSub: {
                    required: "#numExtSub"
                },
                contrasenaEnti: {
                    required: "#contrasenaEnti",
                    minlength: "6"
                },
                contrasenaEnti: {
                    equalTo: "#contrasenaEnti",
                    minlength: "6"
                }

            }
        });
        form.children(".wizard").steps({
            headerTag: ".wizard-section-title",
            bodyTag: ".wizard-section",
            onStepChanging: function(event, currentIndex, newIndex) {
                console.log('currentIndex = '+currentIndex);
                //alert('aaaa');
                var countFalta = 0;
                var countFaltaS = 0;
                var countFaltaC = 0;
                var countError = 0;

                var namecommerce = $("#namecommerce").val();
                var giro = $("#giro").val();
                var actividad = $("#actividad").val();

                var emailEnt = $("#emailEnt").val();
                var emailEntCon = $("#emailEntCon").val();
                var contrasenaEnti = $("#contrasenaEnti").val();
                var contrasenaEntiConf = $("#contrasenaEntiConf").val();
                var telEnt = $("#telEnt").val();

                var calleEnt = $("#calleEnt").val();
                var numExtEnt = $("#numExtEnt").val();
                var numIntEnt = $("#numIntEnt").val();
                var cpEnt = $("#cpEnt").val();
                var colEnt = $("#colEnt").val();
                var delEnt = $("#delEnt").val();
                var edoEnt = $("#edoEnt").val();

                if (namecommerce == '') {
                    countFalta = countFalta + 1;
                }
                if (giro == '') {
                    countFalta = countFalta + 1;
                }
                if (actividad == '' ) {
                    countFalta = countFalta + 1;
                }

                console.log('countFalta = '+countFalta);
                
                if (countFalta > 0) {
                    console.log('if');
                    $('.divInfo').show();

                    $( "#nombreSuc" ).attr( "disabled", true );
                    $( "#rfc" ).attr( "disabled", true );
                    $( "#razonSocialSuc" ).attr( "disabled", true );
                    $( "#regimenFis" ).attr( "disabled", true );
                    $( "#emailSuc" ).attr( "disabled", true );
                    $( "#emailSucCon" ).attr( "disabled", true );
                    $( "#contrasena" ).attr( "disabled", true );
                    $( "#confCon" ).attr( "disabled", true );
                    $( "#telSuc" ).attr( "disabled", true );

                    $( "#calleSuc" ).attr( "disabled", true );
                    $( "#numExtSuc" ).attr( "disabled", true );
                    $( "#numIntSuc" ).attr( "disabled", true );
                    $( "#cpSuc" ).attr( "disabled", true );
                    $( "#colSuc" ).attr( "disabled", true );
                    $( "#delSuc" ).attr( "disabled", true );
                    $( "#edoSuc" ).attr( "disabled", true );

                    $( "#nombreCol" ).attr( "disabled", true );
                    $( "#apaternoCol" ).attr( "disabled", true );
                    $( "#amaternoCol" ).attr( "disabled", true );
                    $( "#emailCol" ).attr( "disabled", true );
                    $( "#emailColCon" ).attr( "disabled", true );
                    $( "#contrasenaCol" ).attr( "disabled", true );
                    $( "#confConCol" ).attr( "disabled", true );
                    $( "#tipocol" ).attr( "disabled", true );
                    $( "#telCol" ).attr( "disabled", true );


                }else{
                    console.log('else');
                    $('.divInfo').hide();
                    
                    $( "#nombreSuc" ).attr( "disabled", false );
                    $( "#rfc" ).attr( "disabled", false );
                    $( "#razonSocialSuc" ).attr( "disabled", false );
                    $( "#regimenFis" ).attr( "disabled", false );
                    $( "#emailSuc" ).attr( "disabled", false );
                    $( "#emailSucCon" ).attr( "disabled", false );
                    $( "#contrasena" ).attr( "disabled", false );
                    $( "#confCon" ).attr( "disabled", false );  
                    $( "#telSuc" ).attr( "disabled", false );

                    $( "#calleSuc" ).attr( "disabled", false );
                    $( "#numExtSuc" ).attr( "disabled", false );
                    $( "#numIntSuc" ).attr( "disabled", false );
                    $( "#cpSuc" ).attr( "disabled", false );
                    $( "#colSuc" ).attr( "disabled", false );
                    $( "#delSuc" ).attr( "disabled", false );
                    $( "#edoSuc" ).attr( "disabled", false );  

                    $( "#nombreCol" ).attr( "disabled", false );
                    $( "#apaternoCol" ).attr( "disabled", false );
                    $( "#amaternoCol" ).attr( "disabled", false );
                    $( "#emailCol" ).attr( "disabled", false );
                    $( "#emailColCon" ).attr( "disabled", false );
                    $( "#tipocol" ).attr( "disabled", false );
                    $( "#contrasenaCol" ).attr( "disabled", false );
                    $( "#confConCol" ).attr( "disabled", false ); 
                    $( "#telCol" ).attr( "disabled", false ); 

                    if (currentIndex == 1) {
                        if ($("#emailEnt").val() == '' ) {
                            countError = countError+1;
                            $("#emailEntHelp").html('Campo obligatorio.');
                            $("#emailEntConHelp").html('Campo obligatorio.');
                        }
                        if ($("#contrasenaEnti").val() == '') {
                            countError = countError+1;
                            $("#contrasenaEntiHelp").html('Campo obligatorio.');
                            $("#contrasenaEntiConfHelp").html('Campo obligatorio.');
                        }
                        if ($("#telEnt").val() == '') {
                            countError = countError+1;
                            $("#telEntHelp").html('Campo obligatorio.');
                        }
                        if ($("#calleEnt").val() == '') {
                            countError = countError+1;
                            $("#calleEntHelp").html('Campo obligatorio.');
                        }
                        if ($("#numExtEnt").val() == '') {
                            countError = countError+1;
                            $("#numExtEntHelp").html('Campo obligatorio.');
                        }
                        if ($("#cpEnt").val() == '') {
                            countError = countError+1;
                            $("#cpEntHelp").html('Campo obligatorio.');
                        }
                        if ($("#colEnt").val() == '') {
                            countError = countError+1;
                            $("#colEntHelp").html('Campo obligatorio.');
                        }

                        if ($("#emailEnt").val() != $("#emailEntCon").val()) {
                            countError = countError+1;
                            $("#emailEntConHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                        }
                        if ($("#contrasenaEnti").val() != $("#contrasenaEntiConf").val()) {
                            countError = countError+1;
                            $("#contrasenaEntiConfHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                        }
                    }
                    
                }

                if (currentIndex == 2) {
                        //validar Sucursal
                        if ($('#nombreSuc').val() != '') {
                             countFaltaS = countFaltaS+1;
                        }
                        if ($('#rfc').val() != '') {
                             countFaltaS = countFaltaS+1;
                        }
                        if ($('#razonSocialSuc').val() != '') {
                             countFaltaS = countFaltaS+1;
                        }
                        if ($('#regimenFis').val() != '') {
                             countFaltaS = countFaltaS+1;
                        }

                        if (countFaltaS > 0) {
                            if ($('#nombreSuc').val() == '') {
                                 countError = countError+1;
                                 $("#nombreSucHelp").html('Campo obligatorio.');
                            }
                            if ($('#rfc').val() == '') {
                                 countError = countError+1;
                                 $("#rfcHelp").html('Campo obligatorio.');
                            }
                            if ($('#razonSocialSuc').val() == '') {
                                 countError = countError+1;
                                 $("#razonSocialSucHelp").html('Campo obligatorio.');
                            }
                            if ($('#regimenFis').val() == '') {
                                 countError = countError+1;
                                 $("#regimenFisHelp").html('Campo obligatorio.');
                            }

                            if ($("#emailSuc").val() == '' ) {
                                countError = countError+1;
                                $("#emailSucHelp").html('Campo obligatorio.');
                                $("#emailSucConHelp").html('Campo obligatorio.');
                            }
                            if ($("#contrasena").val() == '') {
                                countError = countError+1;
                                $("#contrasenaHelp").html('Campo obligatorio.');
                                $("#confConHelp").html('Campo obligatorio.');
                            }
                            if ($("#telSuc").val() == '') {
                                countError = countError+1;
                                $("#telSucHelp").html('Campo obligatorio.');
                            }
                            if ($("#calleSuc").val() == '') {
                                countError = countError+1;
                                $("#calleSucHelp").html('Campo obligatorio.');
                            }
                            if ($("#numExtSuc").val() == '') {
                                countError = countError+1;
                                $("#numExtSucHelp").html('Campo obligatorio.');
                            }
                            if ($("#cpSuc").val() == '') {
                                countError = countError+1;
                                $("#cpSucHelp").html('Campo obligatorio.');
                            }
                            if ($("#colSuc").val() == '') {
                                countError = countError+1;
                                $("#colSucHelp").html('Campo obligatorio.');
                            }

                            if ($("#emailSuc").val() != $("#emailSucCon").val()) {
                                countError = countError+1;
                                $("#emailSucConHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                            }
                            if ($("#contrasena").val() != $("#confCon").val()) {
                                countError = countError+1;
                                $("#confConHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                            }
                        }
                    }

                    if (currentIndex == 3) {
                        //validar Caja
                        if ($('#nombreCol').val() != '') {
                             countFaltaC = countFaltaC+1;
                        }
                        if ($('#apaternoCol').val() != '') {
                             countFaltaC = countFaltaC+1;
                        }
                        if ($('#amaternoCol').val() != '') {
                             countFaltaS = countFaltaS+1;
                        }
                        if ($('#tipocol').val() != '') {
                             countFaltaC = countFaltaC+1;
                        }

                        if (countFaltaC > 0) {
                            if ($('#nombreCol').val() == '') {
                                 countError = countError+1;
                                 $("#nombreColHelp").html('Campo obligatorio.');
                            }
                            if ($('#apaternoCol').val() == '') {
                                 countError = countError+1;
                                 $("#apaternoColHelp").html('Campo obligatorio.');
                            }
                            if ($('#amaternoCol').val() == '') {
                                 countError = countError+1;
                                 $("#amaternoColHelp").html('Campo obligatorio.');
                            }
                            if ($('#tipocol').val() == '') {
                                 countError = countError+1;
                                 $("#tipocolHelp").html('Campo obligatorio.');
                            }

                            if ($("#emailCol").val() == '' ) {
                                countError = countError+1;
                                $("#emailColHelp").html('Campo obligatorio.');
                                $("#emailColConHelp").html('Campo obligatorio.');
                            }
                            if ($("#contrasenaCol").val() == '') {
                                countError = countError+1;
                                $("#contrasenaColHelp").html('Campo obligatorio.');
                                $("#confConColHelp").html('Campo obligatorio.');
                            }
                            if ($("#telSuc").val() == '') {
                                countError = countError+1;
                                $("#telSucHelp").html('Campo obligatorio.');
                            }
                            

                            if ($("#emailCol").val() != $("#emailColCon").val()) {
                                countError = countError+1;
                                $("#emailColConHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                            }
                            if ($("#contrasenaCol").val() != $("#confConCol").val()) {
                                countError = countError+1;
                                $("#confConColHelp").html('Por favor, introduzca el mismo valor de nuevo.');
                            }
                        }
                    }
                

                console.log('countError = '+countError);

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

                $.ajax({
                    url: base_url+"/onbording/registrar",
                    data: $("#form-wizard").serialize(),
                    type: "post",
                    dataType: "json",
                    success: function(respuesta){
                        //alert(respuesta);
                        if(respuesta.rows.success == true){
                            location.href = base_url+'/successOnbording';
                        }else{
                            bootbox.alert({
                                message: 'Verifica tus datos.',
                                //message: respuesta.rows.error.message,
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
