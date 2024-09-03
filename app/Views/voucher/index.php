<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => WS_KASPAYSERVICES.'/KashPay/v2/checkout/'.$_GET['reference'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'AuthorizationToken: Bearer 1234345'
  ),
));

$response = curl_exec($curl);


curl_close($curl);

$datos['rows'] = json_decode($response);

if( $datos['rows']->payOrder->statusOrder == 13 ){
  echo '<script>location.href="paymentLink?reference='.$_GET['reference'].'"</script>';

}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
<header style="background: #333F50;" id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        
      </li>
    </ol>
  </div>
  <div class="topbar-right">
    <div class="ib topbar-dropdown">
    </div>
    <div class="ml15 ib va-m" id="sidebar_right_toggle">
    </div>
  </div>
</header>
  <!-- -------------- /Topbar -------------- -->
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class="panel">
              <div id="figuras" class="row p-3 border rounded m-10">
                <?php
                if ($datos['rows']->payOrder->statusOrder == 14) {
                ?>
                <div class="col-md-12">
                  <div  class="row ">
                    <div class="col-md-2" ></div>
                    <div class="col-md-8" >
                      <div class="row">
                        <div class="col-md-6">
                          <?php
                          $fechaCom = explode(' ', $datos['rows']->payOrder->authorizationResponse->authorizationDate);
                          $fecha = explode('-', $fechaCom[0]);
                          switch ($fecha[1]) {
                            case '01':
                              $mes='Enero';
                              break;
                            case '02':
                              $mes='Febrero';
                              break;
                            case '03':
                              $mes='Marzo';
                              break;
                            case '04':
                              $mes='Abril';
                              break;
                            case '05':
                              $mes='Mayo';
                              break;
                            case '06':
                              $mes='Junio';
                              break;
                            case '07':
                              $mes='Julio';
                              break;
                            case '08':
                              $mes='Agosto';
                              break;
                            case '09':
                              $mes='Septiembre';
                              break;
                            case '10':
                              $mes='Octubre';
                              break;
                            case '11':
                              $mes='Noviembre';
                              break;
                            case '12':
                              $mes='Diciembre';
                              break;                                                                                                                                                   
                            default:
                              # code...
                              break;
                          }
                          ?>
                          <p id="fecha" ><?php echo $fecha[2].' de '.$mes.' '.$fecha[0] ?></p>
                          <p id="hora" ><?php echo $fechaCom[1].' hrs.' ?></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <p id="monto" class="text-24 negritas">$ <?php echo number_format($datos['rows']->payOrder->amount, 2)?></p>
                          <img style="width: 5%;" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Para Movimientos-Comprobante/metro-credit-card.png" >                               
                          <hr>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table">
                            <tr>
                              <td>Estatus</td>
                              <td id="estatus" class="negritas"><?php echo $datos['rows']->payOrder->descPayOrderStatus?></td>
                            <tr>
                            <tr>
                              <td>Tipo de pago</td>
                              <td id="tipoPago" class="negritas">Aprobada</td>
                            <tr>
                            <tr>
                              <td>Tarjeta</td>
                              <td id="card" class="negritas"><?php echo $datos['rows']->payOrder->authorizationResponse->cardNumber?></td>
                            <tr>
                            <tr>
                              <td>Concepto</td>
                              <td id="concepto" class="negritas"><?php echo $datos['rows']->payOrder->payInfo->description?></td>
                            <tr>
                            <tr>
                              <td>Autorización</td>
                              <td id="autorizacion" class="negritas"><?php echo $datos['rows']->payOrder->authorizationResponse->authorizationNumber?></td>
                            <tr>
                          </table>
                        </div>
                      </div>
                      <div style="height:60px;"></div>
                      <div class="row">
                        <div class="col-md-12">
                          <p class="text-center">Descripción cargo</p>
                        </div>
                        <div class="col-md-12">
                          <table class="table">
                            <tr>
                              <td>Importe</td>
                              <td id="importe" class="negritas"><?php echo number_format($datos['rows']->payOrder->amount, 2)?></td>
                            <tr>
                            <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                            <tr>
                              <td>Propina</td>
                              <td id="propina" class="negritas">Aprobada</td>
                            <tr>
                            <?php } ?>
                          </table>
                        </div>
                        <div class="col-md-12">
                          <p class="text-center negritas">**Autoriza con Firma Electronica**</p>
                        </div>
                        <div class="col-md-12">
                          <div style="height:60px;"></div>
                        </div>
                        <div class="col-md-12">
                          <div style="height: 50px;"></div>
                          <div class="col-md-4 col-xs-4 text-center">
                            <a type="button" target="_blank" id="btnSave1" class="text-blue">
                              <i class="fas fa-download"></i>
                            </a>
                          </div>
                          <div class="col-md-4 col-xs-4 text-center">
                            <a type="button" target="_blank" class="text-blue correo" target="_blank">
                              <i class="fas fa-at"></i>
                            </a>
                          </div>
                          <div class="col-md-4 col-xs-4 text-center">
                            <a type="button" target="_blank" class="text-blue whatsapp" href="#">
                              <i class="fab fa-whatsapp"></i>
                            </a>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-md-2 text-center" ></div>
                  </div>
                </div>
                <?php
                }else{
                  echo '<h5>No existen datos de pago, verifique.</h5>';
                }
                ?>
              </div>
              <!--div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 text-center">
                  <input type="button" class="btn btn-verde" id="btnSave2" value="Descargar">
                  <input type="button" class="btn btn-primary" id="btnImp" value="Imprimir" onclick="printDiv('figuras')">
                </div>
                <div class="col-md-3">
                </div>
              </div-->
              <div style="height:60px;"></div>
            </div>
          </div>
          <!-- -------------- /Spec Form -------------- -->
        </div>
      </div>
        <!-- -------------- /Column Center -------------- -->
    </section>
    <!-- -------------- /Content -------------- -->
    <!-- -------------- /Page Footer -------------- -->
  </section>
    <!-- -------------- /Main Wrapper -------------- -->
