$(function(){
    $("#giro").change(function(event){
        var giro = $("#giro").val();
       $('#actividad').html("<option></option>");

        for (var i = 0; i < actividadesGiros.length; i++) {
            if (actividadesGiros[i].idGiro == giro) {
                for (var iAct = 0; iAct < actividadesGiros[i].listActividades.length; iAct++) {
                    $('#actividad').append($('<option>').val(actividadesGiros[i].listActividades[iAct].idcat_actividades).text(actividadesGiros[i].listActividades[iAct].actividad));
                }
            }
        }
    });
    $("#cp").keyup(function(){
        var cp = $("#cp").val();
        if (cp.length == 5) {
            $('#col').html("<option></option>");
            $.ajax({
                url: base_url+"/addEntidad/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#col').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#del').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edo').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#del').html('<option></option>');
                        $('#edo').html('<option></option>');
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
    $("#cpRep").keyup(function(){
        var cp = $("#cpRep").val();
        if (cp.length == 5) {
            $('#colRep').html("<option></option>");
            $.ajax({
                url: base_url+"/addEntidad/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#colRep').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoRep').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#delRep').html('<option></option>');
                        $('#edoRep').html('<option></option>');
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
    $('#inicio').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#fin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioCom').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finCom').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioFin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finFin').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#inicioSop').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });
    $('#finSop').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
    });

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
});