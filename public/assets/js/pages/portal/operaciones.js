$(function(){  
    $('#page').val(pagePaginador);
    $('.page-link').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: base_url+"/operaciones/searchResult/"+$(this).data("page"),
            data: $('#form_filtro').serialize(),
            type: "post",
            dataType: "json",
            success: function(data1){
                var table = '';
                $('#rowsTrasnsacciones').html('');
                $('#page').val($(this).data("page"));
                console.log(data1.response.operations);
                for (var i =0 ; i < data1.response.operations.length; i++) {
                    table +='<tr>'+
                              '<td>'+data1.response.operations[i].id+'</td>'+
                              '<td>'+data1.response.operations[i].type+'</td>'+
                              '<td>'+data1.response.operations[i].amount+'</td>'+
                              '<td>'+data1.response.operations[i].status+'</td>'+
                              '<td>'+data1.response.operations[i].responseCode+'</td>'+
                              '<td>'+data1.response.operations[i].numericReference+'</td>'+
                              '<td>'+data1.response.operations[i].alphanumericReference+'</td>'+
                              '<td>'+data1.response.operations[i].description+'</td>'+
                              '<td>'+data1.response.operations[i].targetName+'</td>'+
                              '<td>'+data1.response.operations[i].targetID+'</td>'+
                              '<td>'+data1.response.operations[i].targetIDCode+'</td>'+
                              '<td>'+data1.response.operations[i].targetEmail+'</td>'+
                              '<td>'+data1.response.operations[i].internalReference+'</td>'+
                            '</tr>';
                }
                $('#rowsTrasnsacciones').html(table);
                bootbox.alert({
                    message: 'hola',
                    locale: 'mx'
                });
            }
        }); 
    });

    $('.buscar').click(function(event) {
        $('#page').val('0');
        event.preventDefault();
        $.ajax({
            url: base_url+"/operaciones/search",
            data: $('#form_filtro').serialize(),
            type: "post",
            dataType: "json",
            success: function(data1){
                var table = '';
                $('#rowsTrasnsacciones').html('');
3                for (var i =0 ; i < data1.response.operations.length; i++) {
                    table +='<tr>'+
                              '<td>'+data1.response.operations[i].id+'</td>'+
                              '<td>'+data1.response.operations[i].type+'</td>'+
                              '<td>'+data1.response.operations[i].amount+'</td>'+
                              '<td>'+data1.response.operations[i].status+'</td>'+
                              '<td>'+data1.response.operations[i].responseCode+'</td>'+
                              '<td>'+data1.response.operations[i].numericReference+'</td>'+
                              '<td>'+data1.response.operations[i].alphanumericReference+'</td>'+
                              '<td>'+data1.response.operations[i].description+'</td>'+
                              '<td>'+data1.response.operations[i].targetName+'</td>'+
                              '<td>'+data1.response.operations[i].targetID+'</td>'+
                              '<td>'+data1.response.operations[i].targetIDCode+'</td>'+
                              '<td>'+data1.response.operations[i].targetEmail+'</td>'+
                              '<td>'+data1.response.operations[i].internalReference+'</td>'+
                            '</tr>';
                }
                $('#rowsTrasnsacciones').html(table);
                
            }
        }); 
    });

});
