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
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
<header style="background: black;" id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a href="#">
          <img style="width: 20%;" src="<?php echo base_url()?>/public/assets/img/logo_kashpay.png">
        </a>
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
            <div class="row">
              <div class="col-md-4 text-center">
              </div>
              <div class="col-md-4 text-center">
                <?php
                if ( $datos['rows']->payOrder->payInfo->urlImage != '') {
                ?>
                  <img class="logokash" src="<?php echo $datos['rows']->payOrder->payInfo->urlImage;?>">
                <?php
                }else{
                ?>
                  <img class="logokash" src="assets/img/comercio_default.png">
                <?php
                }
                ?>        
              </div>
              <div class="col-md-4 text-center">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="credit-card-div">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-4 text-center">
                        </div>
                        <div class="col-md-4 pad-adjust">
                          <div class="p-3 border rounded m-10">
                            <?php
                            if ($datos['rows']->payOrder->statusOrder == 14) {
                            ?>
                            <h3 class="text-center text-black">Gracias por tu pago</h3>
                            <table class="table">
                              <tr>
                                <td>Fecha de pago</td>
                                <td><b><?php echo $datos['rows']->payOrder->authorizationResponse->authorizationDate?></b></td>
                              </tr>
                              <tr>
                                <td>Número de Autorizacion</td>
                                <td><b><?php echo $datos['rows']->payOrder->authorizationResponse->authorizationNumber?></b></td>
                              </tr>
                              <tr>
                                <td>Forma de pago</td>
                                <td><b><?php //echo $datos['rows']->payOrder->authorizationResponse->bin?></b></td>
                              </tr>
                              <tr>
                                <td>Referencia</td>
                                <td><b><?php echo $datos['rows']->payOrder->payInfo->reference?></b></td>
                              </tr>
                              <tr>
                                <td>Concepto</td>
                                <td><b><?php echo $datos['rows']->payOrder->payInfo->description?></b></td>
                              </tr>
                              <tr>
                                <td>Monto</td>
                                <td><b>MXN <?php echo number_format($datos['rows']->payOrder->amount,2)?> MNX</b></td>
                              </tr>
                              
                            </table>
                            <?php
                            } else if ( $datos['rows']->payOrder->statusOrder == 16) {
                            ?>
                            <h3 class="text-center text-black">Gracias</h3>
                            <h6  class="text-center text-black">Información para realizar tu pago. </h6>
                            <table class="table">
                              <tr>
                                <td>Fecha limite de pago</td>
                                <td><b><?php echo $datos['rows']->payOrder->payInfo->expiration?></b></td>
                              </tr>
                              <tr>
                                <td>Pagar en</td>
                                <td><b><?php echo $datos['rows']->payOrder->correspondentResponse->correspondient?></b></td>
                              </tr>
                              <tr>
                                <td>Forma de pago</td>
                                <?php 
                                if ($datos['rows']->payOrder->correspondentResponse->correspondient != 'Citi Banamex') {
                                ?>
                                <td><b>Efectivo</b></td>
                                <?php
                                }else{
                                ?>
                                <td><b>Transferencia</b></td>
                                <?php
                                }
                                ?>
                              </tr>
                              
                              <tr>
                                <td>Referencia</td>
                                <td><b><?php echo $datos['rows']->payOrder->payInfo->reference?></b></td>
                              </tr>
                              <tr>
                                <td>Concepto</td>
                                <td><b><?php echo $datos['rows']->payOrder->payInfo->description?></b></td>
                              </tr>
                              <tr>
                                <td>Monto</td>
                                <td><b>MXN <?php echo number_format($datos['rows']->payOrder->amount,2)?></b></td>
                              </tr>
                              
                            </table>
                            <?php
                            }
                            
                            ?>
                            
                            
                            
                          </div>
                        </div>
                        <div class="col-md-4 text-center">
                        </div>
                      </div>
                    </div>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/gracias.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/html2canvas.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/canvas2image.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script type="text/javascript">
  function redireccionarPagina() {
    window.location = 'voucher?reference=<?php echo $_GET['reference']?>'; 
  }
  setTimeout("redireccionarPagina()", 3000);
</script>
</body>
</html>
<?=$this->endsection()?>