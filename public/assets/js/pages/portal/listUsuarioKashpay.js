$(function(){
    $('#idStatus').hide();

    var typeSearch = $('#typeSearch').val();
     if (typeSearch == 1) {
        $('#busqueda').html('Correo Electrónico');
        $('.busqueda').show();
        $('#valueSearch').show();
        $('#idStatus').hide();
        $('#rango').val('');
     }
     if (typeSearch == 2) {
        $('#busqueda').html('Telefóno');
        $('#valueSearch').show();
        $('.busqueda').show();
        $('#idStatus').hide();
        $('#rango').val('');
     }
     if (typeSearch == 3) {
        $('#busqueda').html('Estatus');
        $('#valueSearch').hide();
        $('#idStatus').show();
        $('#rango').val('');
     }
     if (typeSearch == 0 || typeSearch == 4) {
        $('.busqueda').hide();
        $('#valueSearch').val('');
        $('#idStatus').hide();
     }

    $('.dataTables_paginate ').hide(); 
    $('.dataTables_info ').hide(); 

    $('#searchCard').click(function(event) {
        event.preventDefault();
        $('#message').html('');
        $('#example1_wrapper').hide();
        var table = $('#example1').DataTable();
        table.clear().draw();
        var valueSearch = $('#valueSearch').val();
        var typeSearch = $('#typeSearch').val();
        var dateSearch = $('#rango').val();
        $('#info').html('');
        var valueSearch2 = '';
        if (typeSearch == '0') {
            var indice = dateSearch.split(" / ");
            valueSearch = indice[0]; 
            valueSearch2 = indice[1];

        }else if(typeSearch == 1 || typeSearch == 2){
            valueSearch2 = 'na';
        }else if(typeSearch == 4){
            valueSearch2 = 'na';
            valueSearch = 'na-'+$('#idContext').val();
        }else if(typeSearch == 3){
            valueSearch2 = 'na';
            valueSearch = $('#idStatus').val();
        }else{
            $('#message').html('<div class="alert alert-danger" role="alert">Para poder hacer una busqueda necesitas seleccionar el Tipo de busqueda.</div>');
        }

        //if (countError == 0) {
            location.href = base_url+'/usuariosWallet?id_context='+$('#idContext').val()+'&type='+typeSearch+'&value1='+valueSearch+'&value2='+valueSearch2+'&page=1';
        /*}else{
            bootbox.alert({
                message: "Debe llenar todos los parametros del filtro de busqueda.",
                locale: 'mx'
            });
        }*/
        
       
    });

    $("#btnLimpiar").click(function(event) {
        event.preventDefault();
       $("#form_filtro")[0].reset();
       $("form select").each(function() { this.selectedIndex = 0 });  
        var type = 0;
        var status = $('#estatus').val();
       location.href = base_url+'/usuariosWallet?id_context='+contextSearch+'&type='+type+'&value1='+date1Search+'&value2='+date2Search+'&page=1';
    });


    $("#typeSearch").change(function(event){
         var typeSearch = $('#typeSearch').val();

         if (typeSearch == 1) {
            $('#busqueda').html('Correo Electrónico');
            $('.busqueda').show();
            $('#valueSearch').show();
            $('#valueSearch').val('');
            $('#idStatus').hide();
            $('#rango').val('');
         }
         if (typeSearch == 2) {
            $('#busqueda').html('Telefóno');
            $('#valueSearch').show();
            $('#valueSearch').val('');
            $('.busqueda').show();
            $('#idStatus').hide();
            $('#rango').val('');
         }
         if (typeSearch == 3) {
            $('#busqueda').html('Estatus');
            $('.busqueda').show();
            $('#valueSearch').hide();
            $('#idStatus').show();
            $('#rango').val('');
            $('#valueSearch').val('');
         }
         if (typeSearch == 0 || typeSearch == 4) {
            $('.busqueda').hide();
            $('#valueSearch').val('');
            $('#idStatus').hide();
            $('#valueSearch').val('');
         }
    });


    $("#searchCard").click(function(event){
        $('#message').html('');
        var urlSearch = 'usuarios';

        var valueSearch = $('#valueSearch').val();
        var typeSearch = $('#typeSearch').val();
        var dateSearch = $('#rango').val();
        $('#info').html('');
        var valueSearch2 = '';
        if (typeSearch == '0') {
            var indice = dateSearch.split(" / ");
            valueSearch = indice[0]; 
            valueSearch2 = indice[1];
        }else if(typeSearch == 1 || typeSearch == 2){
            valueSearch2 = '';
        }else if(typeSearch == 3){
            valueSearch2 = 'na';
            valueSearch = $('#idStatus').val();
        }else{
            $('#message').html('<div class="alert alert-danger" role="alert">Para poder hacer una busqueda necesitas seleccionar el Tipo de busqueda.</div>');
        }
        if (valueSearch.length >= 1) {
            if (contextSearch == 0) {
                location.href = base_url+'/usuariosWallet?id_context='+$('#idContext').val()+'&type='+typeSearch+'&value1='+valueSearch+'&value2='+valueSearch2+'&page=1';
            }else{
                location.href = base_url+'/usuariosWallet?id_context='+$('#idContext').val()+'&type='+typeSearch+'&value1='+valueSearch+'&value2='+valueSearch2+'&page=1';
            }
            
        }
        
    });

//ACCIONES MASIVAS
    var usuarios = [];
    var usuarioSelect = '';
    var emailSelect = '';
    var str;
    var str2;

    $( ".selectMasivo" ).click(function(event){
        
        if( $(this).prop('checked') ) {
            usuarioSelect+=$(this).val()+',';
            emailSelect+=$(this).data('email')+',';
            //usuarios.push($(this).val());
            console.log('val = '+$(this).val());
        }else{
            console.log('no');
            usuarioSelect = usuarioSelect.replace($(this).val()+',',"");
            emailSelect = emailSelect.replace($(this).data('email')+',',"");
        }
        str = emailSelect.slice(0, -1);
        str2 = usuarioSelect.slice(0, -1);
        console.log(str);
        console.log(str2);
    });

    $("#actionsMas").change(function(event){
        var accion = $('#actionsMas').val();

        if (accion == 1) {
            //eliminar
            bootbox.dialog({
                message: "¿Seguro que desea eliminar estos usuarios?",
                title: "Eliminar usuario",
                buttons: {
                   buttonName: {
                      label: "Si",
                      className: "btn-primary",
                      callback: function () {
                        event.preventDefault(); 
                          $.ajax({
                            url: base_url+"/usuariosWallet/accionesMasivas/"+str+'/'+str2+'/'+accion,
                            type : "GET",
                            dataType : "json",
                            success:function(respuesta){
                              if (respuesta.rows.success == true) { 
                                bootbox.alert('El usuarios se elimino con exito.');
                                //location.href = base_url+'/usuarios';
                              }else{
                                bootbox.alert('Ocurrio un error al eliminar el usuario.');
                                return false;
                              }
                             
                            }
                          });
                      }
                          
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-dark'
                    }
                }
            });
        }else if (accion == 2) {
            //reprocesar
            bootbox.dialog({
                message: "¿Seguro que desea reprosesar el registro de estos usuarios?",
                title: "Reprosesar Registro",
                buttons: {
                   buttonName: {
                      label: "Si",
                      className: "btn-primary",
                      callback: function () {
                        event.preventDefault(); 
                          $.ajax({
                            url: base_url+"/usuariosWallet/accionesMasivas/"+str+'/'+str2+'/'+accion,
                            type : "GET",
                            dataType : "json",
                            /*beforeSend: function () {
                              bootbox.alert('El reproceso del registro se realizo con exito.');
                              //$("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/dist/img/loading.gif">');
                            },*/
                            success:function(respuesta){
                              if (respuesta.rows.success == true) { 
                                bootbox.alert('El reproceso del registro se realizo con exito.');
                                //location.href = base_url+'/usuarios';
                              }else{
                                bootbox.alert('Ocurrio un error con el reproceso del registro.');
                                return false;
                              }
                             
                            }
                          });
                      }
                          
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-dark'
                    }
                }
              });
        }
    });


    
});