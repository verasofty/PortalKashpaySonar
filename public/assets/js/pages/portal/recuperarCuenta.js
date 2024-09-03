$(function(){
	$('#btn-add').click(function(event) {
        event.preventDefault();        
        var countError = 0;

        $('#contrasenaHelp').html('');
        $('#contrasenaConHelp').html('');

        if ($('#contrasena').val() == '') {
            countError = countError+1;
            $('#contrasenaHelp').html('Campo obligatorio.');
        }
        if ($('#contrasena').val() != $('#contrasenaCon').val()) {
            countError = countError+1;
            $('#contrasenaConHelp').html('Ingresa el mismo valor.');
        }

        if ($('#contrasena').val().length < 4) {
            countError = countError+1;
            $('#contrasenaHelp').html('Ingresa al menos 4 caracteres.');
        }
        
        if ($('#contrasena').val().split(' ').length>=2){
            $('#contrasenaHelp').html('Hay espacios en blanco');
            countError = countError+1;
        }

        if (countError == 0) {
            $.ajax({
                url: base_url+"/recuperarCuenta/updatePassword",
                data: $("#recuperarForm").serialize(),
                type: "post",
                dataType: "json",
                success: function(respuesta){
                    if(respuesta.rows.success == true){
                        bootbox.alert({
                            message: 'Cuenta recuperada exitosamente.',
                            locale: 'mx'
                        });
                        setTimeout("window.location.href = '"+base_url+"'", 3000);
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