$(function(){
  var botons = '';  
  $('#detalleBoton').hide();

    $('.btn-select').click(function(event) {
        $('.btn-select').css('border', '3px solid #fff', 'background','transparent');
        event.preventDefault();
        console.log('hola');
        botons = $(this).data('clase');
      $('#btn-pago').addClass($(this).data('clase'));
        
        $(this).css('border', '5px dotted #333F50','background','#d2d1d17d');
    });
    $('#btn-add').click(function(event) {
      $('#nombreHelp').html('');
      if (isValidUrl($('#nombre').val())) {
        $('#formulario').hide();
        $('#detalleBoton').show();
        $('.codebtn').show();
        var html = '';
        $('.codebtn').val('<div class="panel pn">'+
                            '<div class="row">'+
                              '<div class="col-md-2 mb-5"></div>'+
                              '<div class="col-md-8 mb-5">'+
                                '<div class="col-md-12">'+
                                  '<a id="btn-pago-code" href="'+$('#nombre').val()+'" class="pull-right btn-block btn-opcion btn '+botons+'">Pagar con Kash</a>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<div style="height:15px;"></div>'+
                                  '<p class="text-center">Débito | crédito | efectivo | SPEI</p>'+
                                '</div>'+
                                '<div class="col-md-12">'+
                                  '<img style="width:100%;padding: 15px 0px;" src="'+base_url+'/public/assets/img/linkPago/marcas.png">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-2 mb-5"></div>'+
                            '</div>'+
                          '</div>');
        var funcionC = "btnEmail(event)";
        var funcionW = "btnWApp(event)";
        html += '<div class="row">'+
                  '<div style="height:180px;"></div>'+
                '</div>'+
                '<div class="row">'+
                  '<div class="col-md-4 col-xs-4 text-center">'+
                    '<a type="button" target="_blank" class="text-blue text-20 whatsapp" onclick="'+funcionW+'" href="#">'+
                      '<i class="fab fa-whatsapp"></i>'+
                    '</a>'+
                  '</div>'+
                  '<div class="col-md-4 col-xs-4 text-center">'+
                    '<a type="button" target="_blank" class="text-blue text-20 correo"  onclick="'+funcionC+'" href="#">'+
                      '<i class="fas fa-at"></i>'+
                    '</a>'+
                  '</div>'+
                  '<div class="col-md-4 col-xs-4 text-center">'+
                    '<a href="pagoDistancia?filtro=today&page=1" id="btnSave2" class="text-blue text-20">'+
                      '<i class="fas fa-undo"></i>'+
                    '</a>'+
                  '</div>'+
                '</div>';
                $('#detalles').html(html);

        //$('#detalles').html(html);
        

      } else {
        $('#nombreHelp').html('El texto ingresado no es una URL valida');
      }
      
    }); 
    
});
function btnEmail(event){
  event.preventDefault();
  var texto = '*Codigo HTML del Link* \n\n'+
                $('.codebtn').val()+'\n\n'+
                '*Solo copia y pega el texto anterior en la web que lo necesites*';
    
  
  window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
}

function btnWApp(event){
  event.preventDefault();
  var texto = '*Codigo HTML del Link* \n\n'+
                $('.codebtn').val()+'\n\n'+
                '*Solo copia y pega el texto anterior en la web que lo necesites*';
    
  
  window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));          
  //window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
}
function copyClipboard(element) {
  var $bridge = $("<input>")
  $("body").append($bridge);
  $bridge.val($(element).val()).select();
  document.execCommand("copy");
  $bridge.remove();
}
function isValidUrl(string) {
  try {
    new URL(string);
    return true;
  } catch (err) {
    return false;
  }
}

function saveAs(uri, filename) {
  var link = document.createElement('a');
  if (typeof link.download === 'string') {
    link.href = uri;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  } else {
    window.open(uri);
  }
}