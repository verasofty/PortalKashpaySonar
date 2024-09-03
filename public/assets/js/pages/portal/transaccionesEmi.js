$(function(){
  $('#rango').daterangepicker();

    $('#info_card').hide();
    $('#mas_info').hide(); 

    var card_ver;

    $("#btnLimpiar").click(function(event) {
       $("#fom_filter_operation")[0].reset();
    });

    $("#monto").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });
    
    $("#btnLimpiar").click(function(event) {
        event.preventDefault();
       $("#fom_filter_operation")[0].reset();
       $("form select").each(function() { this.selectedIndex = 0 });  
        var type = 0;
        var status = $('#estatus').val();
        location.href = base_url+'/transaccionesEmision?type_operation=&id_status=&id_context='+contextSearch+'&amount=&auth_number=&num_cuenta=&init_date='+date1Search+'&end_date='+date2Search+'&email=&telephoneNumber=&page=1';
      // location.href = base_url+'/operaciones?id_context='+contextSearch+'&type='+type+'&value1='+date1Search+'&value2='+date2Search+'&page=1';
    });
    

    $("#search").click(function(event){
        $('#example1_wrapper').hide();
        var type_operation = $('#typeOperacion').val();
        var id_status = $('#estatus').val();
        var amount;
        var email;
        var tel;
        var auth_number;
        var id_status; 
        var id_context; 
        var rango;
        var num_cuenta; //533984269
        if ($('#rango').val() != '') {
            if ($('#num_cuenta').val() == '' && $('#typeOperacion').val() == 'na') {
                $('#message').html('<div class="alert alert-danger" role="alert">Para poder hacer una busqueda necesitas seleccionar un tipo de operación o ingresar un número de cuenta.</div>');
            }else{
                $('#message').html('');
                if ($('#num_cuenta').val() != '') {
                    num_cuenta = $('#num_cuenta').val();
                }else{
                    num_cuenta = '';
                }
                if ($('#monto').val() != '') {
                    amount = $('#monto').val();
                }else{
                    amount = '';
                }

                if ($('#idEntidad').val() != '') {
                    id_context = $('#idEntidad').val();
                }else{
                    id_context = '';
                }

                if ($('#estatus').val() != '') {
                    id_status = $('#estatus').val();
                }else{
                    id_status = '';
                }

                if ($('#num_auto').val() != '') {
                    auth_number = $('#num_auto').val();
                }else{
                    auth_number = '';
                }
                if ($('#rango').val() != '') {
                    rango = $('#rango').val();
                    var indice = rango.split(" / ");
                    var init_date = indice[0]; 
                    var end_date = indice[1];
                }else{
                    var init_date = ''; 
                    var end_date = '';
                }

                if ($('#tel').val() != '') {
                    tel = $('#tel').val();
                }else{
                    tel = '';
                }

                if ($('#email').val() != '') {
                    email = $('#email').val();
                }else{
                    email = '';
                }

                /*var table = $('#example1').DataTable();
                table.clear().draw();

                $.ajax({
                    url: base_url+"/operaciones/searchOpe/"+type_operation+"/"+id_status+"/"+id_context+"/"+amount+"/"+auth_number+"/"+num_cuenta+"/"+init_date+"/"+end_date,
                    dataType: "json",
                    beforeSend: function () {
                        $("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/dist/img/loading.gif">');
                    },
                }).done( function(data1) {
                    $("#caja21").html('');
                    $('#example1_wrapper').show();
                    var data = Array();
                    for (var i = 0; i < data1.rows.length; i++) {
                        if (data1.rows[i].creationDate != null) {
                            var fechaCreate = data1.rows[i].creationDate.split("T");
                        }else{
                            var fechaCreate = [''];
                        }
                        if (data1.rows[i].updateDate != null) {
                            var fechaUpdate = data1.rows[i].updateDate.split("T");
                        }else{
                            var fechaUpdate = [''];
                        }
                        var myNumeral = numeral (data1.rows[i].amount);
                        var currencyMonto = myNumeral.format('$0,0.00');
                        var cuentaBen = "";
                        var datadni = [
                                data1.rows[i].idOperation,
                                data1.rows[i].transactionSecuence,
                                data1.rows[i].idCoreMambu,
                                data1.rows[i].operationType,
                                data1.rows[i].statusDescription,
                                data1.rows[i].counterpartInstitution,
                                data1.rows[i].trakingKey,
                                currencyMonto,
                                data1.rows[i].concept,
                                data1.rows[i].numericalReference,
                                data1.rows[i].authNumber,
                                fechaCreate[0],
                                fechaUpdate[0],
                                data1.rows[i].comission,
                                data1.rows[i].descriptionRefund,
                                data1.rows[i].merchantName,
                                data1.rows[i].rubroMaster,
                                data1.rows[i].traceMaster,
                                data1.rows[i].dateMposMaster,
                                data1.rows[i].maskedCard,
                                data1.rows[i].responseCodeMaster,
                                data1.rows[i].entityOperationID,
                                data1.rows[i].isSendWebHook,
                                data1.rows[i].lastUserModify
                            ];
                        data.push (datadni); 
                    }
                    table.rows.add(data).draw();
                
                });*/

                if (contextSearch == 0) {
                    location.href = base_url+'/transaccionesEmision?type_operation='+type_operation+'&id_status='+id_status+'&id_context='+$('#idEntidad').val()+'&amount='+amount+'&auth_number='+auth_number+'&num_cuenta='+num_cuenta+'&init_date='+init_date+'&end_date='+end_date+'&email='+email+'&telephoneNumber='+tel+'&page=1';
                }else{
                    location.href = base_url+'/transaccionesEmision?type_operation='+type_operation+'&id_status='+id_status+'&id_context='+$('#idEntidad').val()+'&amount='+amount+'&auth_number='+auth_number+'&num_cuenta='+num_cuenta+'&init_date='+init_date+'&end_date='+end_date+'&email='+email+'&telephoneNumber='+tel+'&page=1';
                }
            }
        }else{
            $('#message').html('<div class="alert alert-danger" role="alert">Para poder hacer una busqueda necesitas seleccionar un rango de fecha.</div>');
        }
    });
        

});