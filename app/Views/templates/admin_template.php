<!DOCTYPE html>
<html>
<?php
$url = $_SERVER['REQUEST_URI']; 
$partUrl = explode('/', $url);
$mesOpe = date('m');
$fechaOpe = date('Y-m-d H:m');
$fechaTFin = date('Y-m-d H:m');
$fechaTIni = date('Y-m-d');
$curlJS = curl_init();

$fechaIni = date('Y-m-d');
$fechaFin = date('Y-m-d');
if (session('idBusinessModel') == 2) {
	$idcontext = 0;
  $contexCombo = session('entitySonID');
	//$contexCombo = '';
}else if (session('idBusinessModel') == 1) {

	//$idcontext = session('idcontextResponse')[0];
	$contexCombo = session('issueId');
}else{
	$contexComboEm = session('issueId');
    $contexCombo = session('entitySonID');

}

//$hrefTM = 'transacciones?rango=&estatus=&subafiliado='.session('idContext').'&entidad='.session('idEntity').'&sucursal='.session('idTerminal').'&caja='.session('idTerminalUser').'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&type=&mood=0&page=1';
$hrefTM = 'transacciones?rango='.$fechaTIni.' 00:00 / '.$fechaTFin.'&estatus=00&subafiliado='.session('idContext').'&entidad='.session('idEntity').'&sucursal='.session('idTerminal').'&caja='.session('idTerminalUser').'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&type=&mood=&page=1';
?>
<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>KashPay</title>
    <meta name="keywords" content="Adquirencia, Emision, Kash, Kashpay, KashPay"/>
    <meta name="description" content="Adquirencia, Emision, Kash, Kashpay, KashPay">
    <meta name="author" content="Onsigna">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!-- -------------- Icomoon -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/fonts/icomoon/icomoon.css">

    <!-- -------------- FullCalendar -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/magnific/magnific-popup.css">

    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/c3charts/c3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/datepicker/css/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/css/buttons.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/public/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/public/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/public/assets/js/plugins/dropzone/css/dropzone.css">
    

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/skin/default_skin/css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/select2/css/core.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/allcp/forms/css/forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/js/plugins/fancytree/skin-win8/ui.fancytree.min.css">
    <!-- -------------- Favicon -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/custom.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>/public/assets/img/favicon.png">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var base_url = '<?php echo base_url()?>';
        var hrefTM = '<?php echo curl_escape($curlJS, $hrefTM)?>';
        <?php
        if (session('idRol') == 2) {
        ?>
        var obligarEntidad = 1;
        var idSaldo = 'com.onsigna';
        <?php 
        }else{
        ?>
        var obligarEntidad = 0;
        var idSaldo = '<?php echo session('entitySonID')?>';
        <?php 
        }
        ?>
        var contextSearch  = '<?php echo session('entitySonID')?>';
        var contextEmiSearch  = '<?php echo session('issueId')?>';
        var accountS = '<?php echo session('cuenta')?>';
        var emailS = '<?php echo session('mail')?>';
        var telS = '<?php echo session('tel')?>';
        var idBusinessModel = '<?php echo session('idBusinessModel')?>';
        var idRol = '<?php echo session('idRol')?>';
    </script>
</head>

