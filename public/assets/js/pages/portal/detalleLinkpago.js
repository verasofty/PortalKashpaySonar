$(function(){
  $(".whatsapp").click(function(event) {
    event.preventDefault();
    var texto = '*Link de Pago* \n\n'+
                '*URL:* \n'+
                $('#urlpay').val()+'\n\n'+
                '*'+$('#estatus').text()+'*';
                
    //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto,'_blank');
    window.open(encodeURI('https://api.whatsapp.com/send?text='+texto),'_blank');
  });

  $(".correo").click(function(event) {
    event.preventDefault();
    var texto = 'Link de Pago \n\n'+
                'URL: \n'+
                $('#urlpay').val()+'\n\n'+
                $('#estatus').text();
                
    //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto,'_blank');
    window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
  });

});
function copyClipboard(element) {
  var $bridge = $("<input>")
  $("body").append($bridge);
  $bridge.val($(element).text()).select();
  document.execCommand("copy");
  $bridge.remove();
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
