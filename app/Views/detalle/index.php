<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
?>
<script type="text/javascript">
  var urlRep = '<?php echo WS_SALDOS?>';

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
                  <a href="#">Detalle de saldo</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Detalle de Saldo</li>
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
        <div class="center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="row">

            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <form id="form-wizard" name="form-wizard">
                  <div class="col-md-4">
                    <div class="form-group" id="infoOrg">
                      <label for="edoTransaccion">Selecciona cuenta</label>
                      <select class="form-control rounded-0 wizard-required" id="cuenta" name="cuenta">
                        <option value=""></option>
                        <?php
                        for ($iC=0; $iC < count($cuentas) ; $iC++) { 
                          if(isset($cuentas[$iC]->idSirio)){
                            if (session('idBusinessModel') == 1) {
                              $saldoSes = 'selected';
                              echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">Cuenta Emisora</option>';
                            } else if (session('idBusinessModel') == 2) {
                              $saldoSes = 'selected';
                              $nameSes = 'Cuenta Adquirente' ;
                              echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
                            }else {
                              $saldoSes = 'selected';
                              $nameSes = ($cuentas[$iC]->idbusinessModel == 1) ? 'Cuenta Emisora' : 'Cuenta Adquirente' ;
                              echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
                              //echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
                            }
                          }     
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group" id="infoOrg">
                      <label for="edoTransaccion">Entidad</label>
                      <select class="form-control rounded-0 wizard-required" id="cuentaOr" name="cuentaOr">
                        <option value=""></option>
                        <?php
                         if (session('idBusinessModel') == 1) {
                          for ($iC=0; $iC < count($combo) ; $iC++) { 
                            $saldoSes = ($_GET['fatherID'] == $combo[$iC]->bundle) ? 'selected' : '' ;
                            echo '<option '.$saldoSes.' value="'.$combo[$iC]->bundle.'">'.$combo[$iC]->bundle.'</option>';     
                          }
                        }
                        
                        ?>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="panel panel-visible" id="spy2">            
              <?php
              $curlSaldo = curl_init();

              $pageURL = $_GET['page']-1;

              $curl = curl_init();

              if (session('idRol') == 1) {
                $urlServices = WS_SALDOS.'/Entities/entities/all?fatherID='.$_GET['fatherID'].'&type=1&status=25&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
              }else{
                $urlServices = WS_SALDOS.'/Entities/entities/all?fatherID='.$_GET['fatherID'].'&type=1&status=25&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
              }

              //echo $urlServices;

              curl_setopt_array($curlSaldo, array(        
                CURLOPT_URL => $urlServices,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET'
              ));

              $response = curl_exec($curlSaldo);

              curl_close($curlSaldo);

              $datos= array('response'=>json_decode($response));

              //var_dump($datos['response']->totalItems);

              if ($datos['response'] != null) {
                $num_total_rows = $datos['response']->totalItems;
                //$num_total_rows = 0;
              }else{
                $num_total_rows = 0;
              }
              //echo($num_total_rows);
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
                //$total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);
                $total_pages = ceil($num_total_rows);
            ?>
              <div class="panel-body pn">
                <div class="row">
                  <div class="col-md-4">
                <a href="#" class="botonExcel btn ladda-button btn-default">
                  <span class="imoon imoon-file-excel"></span> Exportar a Excel
                </a>
              </div>
              <div class="col-md-4">
                <a href="#" class="botonPDF btn ladda-button btn-default">
                  <span class="imoon imoon-file-pdf"></span> Exportar a PDF
                </a>
              </div>
                </div>
                <div style="height: 30px;"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" style=" overflow: auto;">
                      <div id="caja21" class="text-center"></div>
                      <table id="rows" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead class="bg-dark">
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cuenta Clabe</th>
                            <th>Cuenta Virtual</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Saldo Principal</th>
                            <th>Saldo Garantia</th>
                            <th>Saldo Pendiente</th>
                          </tr>
                        </thead>
                        <tbody id="rowsTrasnsacciones">
                          <?php
                          $html = '';
                          //var_dump($datos['response']->entities);
                          for ($iD=0; $iD < count($datos['response']->entities) ; $iD++) { 
                            $html .= '<tr>
                              <td>'.$datos['response']->entities[$iD]->id.'</td>
                              <td>'.$datos['response']->entities[$iD]->name.'</td>
                              <td>'.$datos['response']->entities[$iD]->clabeAccount.'</td>
                              <td>'.$datos['response']->entities[$iD]->virtualAccount.'</td>
                              <td>'.$datos['response']->entities[$iD]->email.'</td>
                              <td>'.$datos['response']->entities[$iD]->phoneNumber.'</td>
                              <td>$ '.number_format($datos['response']->entities[$iD]->balance,2).'</td>
                              <td>$ '.number_format($datos['response']->entities[$iD]->warrantyBalance,2).'</td>
                              <td>$ '.number_format($datos['response']->entities[$iD]->customerNetworkBalance,2).'</td>
                            </tr>';
                          }
                            echo $html;
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                    
                <script type="text/javascript">
                </script>                
              </div>
              <?php 
            echo '<nav>';
            echo '<ul class="pagination">';

            if ($total_pages > 1) {
              /*if ($page != 1) {
                echo '<li class="page-item"><a class="page-link" href="detalle?fatherID='.session('entitySonID').'&type=1&status=25&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
              }

              for ($i=1;$i<=$total_pages;$i++) {
                if ($page == $i) {
                    echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="detalle?fatherID='.session('entitySonID').'&type=1&status=25&page='.$i.'">'.$i.'</a></li>';
                }
              }

              if ($page != $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="detalle?fatherID='.session('entitySonID').'&type=1&status=25&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
              }*/
            }
            echo '</ul>';
            echo '</nav>';
          }else{
            echo '<h4>No se encontraron datos.</h4>';
          }
          ?>
            </div>
            <div id="divName">
                            
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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-addSucursal.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-addSucursal.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-addSucursal.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script language="javascript">
$(document).ready(function() {
  $(".botonExcel").click(function(event) {
    
    console.log('type = '+urlRep);
    document.location = base_url+'/public/assets/php/exportar_detalle.php?urlRep='+urlRep+'&fatherID=<?php echo $_GET['fatherID']?>&type=1&status=25&total=<?php echo $num_total_rows?>';
  
  });
  $(".botonPDF").click(function(event) {
      document.location = base_url+'/public/assets/php/exportar_detalle_pdf.php?urlRep='+urlRep+'&fatherID=<?php echo $_GET['fatherID']?>&type=1&status=25&total=<?php echo $num_total_rows?>';
    });
});

