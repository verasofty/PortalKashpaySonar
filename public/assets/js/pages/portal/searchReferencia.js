$(function(){

    $(".buscar").click(function(event) {
        $('#msg').html('');
        var countError = 0;
        /*if ($('#entidad').val() == '') {
            countError = countError+1;
            bootbox.alert({
                message: "Debes seleccionar una entidad.",
                locale: 'mx'
            });
        }
        if ($('#sucursal').val() == '') {
            countError = countError+1;
            bootbox.alert({
                message: "Debes seleccionar una sucursal.",
                locale: 'mx'
            });
        }*/
        //if (countError == 0) {
           
            $.ajax({
                url: base_url+"/buscarReferencia/searchReference",
                data: $("#form_filtro").serialize(),
                type: "post",
                dataType: "json",
                beforeSend: function () {
                    $("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                },
                success: function(data1){
                    $('#example1').show();
                    $('#rowsTrasnsacciones').html('');
                    $("#referencias").html('');
                    var html_result = '';
                    console.log(data1);
                    if (data1.rows.success == true) {
                        var onclick = "pagar("+data1.rows.orderEntityResponse.numericReference+", '"+data1.rows.orderEntityResponse.referenceCreatedPayment+"', event)";
                        //var onclickvar = "exportar("+data1.rows[i].idUser+", '"+data1.rows[i].email+"', event)";
                        var estatus = '';
                        var disable = '';
                        switch(data1.rows.orderEntityResponse.status) {
                            case 4:
                                estatus = 'Referencia ya aprobada.';
                                disable = 'disabled';
                                break;
                            case 7:
                                estatus = 'Referencia cancelada.';
                                disable = 'disabled';
                                break;
                            case 15:
                                estatus = 'Referencia confirmada.';
                                disable = 'disabled';
                                break;
                            case 24:
                                estatus = 'Referencia expirada.';
                                disable = 'disabled';
                                break;
                            case 25:
                                estatus = 'Referencia Creada.';
                                disable = '';
                                break;
                            default :
                                estatus = 'Reporte al administrador.';
                                disable = 'disabled';
                        }
                        html_result += '<div class="search-result mt20">'+
                            '<h5 class="mbn mtn"><a href="">'+data1.rows.orderEntityResponse.beneficiaryName+'</a></h5>'+
                            '<ul class="result-info">'+
                                '<li><a href="#"> <span>Referencia: </span>'+data1.rows.orderEntityResponse.referenceCreatedPayment+' </a></li>'+
                                '<li><a href="#"> <span>Fecha: </span>'+data1.rows.orderEntityResponse.createdAt+' </a></li>'+
                                '<li><a href="#"> <span>Referencia alfanumerica: </span>'+data1.rows.orderEntityResponse.numericReference+'</a></li>'+
                                '<li><a href="#"> <span>Monto: </span> $ '+data1.rows.orderEntityResponse.amount+' </a></li>'+
                                '<li><a href="#"> '+estatus+' </a></li>'+
                            '</ul>'+
                           //'<p>'+data1.rows.orderEntityResponse.concept+'</p>'+
                           '<div class="row">'+
                              '<div class="col-md-6"></div>'+
                              '<div class="col-md-6 ">'+
                                '<form id="form-pagar" method="post"> <input type="hidden" value="'+data1.rows.orderEntityResponse.numericReference+'" name="numericReference"> <input type="hidden" value="'+data1.rows.orderEntityResponse.referenceCreatedPayment+'" name="referenceCreatedPayment"> </form>'+
                                '<button class="btn btn-primary pull-right pagar" '+disable+' onclick="pagar(event)"  id="pagar"> Pagar referencia </button>'+
                              '</div>'+
                           '</div>'+
                        '</div>';
                        
                    }else{
                        html_result += '<div class="search-result mt20">'+
                           '<p>No se encontraron resultados</p>'+
                        '</div>';
                    }
                    $("#referencias").append(html_result);
                }
            });
        //}
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

    $("#pagar").click(function(event) {
        
      
    });

    
});

function pagar(event){
    event.preventDefault();
    console.log("Holi!!");
    //var person = { numericReference: numericReference , referenceCreatedPayment: referenceCreatedPayment };
    //console.log(JSON.stringify(person));
    $.ajax({
        url: base_url+"/buscarReferencia/pagarReferencia",
        type: 'post',
        dataType: "json",
        success: function (data) {
            if (data.rows.success == true) {
                bootbox.alert({
                    message: "Referencia pagada con éxito.",
                    locale: 'mx'
                });
            }else{
                bootbox.alert({
                    message: data.rows.error.message,
                    locale: 'mx'
                });
            }
        },
        data: $('#form-pagar').serialize()
    });   
}
