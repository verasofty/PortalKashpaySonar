$(function(){
   console.log('holi222!!');
   $('#divPropina').hide();
   $('#pay_option').show();
   $('#pay_card').hide();
   $('#pay_transfer').hide();
   $('#pay_cash').hide();
   $('#pay_card').hide();
   $('#pay_cash_method').hide();
   $('#pay_trans_method').hide();
   $('.btn-pago').hide();
   $('#info-adicional').show();   
   $('#resumen').hide();   


   if (getOptionPay != '') {
      if(getOptionPay=='card') {
         $('#pay_option').hide();
         $('#pay_card').show();
         $('#paymentMethod').val('3');
      }else if(getOptionPay=='transfer'){
         $('#pay_option').hide();
         $('#pay_transfer').show();
         $('#pay_card').hide();
         $('#paymentMethod').val('2');
         $.ajax({
            url: base_url+'/paymentLink/balance',
            type: "post",
            data: {"validate": idsirio},
            cache: true,
            dataType: "json",
            beforeSend: function () {
                //$("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
               bootbox.dialog({
                     message: '<h4>Cargando información ...</h4>',
                     locale: 'mx'
                  });
            },
            success: function(respuesta){ 
               bootbox.hideAll();
               $('#name_mx').html(respuesta.rows.name);
               $('#copy_mx_clabe').html(respuesta.rows.clabeAccount);
               $('#copy_mx_cel').html(respuesta.rows.phoneNumber);
               $('#copy_mx_clabe').html(respuesta.rows.clabeAccount);
               $('#copy_mx_nc').html(respuesta.rows.virtualAccount);

               $('#name_usa').html(respuesta.rows.name);
               $('#copy_usa_cel').html(respuesta.rows.phoneNumber);
               $('#copy_usa_clabe').html(respuesta.rows.clabeAccount);


            }
         });
      }else if(getOptionPay=='cash'){
         $('#pay_option').hide();
         $('#pay_cash').show();
         $('#pay_card').hide();
         $('#paymentMethod').val('1');
      }else{
         $('#pay_option').show();
         $('#pay_card').hide();
         $('#pay_transfer').hide();
         $('#pay_cash').hide();
         $('#pay_card').hide();
         $('#paymentMethod').val('');
      }
   }else{
      $('#pay_option').show();
      $('#pay_card').hide();
      $('#pay_transfer').hide();
      $('#pay_cash').hide();
      $('#paymentMethod').val('');
   }
  
   //Se valida check de info adicional
   $('#infoAdi').change(function(event) {
      event.preventDefault();
      if( $("#infoAdi").is(':checked')){
         $('#info-adicional').show();
      } else {
         $('#info-adicional').hide();
      }
   });
   // se cambia url para despues de escoger el metodo de pago
   $('.check_option_pay').click(function(event) {
      event.preventDefault();
      var newURL = '&option_pay='+$(this).data('value');
      window.location.href = uri+newURL;
   });
   //seleccion del corresponsal metodo efectivo
   $('.tooltipsCorres').click(function(event) {
      event.preventDefault();
      var imgcorres = $(this).data('imgcorres');
      var namecorres = $(this).data('namecorres');
      $('#pay_cash_method').show();
      $('#pay_cash').hide();
      $('#pay_card').hide();
      $.ajax({
         url: base_url+'/paymentLink/balance',
         type: "post",
         data: {"validate":idsirio},
         cache: true,
         dataType: "json",
         beforeSend: function () {
             //$("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
            bootbox.dialog({
                  message: '<h4>Cargando información</h4>',
                  locale: 'mx'
               });
         },
         success: function(respuesta){ 
            bootbox.hideAll();
            var codeHtml = '<div class="tooltips">'+                     
                        '<label class="circulo">'+ 
                        '<img class="logoPago" src="'+base_url+'/public/assets/img/linkPago/corresponsales/'+imgcorres+'.png">'+
                        '<p>'+namecorres+'</p>'+
                        '</label>'+
                     '</div>';
            var funcionD = "btnSave('"+imgcorres+"',event)";
            var funcionC = "btnEmail('"+imgcorres+"','"+respuesta.rows.clabeAccount+"','"+respuesta.rows.name+"',event)";
            var funcionW = "btnWApp('"+imgcorres+"','"+respuesta.rows.clabeAccount+"','"+respuesta.rows.name+"',event)";
            //var funcionW = "btnWApp('"+imgcorres+"',event)";
            
            switch (imgcorres) {
               case 'telecomm':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-8 col-xs-12">'+ 
                                    '<h5 class="text-center text-black">Depósito a cuenta Citi Banamex</h5>'+ 
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Número de cuenta Citi Banamex</p>'+ 
                                    '<p class="text-center text-info">(Los depósitos con número de cuenta entran como Depósito en efectivo a cuenta de cheques)</p>'+
                                    '<p class="negritas text-center text-18 text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Número de sucursal:</p>'+ 
                                    '<p class="negritas text-center text-18 text-black"><b>6505</b></p>'+
                                    '<p class="text-black text-16"><span class="text-dorado">*</span>Nombre del beneficiario:</p>'+ 
                                    '<p class="negritas text-18 text-center text-dorado">'+respuesta.rows.name+'</p>'+ 
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Cobro de comisión + IVA por depósito.</p>'+                         
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
               case 'farmaciaAhorro':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-8 col-xs-12">'+  
                                    '<h5 class="negritas text-18 text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<h5 class="text-center text-black">Depósito a cuenta Citi Banamex</h5>'+ 
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Cuenta de Cheques, Citi Banamex</p>'+ 
                                    '<p class="text-center text-info">Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados</p>'+
                                    '<p class="negritas text-18 text-center text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Proporciona una referencia alfanumerica</p>'+ 
                                    '<p class="text-center text-info">Ejemplo Ab0123</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Cobro de comisión + IVA por depósito.</p>'+                         
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+   
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
               case 'ley':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-10">'+ 
                                    '<h5 class="text-18 text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<h5 class="text-center text-black">Pago a Tarjeta Citi Banamex</h5>'+ 
                                    '<p class="text-18 text-black">Depósito a cuenta</p>'+ 
                                    '<p class="text-center text-info">Número de referencia: sucursal / número de cuenta</p>'+
                                    '<p class="negritas text-center text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Número de sucursal:</p>'+ 
                                    '<p class="negritas text-center text-black"><b>6505</b></p>'+
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';      
                  break;
               case 'alsuper':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-10">'+ 
                                    '<h5 class="text-18 text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<h5 class="text-center text-black">Pago a Tarjeta Citi Banamex</h5>'+ 
                                    '<p class="text-18 text-black">Depósito a cuenta</p>'+ 
                                    '<p class="text-center text-info">Número de referencia: sucursal / número de cuenta</p>'+
                                    '<p class="negritas text-center text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Número de sucursal:</p>'+ 
                                    '<p class="negritas text-center text-black"><b>6505</b></p>'+
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
               case 'citiBanamex':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-10">'+ 
                                    '<h5 class="text-center text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<p class="text-center text-18 text-black">Deposito a cuenta Citi Banamex</p>'+ 
                                    '<p class="text-16 text-black">Cajeros automáticos</p>'+ 
                                    '<p class=" text-center text-info">Realiza los siguentes pasos para generar un deposito</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">1.-</span>Operaciones sin tarjeta</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">2.-</span>Depositos</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">3.-</span>Efectivo</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">4.-</span>Deposito a cuentas</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Número de sucursal: <b class="negritas">6505</b></p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">*</span>Número de cuenta: <b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">5.-</span>Ingresa monto a depositar</p>'+
                                    '<p class="text-16 text-black"><span class="text-dorado">6.-</span>Confirmar operación</p>'+                    
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
               case '7eleven':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-10">'+ 
                                    '<h5 class="text-18 text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<h5 class="text-center text-black">Depósito a cuenta Citi Banamex</h5>'+ 
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Cuenta de cheques, Citi Banamex</p>'+ 
                                    '<p class="text-center text-info">Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados</p>'+
                                    '<p class="negritas text-center text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Número de sucursal:</p>'+ 
                                    '<p class="negritas text-center text-black"><b>6505</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Cobro de comisión + IVA.</p>'+                         
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
               case 'superFarmacia':
                  codeHtml += '<div class="row">'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                                 '<div class="col-md-12">'+ 
                                    '<h5 class="text-center text-dorado">'+respuesta.rows.name+'</h5>'+ 
                                    '<h5 class="text-center text-black">Depósito a cuenta Citi Banamex</h5>'+ 
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Número de cuenta, Citi Banamex</p>'+ 
                                    '<p class="text-center text-black"><b>'+respuesta.rows.clabeAccount+'</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Número de sucursal:</p>'+ 
                                    '<p class="text-center text-black"><b>6505</b></p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Proporcionar una referencia alfanimerica</p>'+ 
                                    '<p class="text-center text-info">Ejemplo Ab0123</p>'+
                                    '<p class="text-18 text-black"><span class="text-dorado">*</span>Cobro de comisión + IVA.</p>'+                         
                                    '<div class="row">'+
                                       '<div style="height: 50px;"></div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue " onclick="'+funcionD+'">'+
                                          '<i class="fas fa-download"></i></a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue correoCash" onclick="'+funcionC+'" target="_blank">'+
                                          '<i class="fas fa-at"></i>'+
                                          '</a>'+
                                       '</div>'+
                                       '<div class="col-md-4 col-xs-4 text-center">'+
                                          '<a type="button" target="_blank" class="text-blue whatsappCash" onclick="'+funcionW+'">'+
                                          '<i class="fab fa-whatsapp"></i>'+
                                          '</a>'+
                                       '</div>'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2 col-xs-12"></div>'+ 
                              '</div>';
                  break;
            
               default:
                  break;
            }
            $('.selectCorres').html(codeHtml);
                  
         }
      }); 
      //$('.form-corres').append('<input type="hidden" value="'+namecorres+'" name="typeCorrespondient" id="typeCorrespondient">')
      //$('.btn-pago').show();
   });
    
   //pago con transferencia
   $('.tooltipsBancos').click(function(event) {
      event.preventDefault();
      var imgbanco = $(this).data('imgbanco');
      var namebanco = $(this).data('namebanco');
      $('#pay_trans_method').show();
      $('#pay_transfer').hide();



      /*$('.selectBanco').html('<div class="tooltips">'+                     
                                '<label class="circulo">'+ 
                                  '<img class="logoPago" src="'+base_url+'/public/assets/img/linkPago/bancos/'+imgbanco+'.png">'+
                                  '<p>'+namebanco+'</p>'+
                                '</label>'+
                              '</div>');
      $('.form-bancos').append('<input type="hidden" value="'+namebanco+'" name="typeCorrespondient" id="typeCorrespondient">')
      $('.btn-pago').show();*/
   });

   // formato de numero de tarjeta
   $('#numCard').keyup(function() {
      var cc;
      this.value = this.value.replace(/[^0-9]/g,'');
      if ($(this).val().length <= 19) {
         cc = $(this).val().split("-").join("");
         cc = cc.match(new RegExp('.{1,4}$|.{1,4}', 'g')).join("-");
         $(this).val(cc);
      }

   });
   $('#ccv').keyup(function() {
      this.value = this.value.replace(/[^0-9]/g,'');
   });

   //validad campos con pago con tarjeta
   $('#btn-next').click(function(event) {
      event.preventDefault();
      $('#form-pay input:text').css('border','1px solid');
      $('#form-pay input:password').css('border','1px solid');
      $('#form-pay select').css('border','1px solid');
      $('.error').html('');

      var nameCard = $('#nameCard').val();
      var numCard = $('#numCard').val();
      var mm = $('#mm').val();
      var yy = $('#yy').val();
      var ccv = $('#ccv').val();
      var error = 0;
 
      var numCard1 = numCard.replace("-", "");
      var numCard2 = numCard1.replace("-", "");
      var numCard3 = numCard2.replace("-", "");
      var numCardVal = numCard3;

      var address = $('#address').val();
      var ciudad = $('#ciudad').val();
      var cp = $('#cp').val();
      var estado = $('#estado').val();
      var pais = $('#pais').val();


      if (nameCard == '') {
         $('#nameCard').css('border','1px solid red');
         $('#error-name').html('Ingresa el nombre del titular de la tarjeta.');
         error = error+1;
      }
      if (numCardVal == '') {
         $('#numCard').css('border','1px solid red');
         $('#error-card').html('Ingresa el número de tarjeta.');
         error = error+1;
      }
      if (numCardVal.length < 15 || numCardVal.length > 16 ) {
         $('#numCard').css('border','1px solid red');
         $('#error-card').html('El número de la tarjeta debe ser de máximo 16 dígitos y mínimo 15 dígitos.');
         error = error+1;
      }
      if (mm == '') {
         $('#mm').css('border','1px solid red');
         $('#error-mm').html('Selecciona el mes de vencimiento.');
         error = error+1;
      }
      if (yy == '') {
         $('#yy').css('border','1px solid red');
         $('#error-yy').html('Selecciona el año de vencimiento.');
         error = error+1;
      }
      if (mm < mmCurso && yy <=yyCurso) {
         $('#mm').css('border','1px solid red');
         $('#error-mm').html('Tarjeta vencida.');
          $('#yy').css('border','1px solid red');
         $('#error-yy').html('Tarjeta vencida.');
         error = error+1;
      }
      if (ccv == '') {
         $('#ccv').css('border','1px solid red');
         $('#error-ccv').html('Ingresa el ccv.');
         error = error+1;
      }
      if (ccv.length < 3 || ccv.length > 4 ) {
         $('#ccv').css('border','1px solid red');
         $('#error-ccv').html('El ccv debe tener de 3 a 4 dígitos.');
         error = error+1;
      }
      if (address == '') {
         $('#address').css('border','1px solid red');
         $('#error-address').html('Ingresa una direccion');
         error = error+1;
      }
       if (ciudad == '') {
         $('#ciudad').css('border','1px solid red');
         $('#error-ciudad').html('Ingresa una ciudad');
         error = error+1;
      }
       if (cp == '') {
         $('#cp').css('border','1px solid red');
         $('#error-cp').html('Ingresa un estado');
         error = error+1;
      }
       if (estado == '') {
         $('#estado').css('border','1px solid red');
         $('#error-estado').html('Ingresa una direccion');
         error = error+1;
      }
       if (pais == '') {
         $('#pais').css('border','1px solid red');
         $('#error-pais').html('Ingresa un pais');
         error = error+1;
      }
      if (error == 0) {
         $('#verCard').html('****'+numCard.slice(-4));
         $('#verDest').html('****'+cuentaV.slice(-4));
         
         //$('.btn-pago').show();
         $('#form-pay input:text').css('border','1px solid');
         $('#form-pay input:password').css('border','1px solid');
         $('#form-pay select').css('border','1px solid');
         $('.error').html('');
         $('#resumen').show();
         $('#pay_card').hide();
         /*$('html,body').animate({
            scrollTop: $(".areaForm").offset().top
         }, 1000);*/

         //var newURL = '&resumen=1';
         //window.location.href = uri+newURL;

      }
   });

   // boton pagar
   $('#btn-pago').click(function(event) {
      event.preventDefault();
      var url_pay = '';
   
      if (getOptionPay == 'card') {
         url_pay = base_url+'/paymentLink/envio_form?tipo=card';
      }else if (getOptionPay == 'cash') {
         url_pay = base_url+'/paymentLink/envio_form?tipo=cash';
      }else if (getOptionPay == 'transfer') {
         url_pay = base_url+'/paymentLink/envio_form?tipo=transfer';
      }


      $.ajax({
         url: url_pay,
         type: "post",
         data: $('#form-pay').serialize(),
         cache: true,
         dataType: "json",
         beforeSend: function () {
             //$("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
            bootbox.dialog({
                  message: '<h4>Realizando pago...</h4>',
                  locale: 'mx'
               });
         },
         success: function(respuesta){ 
            bootbox.hideAll();

            if (respuesta.success == true) {
               console.log('getOptionPay = ');
               if (getOptionPay == 'card') {
                  var parameters = 'authorizationNumber='+respuesta.authorizationNumber+'|'+
                  respuesta.reference_pay+'|'+respuesta.urlCallback+'|'+respuesta.urlImage+'|'+
                  respuesta.user+'|'+respuesta.email+'|'+respuesta.amount+'|'+respuesta.reference+'|'+respuesta.description+'|'+
                  respuesta.paymentMethod;

                  location.href = 'gracias?reference='+respuesta.reference_pay;
                  //console.log('pagado '+respuesta.email);
               }else {
                  var parameters = 'authorizationNumber=pay_p|'+respuesta.reference_pay+'|'+respuesta.urlCallback+'|'+respuesta.urlImage+'|'+
                  respuesta.user+'|'+respuesta.email+'|'+respuesta.amount+'|'+respuesta.reference+'|'+respuesta.description+'|'+
                  respuesta.paymentMethod+'|'+respuesta.typeCorrespondient;

                  location.href = 'gracias?reference='+respuesta.reference_pay;
                  //console.log('pagado '+respuesta.email);
               }
            }else{
              bootbox.alert({
                  message: respuesta.message,
                  locale: 'mx'
               });
            }
         }
      });      
      
   });


   $("#propina").change(function(event) {
      console.log($(this).val());
      var stringWithoutComma =  $(this).val().replace(/,/g,'')
      var montoFin = (parseFloat(montoGlobal)+parseFloat(stringWithoutComma));
      console.log('montoFin = ('+montoGlobal+'+'+stringWithoutComma+')');
      console.log('montoFin = '+montoFin);
      $('#propinaHide').val(parseFloat(montoFin).toFixed(2));
      $('#verPropina').html('$ '+parseFloat(stringWithoutComma).toFixed(2));
      $('#verTotal').html('$ '+parseFloat(montoFin).toFixed(2));
      $('#propinaMonto').val(parseFloat(stringWithoutComma).toFixed(2));
               
   });
   
   var montoFin = parseFloat(montoGlobal);
         $('#propinaHide').val(montoFin);
         $('#verPropina').html('$ 0.00');
         $('#verTotal').html('$ '+montoFin);
         $('#propinaMonto').val('0');
         console.log('d = ');
         console.log('montoFin = '+montoFin);
         console.log('propina = '+(parseFloat(montoGlobal)*0.30));
         console.log('montoGlobal = '+parseFloat(montoGlobal));
   

   $(".colorcheck").click(function(event) {
      if ($("#propinaOtro").is(":checked")) {
          $('#divPropina').show();
          $('#propina').show();
      } else {
         $('#divPropina').hide();
         var valTipo = $('input[name=checkformColor]:checked', '#form-pay').val();
        // $('#propinaHide').val($(this).val());
         console.log('valTipo = '+valTipo);
         switch (valTipo) {
            case '5':
               var montoFin = ((parseFloat(montoGlobal)*0.05)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.05+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               $('#propinaMonto').val(0.05);
               console.log('propina = '+(parseFloat(montoGlobal)*0.05));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaHide').val(montoFin.toFixed(2));
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.05).toFixed(2));
               $('#verTotal').html('$ '+parseFloat(montoFin).toFixed(2));
               break;
            case '10':
               var montoFin = ((parseFloat(montoGlobal)*0.10)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.10+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.10));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaHide').val(montoFin);
               $('#propinaMonto').val(0.10);
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.10));
               $('#verTotal').html('$ '+parseFloat(montoFin));
               break;
            case '15':
               var montoFin = ((parseFloat(montoGlobal)*0.15)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.15+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.15));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaMonto').val(0.15);

               $('#propinaHide').val(montoFin);
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.15));
               $('#verTotal').html('$ '+parseFloat(montoFin));
               break;
            case '20':
               var montoFin = ((parseFloat(montoGlobal)*0.20)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.20+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.20));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaMonto').val(0.20);
               $('#propinaHide').val(montoFin);
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.20));
               $('#verTotal').html('$ '+parseFloat(montoFin));
               break;
            case '25':
               var montoFin = ((parseFloat(montoGlobal)*0.25)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.25+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.25));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaMonto').val(0.25);
               $('#propinaHide').val(montoFin);
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.25));
               $('#verTotal').html('$ '+parseFloat(montoFin));
               break;
            case '30':
               var montoFin = ((parseFloat(montoGlobal)*0.30)+parseFloat(montoGlobal));
               console.log('montoFin = (('+montoGlobal+'*'+0.30+')+'+parseFloat(montoGlobal)+')');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.30));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               $('#propinaHide').val(montoFin);
               $('#propinaMonto').val(0.30);
               $('#verPropina').html('$ '+(parseFloat(montoGlobal)*0.30));
               $('#verTotal').html('$ '+parseFloat(montoFin));
               break;
            case 'otro':
               var montoFin = (parseFloat(propina)+parseFloat(montoGlobal));
               $('#propinaHide').val(montoFin);
               $('#verPropina').html('$ '+propina);
               $('#verTotal').html('$ '+montoFin);
               $('#propinaMonto').val(propina);
               console.log('otro = ');
               console.log('montoFin = '+montoFin);
               console.log('propina = '+(parseFloat(montoGlobal)*0.30));
               console.log('montoGlobal = '+parseFloat(montoGlobal));
               
               break;
            default:
               
               break;
         }
      }
  });
});
function copyClipboard(element) {
   var $bridge = $("<input>")
   $("body").append($bridge);
   $bridge.val($(element).text()).select();
   document.execCommand("copy");
   $bridge.remove();
}

