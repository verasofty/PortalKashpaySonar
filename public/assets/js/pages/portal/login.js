$(function(){
    $( "#btn_login" ).click(function(event){
        event.preventDefault();
        var user = $('#user_login').val();
        var pass = $('#password_login').val();

        var numError = 0;

        if(user == ''){
            $('#error_user').html('Ingresa tu usuario.');
            numError = numError+1;
        }
        if(pass == ''){
            $('#error_pass').html('Ingresa tu contraseña.');
            numError = numError+1;
        }

        if (numError == 0) {
            $.ajax({
                url: base_url+"/login/searchAccount",
                data: $("#form_login").serialize(),
                type: "post",
                dataType: "json",
                beforeSend: function () {
                    $('#cargando').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                },
                success: function(respuesta){
                    $('#cargando').html('');
                    if(respuesta.success == true){
                        if (respuesta.idStatus == 0) {
                            location.href=base_url+'/dashboard';
                        }else if(respuesta.idStatus == 1){
                            bootbox.alert({
                                title: 'Cuenta no verificada',
                                message: 'Primero debes verificar tu cuenta. KashPay envio un correo de verificación a tu correo <b>'+user+'</b>',
                                locale: 'mx'
                            });
                        }else if (respuesta.idStatus == 18){
                            location.href=base_url+'/onbording?validate='+respuesta.validate;
                        }
                        
                    }else{
                        bootbox.alert({
                            message: respuesta.message,
                            locale: 'mx'
                        });
                    }
                }
            });
        }
    });

    $( "#recPass" ).click(function(event){
        event.preventDefault();
        bootbox.dialog({
            message: BootboxContent,
            title: "Recuperar Contraseña",
            buttons: {
                buttonName: {
                    label: "Recuperar",
                    className: "btn-primary",
                    callback: function () {
                        //location.href=base_url+'/gen';
                        $.ajax({
                            url: base_url+"/login/forgotPassword",
                            data: $("#recPass-form").serialize(),
                            type: "post",
                            dataType: "json",
                            success: function(respuesta){
                                if(respuesta.rows.success == true){
                                    bootbox.alert({
                                        //title: 'Tipos de Coloboradores',
                                        message: 'Recibiras un correo con tu contraseña',
                                        locale: 'mx'
                                    });
                                }else{
                                    bootbox.alert({
                                        message: respuesta.rows.error.message,
                                        locale: 'mx'
                                    });
                                }
                            }
                        });
                        
                    }
                      
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-dark'
                }
            }
        });
    });
});