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
    var montoGlobal = '<?php echo $datos['rows']->payOrder->amount?>';
    var idsirio = '<?php echo $datos['rows']->payOrder->sirioId?>';
    var cuentaV = '<?php echo $datos['rows']->payOrder->orderingAccount?>';

    var host = '<?php echo $_SERVER["HTTP_HOST"]?>';
    var uri  = '<?php echo $_SERVER["REQUEST_URI"]?>';
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
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <header style="background: #333F50;" id="topbar" class="alt">
    <div class="topbar-left">
      <ol class="breadcrumb">
        <li class="breadcrumb-icon">
          <a href="#">
            <!--img style="width: 36%;" src="<?php //echo base_url()?>/public/assets/img/logo_kashpay_sobra.png"-->
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
        <div class="center-block">
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
                <div class="col-md-4 ">
                  <div class="row">
                    <div class=" col-md-12 logoPago text-center infoOcultar">
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
                  <div class="panel panel-visible infoOcultar">
                    <div class="panel-body pn areaForm">
                      <div class="row">
                        <div class="col-md-12 mb-5">
                          <p class="text-16 text-center"><b>Detalles del pago</b></p>
                          <span class="text-black">Referencia: <b class="text-black"><?php echo $datos['rows']->payOrder->payInfo->reference;?></b></span></span><br>
                          <span class="text-black">Importe: <b class="text-black">$ <?php echo number_format( $datos['rows']->payOrder->amount,2 );?></b></span></span><br>
                          <span class="text-black">Concepto: <b class="text-black"><?php echo $datos['rows']->payOrder->payInfo->description;?></b></span></span><br>
                          <span class="text-black">Este link de pago vence en 72 horas despues de la fecha de creación</span><br>
                        </div>
                        <div class="col-md-12" id="div-btn-pago">
                          <button type="button"  class="btn btn-azul btn-pago form-control">Pagar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  
                  <div class="panel panel-visible infoOcultar">
                    <div class="panel-body pn">
                      <div class="col-md-12">
                        <div class="p-3 border rounded m-10" style="margin: 5% 0%;">
                          <p><?php echo $datos['rows']->payOrder->merchantInfo->name;?></p>
                          <p><?php echo $datos['rows']->payOrder->merchantInfo->rfc;?></p>
                          <p><?php echo $datos['rows']->payOrder->merchantInfo->address;?></p>
                        </div>
                      </div>  
                    </div>
                  </div>

                  <div class="credit-card-div" id="pay_option">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-md-12 pad-adjust mb-5">
                            <img style="width:100%;padding: 15px 0px;" src="<?php echo base_url()?>/public/assets/img/linkPago/marcas.png">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 pad-adjust mb-5">
                              <p class="text-grey text-18"><b>¿Cómo quieres pagar?</b></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2 pad-adjust mb-5"></div>
                          <div class="col-md-1 pad-adjust mb-5">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="tooltipsTP check_option_pay" data-value="card">                     
                              <label class="circuloTP"> 
                                <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos en portal/ic_card.png">
                                <p>Tarjeta de Crédito o Débito</p>
                              </label>
                            </div>
                            <div class="tooltipsTP check_option_pay" data-value="cash">                     
                              <label class="circuloTP"> 
                                <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos en portal/ic_cash.png">
                                <p>Efectivo</p>
                              </label>
                            </div>
                            <div class="tooltipsTP check_option_pay" data-value="transfer">                     
                              <label class="circuloTP"> 
                                <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos en portal/ic_bank.png">
                                <p>Transferencia</p>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="pay_cash">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <p class="help-block text-dorado small-font">ELIGE EL CORRESPONSAL PARA REALIZAR UN DEPÓSITO. </p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="corresponsales">
                            <div class="row">
                              <div class="col-md-3 col-xs-6">
                                <div class="tooltips tooltipsCorres" data-imgcorres="telecomm" data-namecorres="Telegrafos Telecomm">                     
                                  <label class="circulo"> 
                                    <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/telecomm.png">
                                    <p>Telecomm</p>
                                    <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-3 col-xs-6">
                                <div class="tooltips tooltipsCorres" data-imgcorres="farmaciaAhorro" data-namecorres="Farmacia del Ahorro">                     
                                  <label class="circulo"> 
                                    <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/farmaciaAhorro.png">
                                    <p>Farmacia del Ahorro</p>
                                    <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-3 col-xs-6">
                                <div class="tooltips tooltipsCorres" data-imgcorres="ley" data-namecorres="Ley">                     
                                  <label class="circulo"> 
                                    <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/ley.png">
                                    <p>Ley</p>
                                    <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-3 col-xs-6">
                                <div class="tooltips tooltipsCorres" data-imgcorres="alsuper" data-namecorres="Al Super">                     
                                  <label class="circulo"> 
                                    <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/alsuper.png">
                                    <p>Al Super</p>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-1 col-xs-12"></div>
                              <div class="col-md-10 col-xs-12">
                                
                                <div class="col-md-4 col-xs-6">
                                  <div class="tooltips tooltipsCorres" data-imgcorres="superFarmacia" data-namecorres="Super Farmacia">                     
                                    <label class="circulo"> 
                                      <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/superFarmacia.png">
                                      <p>Farmacia Guadalajara</p>
                                      <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                  <div class="tooltips tooltipsCorres" data-imgcorres="citiBanamex" data-namecorres="Citi Banamex">                     
                                    <label class="circulo"> 
                                      <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/citiBanamex.png">
                                      <p>Citi Banamex</p>
                                      <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                  <div class="tooltips tooltipsCorres" data-imgcorres="7eleven" data-namecorres="7-eleven">                     
                                    <label class="circulo"> 
                                      <img class="logoPago" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/7eleven.png">
                                      <p>7 Eleven</p>
                                      <!--small>El pago sera acreditado de 1 a 2 di+ías habiles.</small-->
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-1 col-xs-12"></div>
                            </div>
                            
                            <?php
                            $corres_name = array('7eleven','alsuper', 'farmaciaAhorro', 'ley', 'citiBanamex', 'farmaciaGuadalajara', 'telecomm');
                            ?>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="pay_transfer">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <form method="post" class="form-kash" name="form-pay" id="form-pay">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="help-block text-dorado small-font">TRANSFERENCIA </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="tab-block mb25">
                                <ul class="nav nav-tabs tabs-border nav-justified">
                                  <li class="active">
                                    <a href="#tab15_1" data-toggle="tab">Desde México</a>
                                  </li>
                                  <li>
                                    <a href="#tab15_2" data-toggle="tab">Desde USA</a>
                                  </li>
                                </ul>
                                <div class="tab-content">
                                  <div id="tab15_1" class="tab-pane active">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <p class="text-16 text-dorado" id="name_mx">Margarita Gomez Velazquez</p>
                                        <p class="text-16 text-black">Clabe interbancaria</p>
                                        <span id="copy_mx_clabe" class="text-14 text-black">288834002984235422</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_mx_clabe')">
                                          <i class="far fa-copy"></i>
                                        </a>   
                                        <p class="text-16 text-black">Número de celular</p>
                                        <span id="copy_mx_cel" class="text-14 text-black">+52 12345678</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_mx_cel')">
                                          <i class="far fa-copy"></i>
                                        </a> 
                                        <p class="text-16 text-black">Número de cuenta</p>
                                        <span id="copy_mx_nc" class="text-14 text-black">123456</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_mx_nc')">
                                          <i class="far fa-copy"></i>
                                        </a> 
                                        <p class="text-16 text-black">Número de sucursal</p>
                                        <span id="copy_mx_ns" class="text-14 text-black">6506</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_mx_ns')">
                                          <i class="far fa-copy"></i>
                                        </a> 
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-xs-4"></div>
                                      <div class="col-md-4 col-xs-4">
                                        <img style="width: 100%;" class="text-center" src="<?php echo base_url()?>/public/assets/img/linkPago/corresponsales/citiBanamex.png">
                                      </div>
                                      <div class="col-md-4 col-xs-4"></div>
                                    </div>
                                    <div class="row">
                                      <div style="height: 50px;"></div>
                                      <div class="col-md-4 col-xs-4 text-center">
                                        <a type="button" target="_blank" id="btnSave1" class="text-blue"><i class="fas fa-download"></i></a>
                                      </div>
                                      <div class="col-md-4 col-xs-4 text-center">
                                        <a type="button" target="_blank" class="text-blue correo_mx" target="_blank">
                                          <i class="fas fa-at"></i>
                                        </a>
                                      </div>
                                      <div class="col-md-4 col-xs-4 text-center">
                                        <a type="button" target="_blank" class="text-blue whatsapp_mx" href="#">
                                          <i class="fab fa-whatsapp"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="tab15_2" class="tab-pane">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <p class="text-16 text-dorado" id="name_usa">Margarita Gomez Velazquez</p>
                                        <p class="text-16 text-black">Número Móvil</p>
                                        <span id="copy_usa_cel" class="text-14 text-black">+52 55 5656 5656</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_usa_cel')">
                                          <i class="far fa-copy"></i>
                                        </a>   
                                        <p class="text-16 text-black">Dirección</p>
                                        <span id="copy_usa_dir" class="text-14 text-black">5 de Mayo n.23, C.P. 0900 Santa Cruz,<br>
                                        Iztapalapa, Ciudad de México</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_usa_dir')">
                                          <i class="far fa-copy"></i>
                                        </a>   
                                        <p class="text-16 text-black">Banco</p>
                                        <span class="text-14 text-black">Citi Banamex</span>
                                        <p class="text-16 text-black">Dirección de Banco</p>
                                        <span id="copy_usa_db" class="text-14 text-black">5 de Mayo n.23, C.P. 0900 Santa Cruz,<br>
                                        Iztapalapa, Ciudad de México</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_usa_db')">
                                          <i class="far fa-copy"></i>
                                        </a>
                                        <p class="text-16 text-black">Clabe Interbancaria</p>
                                        <span id="copy_usa_clabe" class="text-14 text-black">2888 3400 98 4235422355</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_usa_clabe')">
                                          <i class="far fa-copy"></i>
                                        </a>
                                        <p class="text-16 text-black">SWIFT/BIC</p>
                                        <span id="copy_usa_bic" class="text-14 text-black">Abc123456</span>
                                        <a type="button" class="text-dorado pull-right notification" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('#copy_usa_bic')">
                                          <i class="far fa-copy"></i>
                                        </a>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div style="height: 50px;"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-xs-4 text-center">
                                        <a type="button" target="_blank" id="btnSave2" class="text-blue">
                                          <i class="fas fa-download"></i>
                                        </a>
                                      </div>
                                      <div class="col-md-4 col-xs-4 text-center ">
                                        <a type="button" target="_blank" class="text-blue correo_usa">
                                          <i class="fas fa-at"></i>
                                        </a>
                                      </div>
                                      <div class="col-md-4 col-xs-4 text-center">
                                        <a type="button" target="_blank" class="text-blue whatsapp_usa" href="#">
                                          <i class="fab fa-whatsapp"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="pay_card">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <h6 class="text-dorado">Propinas </h6>
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-md-12 conjuntoColores">
                            <div class="col-xs-3 col-md-3">
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina5" name="checkformColor" value="5" type="radio" />
                                  <span>5%</span>
                                </label>
                              </div>
                            </div>
                            <div class="col-xs-3 col-md-3">       
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina10" name="checkformColor" value="10" type="radio" />
                                  <span>10%</span>
                                </label>
                              </div>
                            </div> 
                            <div class="col-xs-3 col-md-3">  
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina15" name="checkformColor" value="15" type="radio" />
                                  <span>15%</span>
                                </label>
                              </div>
                            </div> 
                            <div class="col-xs-3 col-md-3">   
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina20" name="checkformColor" value="20" type="radio" />
                                  <span>20%</span>
                                </label>
                              </div>
                            </div> 
                            
                          </div>
                          <div class=" col-md-12 conjuntoColores">
                            <div class="col-xs-3 col-md-3"> 
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina25" name="checkformColor" value="25" type="radio"  />
                                  <span>25%</span>
                                </label>
                              </div>
                            </div> 
                            <div class="col-xs-3 col-md-3">   
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck"  id="propina30" name="checkformColor" value="30" type="radio"  />
                                  <span>30%</span>
                                </label>
                              </div>
                            </div> 
                            <div class="col-xs-3 col-md-3">
                              <div class="tooltipsPro">                 
                                <label class="circuloPro circuloCheck">
                                  <input  class="colorcheck otro"  id="propinaOtro" name="checkformColor" value="otro" type="radio" />
                                  <span>Otro monto</span>
                                </label>
                              </div>
                            </div> 
                          </div>
                        </div>
                        <div class="row" id="divPropina">
                          <div class="col-md-4 col-sm-2 col-xs-2"></div>
                          <div class="col-md-4 col-sm-8 col-xs-8">
                            <div class="col-md-12 pad-adjust">
                              <span class="help-block text-black small-font">Propina en $</span>
                              <input type="text" style="box-shadow: 1px 6px 8px #1717177a;" id="propina" name="propina" class="form-control monto" placeholder="0.00">
                              <small class="error" id="error-name"></small>
                            </div>  
                          </div>
                          <div class="col-md-4 col-sm-2 col-xs-2">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <h6 class="text-dorado">Detalles de Tarjeta</h5>
                            <p class="text-black">Ingresa y verifica los datos de tu tarjeta</p>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font"></span>
                            <input type="text" id="nameCard" name="nameCard" class="form-control" placeholder="Nombre del titular">
                            <input type="hidden" value="0.00" id="propinaHide" name="propinaHide" class="form-control" placeholder="">
                            <input type="hidden" value="0.00" id="propinaMonto" name="propinaMonto" class="form-control" placeholder="">
                            <small class="error" id="error-name"></small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font"></span>
                            <input type="text" id="numCard" name="numCard" class="form-control" placeholder="Número de tarjeta" maxlength="19">
                            <small class="error" id="error-card"></small>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-4">
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
                          <div class="col-md-4 col-sm-4 col-xs-4">
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
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <span class="help-block text-black small-font"></span>
                            <input type="password" class="form-control" placeholder="CCV" name="ccv" id="ccv" maxlength="4">
                            <small class="error" id="error-ccv"></small>
                          </div>
                        </div>
                        <!--div class="row" style="margin-top:15px;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" name="infoAdi" id="infoAdi">
                              <label class="form-check-label" for="infoAdi">
                                ¿Deseas enviar información adicional?
                              </label>
                            </div>
                          </div>
                        </div-->
                        <div style="margin-top:15px;" id="info-adicional">
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
                        </div>
                        <div class="row" style="margin-top:15px;">
                          <!--div class="col-md-6 col-sm-6 col-xs-12 pad-adjust">
                            <button class="btn btn-danger">Cancelar</button>
                          </div-->
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="btn-next" name="btn-next" class="btn btn-azul btn-block"
                            >Continuar </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="pay_cash_method">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row" style="margin-bottom: 5px;">
                          <!--div class="col-md-12 pad-adjust">
                              <p class="text-black">Revisa tu compra</p>
                          </div-->
                          <div class="col-md-12 pad-adjust selectCorres">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-corres">
                            <!--span class="help-block text-black small-font">Email </span>
                            <input type="email" class="form-control" placeholder="Email" name="email_cash" id="email_cash" value="<?php //echo $datos['rows']->payOrder->customerInfo->email;?>"-->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="pay_trans_method">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row" style="margin-bottom: 5px;">
                          <div class="col-md-12 pad-adjust">
                              <p class="text-black">Revisa tu compra</p>
                          </div>
                          <div class="col-md-12 pad-adjust selectBanco">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-bancos">
                            <span class="help-block text-black small-font">Email </span>
                            <input type="email" class="form-control" placeholder="Email" name="email_transfer" id="email_transfer" value="<?php echo $datos['rows']->payOrder->customerInfo->email;?>">
                            <small class="error"></small>
                            <input type="hidden" id="orderingAccount" name="orderingAccount" value="<?php echo $datos['rows']->payOrder->orderingAccount;?>">
                            <input type="hidden" id="emailPer" name="emailPer" value="<?php echo $datos['rows']->payOrder->customerInfo->email;?>">
                            <input type="hidden" id="sirioId" name="sirioId" value="<?php echo $datos['rows']->payOrder->sirioId;?>">
                            <input type="hidden" id="amount" name="amount" value="<?php echo $datos['rows']->payOrder->amount;?>">
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="credit-card-div" id="resumen">
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
                                  <td class="text-black">Link de pago</td>
                                </tr>
                                <tr>
                                  <td class="text-black">Destinatario</td>
                                  <td id="verDest" class="text-black"><?php echo $datos['rows']->payOrder->orderingAccount?></td>
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
                                  <td class="text-black">Propina</td>
                                  <td class="text-black" id="verPropina"></td>
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
                  </div>
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
  <!-- -------------- HighCharts Plugin -------------- -->
  <script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>
  <!-- -------------- Plugins -------------- -->
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/html2canvas.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/canvas2image.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>
  <!-- -------------- Theme Scripts -------------- -->
  <script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-file-notifications.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagarLinkPago.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
  <script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
  <script>
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
    $("#btnSave1").click(function() {
      html2canvas($("#tab15_1"), {
        onrendered: function(canvas) {
          saveAs(canvas.toDataURL(), 'TransferenciaMNX_<?php echo $_GET['reference']?>.png');
        }
      });
    });
    $("#btnSave2").click(function() {
      html2canvas($("#tab15_2"), {
        onrendered: function(canvas) {
          saveAs(canvas.toDataURL(), 'TransferenciaUSA_<?php echo $_GET['reference']?>.png');
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
    $(".whatsapp_mx").click(function(event) {
      event.preventDefault();
      var texto = '*Transferencias desde México*\n\n'+
                  '*Nombre:*\n'+
                  $('#name_mx').text()+'\n'+
                  '*Clabe Interbancaria:* \n'+
                  $('#copy_mx_clabe').text()+'\n'+
                  '*Número de celular:* \n'+
                  $('#copy_mx_cel').text()+'\n'+
                  '*Número de Cuenta:* \n'+
                  $('#copy_mx_nc').text()+'\n'+
                  '*Número de Sucursal:* \n'+
                  $('#copy_mx_ns').text();
                  
      //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
      window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));

    });
    $(".whatsapp_usa").click(function(event) {
      event.preventDefault();
      var texto = '*Transferencias desde USA*\n\n'+
                  '*Nombre:*\n'+
                  $('#name_usa').text()+'\n'+
                  '*Número Móvil:* \n'+
                  $('#copy_usa_cel').text()+'\n'+
                  '*Dirección:* \n'+
                  $('#copy_usa_dir').text()+'\n'+
                  '*Dirección de Banco:* \n'+
                  $('#copy_usa_db').text()+'\n'+
                  '*Clabe Interbancaria:* \n'+
                  $('#copy_usa_clabe').text()+'\n'+
                  '*SWIFT/BIC:* \n'+
                  $('#copy_usa_bic').text();
                  
      //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
      window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));

    });
    $(".correo_mx").click(function(event) {
      event.preventDefault();
      var texto = '*Transferencias desde México*\n\n'+
                  '*Nombre:*\n'+
                  $('#name_mx').text()+'\n'+
                  '*Clabe Interbancaria:* \n'+
                  $('#copy_mx_clabe').text()+'\n'+
                  '*Número de celular:* \n'+
                  $('#copy_mx_cel').text()+'\n'+
                  '*Número de Cuenta:* \n'+
                  $('#copy_mx_nc').text()+'\n'+
                  '*Número de Sucursal:* \n'+
                  $('#copy_mx_ns').text();
                  
      //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
      //window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));
      window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));


    });
    $(".correo_usa").click(function(event) {
      event.preventDefault();
      var texto = '*Transferencias desde USA*\n\n'+
                  '*Nombre:*\n'+
                  $('#name_usa').text()+'\n'+
                  '*Número Móvil:* \n'+
                  $('#copy_usa_cel').text()+'\n'+
                  '*Dirección:* \n'+
                  $('#copy_usa_dir').text()+'\n'+
                  '*Dirección de Banco:* \n'+
                  $('#copy_usa_db').text()+'\n'+
                  '*Clabe Interbancaria:* \n'+
                  $('#copy_usa_clabe').text()+'\n'+
                  '*SWIFT/BIC:* \n'+
                  $('#copy_usa_bic').text();
                  
      //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
      //window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));
      window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
    });
    $(".btnSave").click(function() {
      console.log('save');
      html2canvas($("#selectCorres"), {
        onrendered: function(canvas) {
          saveAs(canvas.toDataURL(), 'Efectivo_<?php echo $_GET['reference']?>.png');
        }
      });
    });
    $(".correoCash").click(function(event) {
      event.preventDefault();
      var texto = '*Transferencias desde USA*\n\n'+
                  '*Nombre:*\n'+
                  $('#name_usa').text()+'\n'+
                  '*Número Móvil:* \n'+
                  $('#copy_usa_cel').text()+'\n'+
                  '*Dirección:* \n'+
                  $('#copy_usa_dir').text()+'\n'+
                  '*Dirección de Banco:* \n'+
                  $('#copy_usa_db').text()+'\n'+
                  '*Clabe Interbancaria:* \n'+
                  $('#copy_usa_clabe').text()+'\n'+
                  '*SWIFT/BIC:* \n'+
                  $('#copy_usa_bic').text();
                  
      //window.location.href = encodeURI('https://api.whatsapp.com/send?text='+texto);
      //window.open(encodeURI('https://api.whatsapp.com/send?text='+texto));
      window.open(encodeURI('mailto:correo@ejemplo.com?subject=Pago a distancia&body='+texto,'_blank'));
    });
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxeku5W07_QCAKkgVohqZBfej4JPxzlhw&callback=initMap" async defer></script>
<?php 
}else{
?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
  <header style="background: #333F50;" id="topbar" class="alt">
    <div class="topbar-left">
      <ol class="breadcrumb">
        <li class="breadcrumb-icon">
          <a href="#">
            <!--img style="width: 36%;" src="<?php //echo base_url()?>/public/assets/img/logo_kashpay_sobra.png"-->
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
            <div class="panel panel-visible">
              <div class="panel-body pn">
                <h4 class="text-center"><i class="fas fa-exclamation-triangle"></i> La referencia proporcionada no existe</h4>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagarLinkPago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>

<script type="text/javascript">
  function redireccionarPagina() {
    window.location = 'voucher?reference=<?php echo $_GET['reference']?>'; 
  }
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
  $("#btnSave1").click(function() {
    html2canvas($("#figuras"), {
      onrendered: function(canvas) {
        saveAs(canvas.toDataURL(), '<?php echo $_GET['reference']?>.png');
      }
    });
  });
  $("#btnSave2").click(function() {
    html2canvas($("#figuras"), {
      onrendered: function(canvas) {
        saveAs(canvas.toDataURL(), '<?php echo $_GET['reference']?>.png');
      }
    });
  });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxeku5W07_QCAKkgVohqZBfej4JPxzlhw&callback=initMap" async defer></scrip>

<?php
}
?>
</body>
</html>
<?=$this->endsection()?>