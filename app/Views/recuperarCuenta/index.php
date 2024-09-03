<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>KashPay</title>
    <meta name="keywords" content="KashPay, Adquirencia, Kash"/>
    <meta name="description" content="KashPay, Adquirencia, Kash">
    <meta name="author" content="Onsigna">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/allcp/forms/css/forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/allcp/forms/css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/custom.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url()?>/public/assets/img/favicon.png">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
   
    <script type="text/javascript">
        var base_url = '<?php echo base_url()?>';
    </script>
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
            <div class="allcp-form theme-primary mw600" id="register">
                <!--div class="bg-primary mw600 text-center mb20 br3 pv15">
                    <img class="img-responsive" src="<?php echo base_url()?>/public/assets/img/logoKash.png" alt=""/>
                </div-->
                <div class="panel panel-primary">
                  <div class="panel-heading pn text-center">
                    <span class="panel-title">
                      Recuperar Cuenta
                    </span>
                  </div>
                  <!-- -------------- /Panel Heading -------------- -->

                  <form method="post" id="recuperarForm" name="recuperarForm">
                    <div class="panel-body pn">
                      
                      <div class="section">
                        <label for="contrasena" class="field prepend-icon">
                          <input type="password" name="contrasena" id="contrasena" class="gui-input" placeholder="Nueva Contraseña*">
                          <input type="hidden" name="guid" id="guid" class="gui-input" value="<?php echo $_GET['validate']?>">
                          <label for="contrasena" class="field-icon">
                              <i class="fa fa-lock"></i>
                          </label>
                        </label>
                        <small id="contrasenaHelp" class="error"></small>
                      </div>

                      <div class="section">
                        <label for="contrasenaCon" class="field prepend-icon">
                          <input type="password" name="contrasenaCon" id="contrasenaCon" class="gui-input" placeholder="Confirmar Nueva Contraseña*">
                          <label for="contrasenaCon" class="field-icon">
                              <i class="fa fa-lock"></i>
                          </label>
                        </label>
                        <small id="contrasenaConHelp" class="error"></small>
                      </div>
                      <!-- -------------- /section -------------- -->

                  
                      <!-- -------------- /section -------------- -->

                      <div class="section">
                          <div class="pull-right">
                              <a href="#" id="btn-add" class="btn btn-bordered btn-primary">Recuperar Cuenta
                              </a>
                          </div>
                      </div>
                      <!-- -------------- /section -------------- -->

                    </div>
                    <!-- -------------- /Form -------------- -->
                  
                    <!-- -------------- /Panel Footer -------------- -->
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

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- CanvasBG JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/canvasbg/canvasbg.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/menu.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/recuperarCuenta.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>


</script>

</body>

</html>
