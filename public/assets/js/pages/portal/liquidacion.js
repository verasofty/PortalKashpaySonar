$(function(){
    $(".buscar").click(function(event){
        $.ajax({
            url: base_url+"/liquidacion/searchOperations",
            data: $("#form_filtro").serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function () {
               
            },
            success: function(data1){ 
                var table = $('#example1').DataTable();
                 table.clear().draw();   
                 if(data1.rows.success == true){
                    var data = Array();
                    for(var i=0;i<data1.rows.operations.length;i++){
                        var vtnDetalle = '<a href="detalleTransaccion" class="btn btn-primary btn-block ">Ver detalle</a>';
                        
                        var datadni = [
                            data1.rows.operations[i].amount,
                            data1.rows.operations[i].authorizationNumber,
                            data1.rows.operations[i].card,
                            data1.rows.operations[i].authorizationRrcext,
                            data1.rows.operations[i].authorizationDate,
                            data1.rows.operations[i].status,
                            data1.rows.operations[i].institution,
                            data1.rows.operations[i].brand,
                            data1.rows.operations[i].nature,
                            data1.rows.operations[i].entity,
                            data1.rows.operations[i].terminal,
                            data1.rows.operations[i].transactiontype,
                            data1.rows.operations[i].entryMode,
                            data1.rows.operations[i].additionalAmount,
                            data1.rows.operations[i].responseDescription,
                            data1.rows.operations[i].qtPay,
                            data1.rows.operations[i].planId,
                            data1.rows.operations[i].graceNumber,
                            data1.rows.operations[i].concept,
                            data1.rows.operations[i].bin,
                            data1.rows.operations[i].send_Sirio,
                            data1.rows.operations[i].iva,
                            data1.rows.operations[i].commission1,
                            data1.rows.operations[i].commission2,
                            data1.rows.operations[i].entityOperationId,
                            data1.rows.operations[i].transactionBuilder,
                            vtnDetalle
                        ];

                      //      data1.rows.operations[i].amount.toFixed(2),
                                 data.push (datadni);
                        
                    
                    }
                    table.rows.add(data).draw();
                 }
                }
            });   

    }); 
 });
