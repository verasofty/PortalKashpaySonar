$(function(){
    
    /*bootbox.alert({
        title: '¡Importante!',
        message: 'PARA REALIZAR DISPERSIÓN MASIVA A CUENTAS KASH EL ARCHIVO DEBE CONTENER:<br><br> '+
        '1. El archivo debe tener extensión .txt<br>'+
        '2. El nombre del archivo a procesar debe ser el siguiente:<br>'+
        'Donde:<br><br> <center><b>CARGATRN_250112.txt</b></center> <br> CARGATRN - Número de prefijo<br> 250112 - Número de afiliación <br> .txt - Tipo de archivo',
        locale: 'mx'
    });*/


    $('#btn-add').click(function(event) {

        console.log('hdhdh');

            var formData = new FormData(document.getElementById("form_nomina"));
            //formData.append("dato", "valor");
        console.log('hi');

        if ($('#customFile').val() != '') {        

            $.ajax({
                url: base_url+"/dispersion/cargarArchivo",
                type: "post",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
                        if (respuesta == '0') {
                            bootbox.alert({
                                message: 'Error en el proceso de carga. Consulte al administrador',
                                locale: 'mx'
                            });
                        }else if (respuesta == '1') {
                            bootbox.alert({
                                message: 'Sólo de permiten archivos .csv',
                                locale: 'mx'
                            });
                        }else{
                            var nameArch = document.getElementById('customFile').files[0].name;
                            var splitString = nameArch.split(".");

                            var nombreFile = 'CARGATRN_'+$('#afiliacion').val()+'_'+$('#dateTime').val()+'.csv';
                            console.log('nombreFile = '+nombreFile);
                            var msg = '<div>'+
                                  '<div>'+
                                      "<h3><i class='fas fa-check-circle' style='color:#13b313'></i> Dispersión cargada con exito.</h3><p>Tomará algunos minutos procesar el archivo, al finalizar podrás consultarlo en la opción del Menu Estatus dispersión con el nombre <b>"+nombreFile+"</b>.</p>"+
                                  '</div>'+
                                  
                               '</div>';
                            bootbox.dialog({
                                title: "Dispersión Masiva",
                                message: msg,
                                onEscape: true,
                                backdrop: true,
                                buttons: {
                                    confirm: {
                                        label: 'OK',
                                        className: 'btn-primary',
                                        callback: function(){
                                          bootbox.hideAll();
                                          setTimeout("window.location.href = '"+base_url+"/dispersion'", 1000);
                                        }
                                    }
                                }
                            });
                            
                            //setTimeout("window.location.href = '"+base_url+"/nomina'", 5000);
                        }                        
                }
            });
        
        }else{
            bootbox.alert({
                message: 'Selecciona el archivo que deseas cargar.',
                locale: 'mx'
            });
        }
    });


});