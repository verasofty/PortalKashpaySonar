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
                      Contactanos
                    </span>
                    <p>Es facil y te toma unos minutos</p>
                  </div>
                  <!-- -------------- /Panel Heading -------------- -->

                  <form method="post" id="registroForm" name="registroForm">
                    <div class="panel-body pn">
                      <!-- -------------- /section -------------- -->
                      <div class="section">
                        <label for="negocio" class="field prepend-icon">
                          <input type="text" name="nombre" id="nombre" class="gui-input" placeholder="Nombre Completo o Nombre del Negocio*">
                          <label for="email" class="field-icon">
                              <i class="fa fa-shopping-cart"></i>
                          </label>
                        </label>
                        <small id="nombreHelp" class="error"></small>
                      </div>
                      <div class="section">
                        <label for="email" class="field prepend-icon">
                          <input type="email" name="email" id="email" class="gui-input mail" placeholder="Correo Electrónico*">
                          <label for="email" class="field-icon">
                              <i class="fa fa-envelope"></i>
                          </label>
                        </label>
                        <small id="emailHelp" class="error"></small>
                      </div>
                      <!-- -------------- /section -------------- -->

                      <div class="section">
                        <label for="tel" class="field prepend-icon">
                          <input type="tel" name="tel" id="tel" maxlength="10" class="gui-input soloNum" placeholder="Teléfono*">
                          <label for="username" class="field-icon">
                            <i class="fa fa-mobile"></i>
                          </label>
                        </label>
                        <small id="telHelp" class="error"></small>
                      </div>
                      <!-- -------------- /section -------------- -->
                    
                      <div class="section">
                        <div class="g-recaptcha" data-sitekey="6Lcd4logAAAAADDHq2LpgN9HTMdZOrRcYdEvVoVb" data-callback="verifyCaptcha"></div>
                        <label id="g-recaptcha-error"></label>
                      </div>
                      <!-- -------------- /section -------------- -->

                      <div class="section">
                          <div class="pull-right">
                              <a href="#" id="btn-add" class="btn btn-bordered btn-primary">Contactar
                              </a>
                          </div>
                      </div>
                      <!-- -------------- /section -------------- -->

                    </div>
                    <!-- -------------- /Form -------------- -->
                    <div class="panel-footer">
                    <p>Todos los campos son obligatorios*</p>
                    <p class="text-center">Aquí puedes ver nuestro <a>Aviso de Privacidad</a></p>
                    </div>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/contacto.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<!--script src="https://www.google.com/recaptcha/api.js?render=6Le1bTkeAAAAAC_XibfrB-WRsCNHZmD5tWmcQdCQ"></script>
<script-->


</script>
<!-- -------------- /Scripts --------------
6Lcd4logAAAAADDHq2LpgN9HTMdZOrRcYdEvVoVb
6Lcd4logAAAAAGv14rWQhwdVa4NJb5D2vJSGgE1K
 -->

</body>

</html>
