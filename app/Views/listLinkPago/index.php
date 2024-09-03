
<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d"); 
$today_hora = date("Y-m-d H:i:s"); 
$mesLim = date("Y-m-d",strtotime($today."- 2 month"));     
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
  var mesLim = '<?php echo $mesLim?>';
  var entitySelect = '<?php echo session('idEntity')?>';
  var terminalSelect = '<?php echo session('idTerminal') ?>';
</script>
<header id="topbar" class="alt">
      <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="dashboard">Link de Pago</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Listar Link de Pago</li>
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
      <div class="chute chute-center allcp-form">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="col-md-12">
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn ">
                <form id="form_filtro" name="form_filtro" method="post">
                  <div class="row" id="msg"></div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subafiliado">SubAfiliado</label>
                        <select <?php echo $retValSA = (session('idRol')!=2) ? 'disabled' : '' ; ?> class="form-control" id="subafiliado" name="subafiliado">
                          <option></option>
                          <?php
                          for ($iSub=0; $iSub < count($subafiliado->contextResponse); $iSub++) { 
                            if (session('idContext') == $subafiliado->contextResponse[$iSub]->idContext) {
                              echo '<option selected value="'.$subafiliado->contextResponse[$iSub]->idContext.'">'.$subafiliado->contextResponse[$iSub]->contextDescription.'</option>';
                            }else{
                              echo '<option value="'.$subafiliado->contextResponse[$iSub]->idContext.'">'.$subafiliado->contextResponse[$iSub]->contextDescription.'</option>';
                            }                            
                          }
                          ?>
                        </select>
                        <script type="text/javascript">
                          subAfSelect = '<?php echo session('idContext') ?>';
                          entidadSelect = '<?php echo session('idEntity')?>';
                          sucursalSelect = '<?php echo session('idTerminal')?>';
                          cajaSelect = '<?php echo session('idTerminalUser')?>';
                        </script>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="entidad">Entidad</label>
                        <select <?php echo $retValE = ( (session('idRol') == 2) || (session('idRol') == 3) ) ? '' : 'disabled' ; ?> class="form-control" id="entidad" name="entidad">
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select <?php echo $retValS =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) ) ? '' : 'disabled' ; ?> class="form-control" id="sucursal" name="sucursal">
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php 
                  if ( ($retValSA != '') ) {
                  ?>
                  <input type="hidden" value="<?php echo session('idContext')?>" name="subafiliado">
                  <?php 
                  }
                  ?>
                  <?php 
                  if ( ($retValE != '') ) {
                  ?>
                  <input type="hidden" value="<?php echo session('idEntity')?>" name="entidad">
                  <?php 
                  }
                  ?>
                  <?php 
                  if ( ($retValS != '') ) {
                  ?>
                  <input type="hidden" value="<?php echo session('idTerminal')?>" name="sucursal">
                  <?php 
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="caja">Caja</label>
                        <select <?php echo $retValC =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) || (session('idRol') == 5) ) ? '' : 'disabled' ; ?> class="form-control" id="caja" name="caja">
                          <option></option>
                        </select>                         
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="text" class="form-control monto" id="monto" name="monto">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section">
                        <label for="fechaInicio">Fecha</label>
                        <label for="fechaInicio" class="field prepend-icon">
                          <input type="text" id="fechaInicio" name="fechaInicio" class="gui-input">
                          <label class="field-icon">
                            <i class="fa fa-calendar"></i>
                          </label>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="monto">Referencia</label>
                        <input type="text" class="form-control" id="referencia" name="referencia">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="estatus">Estatus</label>
                        <select class="form-control" id="estatus" name="estatus">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fin">&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block buscar">Buscar</button>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fin">&nbsp;</label>
                        <button type="button" class="btn btn-danger btn-block limpiar">Limpiar filtros</button>
                      </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="panel panel-visible" id="spy2">
              <?php
              $pageURL = $_GET['page']-1;

              $curl = curl_init();

              echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&amount='.$_GET['amount'].'&reference='.$_GET['reference'].'&date='.$_GET['date'].'&status='.$_GET['date'].'&page='.$pageURL;

              curl_setopt_array($curl, array(
                CURLOPT_URL => WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&amount='.$_GET['amount'].'&reference='.$_GET['reference'].'&date='.$_GET['date'].'&status='.$_GET['date'].'&page='.$pageURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Basic YWRtaW46c2VjcmV0'
                ),
              ));

              $response = curl_exec($curl);

              curl_close($curl);

              $datos= array('response'=>json_decode($response));

             // echo WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/paymentLink/searchPaymentLink?idContext='.session('idContext').'&idEntity='.session('idEntity').'&idTerminal='.session('idTerminal').'&idTerminalUser='.session('idTerminalUser').'&amount=&reference=null&date=&status=&page=0';
              var_dump($response);

              //curl_close($curl);

              if ($response != null) {
                $num_total_rows = $datos['response']->totalElements;
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
                <div class="panel-body pn">
                  <div class="table-responsive" style=" overflow: auto;">
                    <div id="caja21" class="text-center"></div>
                    <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class="va-m">idOperation</th>
                          <th class="va-m">fullName</th>
                          <th class="va-m">email</th>
                          <th class="va-m">telephone</th>
                          <th class="va-m">description</th>
                          <th class="va-m">amount</th>
                          <th class="va-m">reference</th>
                          <th class="va-m">expiration</th>
                          <th class="va-m">status</th>
                        </tr>
                      </thead>
                      <tbody id="rowsTrasnsacciones">
                        <?php 
                          $html = '';
                          for ($i=0; $i < count($datos['response']->content) ; $i++) { 
                            $html.='<tr>
                                      <td>'.$datos['response']->content[$i]->idOperation.'</td>
                                      <td>'.$datos['response']->content[$i]->fullName.'</td>
                                      <td>'.$datos['response']->content[$i]->email.'</td>
                                      <td>'.$datos['response']->content[$i]->telephone.'</td>
                                      <td>'.$datos['response']->content[$i]->description.'</td>
                                      <td>$'.number_format($datos['response']->content[$i]->amount,2).'</td>
                                      <td>'.$datos['response']->content[$i]->reference.'</td>
                                      <td>'.$datos['response']->content[$i]->expiration.'</td>
                                      <td>'.$datos['response']->content[$i]->status.'</td>
                                    </tr>';
                          }
                          echo $html;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php 
                echo '<nav>';
                echo '<ul class="pagination">';

                if ($total_pages > 1) {
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="operaciones"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="operaciones">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="operaciones"><span aria-hidden="true">&raquo;</span></a></li>';
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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>



<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/tables-data.js"></script>
<!-- -------------- Page JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/listLinkdepago.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script type="text/javascript">
  $("#example1").DataTable({
      "responsive": false, 
      "lengthChange": false, 
      "autoWidth": false,
      "searching": false,
      "order": [],
      "processing": true,
      "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Lo sentimos, no se encontraron resultados con los datos solicitados.",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No se encontraron resultados",
        "infoFiltered": "(filtered from _MAX_ total records)"
      },
      "buttons": [
            {
                extend: 'excelHtml5',
                title: 'ListLinkPago-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'ListLinkPago-<?php echo $today_hora?>'
            },
            ["print"]
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
</body>


</html>

<?=$this->endsection()?>