$(function(){
    $('#date').datepicker(
        { format: 'YYYY-MM-DD' }
    );

        $('.detalleInfo').hide();
    
        $('.verDetalle').click(function(event) {
                var idDispersion = $(this).data('id');
                var html = '';
    
                $.ajax({
                    url: base_url+"/estatusDispersion/detalleDispercion/"+idDispersion,
                    type: "post",
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
    
                            console.log('html'+respuesta.rows.totalElements);
    
                        if(respuesta.rows.totalElements != 0){
                           // for (var i = 0; i < respuesta.rows.totalElements.length; i++) {
                                for (var j = 0; j < respuesta.rows.dispersalsDetail.length; j++) {
                                    html+='<tr class="detallecss">';
                                    html+='<td>';
                                    html+='<p>Número de cuenta: '+respuesta.rows.dispersalsDetail[j].account+'</p>';
                                    html+='<p>Fecha : '+respuesta.rows.dispersalsDetail[j].createdAt+'</p>';
                                    html+='</td>';
                                    html+='<td>';
                                    html+='<p>Monto: '+respuesta.rows.dispersalsDetail[j].amount+'</p>';
                                    html+='<p>Concepto: '+respuesta.rows.dispersalsDetail[j].concept+'</p>';
                                    html+='</td>';
                                    html+='<td>';
                                    html+='<p>Estatus: '+respuesta.rows.dispersalsDetail[j].status+'</p>';
                                    html+='</td>';
                                    html+='</tr>';
                                }
                            //}
                            console.log(html);
                            $('#detalle-'+idDispersion).after(html);
                            $('.detalleInfo').show();
                        }else{
                            bootbox.alert({
                                message: 'No se encontraron resultados.',
                                locale: 'mx'
                            });
                        }
                    }
                });
            
            
        });
    
        $("#btnLimpiar").click(function(event) {
            event.preventDefault();
           $("#form_filtro")[0].reset();
           location.href = base_url+'/estatusDispersion?name=&date=&page=1';
        });
    
    
        $('.buscar').click(function(event) {
            var countError = 0;
            var name = '';
            var date = '';
            var urlSearch = '';
            console.log('date = '+$('#date').val());
           if ($('#name').val() != '') {
                name = $('#name').val();
                urlSearch += '?name='+name;
            }else{
                countError = countError+1;
                urlSearch += '?name=';
            }
            if ($('#date').val() != '') {
                date = $('#date').val();
                urlSearch += '&date='+date;
            }else{
                countError = countError+1;
                urlSearch += '&date=';
            }
            
            if (countError <= 1) {
                location.href = base_url+'/estatusDispersion'+urlSearch+'&page=1';
    
            }else{
                bootbox.alert({
                    message: "Debes ingresar el nombre de un archivo o una fecha para realizar una busqueda.",
                    locale: 'mx'
                });
            } 
        });
});