$("#cuenta").change(function(event){
  if($("#cuenta").val() != '' ){
  $('#cuentaOr').html('<option></option>');
    $.ajax({
        url: base_url+"/transferenciaspei/combo",
        data: $("#form-wizard").serialize(),
        type: "post",
        dataType: "json",
        success: function(respuesta){
        if(respuesta.rows.length > 0){
            console.log('onsignaEntity = '+respuesta.rows.length);
            for (var i = 0; i < respuesta.rows.length; i++) {
                $('#cuentaOr').append($('<option>').val(respuesta.rows[i].bundle).text(respuesta.rows[i].bundle));
            }
        }else{
            $('#cuentaOr').html('<option></option>');
            bootbox.alert({
                title: 'Busqueda sin datos',
                message: 'Cuenta seleccionada no tiene entidades relacionadas.',
                locale: 'mx'
            });
        }
        }
    });
  }
});
$("#cuentaOr").change(function(event){
  $('#cuentaOr').html('<option></option>');
  <?php
  if (session('idBusinessModel') == 1) {
  ?>
  if ($("#cuentaOr").val() == '') {
    location.href = base_url+'/detalle?fatherID=<?php echo session('issueId')?>&type=1&status=25&page=1';
  } else {
    location.href = base_url+'/detalle?fatherID='+$("#cuentaOr").val()+'&type=1&status=25&page=1';
  }
  <?php
  } else if (session('idBusinessModel') == 2) {
  ?>
  if ($("#cuentaOr").val() == '') {
    location.href = base_url+'/detalle?fatherID=<?php echo session('entitySonID')?>&type=1&status=25&page=1';
  } else {
    location.href = base_url+'/detalle?fatherID='+$("#cuentaOr").val()+'&type=1&status=25&page=1';
  }
  <?php
  }else {
  ?>
  if ($("#cuentaOr").val() == '') {
    location.href = base_url+'/detalle?fatherID=<?php echo session('entitySonID')?>&type=1&status=25&page=1';
  } else {
    location.href = base_url+'/detalle?fatherID='+$("#cuentaOr").val()+'&type=1&status=25&page=1';
  }
  <?php
  }
  ?>
});
</script> 

</body>

</html>

<?=$this->endsection()?>