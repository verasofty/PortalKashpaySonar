<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
if (!isset($_GET['isMovil'])) {
$urlLP = 'addLinkPago?email='.$_GET['email'].'&validate='.$_GET['validate'].'&ordering='.$_GET['ordering'];
$urlPP = 'addPrepago?email='.$_GET['email'].'&validate='.$_GET['validate'].'&ordering='.$_GET['ordering'];
$urlBP = 'addBotonpago?validate='.$_GET['validate'];
$urlLN = 'verLinkNegocio?validate='.$_GET['validate'];
$urlD = '';
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paymentLink.css">
<header style="background: #333F50;" id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a class="text-blanco backPrepago" style="font-size: 22px;" href="#">
          <i class="fas fa-arrow-left"></i>
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
}else{
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
        <a href="dashboard">Pago a Distancia</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Pago a Distancia</li>
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
$urlLP = 'addLinkPago?email='.$_GET['email'].'&validate='.$_GET['validate'].'&ordering='.$_GET['ordering'].'&isMovil=0';
$urlPP = 'addPrepago?email='.$_GET['email'].'&validate='.$_GET['validate'].'&ordering='.$_GET['ordering'].'&isMovil=0';
$urlBP = 'addBotonpago?validate='.$_GET['validate'].'&isMovil=0';
$urlLN = 'verLinkNegocio?validate='.$_GET['validate'].'&isMovil=0';
$urlD = '&isMovil=0';
}
$today = date("Y-m-d");
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
  var urlD = '<?php echo $urlD?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- -------------- /Topbar -------------- -->
<?php
    $pageURL = $_GET['page']-1;
    
    
   //echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?sirioId='.session('entitySonID').'&amount=&reference&date='.$_GET['filtro'].'&page=0';

		$curlNL = curl_init();
		curl_setopt_array($curlNL, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/getPaymentLinkStatus?sirioId='.$_GET['validate'].'&date='.$_GET['filtro'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,//
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic YWRtaW46c2VjcmV0',
				'Cookie: JSESSIONID=131eb2aa155148bd181e012e8502'
			),
		));
		$responseNL = curl_exec($curlNL);
		curl_close($curlNL);
    //echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?sirioId='.$_GET['validate'].'&amount=&reference&date='.$_GET['filtro'].'&page=0';
			
		$curlLinks = curl_init();
		curl_setopt_array($curlLinks, array(
			CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?sirioId='.$_GET['validate'].'&amount=&reference&date='.$_GET['filtro'].'&page=0',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic YWRtaW46c2VjcmV0',
				'Cookie: JSESSIONID=131eb2aa155148bd181e012e8502'
			),
		));
		$responseLinks = curl_exec($curlLinks);
		curl_close($curlLinks);
   //echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?sirioId='.session('entitySonID').'&amount=&reference&date='.$_GET['filtro'].'&page=0';

		$datos = array('numLinks'=>json_decode($responseNL),'links'=>json_decode($responseLinks));
