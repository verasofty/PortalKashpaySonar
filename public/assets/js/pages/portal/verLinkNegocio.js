$(function(){
    $(".whatsapp_mx").click(function(event) {
        event.preventDefault();
        var texto = '*Mi Link de Negocio*\n\n'+
                    $('#texto_a_copiar').text();
        
        window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));          
        
        //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
        //window.location.href = uri+newURL;
    
        
      
    });
    $(".email_mx").click(function(event) {
        event.preventDefault();
        var texto = '*Mi Link de Negocio*\n\n'+
                    $('#texto_a_copiar').text();
        
        window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));

        //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
        //window.location.href = uri+newURL;
    
        
      
      });

    $('#btn-add').click(function(event) {

        var countError = 0;

        $('#nombreHelp').html('');
        $('#apaternoHelp').html('');
        $('#amaternoHelp').html('');
        $('#emailHelp').html('');
        $('#telHelp').html('');
        $('#conceptoHelp').html('');
        $('#montoHelp').html('');
        $('#referenciaHelp').html('');
        $('#logoHelp').html('');
        $('#fechaVigHelp').html('');
        $('#horarioHelp').html('');
        

        var nombre = $('#nombre').val();
        var aPaterno = $('#apaterno').val();
        var aMaterno = $('#amaterno').val();
        var email = $('#email').val();
        var tel = $('#tel').val();
        var referencia = $('#referencia').val();
        var monto = $('#monto').val();
        var concepto = $('#concepto').val();
        var fechaVig = $('#fechaVig').val();
        var horario = $('#horario').val();

        if (horario == '') {
            countError = countError+1;
            $('#horarioHelp').html('Campo obligatorio.');
        }
        if (fechaVig == '') {
            countError = countError+1;
            $('#fechaVigHelp').html('Campo obligatorio.');
        }
        if (monto == '') {
            countError = countError+1;
            $('#montoHelp').html('Campo obligatorio.');
        }
        if (nombre == '') {
            countError = countError+1;
            $('#nombreHelp').html('Campo obligatorio.');
        }
        if (aPaterno == '') {
            countError = countError+1;
            $('#apaternoHelp').html('Campo obligatorio.');
        }
        if (aMaterno == '') {
            countError = countError+1;
            $('#amaternoHelp').html('Campo obligatorio.');
        }
        if (concepto == '') {
            countError = countError+1;
            $('#conceptoHelp').html('Campo obligatorio.');
        }
        if (email == '') {
            countError = countError+1;
            $('#emailHelp').html('Campo obligatorio.');
        }
        if (referencia == '') {
            countError = countError+1;
            $('#referenciaHelp').html('Campo obligatorio.');
        }
        if (tel == '') {
            countError = countError+1;
            $('#telHelp').html('Campo obligatorio.');
        }

        if (countError == 0) {
            var files = $('#logo')[0].files[0];
            formData.append('logo',files);
            formData.append('nombre',nombre);
            formData.append('referencia',referencia);
            formData.append('apaterno',aPaterno);
            formData.append('amaterno',aMaterno);
            formData.append('email',email);
            formData.append('tel',tel);
            formData.append('concepto',concepto);
            formData.append('monto',monto);
            formData.append('fechaVig',fechaVig);
            formData.append('horario',horario);
            $.ajax({
                url: base_url+"/addLinkPago/addLink",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
                    //alert(respuesta);
                    if(respuesta.rows.success == true){
                        bootbox.alert({
                            message: "Link de pago creado exitosamente.",
                            locale: 'mx'
                        });
                        var fecha = respuesta.rows.payOrderResponse.formUrl.split('?reference=');   
                        var referencia2 = fecha[1];                                   
                        var referencia = "'"+base_url+"/detalleLinkpago?referencia="+fecha[1]+"'";                 
                        console.log('referencia = '+referencia);
                        
                        setTimeout("window.location.href ="+referencia, 3000);
                        //setTimeout("window.location.href = '"+base_url+"/detalleLinkpago?referencia='", 3000);

                        //console.log('url = '+fecha);
                       // console.log('url = '+fecha[1]);
                        /*$("#formulario").hide();

                        $("#btn-link").html('<a target="_blank" href="'+respuesta.rows.payOrderResponse.formUrl+'" class="btn btn-danger">'+respuesta.rows.payOrderResponse.formUrl+'</a>');
                        $("#whats").html('<a target="_blank" href="https://api.whatsapp.com/send?text='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-whatsapp"></i></a>');
                        $("#twitter").html('<a target="_blank" href="https://twitter.com/intent/tweet?text='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-twitter"></i></a>');
                        $("#face").html('<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-facebook"></i></a>');
                        $("#texto_a_copiar").html('<a target="_blank" href="'+respuesta.rows.payOrderResponse.formUrl+'" class="btn btn-link">'+respuesta.rows.payOrderResponse.formUrl+'</a>');
                        
                        $("#informacion").show();*/
                    }else{
                        bootbox.alert({
                            message: 'Ocurrio un error al crear el link de pago, por favor intentalo mas tarde.',
                            locale: 'mx'
                        });
                    }
                }
            });
        }
        
    });
});
function copyClipboard(element) {
  var $bridge = $("<input>")
  $("body").append($bridge);
  $bridge.val($(element).text()).select();
  document.execCommand("copy");
  $bridge.remove();
}