$(function(){ 
    $('.dataTables_paginate ').hide(); 
    $('.dataTables_info ').hide(); 

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
        var fechaInicio = '';
        var fechaFin = ''; 
        var urlDate = ''; 
        var countError = 0;

        if ($('#typeOperacion').val() != null) {
            type = $('#typeOperacion').val();
        }else{
            countError = countError+1;
            type = '1,10007';
        }
        if ($('#estatus').val() != null) {
            status = $('#estatus').val();
        }else{
            status = '15';
            countError = countError+1;
        }
        if ($('#datetimepicker1').val() != '') {
            var splitString = $('#datetimepicker1').val().split(" ");
            fechaInicio = splitString[0]+' '+splitString[1];
            urlDate += '&dateInit='+fechaInicio;
        }else{
            countError = countError+1;
        }
        if ($('#datetimepicker2').val() != '') {
            //fechaIniUrl
            var splitString = $('#datetimepicker2').val().split(" ");
            fechaFin = splitString[0]+' '+splitString[1];
            //fechaFin = $('#datetimepicker2').val();
            urlDate += '&dateFinish='+fechaFin;
        }else{
            countError = countError+1;
        }

        //if (countError == 0) {
            location.href = base_url+'/operaciones?type='+type+'&status='+status+'&page=1'+urlDate;
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
       location.href = base_url+'/operaciones?type=10007,1&status=15&page=1';
    });
    $(".select2-multiple").select2({
        placeholder: "",
        allowClear: true
    });
    $('#datetimepicker1').datetimepicker();
    

    $('#datetimepicker2').datetimepicker();

});