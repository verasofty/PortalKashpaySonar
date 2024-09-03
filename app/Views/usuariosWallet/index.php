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
<style>
  .not-active { 
      pointer-events: none; 
      cursor: default; 
      color: #e3e3e3 !important;
  } 
</style>
<header id="topbar" class="alt">
      <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="dashboard">Usuarios</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Usuarios Wallet</li>
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
          <div class="col-md-12">
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn ">
              <form id="form_filtro" name="form_filtro" method="post">
                <div id="message"></div>
                <?php 
                  $retVal = (session('idRol') == 2) ? 'col-sm-12 col-lg-3 col-md-3' : 'col-sm-12 col-lg-3 col-md-3' ; 
                  $retVal2 = (session('idRol') == 2) ? '' : '' ; 
                  if ($_GET['type'] == 0) {
                    $rango  = $_GET['value1'].' / '.$_GET['value2'];
                  }else{
                    $rango  = $_GET['value1'];
                  }

                ?>
                <div class="row">
                  <div class="<?php echo $retVal; ?>">
                    <div class="form-group">
                      <label for="edoTransaccion">Tipo de Busqueda</label>
                      <select class="form-control" id="typeSearch" name="typeSearch">
                        <option></option>
                        <?php 
                        $typeFilter = array('Correo Electrónico', 'Rango de fecha', 'Telefóno', 'Estatus');
                        $idTypeFilter = array(1,0,2,3);
                        for ($iTF=0; $iTF < count($typeFilter); $iTF++) { 
                          if ($idTypeFilter[$iTF] == $_GET['type']) {
                            echo '<option selected value="'.$idTypeFilter[$iTF].'">'.$typeFilter[$iTF].'</option>';
                          }else{
                            echo '<option value="'.$idTypeFilter[$iTF].'">'.$typeFilter[$iTF].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="<?php echo $retVal; ?>">
                    <div class="form-group busqueda">
                      <label for="valueSearch" id="busqueda">&nbsp;</label>
                      <input class="searchFil form-control" value="<?php echo $_GET['value1']?>" type="text" name="valueSearch" id="valueSearch">
                      <select id="idStatus" name="idStatus" class="searchFil form-control">
                        <option value=""></option>
                        <?php 
                        $arraystatus = array('Activo','Bloqueado','Inactivo','Revisando','Verificado','Fallo envio SCUD','Pendiente por revisar core','Estatus diferente de verified','Fallo alta web','Rechazado por SCUD');
                        $arraystatusid = array(1,3,14,18,19,20,21,22,23,24);

                        for ($iStatus=0; $iStatus < count($arraystatusid) ; $iStatus++) { 
                          if ($arraystatusid[$iStatus] == $_GET['value1']) {
                            echo '<option selected value="'.$arraystatusid[$iStatus].'">'.$arraystatus[$iStatus].'</option>';
                          }else{
                            echo '<option value="'.$arraystatusid[$iStatus].'">'.$arraystatus[$iStatus].'</option>';
                          }
                        
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="<?php echo $retVal; ?>">
                    <div class="form-group">
                      <label class="" for="daterangepicker1">Rango de fecha</label>
                      <div class="">
                        <input type="text" class="form-control pull-right active" name="rango" id="rango" value="<?php echo  $retVal = ($_GET['type'] == 0) ? $_GET['value1'].' / '.$_GET['value2'] : '' ;?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-3 col-md-3">
                    <div class="form-group">
                      <label for="idContext">Entidad</label>
                      <select class="searchFil form-control" id="idContext" name="idContext">
                        <option value="0"></option>
                      <?php
                      for ($iC=0; $iC < count($combo) ; $iC++) { 
                        $saldoSes = ($_GET['id_context'] == $combo[$iC]->bundle) ? 'selected' : '' ;
                        echo '<option '.$saldoSes.' value="'.$combo[$iC]->bundle.'">'.$combo[$iC]->bundle.'</option>';
                        
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-sm-12 col-lg-3 col-md-3"></div>
                  <div class="col-sm-12 col-lg-3 col-md-3">
                    <a id="searchCard" style="margin-top: 30px;" class="btn btn-primary btn-block"><i class="fas fa-search"></i> 
                    Buscar</a>
                  </div>
                  <div class="col-sm-12 col-lg-3 col-md-3">
                    <a id="btnLimpiar" style="margin-top: 30px;" class="btn btn-danger btn-block"><i class="far fa-trash-alt"></i>
                    Limpiar</a>
                  </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-md-3"></div>
              </form>
              </div>
            </div>
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
              <?php 
                $pageURL = $_GET['page']-1;

                $curl = curl_init();

                if (session('idRol') == 1) {
                  $urlServices = URL_SERVICES.'/AldebaranServices/getUsersBy?sirioId='.$_GET['id_context'].'&type='.$_GET['type'].'&value1='.$_GET['value1'].'&value2='.$_GET['value2'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
                }else{
                  $urlServices = URL_SERVICES.'/AldebaranServices/getUsersBy?sirioId='.$_GET['id_context'].'&type='.$_GET['type'].'&value1='.$_GET['value1'].'&value2='.$_GET['value2'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
                }

                //echo $urlServices;

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $urlServices,
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
                $datos= array('response'=>json_decode($response));

                  //var_dump($datos['response']);

                 if ($datos['response']->content != null) {
                    $num_total_rows = $datos['response']->totalElements;
                    //$num_total_rows = 0;
                  }else{
                    $num_total_rows = 0;
                  }
                  //echo($num_total_rows);
                  //$num_total_rows = $datos['response']->totalElements;
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
                
                  
                </div>
                <div style="height: 30px;"></div>
                <div class="table-responsive" style=" overflow: auto;">
                  <div id="caja21" class="text-center"></div>
                  <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th># de INE</th>
                        <th>Nombre</th>
                        <th># de Afiliación</th>
                        <th>Nombre de Afiliación</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Fecha Registro</th>
                        <th>CURP</th>    
                        <th>Tarjeta</th>
                        <th>Cuenta Citi</th>
                        <th>Número de Cuenta </th>
                        <th>Clabe</th>
                        <th>Token</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="rowsTrasnsacciones">
                    <?php
                      $disable = '';
                      for ($i=0; $i < count($datos['response']->content); $i++) { 
                        $onclickvar = "exportar(".$datos['response']->content[$i]->idUser.",'".$datos['response']->content[$i]->email."',event)";
                        $onclickToken = "sendToken(".$datos['response']->content[$i]->idUser.",'".$datos['response']->content[$i]->email."',".$datos['response']->content[$i]->idContext.",event)";
                        $onclickBlock = "blockUser(".$datos['response']->content[$i]->idUser.",".$datos['response']->content[$i]->idContext.",event)";
                        $onclickRep = "reproUser('".$datos['response']->content[$i]->idUser."',event)";
                        $onclickDrop = "dropUser('".$datos['response']->content[$i]->email."',event)";
                        $fecha = explode(' ', $datos['response']->content[$i]->dateTimeCreator);
                        $hora = explode('.', $fecha[1]);
                        if ($datos['response']->content[$i]->status != 'INACTIVO') {
                          $disable = 'not-active';
                        }else{
                          $disable = '';
                        }
                        if ($datos['response']->content[$i]->status == 'ACTIVO') {
                          $disableBloq = '';
                        }else{
                          $disableBloq = 'not-active';
                        }
                        if ($datos['response']->content[$i]->status == 'FALLO ENVIO SCUD' || $datos['response']->content[$i]->status == 'FALLO ALTA WEB' || $datos['response']->content[$i]->status == 'RECHAZADO POR SCUD' || $datos['response']->content[$i]->status == 'VERIFICADO' ) {
                          $disableRep = '';
                        }else{
                          $disableRep = 'not-active';
                        }      
                        if ($datos['response']->content[$i]->status == 'ACTIVO' || $datos['response']->content[$i]->status == 'BLOQUEADO' || $datos['response']->content[$i]->status == 'INACTIVO' || $datos['response']->content[$i]->status == 'VERIFICADO'  || $datos['response']->content[$i]->status == 'FALLO ALTA WEB' || $datos['response']->content[$i]->status == 'PENDIENTE POR REVISAR CORE' ) {
                          $disableDrop = 'not-active';
                        }else{
                          $disableDrop = '';
                        } 

                        echo '<tr>
                                <td>
                                  <input type="checkbox" class="selectMasivo" name="masivo[]" data-email="'.$datos['response']->content[$i]->email.'" value="'.$datos['response']->content[$i]->idUser.'">
                                </td>
                                <td>'.$datos['response']->content[$i]->dni.'</td>
                                <td>'.$datos['response']->content[$i]->userName.' '.$datos['response']->content[$i]->firstName.' '.$datos['response']->content[$i]->lastName.'</td>
                                <td>'.$datos['response']->content[$i]->affiliationId.'</td>
                                <td>'.$datos['response']->content[$i]->affiliationName.'</td>
                                <td>'.$datos['response']->content[$i]->email.'</td>
                                <td>'.$datos['response']->content[$i]->telephoneNumber.'</td>
                                <td>'.$fecha[0].' '.$hora[0].'</td>
                                <td>'.$datos['response']->content[$i]->curp.'</td>
                                <td>'.$datos['response']->content[$i]->maskedCard.'</td>
                                <td>'.$datos['response']->content[$i]->cuentaCiti.'</td>
                                <td>'.$datos['response']->content[$i]->numCuenta.'</td>
                                <td>'.$datos['response']->content[$i]->clabe.'</td>
                                <td>'.$datos['response']->content[$i]->registrationCompletToken.'</td>
                                <td>'.$datos['response']->content[$i]->status.'</td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                        <span class="caret ml5"></span>
                                    </button>
                                      <ul class="dropdown-menu" role="menu">
                                          <li>
                                              <a onclick="'.$onclickToken.'" href="#">Reenvio de token</a>
                                          </li>
                                          <li>
                                              <a onclick="'.$onclickvar.'" href="#">Actualizar correo electrónico</a>
                                          </li>';
                                          if (session('idRol') == 1 || session('idRol') == 2) {
                                            echo '<li class="divider"></li>';
                                            echo '<li>
                                                <a class="'.$disableBloq.'" onclick="'.$onclickBlock.'" href="#">Bloqueo</a>
                                            </li>
                                            <li>
                                                <a class="'.$disableRep.'" onclick="'.$onclickRep.'" href="#">Reproceso</a>
                                            </li>
                                            <li>
                                                <a class="'.$disableDrop.'" onclick="'.$onclickDrop.'" href="#">Eliminar</a>
                                            </li>';
                                          }
                                          
                                      echo '</ul>
                                  </div>';
                                 /* echo '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                  <button '.$disable.' onclick="'.$onclickToken.'" title="Reenvio de Token" type="button" class="btn btn-success btn_token"><i class="fas fa-share"></i></button>
                                    <button title="Actualizar Correo Electrónico" onclick="'.$onclickvar.'" type="button" class="btn btn-primary btn_email"><i class="fas fa-edit"></i></button>
                                    <!--button data-iduser="'.$datos['response']->content[$i]->idUser.'" title="Reasignar Contraseña" type="button" class="btn btn-warning btn_pass"><i class="fas fa-unlock-alt"></i></button-->';
                                    if (session('idRol') == 1 || session('idRol') == 2) {
                                      echo '<button '.$disableBloq.' onclick="'.$onclickBlock.'" title="Bloqueo" type="button" class="btn btn-danger btn_bloqueo"><i class="fas fa-ban"></i></button>';
                                      echo '<button '.$disableRep.' onclick="'.$onclickRep.'" title="Reprocesar" type="button" class="btn btn-warning btn_reproceso"><i class="fas fa-redo-alt"></i></button>';
                                      echo '<button '.$disableDrop.' onclick="'.$onclickDrop.'" title="Reprocesar" type="button" class="btn btn-danger btn_reproceso"><i class="fas fa-trash"></i></button>';
                                    }
                                    echo '</div>';*/
                                    
                            echo '
                                </td>
                                
                              </tr>';
                      }                      
                    ?>
                    </tbody>
                  </table>
                  <?php 
                echo '<nav>';
                echo '<ul class="pagination">';

                if ($total_pages > 1) {
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="usuarios?id_context='.$_GET['id_context'].'&type='.$_GET['type'].'&value1='.$_GET['value1'].'&value2='.$_GET['value2'].'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="usuarios?id_context='.$_GET['id_context'].'&type='.$_GET['type'].'&value1='.$_GET['value1'].'&value2='.$_GET['value2'].'&page='.$i.'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="usuarios?id_context='.$_GET['id_context'].'&type='.$_GET['type'].'&value1='.$_GET['value1'].'&value2='.$_GET['value2'].'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
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
<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/daterange/daterangepicker.js"></script>



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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/listUsuarioKashpay.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script type="text/javascript">
  $('#rango').daterangepicker();
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
                title: 'Cajas-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'Cajas-<?php echo $today_hora?>'
            },
            ["print"]
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

</body>

</html>

<?=$this->endsection()?>