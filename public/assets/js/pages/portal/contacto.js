$(function(){
	$('#btn-add').click(function(event) {
        event.preventDefault();        
       /* var countError = 0;

        $('#nombreHelp').html('');
        $('#emailHelp').html('');
        $('#telHelp').html('');
        $('#contrasenaHelp').html('');                
        $('#contrasenaConHelp').html('');                
        $('#g-recaptcha-error').html('');                

        var nombre = $('#nombre').val();
        var email = $('#email').val();
        var tel = $('#tel').val();
        var contrasena = $('#contrasena').val();
        var contrasenaCon = $('#contrasenaCon').val();

        var response = grecaptcha.getResponse();
    
        if (nombre == '') {
            countError = countError+1;
            $('#nombreHelp').html('Campo obligatorio.');
        }
        if (email == '') {
            countError = countError+1;
            $('#emailHelp').html('Campo obligatorio.');
        }
        if (tel == '') {
            countError = countError+1;
            $('#telHelp').html('Campo obligatorio.');
        }
        if (contrasena == '') {
            countError = countError+1;
            $('#contrasenaHelp').html('Campo obligatorio.');
        }
        if (contrasena != contrasenaCon) {
            countError = countError+1;
            $('#contrasenaConHelp').html('Ingresar mismo valor.');
        }
        if(response.length == 0) {
            countError = countError+1;
            document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Campo obligatorio.</span>';
            return false;
        }

        if (countError == 0) {*/
            $.ajax({
                url: base_url+"/contacto/sendMail",
                data: $("#registroForm").serialize(),
                type: "post",
                dataType: "json",
                success: function(respuesta){
                    //alert(respuesta);
                    if(respuesta == 'ok'){
                        location.href = base_url+'/successRegistro'
                    }else{
                        bootbox.alert({
                            message: respuesta.rows.error.message,
                            locale: 'mx'
                        });
                    }
                }
            });
        //}
           
    });
    
});