//var_dump($datos);
//var_dump($datos['numLinks']->pagados);
?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class=" panel">
              <div class="panel-body pn" id="formulario">
                <div class="row">
                  <div class="col-md-3 col-xs-6" >
                    <a href="<?php echo $urlLP?>" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">  
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/linkPago.png">
                          <p>Link de Pago</p>
                        </label>
                      </div>
                    </a>                   
                  </div>
                  <div class="col-md-3 col-xs-6">
                    <a href="<?php echo $urlLN?>" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">                     
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/linkNegocio.png">
                          <p>Link de Negocio</p>
                        </label>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-3 col-xs-6">
                    <a href="<?php echo $urlBP?>" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">                     
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Pagos a distancia/botonPago.png">
                          <p>Boton de Pago</p>
                        </label>
                      </div>
                    </a>
                  </div>
                  <div class="col-md-3 col-xs-6">
                    <a href="<?php echo $urlPP?>" class="">
                      <div class="tooltipsGen check_option_pay" data-value="transfer">                     
                        <label class="circulo"> 
                          <img style="text-align: justify; margin-left: 0px; height: 100px;" class="logoPago" src="<?php echo base_url()?>/public/assets/img/iconos/Iconos/Orden de Pago/prepago.png">
                          <p>Checkout</p>
                        </label>
                      </div>
                    </a>
                  </div>
                  
                </div>
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <hr>
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <div class="row">
                  <form id="form-filtro" name="form-filtro" method="post">
                  <div class="col-md-3">   
                    <div class="section">
                      <label class="field select">
                          <select id="filtro" name="filtro">
                          <?php
                          $aFiltro = array('today','last_week','last_month');
                          $aFiltroN = array('Hoy','Última semana','Último mes');
                          for($iF=0; $iF<count($aFiltro); $iF++){
                            $sel = ($_GET['filtro'] == $aFiltro[$iF]) ? 'selected' : '' ;
                            echo '<option '.$sel.' value="'.$aFiltro[$iF].'">'.$aFiltroN[$iF].'</option>';                            
                          }
                          ?>
                          </select>
                          <i class="arrow"></i>
                      </label>
                    </div>                      
                  </div>
                  </form>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="text-center">
                      <p>Links pedientes de pago</p>
                      <p id="nPendientes"><b><?php echo $datos['numLinks']->pendientes?></b></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <p>Links pagados</p>
                      <p><b id="nPagados"><?php echo $datos['numLinks']->pagados?></b></p>
                    </div>
                  </div>
                </div>
                <?php
                if ($responseLinks != null) {
                  $num_total_rows = $datos['links']->totalElements;
                  //$num_total_rows = 0;
                }else{
                  $num_total_rows = 0;
                }
  
                //$num_total_rows = $datos['response']->totalItems;
                //$num_total_rows = 4;
  
                if ($num_total_rows > 0) {
                  $page = false;
  
                  if (isset($_GET["page"])) {
                      $page = $_GET["page"];
                  }
  
                  if (!$page) {
                      $start = 0;
                      $page = 1;
                  } else {
                      $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
                  }
                  $total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);
  
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <h5 class="text-dorado">Links Creados<h5>
                  </div>
                  <div class="col-md-12">
                    <table id="listaLinks" class="table">
                    <?php
                      for ($i=0; $i < count($datos['links']->content); $i++) { 
                    ?>
                      <tr>
                        <td>
                          <p class="text-dorado"><?php echo $retVal = ($datos['links']->content[$i]->paymentType == 1) ? 'Link de Pago' : 'Chechout' ;?></p>
                          <p><?php echo $datos['links']->content[$i]->status?></p>
                          <p><?php echo $datos['links']->content[$i]->cratedAt?></p>
                        </td>
                        <td>
                          <p><?php echo $datos['links']->content[$i]->description?></p>
                          <?php 
                          if ($datos['links']->content[$i]->paymentType == 1) {
                          ?>
                          <p>Monto: $ <?php echo number_format($datos['links']->content[$i]->amount,2)?></p>
                          <p>Propina: $ <?php echo number_format($datos['links']->content[$i]->otherAmount,2)?></p>
                          <?php 
                          }else{
                          ?>
                          <p>Monto: $ <?php echo number_format($datos['links']->content[$i]->amount,2)?></p>
                          <?php
                          }
                          ?>
                          
                        </td>
                        <td>
                          <a class="btn btn-azul" href="detalleLinkpago?referencia=<?php echo $datos['links']->content[$i]->idOperation.$urlD?>">Ver detalle</a>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                    </table>
                  </div>
                  <div class="col-md-8 text-center">
                    <ul class="pagination pagination_cat" id="paginador"></ul>
                  </div>

                </div>
                <?php 
                echo '<nav>';
                echo '<ul class="pagination">';

                if ($total_pages > 1) {
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="pagoDistancia?filtro='.$_GET['filtro'].'&page='.($page-1).$urlD.'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="pagoDistancia?filtro='.$_GET['filtro'].'&page='.$i.$urlD.'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="pagoDistancia?filtro='.$_GET['filtro'].'&page='.($page+1).$urlD.'"><span aria-hidden="true">&raquo;</span></a></li>';
                  }
                }
                echo '</ul>';
                echo '</nav>';
              }else{
                echo '<h4>No se encontraron datos.</h4>';
              }
              ?>
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
<script src="<?php echo base_url()?>/public/assets/js/plugins/pnotify/pnotify.js"></script>

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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addLinkPago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagoDistancia.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>
  function copyClipboard(element) {
    console.log('copy');
    var co_link = $('#copy_link').text();
    console.log('co_link = '+co_link);
    var $bridge = $("<input>")
    $("body").append($bridge);
    //$bridge.val(co_link);
    document.execCommand("copy");
    $bridge.remove();
  }
  function verModal(operation, event){
    event.preventDefault();
    console.log('hi '+operation);
    var idcopy = "'#copy_link'";
    var listaLinks = '<div class="">'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8">'+
                            '<p>De clic en la url generada o comparta el link para concluir el proceso de pago.</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 panel">'+
                            '<p style="text-align:justify" id="copy_link">'+$("#"+operation).data("link")+'</p>'+
                            '<!--a type="button" class=" pull-right btn btn-primary" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('+idcopy+')">'+
                              '<i class="far fa-copy"></i>'+
                            '</a-->'+ 
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                            var estatus = '';
                            switch ($("#"+operation).data("estatuss")) {
                              case 'PAGADA':
                                estatus = '<p class="text-green">Pagada</p>';
                                break;
                              case 'CREADA':
                                estatus = '<p class="text-dorado">Pendiente de Pago</p>';
                                  break;
                              case 'EXPIRADA':
                                estatus = '<p class="text-grey">Expirada</p>';
                                    break;
                              case 'CANCELADA':
                                estatus = '<p class="text-red">Cancelada</p>';
                                    break;
                              default:
                                break;
                            }
                            listaLinks += estatus;
                listaLinks += '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                          if ($("#"+operation).data("estatuss") != 'PAGADA') {
                            var fecha = $("#"+operation).data("fechaa").split(' ');                                      
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }else{
                            var fecha = $("#"+operation).data("fechamod").split(' ');                                      
                            
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }
              listaLinks +='</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Monto</p>'+
                            '<p class="">$'+$("#"+operation).data("amount")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Concepto</p>'+
                            '<p class="">'+$("#"+operation).data("description")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<button class="btn btn-default">Cancelar</button>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                      '</div>';
                    
    bootbox.alert({
      message: listaLinks
    });

  }
</script>
</body>

</html>

<?=$this->endsection()?>