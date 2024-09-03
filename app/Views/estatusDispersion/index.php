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
                  <a href="dashboard">Estatus de Dispersión</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Estatus de Dispersión</li>
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
                      <label for="name" id="busqueda">Nombre</label>
                      <input class="form-control" value="<?php echo $_GET['name']?>" type="text" name="name" id="name">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="section busqueda">
                      <label for="datepicker1">Fecha Inicio</label>
                      <input value="<?php echo $_GET['date']?>" type="text" class="form-control" id="date" name="date">
                    </div>
                    <!--div class="form-group busqueda">
                      <label for="name" id="busqueda">Fecha</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" id="date" name="date" value="<?php echo $_GET['date']?>" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div-->
                  </div>
                  <div class="col-md-4"></div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-lg-3 col-md-3"></div>
                  <div class="col-sm-12 col-lg-3 col-md-3">
                    <a id="searchCard" style="margin-top: 30px;" class="btn btn-primary btn-block btn-flat buscar"><i class="fas fa-search"></i> 
                    Buscar</a>
                  </div>
                  <div class="col-sm-12 col-lg-3 col-md-3">
                    <a id="btnLimpiar" style="margin-top: 30px;" class="btn btn-danger btn-block btn-flat"><i class="far fa-trash-alt"></i>
                    Limpiar</a>
                  </div>
                </div>
              </form>
            </div>
            <div class="panel panel-visible" id="spy2">   
              <div class="card">
                <!-- /.card-header -->
                <?php
                  $pageURL = $_GET['page']-1;
                  //echo URL_SERVICES.'/AldebaranServices/getDispersions?affiliationID='.$cuentas->onsignaEntity->affiliationId.'&name='.$_GET['name'].'&date='.$_GET['date'].'&page='.$pageURL;

                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    //CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getDispersions?affiliationID='.$afiliacion->onsignaEntity->affiliationId.'&page='.$pageURL,
                    CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getDispersions?affiliationID='.$cuentas->onsignaEntity->affiliationId.'&name='.$_GET['name'].'&date='.$_GET['date'].'&page='.$pageURL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                  ));

                  $response = curl_exec($curl);

                  $datos = array('disperciones'=>json_decode($response));

                  curl_close($curl);

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
                ?>
                <div class="card-body">
                  
                  <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead class="bg-dark">
                      <tr>
                        <th colspan="3">Archivos de Dispersión Masiva</th>
                      </tr>              
                    </thead>
                    <tbody id="info">
                      <?php
                      var_dump($datos['disperciones']);
                      for ($i=0; $i < count($datos['disperciones']->dispersals) ; $i++) { 
                        echo '<tr id="detalle-'.$datos['disperciones']->dispersals[$i]->idMassiveDispersal.'">'.
                                '<td>'.
                                  '<p>'.$datos['disperciones']->dispersals[$i]->fileName.'</p>'.
                                  '<p>Fecha de dispersión: '.$datos['disperciones']->dispersals[$i]->createdAt.'</p>'.
                                '</td>'.
                                '<td>'.
                                  '<p>Estatus: '.$datos['disperciones']->dispersals[$i]->status.'</p>'.
                                  '<p>'.$datos['disperciones']->dispersals[$i]->errorDesc.'</p>'.
                                '</td>'.
                                '<td>'.
                                  '<a href="nominaDetalle?validate='.$datos['disperciones']->dispersals[$i]->idMassiveDispersal.'&account=&page=1" class="" data-id="'.$datos['disperciones']->dispersals[$i]->idMassiveDispersal.'">Ver Detalle</a>'.
                                '</td>'.
                              '</tr>';   
                      }
                      ?>
                    </tbody>
                  </table>
                  
                </div>
                <?php 
                  echo '<nav>';
                  echo '<ul class="pagination">';

                  if ($total_pages > 1) {
                    if ($page != 1) {
                      echo '<li class="page-item"><a class="page-link" href="listarNomina?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                    }

                    for ($i=1;$i<=$total_pages;$i++) {
                      if ($page == $i) {
                          echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                      } else {
                          echo '<li class="page-item"><a class="page-link" href="listarNomina?page='.$i.'">'.$i.'</a></li>';
                      }
                    }

                    if ($page != $total_pages) {
                      echo '<li class="page-item"><a class="page-link" href="listarNomina?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
                    }
                  }
                  echo '</ul>';
                  echo '</nav>';
                }else{
                  echo '<div class="row"><div class="col-md-12"><h4 style="padding: 15px;">No se encontraron datos.</h4></div></div>';
                }
                ?>
                <!-- /.card-body -->
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

<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<!-- -------------- Time/Date Dependencies JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/globalize/globalize.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/moment/moment.js"></script>

<!-- -------------- BS Dual Listbox JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- -------------- Bootstrap Maxlength JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/maxlength/bootstrap-maxlength.min.js"></script>

<!-- -------------- Select2 JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/select2/select2.min.js"></script>

<!-- -------------- Typeahead JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/typeahead/typeahead.bundle.min.js"></script>

<!-- -------------- TagManager JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/tagmanager/tagmanager.js"></script>

<!-- -------------- DateRange JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/daterange/daterangepicker.min.js"></script>

<!-- -------------- DateTime JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>

<!-- -------------- BS Colorpicker JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- -------------- MaskedInput JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/jquerymask/jquery.maskedinput.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- DateTime JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-additional-inputs.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/nominaDetalle.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>