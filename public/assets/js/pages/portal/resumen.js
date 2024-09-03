$(function(){
	/*$('.ver_mas').click(function(event) {
        event.preventDefault();    
        var id =  $(this).data("id"); 
        $.ajax({
            url: base_url+"/resumen/search/"+id,
            //url: base_url+"/resumen/searchSucursal/SUB106",
            data: '',
            type: "post",
            dataType: "json",
            success: function(data1){
                if(data1.success == '1'){
                    
                    var rows = '';
                    var data = Array();
                    for (var i=0; i < data1.rows.length ; i++) { 
                        tr ='<tr>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                                '<td>'+data1.rows[i].id+'</td>'+
                            '</tr>';
                        $("#principal_"+id).after(tr);
                    }               
                }else{
                    bootbox.alert({
                        message: data1.rows,
                        locale: 'mx'
                    });
                }
            }
        });      
    });*/  

   
});
function verComision(id, event){
    $.ajax({
        url: base_url+"/resumen/searchComision/"+id,
        data: '',
        type: "post",
        dataType: "json",
        success: function(data1){
            console.log(data1);
            visaTPD = 0;
            visaED = 0;
            visaTPC =0;
            visaEC = 0;  

            masterTPD = 0;
            masterED = 0;
            masterTPC = 0;
            masterEC = 0;

            amexTPD = 0;
            amexED = 0;
            amexTPC = 0;
            amexEC = 0;

            valesTPD = 0;
            valesED = 0;
            valesTPC = 0;
            valesEC = 0;

            interTPD = 0;
            interED = 0;
            interTPC = 0;
            interEC = 0;

            for (var i = 0; i<data1.length; i++) {
                //visa
                if (data1[i].operationType == 22) {
                  //tarjeta presente
                  if (data1[i].cardCondition == 'CardPresent') {
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      visaTPD = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      visaTPC = (data1[i].percentage/100).toFixed(2);
                      
                    }
                  //ecommerce
                  }else{
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      visaED =  (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      visaEC =  (data1[i].percentage/100).toFixed(2);
                    }
                  }
                }
                //mc
                if (data1[i].operationType == 27) {
                  //tarjeta presente
                  if (data1[i].cardCondition == 'CardPresent') {
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      masterTPD = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      masterTPC = (data1[i].percentage/100).toFixed(2);
                    }
                  //ecommerce
                  }else{
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      masterED = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      masterEC = (data1[i].percentage/100).toFixed(2);
                    }
                  }
                }
                //amex
                if (data1[i].operationType == 23) {
                  //tarjeta presente
                  if (data1[i].cardCondition == 'CardPresent') {
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      amexTPD = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      amexTPC = (data1[i].percentage/100).toFixed(2);
                    }
                  //ecommerce
                  }else{
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      amexED = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      amexEC = (data1[i].percentage/100).toFixed(2);
                    }
                  }                   
                }
                //vales
                if (data1[i].operationType == 56) {
                  if (data1[i].cardCondition == 'CardPresent') {
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      valesTPD = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      valesTPC = (data1[i].percentage/100).toFixed(2);
                    }
                  //ecommerce
                  }else{
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      valesED = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      valesEC = (data1[i].percentage/100).toFixed(2);
                    }
                  } 
                }
                //inter
                if (data1[i].operationType == 57) {
                  if (data1[i].cardCondition == 'CardPresent') {
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      interTPD = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      interTPC = (data1[i].percentage/100).toFixed(2);
                    }
                  //ecommerce
                  }else{
                    //debito
                    if (data1[i].accountabilityNature == 'Debit') {
                      interED = (data1[i].percentage/100).toFixed(2);
                    //credito
                    }else{
                      interEC = (data1[i].percentage/100).toFixed(2);
                    }
                  } 
                }
                
            }
            bootbox.alert({
                title: 'Comisiones',
                message: '<h6>Tarjeta Presente Débito</h6> <br> '+
                '1.- Venta Visa: '+visaTPD+' % <br>2.- Venta Mastercard: '+masterTPD+' % <br>3.- Venta Amex: '+amexTPD+' % <br>4.- Venta Vales: '+valesTPD+' % <br>5.- Venta Internacional: '+interTPD+' % <br><br>'+
                '<h6>Ecommerce Débito</h6><br>'+
                '1.- Venta Visa: '+visaED+' % <br>2.- Venta Mastercard: '+masterED+' % <br>3.- Venta Amex: '+amexED+' % <br>4.- Venta Vales: '+valesED+' % <br>5.- Venta Internacional: '+interED+' % <br><br>'+
                '<h6>Tarjeta Presente Crédito</h6> <br> '+
                '1.- Venta Visa: '+visaTPC+' % <br>2.- Venta Mastercard: '+masterTPC+' % <br>3.- Venta Amex: '+amexTPC+' % <br>4.- Venta Vales: '+valesTPC+' % <br>5.- Venta Internacional: '+interTPC+' % <br><br>'+
                '<h6>Ecommerce Crédito</h6><br>'+
                '1.- Venta Visa: '+visaEC+' % <br>2.- Venta Mastercard: '+masterEC+' % <br>3.- Venta Amex: '+amexEC+' % <br>4.- Venta Vales: '+valesEC+' % <br>5.- Venta Internacional: '+interEC+' % <br><br>',
                locale: 'mx'
            });
        }
    });
}
function vermas(id, event){
    event.preventDefault();   
    
    $.ajax({
        url: base_url+"/resumen/search/"+id,
        data: '',
        type: "post",
        dataType: "json",
        success: function(data1){
            if(data1.success == '1'){
                var rows = '';
                var data = Array();
                console.log(data1.rows);
                for (var i=0; i < data1.rows.length ; i++) { 
                    Cifra = new Intl.NumberFormat( "en-US", { maximumFractionDigits: 2, currency: 'USD',style: 'currency' } ).format( data1.rows[i].customerNetworkBalance );
                    OtraCifra = new Intl.NumberFormat( "en-US", { maximumFractionDigits: 2, currency: 'USD',style: 'currency' } ).format( data1.rows[i].balance );

                    var parametro = "'"+data1.rows[i].id+"'";
                    tr ='<tr id="principal_'+data1.rows[i].id+'">'+
                            '<td>'+data1.rows[i].name+'</td>'+
                            '<td>'+Cifra+'</td>'+
                            '<td>'+OtraCifra +'</td>'+
                            '<td>'+
                                '<div class="btn-group">'+
                                    '<a id="ver_comision_'+data1.rows[i].id+'" onclick="verComision('+parametro+',event)" href="#" class="btn btn-primary">'+
                                        '<i class="fas fa-hand-holding-usd"></i>'+
                                    '</a>'+
                                '</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="btn-group">'+
                                    '<a id="ver_mas_'+data1.rows[i].id+'" onclick="vermas('+parametro+',event)" href="#" class="btn btn-info">'+
                                        '<i class="fa fa-plus"></i>'+
                                    '</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>';
                    $("#principal_"+id).after(tr);
                    $('#ver_mas_'+id).prop("onclick", null).off("click");
                    $('#ver_mas_'+id).hide();
                }                          
            }else{
                bootbox.alert({
                    message: data1.rows,
                    locale: 'mx'
                });
            }
        }
    }); 
}

function numbCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    /*
Cifra = new Intl.NumberFormat( "es-AR", { maximumFractionDigits: 0 } ).format( valor );

OtraCifra = new Intl.NumberFormat( "es-AR", { maximumFractionDigits: 2 } ).format( valor );
    console.log( x, 
  Math.trunc( 
    parseFloat( 
      x
        .replace(".", "") // miles
        .replace(",", ".") // decimales
    )
  )
);*/
}

function currencyFormatter({ currency, value}) {
  const formatter = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 2,
    currency: 'USD',
    style: 'currency'
  }) ;
  
  return formatter.format(value);
}
