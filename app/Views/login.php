<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>KashPay</title>
    <meta name="keywords" content="KashPay, Kash, Adquirencia"/>
    <meta name="description" content="KashPay, Kash, Adquirencia">
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/custom.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url()?>/public/assets/img/favicon.png">
    <script type="text/javascript">
      var base_url = '<?php echo base_url()?>';
    </script>
    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="utility-page sb-l-c sb-r-c">

<!-- -------------- Body Wrap  -------------- -->
<div id="main" class="animated fadeIn">

    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>
        

        <!-- -------------- Content --------------linear-gradient(to top, #c7924b, #84653b) !important -->
        <section id="content">
          <div id="message"></div>
            <!-- -------------- Login Form -------------- -->
            <div class="allcp-form theme-primary mw320" id="login">
                <div class="bg-primary mw600 text-center mb20 br3 pv15">
                  <img src="<?php echo base_url()?>/public/assets/img/logo_kashpay_sobra.png" class="img-responsive" alt="Logo"/>
                </div>
                <div class="panel panel-black mw320">
                  <div class="row text-center" id="cargando">
                    
                  </div>
                  <form id="form_login" name="form_login" method="post">
                      <div class="panel-body pn mv10">

                        <div class="section">
                          <label for="username" class="field prepend-icon white ">
                            <input type="email" name="user_login" id="user_login" class="form-control white" placeholder="Usuario">
                            <label for="username" class="field-icon white">
                              <i class="fa fa-user white"></i>
                            </label>
                          </label>
                        </div>
                        <!-- -------------- /section -------------- -->

                        <div class="section">
                          <label for="password" class="field prepend-icon">
                            <input type="password" class="form-control" name="password_login" id="password_login" placeholder="Contraseña">
                            <label for="password" class="field-icon">
                              <i class="fa fa-lock"></i>
                            </label>
                          </label>
                        </div>
                        <!-- -------------- /section -------------- -->
                        
                        <div class="section">
                          <button id="btn_login" class="btn btn-block btn-white btn-primary">Iniciar Sesión</button>
                        </div>
                        <div class="section">
                          <div class=" pull-left pt5">
                            <div class=" pull-left pt5">
                              <a href="#" id="recPass" title="">Recuperar Contraseña</a>
                            </div>
                          </div>
                        </div>
                        <div class="section">
                          <div class=" pull-left pt5">
                            <!--div class="radio-custom radio-primary mb5 lh25">
                              ¿Necesitas una cuenta? <a href="registro" title="">Registrate</a>
                            </div>
                            <div class="radio-custom radio-primary mb5 lh25">
                              ¿Necesitas una cuenta? <a href="contacto" title="">Contactanos</a>
                            </div-->
                          </div>
                        </div>
                        
                        <!-- -------------- /section -------------- -->

                      </div>
                      <!-- -------------- /Form -------------- -->
                  </form>
                </div>
                <!-- -------------- /Panel -------------- -->
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
<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.js"></script>
<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/login.js"></script>

<!-- -------------- Page JS -------------- -->
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Init CanvasBG
        CanvasBG.init({
            Loc: {
                x: window.innerWidth / 5,
                y: window.innerHeight / 10
            }
        });

    });

  function BootboxContent(){    
    var frm_str = '<form id="recPass-form">'
                    + '<div id="message"></div>'
                    + '<div class="row allcp-form" >'
                      + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label for="email">Correo Electrónico*</label>'+
                                  '<input type="email" class="form-control mail" id="email" name="email">'+
                                '</div>'+
                              '</div>'
                          + '</div>'
                      + '</div>'
                    + '</div>'
                + '</form>';
    var object = $('<div/>').html(frm_str).contents();
    return object
  }

</script>
<!-- -------------- /Scripts -------------- -->

</body>

</html>
