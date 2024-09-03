$(function(){
    $('#info_card').hide();
    $('#mas_info').hide(); 

    var card_ver;
    var alias;
    var cardObFuscated;

    $("#searchCard").click(function(event){
        var tarjeta = $('#tarjeta').val();
        var context = $('#idContext').val();
        $('#info_card').hide();
        $('#mas_info').hide();

        if (context != '') {
            $('#message').html('');
             if (tarjeta != '') {
            
                $.ajax({
                    url: base_url+"/tarjeta/searchStatus/"+tarjeta+"/"+context,
                    dataType: "json",
                    beforeSend: function () {
                        //$("#caja21").html("Procesando, espere por favor...");
                        $("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/dist/img/loading.gif">');
                    },
                    success: function(respuesta){
                        $("#caja21").html('');
                        if (respuesta.rows.success) {
                             
                            $('#info_card').show();
                            $('#num_account').html(respuesta.rows.statusByCardResponse.card.acount);
                            card_ver = respuesta.rows.statusByCardResponse.card.number;
                            $('#vig').html(respuesta.rows.statusByCardResponse.card.validity.current);
                            alias = respuesta.rows.statusByCardResponse.card.number;
                            $('#name_user').html(respuesta.rows.statusByCardResponse.card.person.denomination);
                            $('#num_doc').html(respuesta.rows.statusByCardResponse.card.person.document.iden);
                           // $('#trans_apro').html(respuesta.rows.statusByCardResponse.card.activity.lastOperationApproved);
                            //$('#trans_rech').html(respuesta.rows.statusByCardResponse.card.activity.lastOperationDenied);
                        }else{
                            $('#info_card').hide();
                            $('#caja21').html('<p>Datos no encontrados.</p>');
                        }
                    }
                }); 

                $.ajax({
                    url: base_url+"/tarjeta/searchCard/"+tarjeta+"/"+context,
                    dataType: "json",
                    success: function(respuesta){
                        if (respuesta.rows.success == true) {
                            $('#info_card').show();
                            $('#num_card').html(respuesta.rows.cardsResponse.card[0].cardObFuscated);
                            cardObFuscated = respuesta.rows.cardsResponse.card[0].cardObFuscated;
                            //alias = respuesta.rows.cardsResponse.card[0].alias;
                            $('#saldo').val(respuesta.rows.cardsResponse.card[0].saldos.availableConsumptions);

                        }else{
                            $('#info_card').hide();
                            $('#caja21').html('<p>Datos no encontrados</p>');
                        }
                    }
                });
            }else{
                $('#message').html('<div class="alert alert-danger" role="alert">Ingresa un numero de telefóno, tarjeta o correo.</div>');
            }
         } else{
                $('#message').html('<div class="alert alert-danger" role="alert">Selecciona una entidad.</div>');
            }

        


        /*$.ajax({
            url: base_url+"/tarjetas/listStatus/"+tarjeta,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success) {
                    $('#status_card').html('');
                }else{
                    $('#info_card').show();
                    $('#mas_info').html('<p>Datos no encontrados</p>');
                }
            }
        })*/
    });

        

    $( ".masInfo" ).click(function(event){
        event.preventDefault();
        $('#mas_info').show();
        var tarjeta = $('#tarjeta').val();
        $("input[data-bootstrap-switch]").bootstrapSwitch();
        var exterior = document.getElementById('exterior');
        var atm = document.getElementById('atm');
        var comercio = document.getElementById('comercio');
        var transferencias = document.getElementById('transferencias');
        var retiro = document.getElementById('retiro');
        var context = $('#idContext').val();


        $.ajax({
            url: base_url+"/tarjeta/searchMarcas/"+tarjeta+'/'+context,
            dataType: "json",
            success: function(respuesta){
                if (respuesta.rows.success) {
                    if (respuesta.rows.marcaResponse.marca.exterior == 1) {
                        $('#exterior').bootstrapSwitch('state', 'checked');
                    }else{
                        $('#exterior').bootstrapSwitch('state', '');
                    }                  
                    if (respuesta.rows.marcaResponse.marca.atm == 1) {
                        //exterior.checked = true;
                        $('#atm').bootstrapSwitch('state', 'checked');
                    }else{
                        $('#atm').bootstrapSwitch('state', '');
                    }   
                    if (respuesta.rows.marcaResponse.marca.pos == 1) {
                        $('#transfer').bootstrapSwitch('state', 'checked');
                    }else{
                        $('#transfer').bootstrapSwitch('state', '');
                    }   
                    if (respuesta.rows.marcaResponse.marca.ecomerce == 1) {
                        $('#comercio').bootstrapSwitch('state', 'checked');
                    }else{
                        $('#comercio').bootstrapSwitch('state', '');
                    }   
                    if (respuesta.rows.marcaResponse.marca.telefonica == 1) {
                        $('#retiro').bootstrapSwitch('state', 'checked');
                    }else{
                        $('#retiro').bootstrapSwitch('state', '');
                    }   
                }else{
                    $('#info_card').show();
                    $('#mas_info').html('<p>Datos no encontrados</p>');
                }
            }
        });
    });

    $('.ver_card').mousedown(function(event){
        event.preventDefault();
        /*bootbox.alert("Número de Tarjeta: <b>"+card_ver+"</b>", function() {
            //console.log("Alert Callback");
        });*/
        //bootbox.alert('Permiso no habilitado.');
        $('#num_card').html(alias);

        
    });
    $('.ver_card').mouseup(function(event){
        event.preventDefault();
        /*bootbox.alert("Número de Tarjeta: <b>"+card_ver+"</b>", function() {
            //console.log("Alert Callback");
        });*/
        //bootbox.alert('Permiso no habilitado.');
        $('#num_card').html(cardObFuscated);

        
    });
});