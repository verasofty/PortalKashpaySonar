$(document).ready(function(){
    $('.divInfo').hide();
    $('.allcp-form').hide();
    $.ajax({
        url: base_url+"/onbording/validarToken/"+token,
        dataType: "json",
        success: function(respuesta){
            if (respuesta.rows.success == true) {
                if (respuesta.rows.accountResponse.idStatus == 0) {
                    /*bootbox.alert({
                        title: 'Registro terminado',
                        message: 'El registro ya fue concluido con exito. Te refireccionaremos para que inicies sesión en KashPay.',
                        locale: 'mx'
                    });
                    setTimeout("window.location.href = '"+base_url+"'", 3000);*/
                    location.href = base_url+'/successOnbording';
                }else{
                    $('.allcp-form').show();
                    $('#nombre').val(respuesta.rows.accountResponse.nameCommerce);
                    $('#idContext').val(respuesta.rows.accountResponse.idContext);
                    $('#idEntity').val(respuesta.rows.accountResponse.idEntity);
                    $('#idRol').val(respuesta.rows.accountResponse.idAffiliationLevel);
                    $('#nombreCom').val(respuesta.rows.accountResponse.nameCommerce);
                }
                
            }else{
                bootbox.alert({
                    title: 'Sin registro previo',
                    message: 'Primero debes registrarte. En un momento te redirigiremos al registro de KashPay',
                    locale: 'mx'
                });
                setTimeout("window.location.href = '"+base_url+"/registro'", 3000);
            }
        }
    }); 
});
$(function(){

    $('.copiarInfo').click(function(event){
        if( $('.copiarInfo').prop('checked') ) {
            var comboCol = document.getElementById("colSub");
            var selectedCol = comboCol.options[comboCol.selectedIndex].text;

            var comboMun = document.getElementById("delSub");
            var selectedMun = comboMun.options[comboMun.selectedIndex].text;

            var comboEdo = document.getElementById("edoSub");
            var selectedEdo = comboEdo.options[comboEdo.selectedIndex].text;

            //alert($('#colSub').val());
            //alert(selected);

            $('#calleEnt').val($('#calleSub').val());
            $('#numExtEnt').val($('#numExtSub').val());
            $('#numIntEnt').val($('#numIntSub').val());
            $('#cpEnt').val($('#cpSub').val());
            $('#colEnt').html($('<option>').val($('#colSub').val()).text(selectedCol));
            $('#delEnt').html($('<option>').val($('#delSub').val()).text(selectedMun));
            $('#edoEnt').html($('<option>').val($('#edoSub').val()).text(selectedEdo));
            
        }else{
            $('#calleEnt').val('');
            $('#numExtEnt').val('');
            $('#numIntEnt').val('');
            $('#cpEnt').val('');
            $('#colEnt').html($('<option></option>'));
            $('#delEnt').html($('<option></option>'));
            $('#edoEnt').html($('<option></option>'));
        }
        
    });
    
    $('.copiarInfoSuc').click(function(event){
        if( $('.copiarInfoSuc').prop('checked') ) {
            var comboCol = document.getElementById("colEnt");
            var selectedCol = comboCol.options[comboCol.selectedIndex].text;

            var comboMun = document.getElementById("delEnt");
            var selectedMun = comboMun.options[comboMun.selectedIndex].text;

            var comboEdo = document.getElementById("edoEnt");
            var selectedEdo = comboEdo.options[comboEdo.selectedIndex].text;

            //alert($('#colSub').val());
            //alert(selected);

            $('#calleSuc').val($('#calleEnt').val());
            $('#numExtSuc').val($('#numExtEnt').val());
            $('#numIntSuc').val($('#numIntEnt').val());
            $('#cpSuc').val($('#cpEnt').val());
            $('#colSuc').html($('<option>').val($('#colEnt').val()).text(selectedCol));
            $('#delSuc').html($('<option>').val($('#delEnt').val()).text(selectedMun));
            $('#edoSuc').html($('<option>').val($('#edoEnt').val()).text(selectedEdo));
            
        }else{
            $('#calleSuc').val('');
            $('#numExtSuc').val('');
            $('#numIntSuc').val('');
            $('#cpSuc').val('');
            $('#colSuc').html($('<option></option>'));
            $('#delSuc').html($('<option></option>'));
            $('#edoSuc').html($('<option></option>'));
        }
        
    });

    $("#giro").change(function(event){
        var giro = $("#giro").val();
       $('#actividad').html("<option></option>");

        for (var i = 0; i < actividadesGiros.length; i++) {
            if (actividadesGiros[i].idGiro == giro) {
                for (var iAct = 0; iAct < actividadesGiros[i].listActividades.length; iAct++) {
                    $('#actividad').append($('<option>').val(actividadesGiros[i].listActividades[iAct].idcat_actividades).text(actividadesGiros[i].listActividades[iAct].actividad));
                }
            }
            //alert(actividadesGiros[i].idcat_actividades);
        }
    });

    $("#cp").keyup(function(){
        var cp = $("#cp").val();
        if (cp.length == 5) {
            $('#col').html("<option></option>");
            $.ajax({
                url: base_url+"/onbording/searchLocalidad/"+cp,
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

    $("#cpSub").keyup(function(){
        var cp = $("#cpSub").val();
        if (cp.length == 5) {
            $('#colSub').html("<option></option>");
            $.ajax({
                url: base_url+"/onbording/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#colSub').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delSub').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoSub').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#delSub').html('<option></option>');
                        $('#edoSub').html('<option></option>');
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

    $("#cpEnt").keyup(function(){
        var cp = $("#cpEnt").val();
        if (cp.length == 5) {
            $('#colSub').html("<option></option>");
            $.ajax({
                url: base_url+"/onbording/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#colEnt').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delEnt').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoEnt').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#delEnt').html('<option></option>');
                        $('#edoEnt').html('<option></option>');
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

    $("#cpSuc").keyup(function(){
        var cp = $("#cpSuc").val();
        if (cp.length == 5) {
            $('#colSuc').html("<option></option>");
            $.ajax({
                url: base_url+"/onbording/searchLocalidad/"+cp,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.catLocalidadesResponse.length > 0){
                        for (var i = 0; i < respuesta.rows.catLocalidadesResponse.length; i++) {
                            $('#colSuc').append($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].colonia));
                            $('#delSuc').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].municipio));
                            $('#edoSuc').html($('<option>').val(respuesta.rows.catLocalidadesResponse[i].idLocalidad).text(respuesta.rows.catLocalidadesResponse[i].estado));
                        }
                    }else{
                        $('#delSuc').html('<option></option>');
                        $('#edoSuc').html('<option></option>');
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

    $(".popCol").click(function(event){
        var gerente = '<p><b>Gerente</b></p>'+
                    '<p>Puede aceptar pagos y ver el historial de transacciones en la Clip app, así como el ingresar a su cuenta en el sitio web de Clip para ver y descargar transacciones, agregar, editar y eliminar Cajeros, y ordenar lectores de Clip. El Gerente no puede editar la información del negocio o la cuenta bancaria.</p>';
        
        var finanzas = '<p><b>Finanzas</b></p>'+
                        '<p>Puede aceptar pagos y ver el historial de transacciones en la Clip app, así como ingresar a su cuenta en el sitio web de Clip para ver y descargar los informes de transacciones y ordenar lectores de Clip. Finanzas no puede administrar colaboradores o editar la información del negocio o la cuenta bancaria.</p>';

        var cajero = '<p><b>Cajero</b></p>'+
                    '<p>Sólo puede ingresar a su cuenta en la Clip app para aceptar pagos y ver el historial de transacciones.</p>';

        bootbox.alert({
            title: 'Tipos de Coloboradores',
            message: gerente+'<br>'+cajero+'<br>'+finanzas,
            locale: 'mx'
        });

            
        
    });

    
});