$(function(){ 
    $('.dataTables_paginate ').hide(); 
    $('.dataTables_info ').hide(); 

    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();

    $('.buscar').click(function(event) {
        event.preventDefault();
        //var type = $('#typeOperacion').val();
        //var status = $('#estatus').val();
        /*
        SUB165166235394098
        SUB165166235394098
        */
        var type = '';
        var status = '';
        var cuentaOr= '';
        var fechaInicio = '';
        var fechaFin = ''; 
        var urlDate = ''; 
        var countError = 0;

        if ($('#typeOperacion').val() != null) {
            type = $('#typeOperacion').val();
        }else{
            countError = countError+1;
            type = '1,2,3,4';
        }
        if ($('#estatus').val() != null) {
            status = $('#estatus').val();
        }else{
            status = '15,31';
            countError = countError+1;
        }
        if ($('#cuentaOr').val() != null) {
            cuentaOr = $('#cuentaOr').val();
        }
        if ($('.datetimepicker1').val() != '') {
            var splitString = $('.datetimepicker1').val().split(" ");
            fechaInicio = splitString[0]+' '+splitString[1];
            urlDate += '&dateInit='+fechaInicio;
        }else{
            countError = countError+1;
        }
        if ($('.datetimepicker2').val() != '') {
            //fechaIniUrl
            var splitString = $('.datetimepicker2').val().split(" ");
            fechaFin = splitString[0]+' '+splitString[1];
            //fechaFin = $('#datetimepicker2').val();
            urlDate += '&dateFinish='+fechaFin;
        }else{
            countError = countError+1;
        }

        //console.log('urlDate = '+$('.datetimepicker1').val());

        //if (countError == 0) {
            location.href = base_url+'/operacionesEmision?type='+type+'&entidad='+cuentaOr+'&status='+status+'&page=1'+urlDate;
        /*}else{
            bootbox.alert({
                message: "Debe llenar todos los parametros del filtro de busqueda.",
                locale: 'mx'
            });
        }*/
        
       
    });
    $(".limpiar").click(function(event) {
        event.preventDefault();
       $("#form_filtro")[0].reset();
       $("form select").each(function() { this.selectedIndex = 0 });  
       var type = $('#typeOperacion').val();
        var status = $('#estatus').val();
        var hooy = new Date();
        var fecha = '';
        if (hooy.getMonth() < 10) {
            fecha =  hooy.getFullYear() +'-' + '0'+( hooy.getMonth() + 1 ) + '-' +hooy.getDate()  ;
        }else{
            fecha =  hooy.getFullYear() +'-' + ( hooy.getMonth() + 1 ) + '-' +hooy.getDate()  ;
        }
        
       // console.log(fecha);
       location.href = base_url+'/operacionesEmision?type=1,2,3,4&entidad='+entidad+'&status=15,31&page=1&dateInit='+fecha+' 09:03&dateFinish='+fecha+' 09:03';
    });
    $(".select2-multiple").select2({
        placeholder: "",
        allowClear: true
    });
    

});