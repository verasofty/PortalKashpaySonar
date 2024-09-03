<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<header id="topbar" class="alt">
      <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="dashboard">Detalle Dispersión</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Detalle Dispersión</li>
          </ol>
      </div>
      <div class="topbar-right">
        <div class="ib topbar-dropdown">
        </div>
        <div class="ml15 ib va-m" id="sidebar_right_toggle">
        </div>
      </div>
  </header>
  <style>
  .form-controll {
  display: block;
  width: auto;
  height: 36px;
  padding: 6px 15px;
  font-size: 14px;
  line-height: 1.49;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #dddddd;
  border-radius: 3px;
  -webkit-appearance: none;
  -webkit-transition: border-color ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s;
  transition: border-color ease-in-out .15s;
}
  </style>
  <!-- -------------- /Topbar -------------- -->
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class="panel panel-visible" id="spy2">
              <form method="post" name="form_filtro" id="form_filtro">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group busqueda">
                      <label for="name" id="busqueda">Cuenta</label>
                      <input class="form-control" value="<?php //echo $_GET['account']?>" type="text" name="account" id="account">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <a id="searchCard" style="margin-top: 20px;" class="btn btn-primary btn-block buscar"><i class="fas fa-search"></i> 
                    Buscar</a>
                  </div>
                  <div class="col-md-4">
                    <a id="btnLimpiar" style="margin-top: 20px;" class="btn btn-danger btn-block"><i class="far fa-trash-alt"></i>
                    Limpiar</a>
                  </div>
                </div>
              </form>
            </div>
            <div class="panel panel-visible" id="spy2">
              <!-- /.card-header -->
              <?php
                /*$pageURL = $_GET['page']-1;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getDispersionsDetail?id='.$_GET['validate'].'&account='.$_GET['account'].'&page='.$pageURL,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $datos['disperciones']= json_decode($response);

                if ($response != null) {
                    $num_total_rows = $datos['disperciones']->totalElements;
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
                    */
              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <a href="#" class="botonExcel btn ladda-button btn-default">
                      <span class="imoon imoon-file-excel"></span> Exportar a Excel
                    </a>
                  </div>
                  <div class="col-md-4">
                    <a href="#" onclick="printDiv('figuras')" class="botonPDF btn ladda-button btn-default">
                      <span class="imoon imoon-file-pdf"></span> Exportar a PDF
                    </a>
                  </div>
                  <div class="col-md-4"></div>
                </div>
                <div style="height: 30px;"></div>
                <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                  <thead class="bg-dark">
                    <tr>
                      <th colspan="4">Detalle Dispersión Masiva</th>
                    </tr>              
                  </thead>
                  <tbody id="info">
                    <?php
                    /*var_dump($datos['disperciones']);
                    for ($i=0; $i < count($datos['disperciones']->dispersalsDetail) ; $i++) { 
                      echo '<tr id="detalle-'.$datos['disperciones']->dispersalsDetail[$i]->idMassiveDispersal.'">'.
                              '<td>'.
                                '<div class="row">'.
                                  '<div class="col-md-4">'.
                                    '<p>Número de Cuenta: '.$datos['disperciones']->dispersalsDetail[$i]->account.'</p>'.
                                    '<p>Número Ordenante: '.$datos['disperciones']->dispersalsDetail[$i]->ordeningAccount.'</p>'.
                                    '<p>Beneficiario: '.$datos['disperciones']->dispersalsDetail[$i]->beneficiaryName.'</p>'.
                                    '<p>Cuenta del Beneficiario: '.$datos['disperciones']->dispersalsDetail[$i]->beneficiaryAccount.'</p>'.
                                    '<p>Tipo: '.$datos['disperciones']->dispersalsDetail[$i]->accountType.'</p>'.
                                  '</div>'.
                                  '<div class="col-md-4">'.
                                    '<p>Fecha de dispersión: '.$datos['disperciones']->dispersalsDetail[$i]->createdAt.'</p>'.
                                    '<p>Monto: $'.number_format($datos['disperciones']->dispersalsDetail[$i]->amount,2).'</p>'.
                                    '<p>Concepto: '.$datos['disperciones']->dispersalsDetail[$i]->concept.'</p>'.
                                    '<p>Autorización: '.$datos['disperciones']->dispersalsDetail[$i]->authNumber.'</p>'.
                                  '</div>'.
                                  '<div class="col-md-4">'.
                                    '<p>Estatus: '.$datos['disperciones']->dispersalsDetail[$i]->status.'</p>'.
                                    '<p>'.$datos['disperciones']->dispersalsDetail[$i]->errorDesc.'</p>'.
                                  '</div>'.
                                '</div>'.
                              '</td>'.
                            '</tr>';   
                    }*/
                    ?>
                  </tbody>
                </table>
                
              </div>

              <?php 
                /*echo '<nav>';
                echo '<ul class="pagination">';

                if ($total_pages > 1) {
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="nominaDetalle?validate='.$_GET['validate'].'&account='.$_GET['account'].'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="nominaDetalle?validate='.$_GET['validate'].'&account='.$_GET['account'].'&page='.$i.'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="nominaDetalle?validate='.$_GET['validate'].'&account='.$_GET['account'].'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
                  }
                }
                echo '</ul>';
                echo '</nav>';
              }else{
                echo '<div class="row"><div class="col-md-12"><h4 style="padding: 15px;">No se encontraron datos.</h4></div></div>';
              }*/
              ?>
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

<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/c3charts/d3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/c3charts/c3.min.js"></script>

<!-- -------------- Time/Date Dependencies JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/globalize/globalize.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/moment/moment.js"></script>
<!-- -------------- Simple Circles Plugin -------------- -->

<!-- -------------- Maps JSs -------------- -->

<!-- -------------- FullCalendar Plugin -------------- -->

<!-- -------------- Date/Month - Pickers -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>

<!-- -------------- DateRange JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/daterange/daterangepicker.min.js"></script>

<!-- -------------- DateTime JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>

<!-- -------------- Magnific Popup Plugin -------------- -->

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>

<!-- -------------- Widget JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/charts/d3.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/dashboard.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/bootbox/bootbox.locales.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Init D3Charts
        D3Charts.init();
        demoHighCharts.init();
    });
</script>

</body>

</html>

<?=$this->endsection()?>