</div>
<!-- -------------- /Body Wrap  -------------- -->
<!-- -------------- Scripts -------------- -->
<!-- -------------- jQuery -------------- -->
<style>
    /*page demo styles*/
    .wizard .steps .fa,
    .wizard .steps .glyphicon,
    .wizard .steps .glyphicon {
        display: none;
    }
</style>
<!-- -------------- Scripts -------------- -->
<!-- -------------- jQuery -------------- -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>
<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>
<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>
<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/voucher.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/html2canvas.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/canvas2image.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script type="text/javascript">
  function redireccionarPagina() {
    //window.location = '<?php //echo $datos['rows']->payOrder->payInfo->urlCallback?>'; 
    var urlCallback = '<?php echo $datos['rows']->payOrder->payInfo->urlCallback?>'; 
    $.post(
      "<?php echo $datos['rows']->payOrder->payInfo->urlCallback?>", 
      {user: "Ford", 
      terminalId: "Focus", 
      terminalUserId: "Focus", 
      paymentMethod: "Focus", 
      statusOrder: "Focus", 
      descPayOrderStatus: "Focus", 
      amount: "Focus", 
      retrivalReferenceCode: "Focus", 
      reference_payment: "Focus", 
      currency: "Focus", 
      firstName: "Focus", 
      lastName: "Focus", 
      middleName: "Focus", 
      email: "Focus", 
      phone1: "Focus", 
      payOrder: "Focus", 
      formUrl: "Focus", 
      unique: "Focus", 
      reference: "Focus", 
      description: "Focus", 
      response: "Focus", 
      expiration: "Focus", 
      urlCallback: "Focus", 
      urlImage: "Focus", 
      name: "Focus", 
      rfc: "Focus", 
      address: "Focus"}, 
      function(htmlexterno){
      //$("#cargaexterna").html(htmlexterno);
    });
  }
  //setTimeout("redireccionarPagina()", 5000);

  document.getElementById('figuras').contentEditable = 'false';
  document.getElementById('figuras').designMode='on';
  $(function() {
    showqr('<?php echo $_GET['reference']?>');
    $("#btnSave2").click(function() {
      html2canvas($("#figuras"), {
        onrendered: function(canvas) {
          saveAs(canvas.toDataURL(), '<?php echo $_GET['reference']?>.png');
        }
      });
    });
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

    
  });
  $("#btnSave1").click(function() {
    html2canvas($("#figuras"), {
      onrendered: function(canvas) {
        saveAs(canvas.toDataURL(), 'Comprobante_<?php echo $_GET['reference']?>.png');
      }
    });
  });
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
  $(".whatsapp").click(function(event) {
    event.preventDefault();
    var texto = 'Comprobante de pago\n\n'+
                'Fecha:\n'+
                $('#fecha').text()+'\n'+
                $('#hora').text()+'\n'+
                'Monto: \n'+
                 $('#monto').text()+'\n'+
                'Estatus: \n'+
                $('#estatus').text()+'\n'+
                'Tipo de pago: \n'+
                $('#tipoPago').text()+'\n'+
                'Tarjeta \n'+
                $('#card').text()+'\n'+
                'Concepto: \n'+
                $('#concepto').text()+'\n'+
                'Autorización: \n'+
                $('#autorizacion').text()+'\n\n\n'+
                'Descripción de pago\n\n'+
                'Importe:\n'+
                $('#importe').text();
                <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                texto += 'Importe:\n'+
                $('#importe').text();
                <?php } ?>
    html2canvas($("#figuras"), {
      onrendered: function(canvas) {
        window.open(encodeURI('https://api.whatsapp.com/send?image='+canvas.toDataURL()));

        //saveAs(canvas.toDataURL(), 'Comprobante_<?php echo $_GET['reference']?>.png');
      }
    });
                
    //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
    //window.open(encodeURI('https://api.whatsapp.com/send?image='+texto));

  });
  $(".correo").click(function(event) {
    event.preventDefault();
    var texto = 'Comprobante de pago\n\n'+
                'Fecha:\n'+
                $('#fecha').text()+'\n'+
                $('#hora').text()+'\n'+
                'Monto: \n'+
                 $('#monto').text()+'\n'+
                'Estatus: \n'+
                $('#estatus').text()+'\n'+
                'Tipo de pago: \n'+
                $('#tipoPago').text()+'\n'+
                'Tarjeta \n'+
                $('#card').text()+'\n'+
                'Concepto: \n'+
                $('#concepto').text()+'\n'+
                'Autorización: \n'+
                $('#autorizacion').text()+'\n\n\n'+
                'Descripción de pago\n\n'+
                'Importe:\n'+
                $('#importe').text();
                <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                texto += 'Importe:\n'+
                $('#importe').text();
                <?php } ?>
                
                
    //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
    //window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));
    window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));


  });
  
  function printDiv(nombreDiv) {
       var contenido= document.getElementById(nombreDiv).innerHTML;
       var contenidoOriginal= document.body.innerHTML;

       document.body.innerHTML = contenido;

       window.print();

       document.body.innerHTML = contenidoOriginal;
  }
  function showqr(ref) {
    var reference = ref;
    console.log('showqr');
    $.ajax({
      url: base_url+'/public/assets/codigo_qr/generador_qr.php?reference='+reference,
      type: "post",
      data: '',
      cache: true
    }).done(function(respuesta){
     if (respuesta != '') {
      $("#img_qr").html(respuesta);
     }
       
    });
  }

</script>


</body>
</html>
<?=$this->endsection()?>