<body class="tables-datatables" >
<!-- -------------- Body Wrap  -------------- -->
<div id="main">

    <!-- -------------- Header  -------------- -->
    <header class="navbar navbar-fixed-top bg-dark">
        <div class="navbar-logo-wrapper">
            <a class="navbar-logo-text" href="dashboard">
                <b>KashPay</b>
            </a>
            <span id="sidebar_left_toggle" class="ad ad-lines"></span>
        </div>
        <?php
        if (session('idBusinessModel') != 1) {
        ?>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown dropdown-fuse hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Saldos
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">Saldo Pendiente 
                            <span class="tm-tag tm-tag-inverse">
                                <span class="saldoP">$</span>
                            </span>
                        </a>
                    </li>
                    <!--li><a href="#">Saldo Principal <span class="tm-tag tm-tag-inverse"><span>$5,400.00</span></span></a></li-->
                    <li>
                        <a href="#">Saldo Disponible 
                            <span class="label label-info">
                                <span class="saldoD">$</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php } ?>
        <ul class="nav navbar-nav navbar-right">
            <!--li class="hidden-xs">
                <div class="navbar-btn btn-group">
                    <a href="#" class="topbar-dropmenu-toggle btn" data-toggle="button">
                        <span class="fa fa-magic fs20 text-info"></span>
                    </a>
                </div>
            </li-->
            <li class="dropdown dropdown-fuse">
                <a href="#" class="dropdown-toggle fw600" data-toggle="dropdown">
                    <span class="hidden-xs"><name><?php echo session('mail')?></name> </span>
                    <span class="fa fa-caret-down hidden-xs mr15"></span>
                    <img style="background: #efefef;" src="<?php echo base_url()?>/public/assets/img/avatars/user-avatar.png" alt="avatar" class="mw55">
                </a>
                <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                    <li class="list-group-item">
                        <a href="miCuenta" class="animated animated-short fadeInUp">
                            <span class="fa fa-user"></span> Mi Cuenta
                        </a>
                    </li>
                    <li class="dropdown-footer text-center">
                        <a href="#" class="salir btn btn-primary btn-sm btn-bordered">
                            <span class="fa fa-power-off pr5 "></span> Salir </a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- -------------- /Header  -------------- -->

    <!-- -------------- Sidebar  -------------- -->
    
    <aside id="sidebar_left" class="nano nano-light affix">

        <!-- -------------- Sidebar Left Wrapper  -------------- -->
        <div class="sidebar-left-content nano-content">
            <!-- -------------- Sidebar Header -------------- -->
            <header class="sidebar-header">

                <!-- -------------- Sidebar - Author -------------- -->
                <!--div class="sidebar-widget author-widget">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="<?php //echo base_url()?>/public/assets/img/avatars/profile_avatar.jpg" class="img-responsive">
                        </a>

                        <div class="media-body">
                            <div class="media-author"><?php //echo session('mail')?></div>
                        </div>
                    </div>
                </div-->
            </header>
            <!-- -------------- /Sidebar Header -------------- -->

            <!-- -------------- Sidebar Menu  -------------- -->
            <ul class="nav sidebar-menu">
                <?php $tMenu=''; $tuMenu=''; $urlDetalle='';
                if (session('idBusinessModel') == 1) {
                    $tMenu = 'Emisor';
                    $urlDetalle = 'detalle?fatherID='.session('issueId').'&type=1&status=25&page=1&size=10&cuenta='.session('issueId');
                } else if (session('idBusinessModel') == 2) {
                    $tMenu = 'Adquirente';
                    $urlDetalle = 'detalle?fatherID='.session('entitySonID').'&type=1&status=25&page=1&size=10&cuenta='.session('entitySonID');
                }else {
                    $tMenu = 'Mixto';
                    $urlDetalle = 'detalle?fatherID='.session('entitySonID').'&type=1&status=25&page=1&size=10&cuenta='.session('entitySonID');
                }

                if (session('idRol') == 2) {
                  $tuMenu = 'Administrador';
                } else if (session('idRol') == 3) {
                    $tuMenu = 'Subafiliado';
                }else if (session('idRol') == 4) {
                  $tuMenu = 'Entidad';
                } else if (session('idRol') == 5) {
                  $tuMenu = 'Sucursal';
                } else if (session('idRol') == 6) {
                  $tuMenu = 'Caja';
                } 
                ?>
                <li class="sidebar-label pt30">Menu <?php echo $tuMenu.' '.$tMenu?></li>
                <li class="<?php echo $retURL = ($partUrl[1] == 'dashboard') ? 'active' : '' ; ?>">
                    <a href="dashboard">
                        <span class="fas fa-tachometer-alt"></span>
                        <span class="sidebar-title">Dashboard</span>
                    </a>
                </li>

                <li class="<?php echo $retURL = ($partUrl[1] == 'miCuenta' || $partUrl[1] == 'resumen') ? 'active' : '' ; ?>">
                    <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'miCuenta' || $partUrl[1] == 'resumen') ? 'menu-open' : '' ; ?>" href="#">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Mi Cuenta</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php if (session('idRol') == 2) { ?>
                        <li class="<?php echo $retURL = ($partUrl[1] == 'miCuenta') ? 'active' : '' ; ?>">
                            <a href="miCuenta"><span class="fa fa-file-text-o"></span> Información de la cuenta </a>
                        </li>
                        <?php } ?>
                        <li class="<?php echo $retURL = ($partUrl[1] == 'estadoCuenta') ? 'active' : '' ; ?>">
                            <a href="estadoCuenta" class=""><span class="fa fa-file-text-o"></span> Estado de cuenta  </a>
                        </li>
                        <li class="">
                            <a href="<?php echo $urlDetalle?>"><span class="fa fa-file-text-o"></span> Detalle del Saldo  </a>
                        </li>
                    </ul>
                </li>
                <!-- ********** VALIDACIONES DE MENU ************ -->
                <?php
                if (session('idBusinessModel') == 1) {
                    //'Emisor';
                ?>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="imoon imoon-pie"></span>
                            <span class="sidebar-title">Reportes Emision</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="transaccionesEmision?type_operation=&id_status=&id_context=<?php echo session('issueId')?>&amount=&auth_number=&num_cuenta=&init_date=<?php echo $fechaIni?>&end_date=<?php echo $fechaFin?>&email=&telephoneNumber&page=1">
                                    <span class="glyphicon glyphicon-tags"></span> Transacciones 
                                </a>
                            </li>
                            <li>
                                <a href="operacionesEmision?type=1,2,3,4&entidad=<?php echo session('issueId')?>&status=15,31&page=1&dateInit=<?php echo $fechaOpe?>&dateFinish=<?php echo $fechaOpe ?>">
                                    <span class="glyphicon glyphicon-tags"></span> Operaciones 
                                </a>
                            </li>
                            <?php if (session('idRol') != 6) { ?>
                            <li>
                                <a href="tarjeta">
                                <span class="glyphicon glyphicon-tags"></span>Tarjeta
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'usuariosKashpay' || $partUrl[1] == 'usuariosWallet' || $partUrl[1] == 'addUsuario') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'usuariosWallet' || $partUrl[1] == 'addUsuario') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="imoon imoon-user3"></span>
                            <span class="sidebar-title">Usuarios</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'usuariosWallet') ? 'active' : '' ; ?>">
                                <a href="usuariosWallet?id_context=<?php echo session('issueId') ?>&type=0&value1=<?php echo $fechaIni?>&value2=<?php echo $fechaFin?>&page=1"><span class="fa fa-file-text-o"></span> Listar Usuario Wallet </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    // ******* ADMIN EMISOR *******
                    if(session('idRol') == 2) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="imoon imoon-office"></span>
                            <span class="sidebar-title">Sub Afiliado</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="listSubAfiliado"><span class="fa fa-file-text-o"></span> Listar Sub Afiliado </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="addSubAfiliado"><span class="fa fa-file-text-o"></span> Agregar Sub Afiliado </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    // ******* SUBAFILIADO EMISOR *******
                    if(session('idRol') == 3) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* ENTIDAD EMISOR *******
                    if(session('idRol') == 4) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* SUCURSAL EMISOR *******
                    if(session('idRol') == 5) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* CAJA EMISOR *******
                    if(session('idRol') == 6) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <?php
                    }
                    ?>
                    
                <?php
                } else if (session('idBusinessModel') == 2) {
                    //'Adquirente';
                ?>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="imoon imoon-stats"></span>
                            <span class="sidebar-title">Reportes Adquirencia</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'transacciones') ? 'active' : '' ; ?>">
                                <a href="<?php echo $hrefTM?>">
                                Transacciones
                                </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'operaciones') ? 'active' : '' ; ?>">
                                <a href="operaciones?type=10007,1,10008&status=15,31&page=1&dateInit=<?php echo $fechaOpe?>&dateFinish=<?php echo $fechaOpe?>&subafiliado=<?php echo session('idContext')?>&entidad=<?php echo session('idEntity')?>&sucursal=<?php echo session('idTerminal')?>&caja=<?php echo session('idTerminalUser')?>">Operaciones</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    // ******* ADMIN ADQUIRENTE *******
                    if(session('idRol') == 2) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="imoon imoon-office"></span>
                            <span class="sidebar-title">Sub Afiliado</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="listSubAfiliado"><span class="fa fa-file-text-o"></span> Listar Sub Afiliado </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="addSubAfiliado"><span class="fa fa-file-text-o"></span> Agregar Sub Afiliado </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <?php
                    }
                    // ******* SUBAFILIADO ADQUIRENTE *******
                    if(session('idRol') == 3) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* ENTIDAD ADQUIRENTE *******
                    if(session('idRol') == 4) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* SUCURSAL ADQUIRENTE *******
                    if(session('idRol') == 5) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    // ******* CAJA ADQUIRENTE *******
                    if(session('idRol') == 6) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                <?php
                }else {
                    //'Mixto';
                ?>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="imoon imoon-stats"></span>
                            <span class="sidebar-title">Reportes Adquirencia</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'transacciones') ? 'active' : '' ; ?>">
                                <a href="<?php echo $hrefTM?>">
                                Transacciones
                                </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'operaciones') ? 'active' : '' ; ?>">
                                <a href="operaciones?type=10007,1,10008&status=15,31&page=1&dateInit=<?php echo $fechaOpe?>&dateFinish=<?php echo $fechaOpe?>&subafiliado=<?php echo session('idContext')?>&entidad=<?php echo session('idEntity')?>&sucursal=<?php echo session('idTerminal')?>&caja=<?php echo session('idTerminalUser')?>">Operaciones</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="imoon imoon-pie"></span>
                            <span class="sidebar-title">Reportes Emision</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="transaccionesEmision?type_operation=&id_status=&id_context=<?php echo session('issueId') ?>&amount=&auth_number=&num_cuenta=&init_date=<?php echo $fechaIni?>&end_date=<?php echo $fechaFin?>&email=&telephoneNumber&page=1">
                                    <span class="glyphicon glyphicon-tags"></span> Transacciones 
                                </a>
                            </li>
                            <li>
                                <a href="operacionesEmision?type=1,2,3,4&entidad=<?php echo session('issueId')?>&status=15,31&page=1&dateInit=<?php echo $fechaOpe?>&dateFinish=<?php echo $fechaOpe ?>">
                                    <span class="glyphicon glyphicon-tags"></span> Operaciones 
                                </a>
                            </li>
                            <?php if (session('idRol') != 6) { ?>
                            <li>
                                <a href="tarjeta">
                                <span class="glyphicon glyphicon-tags"></span>Tarjeta
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'usuariosKashpay' || $partUrl[1] == 'usuariosWallet' || $partUrl[1] == 'addUsuario') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'usuariosWallet' || $partUrl[1] == 'addUsuario') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="imoon imoon-user3"></span>
                            <span class="sidebar-title">Usuarios</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'usuariosWallet') ? 'active' : '' ; ?>">
                                <a href="usuariosWallet?id_context=<?php echo session('issueId') ?>&type=0&value1=<?php echo $fechaIni?>&value2=<?php echo $fechaFin?>&page=1"><span class="fa fa-file-text-o"></span> Listar Usuario Wallet </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    // ******* ADMIN MIXTO *******
                    if(session('idRol') == 2) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSubAfiliado' || $partUrl[1] == 'addSubAfiliado') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="imoon imoon-office"></span>
                            <span class="sidebar-title">Sub Afiliado</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="listSubAfiliado"><span class="fa fa-file-text-o"></span> Listar Sub Afiliado </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSubAfiliado') ? 'active' : '' ; ?>">
                                <a href="addSubAfiliado"><span class="fa fa-file-text-o"></span> Agregar Sub Afiliado </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('issueId') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    // ******* SUBAFILIADO MIXTO *******
                    if(session('idRol') == 3) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listEntidad' || $partUrl[1] == 'addEntidad') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-store-alt"></span>
                            <span class="sidebar-title">Entidad</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listEntidad') ? 'active' : '' ; ?>">
                                <a href="listEntidad"><span class="fa fa-file-text-o"></span> Listar Entidad </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addEntidad') ? 'active' : '' ; ?>">
                                <a href="addEntidad">
                                    <span class="fa fa-file-text-o"></span> Agregar Entidad </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    // ******* ENTIDAD MIXTO *******
                    if(session('idRol') == 4) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listSucursal' || $partUrl[1] == 'addSucursal') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar-title">Sucursal</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listSucursal') ? 'active' : '' ; ?>">
                                <a href="listSucursal"><span class="fa fa-file-text-o"></span> Listar Sucursal </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addSucursal') ? 'active' : '' ; ?>">
                                <a href="addSucursal">
                                    <span class="fa fa-file-text-o"></span> Agregar Sucursal </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    // ******* SUCURSAL MIXTO *******
                    if(session('idRol') == 5) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'listColaborador' || $partUrl[1] == 'addCaja') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-cash-register"></span>
                            <span class="sidebar-title">Cajas</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listColaborador') ? 'active' : '' ; ?>">
                                <a href="listColaborador"><span class="fa fa-file-text-o"></span> Listar Caja </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'addCaja') ? 'active' : '' ; ?>">
                                <a href="addCaja"><span class="fa fa-file-text-o"></span> Agregar Caja </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'dispersion' || $partUrl[1] == 'estatusDispersion') ? 'active' : '' ; ?>">
                        <a class="accordion-toggle <?php echo $retURL = ($partUrl[1] == 'estatusDispersion' || $partUrl[1] == 'dispersion') ? 'menu-open' : '' ; ?>" href="#">
                            <span class="fas fa-hand-holding-usd"></span>
                            <span class="sidebar-title">Dispersión de nómina</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="<?php echo $retURL = ($partUrl[1] == 'nomina') ? 'active' : '' ; ?>">
                                <a href="dispersion"><span class="fa fa-file-text-o"></span> Cargar dispersión </a>
                            </li>
                            <li class="<?php echo $retURL = ($partUrl[1] == 'listarNomina') ? 'active' : '' ; ?>">
                                <a href="estatusDispersion?name=&date=<?php echo $fechaIni?>&page=1" class=""><span class="fa fa-file-text-o"></span> Estatus dispersión </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    // ******* CAJA MIXTO *******
                    if(session('idRol') == 6) {
                    ?>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'pagoDistancia') ? 'active' : '' ; ?>">
                        <a href="pagoDistancia?filtro=today&page=1&validate=<?php echo session('entitySonID')?>&email=<?php echo session('mail')?>&ordering=<?php echo session('cuenta')?>&isMovil=0">
                            <span class="fas fa-link"></span>
                            <span class="sidebar-title">Pago a distancia</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'webhook') ? 'active' : '' ; ?>">
                        <a href="webhook">
                            <span class="fas fa-globe"></span>       
                            <span class="sidebar-title">WebHook</span>
                        </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'transferenciaspei') ? 'active' : '' ; ?>">
                      <a href="transferenciaspei?entidad=<?php echo session('entitySonID') ?>">
                          <span class="imoon imoon-info"></span>
                          <span class="sidebar-title">Información Spei</span>
                      </a>
                    </li>
                    <li class="<?php echo $retURL = ($partUrl[1] == 'envios') ? 'active' : '' ; ?>">
                        <a href="envios">
                            <span class="fas fa-exchange-alt"></span>
                            <span class="sidebar-title">Envios</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
                              
            </ul>
            <!-- -------------- /Sidebar Menu  -------------- -->

            <!-- -------------- Sidebar Hide Button -------------- -->
            <div class="sidebar-toggler">
                <a href="#">
                    <span class="far fa-arrow-alt-circle-left"></span>
                </a>
            </div>
            <!-- -------------- /Sidebar Hide Button -------------- -->
          
        </div>
        <!-- -------------- /Sidebar Left Wrapper  -------------- -->

    </aside>
    
    <!-- -------------- /Sidebar -------------- -->

    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">

    <?=$this->renderSection('content')?>
