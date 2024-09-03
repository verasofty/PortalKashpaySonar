$(function(){
    $('.copiarInfo').click(function(event){
        if( $('.copiarInfo').prop('checked') ) {
            $('#tasaVisaTPC').val($('#tasaVisaTP').val());
            $('#tasaMCTPC').val($('#tasaMCTP').val());
            $('#tasaAMEXTPC').val($('#tasaAMEXTP').val());
            $('#tasaValesTPC').val($('#tasaValesTP').val());
            $('#tasaInterTPC').val($('#tasaInterTP').val());

            $('#tasaVisaEC').val($('#tasaVisaE').val());
            $('#tasaMCEC').val($('#tasaMCE').val());
            $('#tasaAMEXEC').val($('#tasaAMEXE').val());
            $('#tasaValesEC').val($('#tasaValesE').val());
            $('#tasaInterEC').val($('#tasaInterE').val());
        }else{
            $('#tasaVisaTPC').val('');
            $('#tasaMCTPC').val('');
            $('#tasaAMEXTPC').val('');
            $('#tasaValesTPC').val('');
            $('#tasaInterTPC').val('');

            $('#tasaVisaEC').val('');
            $('#tasaMCEC').val('');
            $('#tasaAMEXEC').val('');
            $('#tasaValesEC').val('');
            $('#tasaInterEC').val('');
        }
        
    });

    $("#btn-add").click(function(event){
    	var countError = 0;

        $('#tasaVisaTPHelp').html('');
        $('#tasaMCTPHelp').html('');
        $('#tasaAMEXTPHelp').html('');
        $('#tasaValesTPHelp').html('');
    	$('#tasaInterTPHelp').html('');

        $('#tasaVisaEHelp').html('');
        $('#tasaMCEHelp').html('');
        $('#tasaAMEXEHelp').html('');
        $('#tasaValesEHelp').html('');
        $('#tasaInterEHelp').html('');

        $('#tasaVisaTPCHelp').html('');
        $('#tasaMCTPCHelp').html('');
        $('#tasaAMEXTPCHelp').html('');
        $('#tasaValesTPCHelp').html('');
        $('#tasaInterTPCHelp').html('');

        $('#tasaVisaECHelp').html('');
        $('#tasaMCECHelp').html('');
        $('#tasaAMEXECHelp').html('');
        $('#tasaValesECHelp').html('');
        $('#tasaInterECHelp').html('');



        var tasaVTP = $('#tasaVisaTP').val();
        var tasaMTP = $('#tasaMCTP').val();
        var tasaATP = $('#tasaAMEXTP').val();
        var tasaVlTP = $('#tasaValesTP').val();
        var tasaITP = $('#tasaInterTP').val();

        var tasaVE = $('#tasaVisaE').val();
        var tasaME = $('#tasaMCE').val();
        var tasaAE = $('#tasaAMEXE').val();
        var tasaVlE = $('#tasaValesE').val();
        var tasaIE = $('#tasaInterE').val();

        var tasaVTPC = $('#tasaVisaTPC').val();
        var tasaMTPC = $('#tasaMCTPC').val();
        var tasaATPC = $('#tasaAMEXTPC').val();
        var tasaVlTPC = $('#tasaValesTPC').val();
        var tasaITPC = $('#tasaInterTPC').val();

        var tasaVEC = $('#tasaVisaEC').val();
        var tasaMEC = $('#tasaMCEC').val();
        var tasaAEC = $('#tasaAMEXEC').val();
        var tasaVlEC = $('#tasaValesEC').val();
        var tasaIEC = $('#tasaInterEC').val();

        var contextSon = $('#contextSon').val();
        var level = $('#level').val();
        var urlEdit = base_url+'/editar?validate='+contextSon+'&level='+level;

        if (tasaVTP == '') {
            countError = countError+1;
            $('#tasaVisaTPHelp').html('Campo obligatorio.');
        }
        if (tasaMTP == '') {
            countError = countError+1;
            $('#tasaMCTPHelp').html('Campo obligatorio.');
        }
        if (tasaATP == '') {
            countError = countError+1;
            $('#tasaAMEXTPHelp').html('Campo obligatorio.');
        }
        if (tasaVlTP == '') {
            countError = countError+1;
            $('#tasaValesTPHelp').html('Campo obligatorio.');
        }
        if (tasaITP == '') {
            countError = countError+1;
            $('#tasaInterTPHelp').html('Campo obligatorio.');
        }

        if (tasaVE == '') {
            countError = countError+1;
            $('#tasaVisaEHelp').html('Campo obligatorio.');
        }
        if (tasaME == '') {
            countError = countError+1;
            $('#tasaMCEHelp').html('Campo obligatorio.');
        }
        if (tasaAE == '') {
            countError = countError+1;
            $('#tasaAMEXEHelp').html('Campo obligatorio.');
        }
        if (tasaVlE == '') {
            countError = countError+1;
            $('#tasaValesEHelp').html('Campo obligatorio.');
        }
        if (tasaIE == '') {
            countError = countError+1;
            $('#tasaInterEHelp').html('Campo obligatorio.');
        }
        //
        if (tasaVTPC == '') {
            countError = countError+1;
            $('#tasaVisaTPCHelp').html('Campo obligatorio.');
        }
        if (tasaMTPC == '') {
            countError = countError+1;
            $('#tasaMCTPCHelp').html('Campo obligatorio.');
        }
        if (tasaATPC == '') {
            countError = countError+1;
            $('#tasaAMEXTPCHelp').html('Campo obligatorio.');
        }
        if (tasaVlTPC == '') {
            countError = countError+1;
            $('#tasaValesTPCHelp').html('Campo obligatorio.');
        }
        if (tasaITPC == '') {
            countError = countError+1;
            $('#tasaInterTPCHelp').html('Campo obligatorio.');
        }

        if (tasaVEC == '') {
            countError = countError+1;
            $('#tasaVisaECHelp').html('Campo obligatorio.');
        }
        if (tasaMEC == '') {
            countError = countError+1;
            $('#tasaMCECHelp').html('Campo obligatorio.');
        }
        if (tasaAEC == '') {
            countError = countError+1;
            $('#tasaAMEXECHelp').html('Campo obligatorio.');
        }
        if (tasaVlEC == '') {
            countError = countError+1;
            $('#tasaValesECHelp').html('Campo obligatorio.');
        }
        if (tasaIEC == '') {
            countError = countError+1;
            $('#tasaInterECHelp').html('Campo obligatorio.');
        }

        if (countError == 0) {
            $.ajax({
                url: base_url+"/editar/updateComision",
                data: $("#form_updateComision").serialize(),
                type: "post",
                dataType: "json",
                success: function(respuesta){
                    if (respuesta != null) {
                        bootbox.alert({
                            message: "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Comisiones actualizadas exitosamente.</h3>",
                            locale: 'mx'
                        });
                        setTimeout("window.location.href = '"+urlEdit+"'", 3000);
                    }else{
                        bootbox.alert({
                            message: "Algo salio mal, intente más tarde.",
                            locale: 'mx'
                        });
                    }
                    
                }
            }); 
        }
            
    });
});