function btnSave(corresponsal, event){
   console.log('giii');
   html2canvas($(".selectCorres"), {
      onrendered: function(canvas) {
        saveAs(canvas.toDataURL(), corresponsal+'.png');
      }
   });
}

function btnEmail(corresponsal, clabeAccount, username, event){
   event.preventDefault();
   var texto = '*Efectivo a pagar en '+corresponsal+'*\n\n';
   switch (corresponsal) {
      case 'telecomm':
         texto += 'Depósito a cuenta Citi Banamex\n\n'+ 
                  'Número de cuenta Citi Banamex\n'+ 
                  '(Los depósitos con número de cuenta entran como Depósito en efectivo a cuenta de cheques)\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505\n'+
                  'Nombre del beneficiario:\n'+ 
                  username+'\n'+ 
                  'Cobro de comisión + IVA por depósito.';                       
         break;
      case 'farmaciaAhorro':
         texto += username+'\n'+ 
                  'Depósito a cuenta Citi Banamex\n'+ 
                  'Cuenta de Cheques, Citi Banamex\n'+ 
                  'Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados\n'+
                  clabeAccount+'\n'+
                  'Proporciona una referencia alfanumerica\n'+ 
                  'Ejemplo Ab0123\n'+
                  'Cobro de comisión + IVA por depósito.';                      
         break;
      case 'ley':
         texto += username+'\n'+ 
                  'Pago a Tarjeta Citi Banamex\n'+ 
                  'Depósito a cuenta\n'+ 
                  'Número de referencia: sucursal / número de cuenta\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505';      
         break;
      case 'alsuper':
         texto += username+'\n'+ 
                  'Pago a Tarjeta Citi Banamex\n'+ 
                  'Depósito a cuenta\n'+ 
                  'Número de referencia: sucursal / número de cuenta\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505';
         break;
      case 'citiBanamex':
         texto += username+'\n'+ 
                  'Deposito a cuenta Citi Banamex\n'+ 
                  'Cajeros automáticos\n'+ 
                  'Realiza los siguentes pasos para generar un deposito\n'+
                  '1.-Operaciones sin tarjeta\n'+
                  '2.-Depositos\n'+
                  '3.-Efectivo\n'+
                  '4.-Deposito a cuentas\n'+
                  '*Número de sucursal: 6505\n'+
                  '*Número de cuenta: '+clabeAccount+'\n'+
                  '5.-Ingresa monto a depositar\n'+
                  '6.-Confirmar operación'   ;              
              
         break;
      case '7eleven':
         codeHtml += username+'\n'+ 
                     'Depósito a cuenta Citi Banamex\n'+ 
                     '*Cuenta de cheques, Citi Banamex\n'+ 
                     'Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados\n'+
                     clabeAccount+'\n'+
                     '*Número de sucursal:\n'+ 
                     '6505\n'+
                     '*Cobro de comisión + IVA.';                       
                       
         break;
      case 'superFarmacia':
         texto += username+'\n'+ 
                  'Depósito a cuenta Citi Banamex\n'+ 
                  '*Número de cuenta, Citi Banamex\n'+ 
                  clabeAccount+'\n'+
                  '*Número de sucursal:\n'+ 
                  '6505\n'+
                  '*Proporcionar una referencia alfanimerica\n'+ 
                  'Ejemplo Ab0123\n'+
                  '*Cobro de comisión + IVA.';                    
                        
         break;
   
      default:
         break;
   }
               
   window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
}

