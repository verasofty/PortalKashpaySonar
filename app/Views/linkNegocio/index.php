<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d");

$curl = curl_init();
//echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/businessLink?sirioId='.$_GET['validate'];
curl_setopt_array($curl, array(
  CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/businessLink?sirioId='.$_GET['validate'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic YWRtaW46c2VjcmV0',
    'Cookie: JSESSIONID=A58782BB5F83A4A77F3D2E07BD078C72'
  ),
));

$response = curl_exec($curl);


curl_close($curl);

$datos['row'] = json_decode($response);

//var_dump($datos['row']);

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
?>
<script type="text/javascript">
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
<?php
//var_dump($datos['rows']);
?>
  <!-- -------------- /Topbar -------------- -->
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
      
            <div class="row">
              <form method="post" class="form-kash" name="form-pay" id="form-pay">
                <div class="col-md-2"></div>
                <div class="col-md-8 ">
                  <div class="row">
                    <h5 class="text-center text-dorado">PAGOS A DISTANCIA</h5>
                  </div>
                  <div class="panel panel-visible infoOcultar">
                    <div class="panel-body pn areaForm">
                      <div class="row">
                        <div class="col-md-12 mb-5">
                          <p class="text-16 text-center"><b>¡Bienvenido! a la página de pago de:</b></p>
                          <?php
                          $name = ($datos['row']->name != 'NA') ? $datos['row']->name : '' ;
                          $paternalSurname = ($datos['row']->paternalSurname != 'NA') ? $datos['row']->paternalSurname : '' ;
                          $maternalSurname = ($datos['row']->maternalSurname != 'NA') ? $datos['row']->maternalSurname : '' ;
                          ?>
                          <p class="text-16 "><?php echo $name.' '.$paternalSurname.' '.$maternalSurname?></p>
                          <p class="text-16 ">Celular: <?php echo $datos['row']->phoneNumber?></p>
                        </div>
                      </div>
                    </div>
                  </div>                  
                  <div class="panel panel-visible">
                    <div class="panel-body pn">
                      <div class="col-md-12">
                        <div class="p-3 border rounded m-10" style="margin: 5% 0%;">
                          <p>Ingresa el monto y concepto para que puedan identificar tu pago.</p>
                          <p>Recuerda que puedes pagar con tarjeta de Crédito, débito, pagos en efectivo o SPEI.</p>
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
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Monto</span>
                            <input type="text" id="monto" name="monto" class="form-control monto" placeholder="0.00" value="">
                            <small class="error" id="error-monto"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Concepto</span>
                            <input type="text" id="concepto" name="concepto" class="form-control" placeholder="" >
                            <small class="error" id="error-concepto"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Nombre</span>
                            <input type="hidden" id="sirio" name="sirio" class="form-control" value="<?php echo $datos['row']->idSirio?>" >
                            <input type="hidden" id="emailComer" name="emailComer" class="form-control" value="<?php echo $datos['row']->email?>" >
                            <input type="hidden" id="orderingAccount" name="orderingAccount" class="form-control" value="<?php echo $datos['row']->onsignaEntity->virtualAccount?>" >
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="" >
                            <small class="error" id="error-nombre"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Apellido Paterno</span>
                            <input type="text" id="apaterno" name="apaterno" class="form-control" placeholder="" >
                            <small class="error" id="error-apaterno"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Apellido Materno</span>
                            <input type="text" id="amaterno" name="amaterno" class="form-control" placeholder="" >
                            <small class="error" id="error-amaterno"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Correo Electrónico</span>
                            <input type="text" id="email" name="email" class="form-control" placeholder="" >
                            <small class="error" id="error-email"></small>
                          </div>
                          <div class="col-md-12 pad-adjust">
                            <span class="help-block text-black small-font">Teléfono</span>
                            <input maxlength="10" type="text" id="telefono" name="telefono" class="form-control soloNum" placeholder="" >
                            <small class="error" id="error-tel"></small>
                          </div>
                        </div>
                        <div class="row" style="margin-top:15px;">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="btn-add" name="btn-add" class="btn btn-azul btn-block"
                            >Continuar </button>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2 pad-adjust mb-5"></div>
                          <div class="col-md-1 pad-adjust mb-5">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2"></div>

              </form>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-file-notifications.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/linkNegocio.js"></script>
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxeku5W07_QCAKkgVohqZBfej4JPxzlhw&callback=initMap" async defer></script>

</body>
</html>
<?=$this->endsection()?>