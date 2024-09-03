<!DOCTYPE html>
<html>
<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>KashPay</title>
    <meta name="keywords" content="Adquirencia, Kash, Kashpay, KashPay"/>
    <meta name="description" content="Adquirencia, Kash, Kashpay, KashPay">
    <meta name="author" content="Onsigna">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!-- -------------- Icomoon -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/fonts/icomoon/icomoon.css">

    <!-- -------------- FullCalendar -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/magnific/magnific-popup.css">

    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/c3charts/c3.min.css">

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/custom.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/allcp/forms/css/forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/allcp/forms/css/menu.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url()?>/public/assets/img/favicon.png">
    <script type="text/javascript">
      var base_url = '<?php echo base_url()?>';
      <?php 
      if(isset($_GET["validate"])){
        if(!empty($_GET['validate'])){
          $valValidate = $_GET["validate"];
        }else{
          $valValidate = 'na';
        }
      }else{
        $valValidate = 'na';
      }
      ?>
      var token = '<?php echo $valValidate?>';
    </script>
    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="utility-page sb-l-c sb-r-c">
<?php 
  //include_once APPPATH.'/Views/menu/index.php';
?>

<!-- -------------- Body Wrap  -------------- -->
<div id="main" class="animated fadeIn">

    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!-- -------------- Content -------------- -->
        <section id="content" class="">

            <!-- -------------- Registration -------------- -->
            <div class="allcp-form theme-primary " id="register">
                <div class="panel panel-primary">
                  <div class="panel-heading pn text-center">
                    <span class="panel-title">
                      Unete a KashPay
                    </span>
                    <p>Es facil y te toma unos minutos</p>
                  </div>
                  <!-- -------------- /Panel Heading -------------- -->
                  <form method="post" action="/" id="form-wizard">
                    <div class="wizard steps-bg clearfix steps-left">
                      <!-- -------------- step 1 -------------- -->
                      <h4 class="wizard-section-title">Tu Negocio</h4>
                      <section class="wizard-section">
                        <div class="row" id="div">
                          <div class="col-md-12">
                            <div class="alert alert-info alert-dismissable">
                              ¡Cuenta verificada! Tu cuenta se verifico exitosamente.
                              <br>
                              Configura tu cuenta para realizar tu primer transacción con KashPay.
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="nombre">Nombre del negocio</label>
                              <input type="text" disabled class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp"> 
                              <small id="nombreHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="rfcSub">RFC</label>
                              <input type="text" maxlength="13" class="form-control rfc" id="rfcSub" name="rfcSub" aria-describedby="rfcSubHelp"> 
                              <small id="rfcSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Dirección</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="calleSub">Calle</label>
                              <input type="text" class="form-control" id="calleSub" name="calleSub" aria-describedby="calleSubHelp">
                              <small id="calleSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numExtSub">Número Exterior</label>
                              <input type="text" class="form-control" id="numExtSub" name="numExtSub" aria-describedby="numExtSubHelp">
                              <small id="numExtSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numIntSub">Número Interior</label>
                              <input type="text" class="form-control" id="numIntSub" name="numIntSub" aria-describedby="numIntSubHelp">
                              <small id="numIntSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="cpSub">Código Postal</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cpSub" name="cpSub" aria-describedby="cpSubHelp">
                              <small id="cpSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="colSub">Colonia</label>
                              <select class="form-control" id="colSub" name="colSub">
                                <option></option>
                              </select>
                              <small id="colSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="delSub">Municipio/Alcaldia</label>
                              <select class="form-control" id="delSub" name="delSub">
                                <option></option>
                              </select>
                              <small id="delSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="edoSub">Estado</label>
                              <select class="form-control" id="edoSub" name="edoSub">
                                <option></option>
                              </select>
                              <small id="edoSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- -------------- step 2 -------------- -->
                      <h4 class="wizard-section-title">Añade Entidad</h4>
                      <section class="wizard-section">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="option-group field">
                              <div class="col-md-12">
                                <label class="option block option-primary">
                                  <input type="checkbox" class="copiarInfo">
                                  <span class="checkbox"></span> ¿Desea usar la información del negocio?
                                </label>
                              </div>
                            </div>
                            <div style="height: 60px;"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="namecommerce">Nombre del Comercio</label>
                              <input type="text" class="form-control" id="namecommerce" name="namecommerce" aria-describedby="namecommerceHelp">
                              <input type="hidden" class="form-control" id="idContext" name="idContext">
                              <input type="hidden" class="form-control" id="idEntity" name="idEntity">
                              <input type="hidden" class="form-control" id="idRol" name="idRol">
                              <input type="hidden" class="form-control" id="nombreCom" name="nombreCom">
                              <small id="namecommerceHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="giro">Giro del Comercio</label>
                              <select class="form-control" id="giro" name="giro">
                                <option></option>
                                <?php
                                $actividades = array();
                                for ($iGiro=0; $iGiro < count($giros) ; $iGiro++) { 
                                  echo '<option value="'.$giros[$iGiro]->idGiro.'">'.$giros[$iGiro]->giro.'</option>';
                                  $actividades = $giros;
                                }

                                ?>
                                <script type="text/javascript">
                                  var actividadesGiros = [] = <?php echo json_encode($actividades);?>;
                                </script>
                              </select>
                              <small id="giroHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="actividad">Especifica tu Actividad</label>
                              <select class="form-control" id="actividad" name="actividad">
                                <option></option>
                              </select>
                              <small id="actividadHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Cuenta de la Entidad</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="emailEnt">Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailEnt" name="emailEnt" aria-describedby="emailEntHelp">
                              <small id="emailEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="emailEntCon">Confirmar Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailEntCon" name="emailEntCon" aria-describedby="emailEntConHelp">
                              <small id="emailEntConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="contrasenaEnti">Contraseña</label>
                              <input type="password" class="form-control" id="contrasenaEnti" name="contrasenaEnti" aria-describedby="contrasenaEntiHelp">
                              <small id="contrasenaEntiHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="contrasenaEntiConf">Confirmar Contraseña</label>
                              <input type="password" class="form-control" id="contrasenaEntiConf" name="contrasenaEntiConf" aria-describedby="contrasenaEntiConfHelp">
                              <small id="contrasenaEntiConfHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telEnt">Teléfono</label>
                              <input type="tel" maxlength="10" class="form-control soloNum" id="telEnt" name="telEnt" aria-describedby="telEntHelp">
                              <small id="telEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Dirección</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="calleEnt">Calle</label>
                              <input type="text" class="form-control" id="calleEnt" name="calleEnt" aria-describedby="calleEntHelp">
                              <small id="calleEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numExtEnt">Número Exterior</label>
                              <input type="text" class="form-control" id="numExtEnt" name="numExtEnt" aria-describedby="numExtEntHelp">
                              <small id="numExtEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numIntEnt">Número Interior</label>
                              <input type="text" class="form-control" id="numIntEnt" name="numIntEnt" aria-describedby="numIntEntHelp">
                              <small id="numIntEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="cpEnt">Código Postal</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cpEnt" name="cpEnt" aria-describedby="cpEntHelp">
                              <small id="cpEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="colEnt">Colonia</label>
                              <select class="form-control" id="colEnt" name="colEnt">
                                <option></option>
                              </select>
                              <small id="colEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="delEnt">Municipio/Alcaldia</label>
                              <select class="form-control" id="delEnt" name="delEnt">
                                <option></option>
                              </select>
                              <small id="delEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="edoEnt">Estado</label>
                              <select class="form-control" id="edoEnt" name="edoEnt">
                                <option></option>
                              </select>
                              <small id="edoEntHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- -------------- step 3 -------------- -->
                      <h4 class="wizard-section-title">Añade Sucursal</h4>
                      <section class="wizard-section">
                        <div class="row divInfo">
                          <div class="col-md-12">
                            <div class="alert alert-info alert-dismissable">
                              ¡Recuerda!
                              <br>
                              No puedes añadir una sucursal y una caja sin añadir antes una entidad.
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="option-group field">
                              <div class="col-md-12">
                                <label class="option block option-primary">
                                  <input type="checkbox" class="copiarInfoSuc">
                                  <span class="checkbox"></span> ¿Desea usar la información de la entidad?
                                </label>
                              </div>
                            </div>
                            <div style="height: 60px;"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Datos de la Sucursal</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="nombreCol">Nombre de la Sucursal</label>
                              <input type="text" class="form-control" id="nombreSuc" name="nombreSuc" aria-describedby="nombreSucHelp">
                              <small id="nombreSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="nombreCol">RFC</label>
                              <input type="text" maxlength="13" class="form-control rfc" id="rfc" name="rfc" aria-describedby="rfcHelp">
                              <small id="rfcHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="apaternoCol">Razón Social</label>
                              <input type="text" class="form-control" id="razonSocialSuc" name="razonSocialSuc" aria-describedby="razonSocialSucHelp">
                              <small id="razonSocialSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="regimenFis">Regimen fiscal</label>
                              <select  class="form-control" id="regimenFis" name="regimenFis" aria-describedby="regimenFisHelp">
                                <option></option>
                                <?php
                                for ($iregFis=0; $iregFis < count($regimenFiscal->catFiscalRegimes); $iregFis++) {
                                  echo '<option value="'.$regimenFiscal->catFiscalRegimes[$iregFis]->idFiscalRegime.'">'.$regimenFiscal->catFiscalRegimes[$iregFis]->descripcion.'</option>';
                                }
                                ?>
                              </select>
                              <small id="regimenFisHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Cuenta de Sucursal</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="emailSuc">Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailSuc" name="emailSuc" aria-describedby="emailSucHelp">
                              <small id="emailSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="emailSucCon">Confirmar Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailSucCon" name="emailSucCon" aria-describedby="emailSucConHelp">
                              <small id="emailSucConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="contrasena">Contraseña</label>
                              <input type="password" class="form-control" id="contrasena" name="contrasena" aria-describedby="contrasenaHelp">
                              <small id="contrasenaHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="confCon">Confirmar Contraseña</label>
                              <input type="password" class="form-control" id="confCon" name="confCon" aria-describedby="confConConHelp">
                              <small id="confConConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telSuc">Teléfono</label>
                              <input type="tel" maxlength="10" class="form-control soloNum" id="telSuc" name="telSuc" aria-describedby="telSucHelp">
                              <small id="telSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Dirección</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="calleSuc">Calle</label>
                              <input type="text" class="form-control" id="calleSuc" name="calleSuc" aria-describedby="calleSucHelp">
                              <small id="calleSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numExtSuc">Número Exterior</label>
                              <input type="text" class="form-control" id="numExtSuc" name="numExtSuc" aria-describedby="numExtSubHelp">
                              <small id="numExtSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="numIntSuc">Número Interior</label>
                              <input type="text" class="form-control" id="numIntSuc" name="numIntSuc" aria-describedby="numIntSucHelp">
                              <small id="numIntSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="cpSuc">Código Postal</label>
                              <input type="text" maxlength="5" class="form-control soloNum" id="cpSuc" name="cpSuc" aria-describedby="cpSucHelp">
                              <small id="cpSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="colSuc">Colonia</label>
                              <select class="form-control" id="colSuc" name="colSuc">
                                <option></option>
                              </select>
                              <small id="colSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="delSuc">Municipio/Alcaldia</label>
                              <select class="form-control" id="delSuc" name="delSuc">
                                <option></option>
                              </select>
                              <small id="delSucHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="edoSub">Estado</label>
                              <select class="form-control" id="edoSuc" name="edoSuc">
                                <option></option>
                              </select>
                              <small id="edoSubHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </section>
                      <!-- -------------- step 4 -------------- -->
                      <h4 class="wizard-section-title">Añade Caja</h4>
                      <section class="wizard-section">
                        <div class="row divInfo">
                          <div class="col-md-12">
                            <div class="alert alert-info alert-dismissable">
                              ¡Recuerda!
                              <br>
                              No puedes añadir una sucursal y una caja sin añadir antes una entidad.
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Datos Personales del Colaborador</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="nombreCol">Nombre</label>
                              <input type="text" class="form-control" id="nombreCol" name="nombreCol" aria-describedby="nombreColHelp">
                              <small id="nombreColHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="apaternoCol">Apellido Paterno</label>
                              <input type="text" class="form-control" id="apaternoCol" name="apaternoCol" aria-describedby="apaternoColHelp">
                              <small id="apaternoColConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="amaternoCol">Apellido Materno</label>
                              <input type="text" class="form-control" id="amaternoCol" name="amaternoCol" aria-describedby="amaternoColHelp">
                              <small id="amaternoColConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="tipocol">Tipo de colaborador</label>
                              <select class="form-control" id="tipocol" name="tipocol">
                                <option></option>
                                <option value="2">Gerente</option>
                                <option value="3">Cajero</option>
                                <option value="4">Finanzas</option>
                              </select>
                              <small id="tipocolHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3>Cuenta de Colaborador</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                         
                              <label for="emailCol">Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailCol" name="emailCol" aria-describedby="mailColHelp">
                              <small id="mailColHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="emailColCon">Confirmar Correo Electrónico</label>
                              <input type="email" class="form-control mail" id="emailColCon" name="emailColCon" aria-describedby="emailColConHelp">
                              <small id="emailColConHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="contrasenaCol">Contraseña</label>
                              <input type="password" class="form-control" id="contrasenaCol" name="contrasenaCol" aria-describedby="contrasenaColHelp">
                              <small id="contrasenaColHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="confConCol">Confirmar Contraseña</label>
                              <input type="password" class="form-control" id="confConCol" name="confConCol" aria-describedby="confConColHelp">
                              <small id="confConColHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telCol">Teléfono</label>
                              <input type="tel" maxlength="10" class="form-control soloNum" id="telCol" name="telCol" aria-describedby="telColHelp">
                              <small id="telColHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                          </div>
                        </div>
                      </section>
                      <!-- -------------- step 5 -------------- 
                      <h4 class="wizard-section-title">Pagos Mensuales</h4>
                      <section class="wizard-section">
                        <div class="row">
                          <div class="col-md-12">
                            <p>Puedes ofrecer a tus clientes la opción de pagar a 3, 6, 9 ó 12 meses sin intereses. Recuerda consultar las <a href="#">comisiones de las mensualidades, los bancos participantes y los términos y condiciones.</a></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="meses">Pagos Mensuales</label>
                              <select class="form-control" id="meses" name="meses">
                                <option></option>
                                <option value="3">3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="9">9 meses</option>
                                <option value="12">12 meses</option>
                              </select>
                              <small id="mesesHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="montomin">Monto Mínimo</label>
                              <input type="text" placeholder="Monto igual o superior de 500 MNX" class="form-control monto" id="montomin" name="montomin" aria-describedby="montominHelp">
                              <small id="montominHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </section>-->
                      <!-- -------------- step 6 -------------- 
                      <h4 class="wizard-section-title">Datos Bancarios</h4>
                      <section class="wizard-section">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-alert alert-dismissable" role="alert">
                              Registra una cuenta bancaria. KashPay deposita el dinero de tus transacciopnes en la CLABE Interbancaria que registres en tu cuenta. Asegurate de incluirla para que recibas todos tus pagos.
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="clabe">Clabe Interbancaria</label>
                              <input type="text" class="form-control" id="clabe" name="clabe" aria-describedby="clabeHelp">
                              <small id="clabeHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="banco">Nombre del Banco</label>
                              <input type="text" class="form-control" id="banco" name="banco" aria-describedby="bancoHelp">
                              <small id="bancoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="clabe">Nombre del Titular</label>
                              <input type="text" class="form-control" id="clabe" name="clabe" aria-describedby="clabeHelp">
                              <small id="clabeHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="banco">Apellido Paterno del Titular</label>
                              <input type="text" class="form-control" id="banco" name="banco" aria-describedby="bancoHelp">
                              <small id="bancoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="banco">Apellido Materno del Titular</label>
                              <input type="text" class="form-control" id="banco" name="banco" aria-describedby="bancoHelp">
                              <small id="bancoHelp" class="error form-text text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </section-->
                    </div>
                    <!-- -------------- /Wizard -------------- -->

                  </form>
                </div>
            </div>
            <!-- -------------- /Spec Form -------------- -->

        </section>
        <!-- -------------- /Content -------------- -->

    </section>
    <!-- -------------- /Main Wrapper -------------- -->

</div>
<!-- -------------- /Body Wrap  -------------- -->
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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-onbording.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-onbording.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-onbording.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/onbording.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
</body>

</html>