function btnWApp(corresponsal, clabeAccount, username, event){
   event.preventDefault();
   var texto = '*Efectivo a pagar en '+corresponsal+'*\n\n';
   switch (corresponsal) {
      case 'telecomm':
         texto += 'Depósito a cuenta Citi Banamex\n\n'+ 
                  'Número de cuenta Citi Banamex\n'+ 
                  '(Los depósitos con número de cuenta entran como Depósito en efectivo a cuenta de cheques)\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505\n'+
                  'Nombre del beneficiario:\n'+ 
                  username+'\n'+ 
                  'Cobro de comisión + IVA por depósito.';                       
         break;
      case 'farmaciaAhorro':
         texto += username+'\n'+ 
                  'Depósito a cuenta Citi Banamex\n'+ 
                  'Cuenta de Cheques, Citi Banamex\n'+ 
                  'Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados\n'+
                  clabeAccount+'\n'+
                  'Proporciona una referencia alfanumerica\n'+ 
                  'Ejemplo Ab0123\n'+
                  'Cobro de comisión + IVA por depósito.';                      
         break;
      case 'ley':
         texto += username+'\n'+ 
                  'Pago a Tarjeta Citi Banamex\n'+ 
                  'Depósito a cuenta\n'+ 
                  'Número de referencia: sucursal / número de cuenta\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505';      
         break;
      case 'alsuper':
         texto += username+'\n'+ 
                  'Pago a Tarjeta Citi Banamex\n'+ 
                  'Depósito a cuenta\n'+ 
                  'Número de referencia: sucursal / número de cuenta\n'+
                  clabeAccount+'\n'+
                  'Número de sucursal:\n'+ 
                  '6505';
         break;
      case 'citiBanamex':
         texto += username+'\n'+ 
                  'Deposito a cuenta Citi Banamex\n'+ 
                  'Cajeros automáticos\n'+ 
                  'Realiza los siguentes pasos para generar un deposito\n'+
                  '1.-Operaciones sin tarjeta\n'+
                  '2.-Depositos\n'+
                  '3.-Efectivo\n'+
                  '4.-Deposito a cuentas\n'+
                  '*Número de sucursal: 6505\n'+
                  '*Número de cuenta: '+clabeAccount+'\n'+
                  '5.-Ingresa monto a depositar\n'+
                  '6.-Confirmar operación'   ;              
              
         break;
      case '7eleven':
         codeHtml += username+'\n'+ 
                     'Depósito a cuenta Citi Banamex\n'+ 
                     '*Cuenta de cheques, Citi Banamex\n'+ 
                     'Si tu número en menor a 8 dígitos, ingresa ceros antes del número de cuenta para completar los dígitos solicitados\n'+
                     clabeAccount+'\n'+
                     '*Número de sucursal:\n'+ 
                     '6505\n'+
                     '*Cobro de comisión + IVA.';                       
                       
         break;
      case 'superFarmacia':
         texto += username+'\n'+ 
                  'Depósito a cuenta Citi Banamex\n'+ 
                  '*Número de cuenta, Citi Banamex\n'+ 
                  clabeAccount+'\n'+
                  '*Número de sucursal:\n'+ 
                  '6505\n'+
                  '*Proporcionar una referencia alfanimerica\n'+ 
                  'Ejemplo Ab0123\n'+
                  '*Cobro de comisión + IVA.';                    
                        
         break;
   
      default:
         break;
   }
   window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));          
   //window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
}