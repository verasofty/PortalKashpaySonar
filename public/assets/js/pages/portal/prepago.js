$(function(){
   $('.backPrepago').click(function(event) {
      var msg = "<p>Al salir se perdera el proceso que se esta realizando</p>";
      bootbox.dialog({
         title: "¿Deseas salir?",
         message: msg,
         onEscape: true,
         backdrop: true,
         buttons: {
            confirm: {
               label: 'Aceptar',
               className: 'btn-azul',
               callback: function(){
                  bootbox.hideAll();
                  //$("#form-kash")[0].reset();
                  $("form input").each(function() { this.selectedIndex = 0 });  
                  $("form select").each(function() { this.selectedIndex = 0 });  
                  setTimeout("window.location.href = '"+base_url+"/addPrepago'", 3000);
                  
               }
            },
            cancel: {
               label: 'Cancelar',
               className: 'btn-grey',
               callback: function(){
                     bootbox.hideAll();
               }
            }
         }
      });
   });

   var infoCards = [];
   $('.btn-pago').hide();
   $.ajax({
      url: base_url+'/prepago/searchCard',
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
         console.log(respuesta);
         if (respuesta.cards.length > 0) {
            infoCards = respuesta.cards;
            for (let iC = 0; iC < respuesta.cards.length; iC++) {
               //const element = array[index];
               var restCard = respuesta.cards[iC].card.substr(-4);
               if (typeof respuesta.cards[iC].urlImg !== 'undefined') {
                  var urlCardImg = respuesta.cards[iC].urlImg;
               } else {
                  var urlCardImg = base_url+'/public/assets/img/iconos/Iconos/Pagos en portal/ic_card.png';
               }
               $('#id_select2_example').append($('<option data-img_src="'+urlCardImg+'">').val(respuesta.cards[iC].id).text('****'+restCard));
               
            }
         } else {
            
         }
         //var restCard = substr($cards[$iCards]->card, -4);
         //var imgcard = (cards[$iCards]->urlImg) ? $cards[$iCards]->urlImg : base_url().'/public/assets/img/iconos/Iconos/Pagos en portal/ic_card.png';
         //$('#id_select2_example
         /*$('#name_mx').html(respuesta.rows.name);
         $('#copy_mx_clabe').html(respuesta.rows.clabeAccount);
         $('#copy_mx_cel').html(respuesta.rows.phoneNumber);
         $('#copy_mx_clabe').html(respuesta.rows.clabeAccount);
         $('#copy_mx_nc').html(respuesta.rows.virtualAccount);

         $('#name_usa').html(respuesta.rows.name);
         $('#copy_usa_cel').html(respuesta.rows.phoneNumber);
         $('#copy_usa_clabe').html(respuesta.rows.clabeAccount);*/


      }
   });
   
   $('#id_select2_example').change(function(event) {
      for (let iCard = 0; iCard < infoCards.length; iCard++) {
         if($(this).val() == infoCards[iCard].id){
            let arr = infoCards[iCard].expirationDate.split('-'); 
            //$('#numCard').val(infoCards[iCard].card);
            $('#numCard').val(separarString(infoCards[iCard].card, 4));
            $('#nameCard').val(infoCards[iCard].name);            
            $('#address').val(infoCards[iCard].address);
            $('#ciudad').val(infoCards[iCard].city);
            $('#cp').val(infoCards[iCard].postalCode);
            $('#estado').val(infoCards[iCard].locality);
            $('#pais').val(infoCards[iCard].country);
            $('#mm').val(arr[0]);
            $('#yy').val(arr[1].slice(-2));
            $('#instruccion').html('Verifica los datos de tu tarjeta');
         }else if ($(this).val() == 'nueva') {
            $('#instruccion').html('Ingresa y verifica los datos de tu tarjeta');
            $('#numCard').val('');
            $('#nameCard').val('');
            $('#mm').val('');
            $('#yy').val('');
            $('#address').val('');
            $('#ciudad').val('');
            $('#cp').val('');
            $('#estado').val('');
            $('#pais').val('');
         }
         
         
      }
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
      /*
      var numberCredit = document.getElementById("numCard").value;
     //Aca obtenes el valor de la tarjeta
     if(numberCreditCard.length == 4 || numberCreditCard.length == 8 ||
         numberCreditCard.length == 12){
       //Podrias hacer algo asi
       numberCredit += '-';
      //Aca le concatenas el -
     }*/

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

      var cardS = $('#id_select2_example').val();
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

      /*var address = $('#address').val();
      var ciudad = $('#ciudad').val();
      var cp = $('#cp').val();
      var estado = $('#estado').val();
      var pais = $('#pais').val();*/


      /*if (cardS == '') {
         $('#id_select2_example').css('border','1px solid red');
         $('#error-cardS').html('Selecciona una tarjeta, o sele.');
         error = error+1;
      }*/
      if (numCardVal == '') {
         $('#numCard').css('border','1px solid red');
         $('#error-card').html('Ingresa el número de tarjeta.');
         error = error+1;
      }
      if($('#id_select2_example').val() != 'nueva'){
         if (numCardVal.length < 15 || numCardVal.length > 16 ) {
            $('#numCard').css('border','1px solid red');
            $('#error-card').html('El número de la tarjeta debe ser de máximo 16 dígitos y mínimo 15 dígitos.');
            error = error+1;
         }
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
      /*if (address == '') {
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
      }*/
      if (error == 0) {
         if($('#id_select2_example').val() == 'nueva'){
            var msg = "<p>¿Deseas guardar la tarjeta?</p>";
            bootbox.dialog({
               title: "Nueva Tarjeta",
               message: msg,
               onEscape: true,
               backdrop: true,
               buttons: {
                  confirm: {
                     label: 'Aceptar',
                     className: 'btn-azul',
                     callback: function(){
                        $.ajax({
                           url: base_url+'/prepago/addCard',
                           type: "post",
                           data: $('#form-pay').serialize(),
                           cache: true,
                           dataType: "json",
                           beforeSend: function () {
                              //$("#caja21").html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                              bootbox.dialog({
                                 message: '<p>Guardando Tarjeta ...</p>',
                                 locale: 'mx'
                              });
                           },
                           success: function(respuesta){ 
                              bootbox.hideAll();
                  
                              if (respuesta.success == true) {
                                 bootbox.alert({
                                    message: 'Tarjeta guardada con éxito',
                                    locale: 'mx'
                                 });
                                 $('.btn-pago').show();
                                 $('#form-pay input:text').css('border','1px solid');
                                 $('#form-pay input:password').css('border','1px solid');
                                 $('#form-pay select').css('border','1px solid');
                                 $('.error').html('');
                                 $('html,body').animate({
                                    scrollTop: $(".areaForm").offset().top
                                 }, 1000);
                              }else{
                                 bootbox.alert({
                                    message: respuesta.error.message,
                                    locale: 'mx'
                                 });
                                 $('.btn-pago').show();
                                 $('#form-pay input:text').css('border','1px solid');
                                 $('#form-pay input:password').css('border','1px solid');
                                 $('#form-pay select').css('border','1px solid');
                                 $('.error').html('');
                                 $('html,body').animate({
                                    scrollTop: $(".areaForm").offset().top
                                 }, 1000);
                              }
                           }
                        }); 
                     }
                  },
                  cancel: {
                     label: 'Cancelar',
                     className: 'btn-grey',
                     callback: function(){
                           bootbox.hideAll();
                           $('.btn-pago').show();
                           $('#form-pay input:text').css('border','1px solid');
                           $('#form-pay input:password').css('border','1px solid');
                           $('#form-pay select').css('border','1px solid');
                           $('.error').html('');
                           $('html,body').animate({
                              scrollTop: $(".areaForm").offset().top
                           }, 1000);
                     }
                  }
               }
            });
         }else{
            $('.btn-pago').show();
            $('#form-pay input:text').css('border','1px solid');
            $('#form-pay input:password').css('border','1px solid');
            $('#form-pay select').css('border','1px solid');
            $('.error').html('');
            $('html,body').animate({
               scrollTop: $(".areaForm").offset().top
            }, 1000);
         }       
      }
   });

   // boton pagar
   $('.btn-pago').click(function(event) {
      event.preventDefault();
      var url_pay = '';
   
      /*if (getOptionPay == 'card') {
         url_pay = base_url+'/paymentLink/envio_form?tipo=card';
      }else if (getOptionPay == 'cash') {
         url_pay = base_url+'/paymentLink/envio_form?tipo=cash';
      }else if (getOptionPay == 'transfer') {*/
         url_pay = base_url+'/prepago/envio_form';
      //}


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
               console.log('getOptionPay = '+getOptionPay);
               //if (getOptionPay == 'card') {
                  var parameters = 'authorizationNumber='+respuesta.authorizationNumber+'|'+
                  respuesta.reference_pay+'|'+respuesta.urlCallback+'|'+respuesta.urlImage+'|'+
                  respuesta.user+'|'+respuesta.email+'|'+respuesta.amount+'|'+respuesta.reference+'|'+respuesta.description+'|'+
                  respuesta.paymentMethod;

                  location.href = 'gracias?reference='+respuesta.reference_pay;
                  //console.log('pagado '+respuesta.email);
               /*}else {
                  var parameters = 'authorizationNumber=pay_p|'+respuesta.reference_pay+'|'+respuesta.urlCallback+'|'+respuesta.urlImage+'|'+
                  respuesta.user+'|'+respuesta.email+'|'+respuesta.amount+'|'+respuesta.reference+'|'+respuesta.description+'|'+
                  respuesta.paymentMethod+'|'+respuesta.typeCorrespondient;

                  location.href = 'gracias?reference='+respuesta.reference_pay;
                  //console.log('pagado '+respuesta.email);
               }*/
            }else{
              bootbox.alert({
                  message: respuesta.message,
                  locale: 'mx'
               });
            }
         }
      });      
      
   });

});
function copyClipboard(element) {
   var $bridge = $("<input>")
   $("body").append($bridge);
   $bridge.val($(element).text()).select();
   document.execCommand("copy");
   $bridge.remove();
}
function separarString(str, size) {
   let result = "";
   for (let i = 0; i < str.length; i += size) {
       result += str.substring(i, i + size) + "-";
   }
   return result.substring(0, result.length - 1);
}