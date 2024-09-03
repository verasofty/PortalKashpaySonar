$(function(){
    
    $('#btn-add').click(function(event) {

        var countError = 0;

        $('#conceptoHelp').html('');
        $('#montoHelp').html('');
        
        var monto = $('#monto').val();
        var concepto = $('#concepto').val();

        if (monto == '') {
            countError = countError+1;
            $('#montoHelp').html('Campo obligatorio.');
        }
        if (concepto == '') {
            countError = countError+1;
            $('#conceptoHelp').html('Campo obligatorio.');
        }
        
        if (countError == 0) {
            $.ajax({
                url: base_url+"/linkNegocio/addLink",
                data: $("#form-pay").serialize(),
                type: "post",
                dataType: "json",
                success: function(respuesta){
                    //alert(respuesta);
                    if(respuesta.rows.success == true){
                        bootbox.alert({
                            message: "Link de pago creado exitosamente.",
                            locale: 'mx'
                        });
                        var fecha = respuesta.rows.payOrderResponse.formUrl.split('?reference=');   
                        var referencia2 = fecha[1];                                   
                        var referencia = "'"+base_url+"/paymentLink?reference="+fecha[1]+"'";                 
                        console.log('referencia = '+referencia);
                        
                        setTimeout("window.location.href ="+referencia, 1000);
                        
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