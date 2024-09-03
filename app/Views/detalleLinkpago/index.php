<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
if (!isset($_GET['isMovil'])) {
$urlCancel = '';
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
<header style="background: #333F50;" id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <button onclick="history.back()" class="text-blanco backPrepago" style="font-size: 22px;" href="#">
          <i class="fas fa-arrow-left"></i>
        </button>
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
<style>
.form-group > label {
  bottom: 0px !important;
  left: 0px !important;
  position: relative !important;
  background-color: white !important;
  padding: 0px 5px 0px 5px !important;
  font-size: 1.1em !important;
  transition: 0.2s;
  pointer-events: none !important;
}
</style>
<?php
}else{
$urlCancel = '&isMovil=0';
?>
<header id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a href="dashboard">
          <span class="fa fa-home"></span>
        </a>
      </li>
      <li class="breadcrumb-active">
        <a href="dashboard">Detalle Link de Pago</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Detalle Link de Pago</li>
    </ol>
  </div>
  <div class="topbar-right">
    <div class="ib topbar-dropdown">
    </div>
    <div class="ml15 ib va-m" id="sidebar_right_toggle">
    </div>
  </div>
</header>
<?php
}
$today = date("Y-m-d");
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- -------------- /Topbar -------------- -->
    <?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => WS_KASPAYSERVICES.'/KashPay/v2/checkout/'.$_GET['referencia'],
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
    
    //var_dump($datos['rows']);
    ?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class="panel panel-visible">
              <div class="panel-body pn" id="formulario">
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <p class="text-20 negritas text-dorado">Link de Pago.</p>
                    <p class="text-16">De clic en la url generada o comparta el link para concluir el proceso de pago.</p>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <?php }else{ ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <p class="text-20 negritas text-dorado">Chechout.</p>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <?php } ?>
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 panel">
                    <a style="text-align:justify" href="<?php echo $datos['rows']->payOrder->payInfo->formUrl?>" class="text-16" id="copy_link"><?php echo $datos['rows']->payOrder->payInfo->formUrl?></a>
                    <a type="button" class=" pull-right btn btn-primary notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_link')">
                      <i class="far fa-copy"></i>
                    </a>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <?php } ?>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 ">
                    <?php
                    $estatus = '';
                    switch ( $datos['rows']->payOrder->descPayOrderStatus) {
                      case 'PAGADA':
                        $estatus = '<p id="estatus" class="text-16 text-green">Pagada</p>';
                        break;
                      case 'CREADA':
                        $estatus = '<p id="estatus" class="text-16 text-dorado">Pendiente de Pago</p>';
                          break;
                      case 'EXPIRADA':
                        $estatus = '<p id="estatus" class="text-16 text-grey">Expirada</p>';
                            break;
                      case 'CANCELADA':
                        $estatus = '<p id="estatus" class="text-16 text-red">Cancelada</p>';
                            break;
                      default:
                        break;
                    }
                        echo $estatus;
                    ?>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 ">
                  <?php
                  if ($datos['rows']->payOrder->descPayOrderStatus != 'PAGADA') {
                    $fecha = explode(' ',$datos['rows']->payOrder->payInfo->expiration);
                    $fechaform = explode('-',$fecha[0]);
                    $mes = '';
                    switch ($fechaform[1]) {
                      case '01':
                        $mes = 'Enero';
                        break;
                      case '02':
                        $mes = 'Febrero';
                        break;
                      case '03':
                        $mes = 'Marzo';
                        break;
                      case '04':
                        $mes = 'Abril';
                        break;
                      case '05':
                        $mes = 'Mayo';
                        break;
                      case '06':
                        $mes = 'Junio';
                        break;
                      case '07':
                        $mes = 'Julio';
                        break;
                      case '08':
                        $mes = 'Agosto';
                        break;
                      case '09':
                        $mes = 'Septiembre';
                        break;
                      case '10':
                        $mes = 'Octubre';
                        break;
                      case '11':
                        # code...
                        $mes = 'Noviembre';
                      case '12':
                        $mes = 'Diciembre';
                        break;
                      default:
                        break;
                    }
                    echo '<div class="pull-right"><p class="text-16">'.$fechaform[2].' '.$mes.' '.$fechaform[0].'</p>'.
                    '<p class="text-16">'.'</p></div>';
                  }else{
                    //$fecha = $("#"+operation).data("fechamod").split(' ');                                      
                    $fecha = explode(' ',$datos['rows']->payOrder->authorizationResponse->authorizationDate);
                    $fechaform = explode('-',$fecha[0]);
                    $mes = '';
                    switch ($fechaform[1]) {
                      case '01':
                        $mes = 'Enero';
                        break;
                      case '02':
                        $mes = 'Febrero';
                        break;
                      case '03':
                        $mes = 'Marzo';
                        break;
                      case '04':
                        $mes = 'Abril';
                        break;
                      case '05':
                        $mes = 'Mayo';
                        break;
                      case '06':
                        $mes = 'Junio';
                        break;
                      case '07':
                        $mes = 'Julio';
                        break;
                      case '08':
                        $mes = 'Agosto';
                        break;
                      case '09':
                        $mes = 'Septiembre';
                        break;
                      case '10':
                        $mes = 'Octubre';
                        break;
                      case '11':
                        # code...
                        $mes = 'Noviembre';
                      case '12':
                        $mes = 'Diciembre';
                        break;
                      default:
                        break;
                    }
                    echo '<div class="pull-right"><p class="text-16">'.$fechaform[2].' '.$mes.' '.$fechaform[0].'</p>'.
                    '<p class="text-16">'.'</p></div>';
                  }
                  ?>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-4 ">
                    <p class="negritas text-16">Concepto</p>
                    <p class="text-16"><?php echo $datos['rows']->payOrder->payInfo->description?></p>
                    <p class="text-16 negritas">Importe</p>
                    <p class="text-16">$<?php echo number_format($datos['rows']->payOrder->amount,2)?></p>
                    <?php if ($datos['rows']->payOrder->payment_type != 2) { ?>
                    <p class="text-16 negritas">Propina</p>
                    <p class="text-16">$<?php echo number_format($datos['rows']->payOrder->otherAmount,2)?></p>
                    <?php } ?>
                  </div> 
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 ">
                    <div class="pull-right">
                      <p class="text-16 negritas">Monto Total</p>
                      <p class="text-16">$<?php echo number_format(($datos['rows']->payOrder->amount+$datos['rows']->payOrder->otherAmount),2)?></p>
                      <input id="urlpay" value="<?php echo $datos['rows']->payOrder->payInfo->formUrl?>" type="hidden">
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-4 ">
                    <button onclick="history.back()" class="btn btn-default backPrepago">Cancelar</button>
                  </div>
                  <?php
                  if ($datos['rows']->payOrder->descPayOrderStatus == 'PAGADA') {
                  ?>
                  <div class="col-md-4 ">
                    <a href="<?php echo $datos['rows']->payOrder->payInfo->formUrl?>" class="pull-right btn btn-primary">Comprobante</a>
                  </div>
                  <?php } ?>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div style="height:180px;"></div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-xs-3 text-center">
                    <a type="button" target="_blank" class="text-blue text-20 whatsapp" href="#">
                      <i class="fab fa-whatsapp"></i>
                    </a>
                  </div>
                  <div class="col-md-3 col-xs-3 text-center">
                    <a type="button" target="_blank" class="text-blue text-20 correo"  href="#">
                      <i class="fas fa-at"></i>
                    </a>
                  </div>
                  <div class="col-md-3 col-xs-3 text-center">
                    <a type="button" target="_blank" id="btnSave2" class="text-blue text-20">
                      <i class="fas fa-download"></i>
                    </a>
                  </div>
                  <div class="col-md-3 col-xs-3 text-center">
                    <a href="pagoDistancia?filtro=today&page=1" id="btnSave2" class="text-blue text-20">
                      <i class="fas fa-undo"></i>
                    </a>
                  </div>
                  
                </div>
              </div>
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

<script src="<?php echo base_url()?>/public/assets/js/pages/html2canvas.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/canvas2image.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-file-notifications.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/detalleLinkpago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

<script>
  $("#btnSave2").click(function() {
    html2canvas($("#formulario"), {
      onrendered: function(canvas) {
        saveAs(canvas.toDataURL(), 'Link-de-pago<?php echo $_GET['referencia']?>.png');
      }
    });
  });
  function validarEmail(valor) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
     $('#mail').css('border','1px solid #ced4da');
      $('#error_mail').html('');
    } else {
     $('#mail').css('border','1px solid red');
     $('#error_mail').html('Ingresa un email válido.');
    }
  }

</script>
</body>

</html>

<?=$this->endsection()?>