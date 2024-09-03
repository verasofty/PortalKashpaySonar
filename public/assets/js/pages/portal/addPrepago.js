$(function(){
    $("#informacion").slideUp();
    $("#fechaVig").datepicker({
        minDate: hoy,
        dateFormat: "yy-mm-dd"
    });
    $('#horario').timepicker({
        beforeShow: function(input, inst) {
            var newclass = 'allcp-form';
            var themeClass = $(this).parents('.allcp-form').attr('class');
            var smartpikr = inst.dpDiv.parent();
            if (!smartpikr.hasClass(themeClass)) {
                inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
            }
        }
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
            formData.append('nombre',nombre);
            formData.append('referencia',referencia);
            formData.append('apaterno',aPaterno);
            formData.append('amaterno',aMaterno);
            formData.append('email',email);
            formData.append('tel',tel);
            formData.append('concepto',concepto);
            formData.append('monto',monto);
            $.ajax({
                url: base_url+"/addPrepago/addLink",
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
                            message: "Checkout creado exitosamente.",
                            locale: 'mx'
                        });
                        setTimeout("window.location.href = '"+respuesta.rows.payOrderResponse.formUrl+"'", 3000);

                        /*$("#formulario").hide();
                        $("#btn-link").html('<a target="_blank" href="'+respuesta.rows.payOrderResponse.formUrl+'" class="btn btn-danger">'+respuesta.rows.payOrderResponse.formUrl+'</a>');
                        $("#whats").html('<a target="_blank" href="https://api.whatsapp.com/send?text='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-whatsapp"></i></a>');
                        $("#twitter").html('<a target="_blank" href="https://twitter.com/intent/tweet?text='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-twitter"></i></a>');
                        $("#face").html('<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+respuesta.rows.payOrderResponse.formUrl+'" style="font-size:30pt;"><i class="fab fa-facebook"></i></a>');
                        $("#texto_a_copiar").html('<a target="_blank" href="'+respuesta.rows.payOrderResponse.formUrl+'" class="btn btn-link">'+respuesta.rows.payOrderResponse.formUrl+'</a>');
                        $("#informacion").show();*/
                    }else{
                        bootbox.alert({
                            message: respuesta.rows.error.message,
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