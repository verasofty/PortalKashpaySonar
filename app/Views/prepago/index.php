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

//var_dump($datos['rows']);

if (isset($datos['rows']->payOrder)) {
  //echo 'hola';
  $expira = explode (' ',$datos['rows']->payOrder->payInfo->expiration);
  $partExpira = explode('-',$expira[0]);
  $fecha_actual = strtotime(date("d-m-Y"));
  $fecha_entrada = strtotime(date($partExpira[2].'-'.$partExpira[1].'-'.$partExpira[0]));

  if (getenv('HTTP_CLLIENT_IP')) {
    $ip = getenv('HTTP_CLLIENT_IP');
  }else if (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  }else if (getenv('HTTP_X_FORWARDED')) {
    $ip = getenv('HTTP_X_FORWARDED');
  }else if (getenv('HTTP_FORWARDED_FOR')) {
    $ip = getenv('HTTP_FORWARDED_FOR');
  }else if (getenv('HTTP_FORWARDED')) {
    $ip = getenv('HTTP_FORWARDED');
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  $mesCurso = date('m');
  $anio = date('y');
  $address = '';
  $city = '';
  $estado = '';
  $cp = '';
  $pais = '';
  if (isset($datos['rows']->payOrder->customerInfo->address1)) {
    $address = $datos['rows']->payOrder->customerInfo->address1;
  }
  if (isset($datos['rows']->payOrder->customerInfo->city)) {
    $city = $datos['rows']->payOrder->customerInfo->city;
  }
  if (isset($datos['rows']->payOrder->customerInfo->state)) {
    $estado = $datos['rows']->payOrder->customerInfo->state;
  }
  if (isset($datos['rows']->payOrder->customerInfo->country)) {
    $pais = $datos['rows']->payOrder->customerInfo->country;

  }
  if (isset($datos['rows']->payOrder->customerInfo->cp)) {
    $cp = $datos['rows']->payOrder->customerInfo->cp;
  }
  ?>
    <script type="text/javascript">
      var hoy = '<?php echo $today?>';
      var reference = '<?php echo $_GET['reference']?>';
      var montoGlobal = <?php echo $datos['rows']->payOrder->amount?>;
      var idsirio = '<?php echo $datos['rows']->payOrder->sirioId?>';

      var host = '<?php echo $_SERVER["HTTP_HOST"]?>';
      var uri  = '<?php echo $_SERVER["REQUEST_URI"]?>';
      var cardNum  = '';
      var cardName  = '';
      var cardExp  = '';
      var cardDir  = '';
      var cardLoc  = '';
      var cardCP  = '';
      var cardTel  = '';
      var cardEmail  = '';
      var cardId  = '';
      <?php
      if (isset($_GET["option_pay"])) {
      ?>
      var getOptionPay = '<?php echo $_GET["option_pay"]?>';
      <?php
      }else{
      ?>
      var getOptionPay = '';
      <?php
      }
      ?>
      var mmCurso = '<?php echo $mesCurso?>';
      var yyCurso = '<?php echo $anio?>';

    </script> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />
    <header style="background: #333f50;" id="topbar" class="alt">
      <div class="topbar-left">
        <ol class="breadcrumb">
          <li class="breadcrumb-icon">
            <a class="text-blanco backPrepago" style="font-size: 22px;" href="#">
              <i class="fas fa-arrow-left"></i>
            </a>
            <a href="#">
              <img style="width: 62%;margin: 10px;" src="<?php echo base_url()?>/public/assets/img/logo_kashpay_sobra.png">
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
            <?php
            if ($datos['rows']->success != 1 ) {
              echo '<div class="panel panel-visible">
                      <div class="panel-body pn">
                        <h4 class="text-center"><i class="fas fa-exclamation-triangle"></i> El Link de pago no existe.</h4>
                      </div>
                    </div>';
            }else
            if ($datos['rows']->payOrder->statusOrder == 14) {
              echo '<script>location.href="voucher?reference='.$_GET['reference'].'"</script>';
            }else if ($fecha_actual > $fecha_entrada) {
              echo '<div class="panel panel-visible">
                      <div class="panel-body pn">
                        <h4 class="text-center"><i class="fas fa-exclamation-triangle"></i> El Link de pago ha vencido.</h4>
                      </div>
                    </div>';
            }else
            if ($datos['rows']->payOrder->statusOrder == 16) {
              echo '<script>location.href="voucher?reference='.$_GET['reference'].'"</script>';
            }else if (!isset($_GET['reference'])) {
              echo '<div class="panel panel-visible">
                      <div class="panel-body pn">
                        <h4 class="text-center"><i class="fas fa-exclamation-triangle"></i> El Link de pago ha vencido.</h4>
                      </div>
                    </div>';
            }else{?>
            <div class="row">
              <form method="post" class="form-kash" name="form-pay" id="form-pay">
                <div class="col-md-4">
                  <div class="row">
                    <div class=" col-md-12 logoPago text-center">
                      <?php
                      if ( $datos['rows']->payOrder->payInfo->urlImage != '') {
                      ?>
                        <img id="logoPago" src="<?php echo $datos['rows']->payOrder->payInfo->urlImage;?>">
                      <?php
                      }else{
                      ?>
                        <img id="logoPago" src="<?php echo base_url().'/public/assets/img/logos_pagos/comercio_default.png'?>">
                      <?php
                      }
                      ?>
                      
                    </div>
                  </div>
                  <div class="panel panel-visible">
                    <div class="panel-body pn areaForm">
                      <div class="row">
                        <div class="col-md-12 mb-5">
                          <p class="text-16 text-black text-center">Detalles</p>
                          <span class="text-black">Referencia: <b class="text-black"><?php echo $datos['rows']->payOrder->payInfo->reference;?></b></span></span><br>
                          <span class="text-black">Importe:<b class="text-black">$<?php echo number_format( $datos['rows']->payOrder->amount,2 );?></b></span></span><br>
                          <span class="text-black">Concepto: <b class="text-black"><?php echo $datos['rows']->payOrder->payInfo->description;?></b></span></span><br>
                        </div>
                        <div class="col-md-12" id="div-btn-pago">
                          <button type="button"  class="btn btn-primary btn-pago form-control">Pagar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  
                  <div class="panel panel-visible">
                    <div class="panel-body pn">
                      <div class="col-md-12">
                        <div class="p-3 border rounded m-10" style="margin: 5% 0%;">
                          <p><?php echo $datos['rows']->payOrder->merchantInfo->name;?></p>
                        </div>
                      </div>  
                    </div>
                  </div>

                  <div class="credit-card-div" id="pay_option">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-md-12 pad-adjust mb-5">
                           <p class="text-dorado"><b>Tarjeta Retiro</b></p>
                          </div>
                          <div class="col-md-12 mb-5">
                            <select id="id_select2_example" class="selectCard" style="width: 100%;">
                              <option data-img_src="<?php echo base_url().'/public/assets/img/iconos/Iconos/Pagos en portal/ic_card.png'?>">Selecciona</option>
                              <?php 
                             /* $infoCard = array();
                              $infoCard=$cards;
                              for ($iCards=0; $iCards < count($cards) ; $iCards++) { 
                                $restCard = substr($cards[$iCards]->card, -4);
                                $imgcard = (isset($cards[$iCards]->urlImg)) ? $cards[$iCards]->urlImg : base_url().'/public/assets/img/iconos/Iconos/Pagos en portal/ic_card.png';
                              ?>
                              <option value="<?php echo $cards[$iCards]->id?>" data-img_src="<?php echo $imgcard ?>"><?php echo '**** '.$restCard ?></option>
                              <?php
                              }*/
                              ?>
                              <option value="nueva" data-img_src="<?php echo base_url().'/public/assets/img/iconos/Iconos/Complementos/Dorado/Grupo 4439.png'?>">Nueva</option>
                            </select>
                            <script>
                                //var infoCards = [] = <?php //echo json_encode($infoCard);?>;
                            </script>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <p id="instruccion" class="text-center text-black">Ingresa y verifica los datos de tu tarjeta</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font"></span>
                            <input type="text" id="nameCard" name="nameCard" class="form-control" placeholder="Nombre del titular">
                            <input type="hidden" value="0.00" id="propinaHide" name="propinaHide" class="form-control" placeholder="">
                            <input type="hidden" id="amount" name="amount" value="<?php echo $datos['rows']->payOrder->amount;?>">
                            <input type="hidden" id="validate" name="validate" value="<?php echo $datos['rows']->payOrder->sirioId;?>">
                            <input type="hidden" id="reference" name="reference" value="<?php echo $datos['rows']->payOrder->payInfo->reference;?>">
                            <input type="hidden" id="urlcallback" name="urlcallback" value="<?php echo $datos['rows']->payOrder->payInfo->urlCallback;?>">
                            <input type="hidden" id="exp" name="exp" value="<?php echo $datos['rows']->payOrder->payInfo->expiration;?>">
                            <input type="hidden" id="reference_pay" name="reference_pay" value="<?php echo $datos['rows']->payOrder->reference_payment;?>">
                            <input type="hidden" id="urlImage" name="urlImage" value="<?php echo $datos['rows']->payOrder->payInfo->urlImage;?>">
                            <input type="hidden" id="description" name="description" value="<?php echo $datos['rows']->payOrder->payInfo->description;?>">
                            <input type="hidden" id="paymentMethod" name="paymentMethod" value="">
                            <input type="hidden" id="lat" name="lat" value="">
                            <input type="hidden" id="lon" name="lon" value="">
                            <input type="hidden" id="ip" name="ip" value="<?php echo $ip?>">
                              <input type="hidden" id="fname" name="fname" class="form-control" placeholder="Nombre" value="<?php echo $datos['rows']->payOrder->customerInfo->firstName;?>">
                              <input type="hidden" id="lname" name="lname" class="form-control" placeholder="Apellido" value="<?php echo $datos['rows']->payOrder->customerInfo->lastName;?>">
                              <input type="hidden" id="emailCard" name="emailCard" class="form-control" placeholder="Email" value="<?php echo $datos['rows']->payOrder->customerInfo->email;?>">                             
                              <input type="hidden" id="telCard" name="telCard" class="form-control" placeholder="Teléfono" value="<?php echo $datos['rows']->payOrder->customerInfo->phone1;?>">                              
                            <small class="error" id="error-name"></small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font"> </span>
                            <input type="text" id="numCard" name="numCard" class="form-control" placeholder="Número de tarjeta" maxlength="19">
                            <small class="error" id="error-card"></small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <span class="help-block text-black small-font"></span> 
                            <select class="form-control" name="mm" id="mm">
                              <option value="">MM</option>
                              <?php
                              $mes = array('01','02','03','04','05','06','07','08','09','10','11','12');
                              for ($iMes=0 ; $iMes < count($mes) ; $iMes++ ) { 
                                echo '<option value="'.$mes[$iMes].'">'.$mes[$iMes].'</option>';
                              }
                              ?>
                            </select>
                            <small class="error" id="error-mm"></small>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <span class="help-block text-black small-font"></span>
                            <select class="form-control" name="yy" id="yy">
                              <option value="">YY</option>
                              <?php
                              for ($iAnio=$anio ; $iAnio <= ($anio+10) ; $iAnio++ ) { 
                                echo '<option value="'.$iAnio.'">'.$iAnio.'</option>';
                              }
                              ?>
                            </select>
                            <small class="error" id="error-yy"></small>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <span class="help-block text-black small-font"></span> 
                            <input type="password" class="form-control" placeholder="CCV" name="ccv" id="ccv" maxlength="4">
                            <small class="error" id="error-ccv"></small>
                          </div>
                        </div>
                          <div class="row">
                            <div class="col-md-12 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="address" name="address" class="form-control" placeholder="Dirección" value="<?php echo $address;?>">
                              <small class="error" id="error-address"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Ciudad"  value="<?php echo $city;?>">
                              <small class="error" id="error-ciudad"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input maxlength="5" id="cp" name="cp" class="form-control soloNum" placeholder="Código Postal"  value="<?php echo $cp;?>">
                              <small class="error" id="error-cp"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado"  value="<?php echo $estado;?>">
                              <small class="error" id="error-estado"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="pais" name="pais" class="form-control" placeholder="País"  value="<?php echo $pais;?>">
                              <small class="error" id="error-cp"></small>
                            </div>
                          </div>
                        
                        <!--div style="margin-top:15px;" id="info-adicional">
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="fname" name="fname" class="form-control" placeholder="Nombre" value="<?php echo $datos['rows']->payOrder->customerInfo->firstName;?>">
                              <small class="error" id="error-fname"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="lname" name="lname" class="form-control" placeholder="Apellido" value="<?php echo $datos['rows']->payOrder->customerInfo->lastName;?>">
                              <small class="error" id="error-lname"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="email" id="emailCard" name="emailCard" class="form-control" placeholder="Email" value="<?php echo $datos['rows']->payOrder->customerInfo->email;?>">
                              <small class="error" id="error-emailCard"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="tel" id="telCard" name="telCard" class="form-control" placeholder="Teléfono" value="<?php echo $datos['rows']->payOrder->customerInfo->phone1;?>">
                              <small class="error" id="error-telCard"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="address" name="address" class="form-control" placeholder="Dirección" value="<?php echo $address;?>">
                              <small class="error" id="error-address"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Ciudad"  value="<?php echo $city;?>">
                              <small class="error" id="error-ciudad"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="number" id="cp" name="cp" class="form-control" placeholder="Código Postal"  value="<?php echo $cp;?>">
                              <small class="error" id="error-cp"></small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado"  value="<?php echo $estado;?>">
                              <small class="error" id="error-estado"></small>
                            </div>
                            <div class="col-md-6 pad-adjust">
                              <span class="help-block text-black small-font"></span>
                              <input type="text" id="pais" name="pais" class="form-control" placeholder="País"  value="<?php echo $pais;?>">
                              <small class="error" id="error-cp"></small>
                            </div>
                          </div>
                        </div-->
                        <div class="row" style="margin-top:15px;">
                          <!--div class="col-md-6 col-sm-6 col-xs-12 pad-adjust">
                            <button class="btn btn-danger">Cancelar</button>
                          </div-->
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="btn-next" name="btn-next" class="btn btn-block btn-azul ">Continuar </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--div class="credit-card-div" id="resumen">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <form method="post" class="form-kash" name="form-pay" id="form-pay">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="text-18  help-block text-dorado small-font">Resumen </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="help-block text-dorado small-font">Destino </p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <table id="listaLinks" class="table">
                                <tr>
                                  <td class="text-black">Tipo de pago</td>
                                  <td class="text-black">Prepago</td>
                                </tr>
                                <tr>
                                  <td class="text-black">Destinatario</td>
                                  <td class="text-black">**** 1254</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <hr class="text-dorado">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="help-block text-dorado small-font">Datos de envio </p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <table id="listaLinks" class="table">
                                <tr>
                                  <td class="text-black">Cargo a la tarjeta</td>
                                  <td class="text-black" id="verCard"></td>
                                </tr>
                                <tr>
                                  <td class="text-black">Concepto</td>
                                  <td class="text-black" id="verConcepto"><?php echo $datos['rows']->payOrder->payInfo->description;?></td>
                                </tr>
                                <tr>
                                  <td class="text-black">Importe</td>
                                  <td class="text-black" id="verImporte">$ <?php echo number_format( $datos['rows']->payOrder->amount,2 );?></td>
                                </tr>
                                <tr>
                                  <td><p class="negritas text-20 text-black">Monto Total</p></td>
                                  <td><p class="negritas text-20 text-black" id="verTotal"></p>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="row" style="margin-top:15px;">
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <button id="btn-pago" class="btn btn-azul btn-block"
                              >Aceptar </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div-->
                </div>
              </form>
            </div>
          <?php }?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/prepago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script>
$(document).ready(function(){
	initControls();
});

function initControls(){
	window.location.hash="red";
	window.location.hash="Red" //chrome
	window.onhashchange=function(){window.location.hash="red";}
}
function custom_template(obj){
  var data = $(obj.element).data();
  var text = $(obj.element).text();
  if(data && data['img_src']){
      img_src = data['img_src'];
      template = $("<div><img src=\"" + img_src + "\" style=\"width:5%;margin-bottom: 3px;\"/><p style=\"font-weight: 200;font-size:14px;display:inline;margin-left: 20px;\">" + text + "</p></div>");
      return template;
  }
}

var options = {
  'templateSelection': custom_template,
  'templateResult': custom_template,
}

$('#id_select2_example').select2(options);

$('.select2-container--default .select2-selection--single').css({'height': 'auto'});
  window.addEventListener('load', function() {
    let selUpdate = function(item) {
        // Remover clase seleccionada de opción anterior
        if(ul.querySelector('.selected')) {
            ul.querySelector('.selected').classList.remove('selected');
        }
        // Seleccionar opción actual
        item.classList.add('selected');
        // Actualizar valor del select
        sel.value = item.innerText;
        // Actualizar valor del botón
        btn.innerText = item.innerText;
        btn.style.backgroundImage = item.style.backgroundImage;
        // Ocultar lista
        ul.style.display = 'none';
    }
    // Si no queda en la posición deseada, el contenedor debe tener posición relativa
    // sel.parentNode.style.position = 'relative'; // Descomentar esta línea

    // Obtener select
    let sel = document.querySelector('#id_select2_example');
    // Crear botón, asignar clase y agregar después del select
    let btn = document.createElement('span');
    btn.innerText = 'Selecciona idioma';
    btn.className = 'btn-sel';
    sel.parentNode.insertBefore(btn, sel.nextSibling);
    // Posicionar sobre el select
    btn.style.top = sel.offsetTop + 'px';
    btn.style.left = sel.offsetLeft + 'px';
    // Mostrar / ocultar lista al hacer clic en botón
    btn.addEventListener('click', function() {
        ul.style.display = (ul.style.display == 'none') ? 'block' : 'none';
    });

    // Crear lista y agregar clase
    let ul = document.createElement('ul');
    ul.style.width = btn.offsetWidth + 'px';
    ul.className = 'ul-sel';
    // Recorrer opciones del select
    for(let i = 0; i < sel.options.length; i++) {
        // Crear elemento de lista y agregar clase
        let li = document.createElement('li');
        li.className = 'li-option';
        // Agregar contenido y estilo desde opción
        li.innerText = sel.options[i].innerText;
        li.style = sel.options[i].dataset.style;
        // Actualizar valor del select al hacer clic en elemento de lista
        li.addEventListener('click', function() {
            selUpdate(this);
        });
        // ¿La opción actual está seleccionada? Aplicar al elemento de lista
        if(sel.options[i].selected) {
            li.classList.add('selected');
            // Asignar valor inicial al botón
            selUpdate(li);
        }
        // Agregar elemento a lista
        ul.appendChild(li);
    }
    // Agregar lista, justo después del botón
    sel.parentNode.insertBefore(ul, btn.nextSibling);
    // Posicionar lista bajo el botón
    ul.style.top = (btn.offsetTop + btn.offsetHeight) + 'px';
    ul.style.left = btn.offsetLeft + 'px';
    // Ocultar select
    sel.style.display = 'none';
    // Ocultar lista si se hace clic fuera
    document.addEventListener('click', function(e) {
        // Solo si el clc no fue sobre la lista o el botón
        if(e.target != ul && e.target != btn) {
            ul.style.display = 'none';
        }
    });
});
  $('#thumbs').delegate('img', 'click', function() {

    var $this = $(this);
    // Clear formatting
    $('#thumbs img').removeClass('border-highlight');

    // Highlight with coloured border
    $this.addClass('border-highlight');

    // Changes the value of the form field "prod" to the value of img.id
    $('[name="prod"]').val( $this.attr('id').substring($this.attr('id').lastIndexOf('-')+1));

  });
  var map, infoWindow;
  function initMap() {
    map = new google.maps.Map(document.getElementById("map"), { 
      center: {lat:19.4342, lng:-99.1386}, zoom: 9 
    });
    infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {lat: position.coords.latitude,lng: position.coords.longitude};
        var miLat = position.coords.latitude;
        var miLon = position.coords.longitude;
        map.setCenter(pos);
        var markerOptions = { position: pos}
        var marker = new google.maps.Marker(markerOptions);
        marker.setMap(map);
        miDireccion(miLat,miLon);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      handleLocationError(false, infoWindow, map.getCenter());
    }
  }
  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ? correo() : console.log("Error: Your browser doesn`t support geolocation."));
    infoWindow.open(map);
  }
  function miDireccion(lat,lon) {
    $('#lat').val(lat);
    $('#lon').val(lon);
  } 
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxeku5W07_QCAKkgVohqZBfej4JPxzlhw&callback=initMap" async defer></script>
<?php 
}
?>
</body>
</html>
<?=$this->endsection()?>