<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/assets/css/paginador.css">
<?php
$today = date("Y-m-d"); 
$today_hora = date("Y-m-d H:i:s"); 
$mesLim = date("Y-m-d",strtotime($today."- 2 month"));     
?>
<script type="text/javascript">
  var urlRep = '<?php echo URL_SERVICES?>';
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
                  <a href="#">Transacciones </a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Transacciones Emision</li>
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
                <form id="fom_filter_operation" name="fom_filter_operation" method="post">
                  <div class="row">
                    <div class="col-md-12">
                    <div id="message"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Tipo de operación</label>
                        <select class="form-control rounded-0" id="typeOperacion" name="typeOperacion">
                          <option value=""></option>
                          <?php
                          for ($i=0; $i < count($rows); $i++) { 
                            if ($rows[$i]->idOperationType == $_GET['type_operation']) {
                              echo '<option selected value="'.$rows[$i]->idOperationType.'">'.$rows[$i]->name.'</option>';
                            }else{
                              echo '<option value="'.$rows[$i]->idOperationType.'">'.$rows[$i]->name.'</option>';
                            }                        
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Número de cuenta</label>
                        <input class="form-control rounded-0" value="<?php echo $_GET['num_cuenta']?>" type="text" name="num_cuenta" id="num_cuenta">
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label class="" for="daterangepicker1">Rango de fecha</label>
                        <div class="">
                          <input type="text" class="form-control pull-right active" value="<?php echo $_GET['init_date'].' / '.$_GET['end_date']?>" name="rango" id="rango">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Monto</label>
                        <input class="form-control rounded-0" value="<?php echo $_GET['amount']?>" type="text" name="monto" id="monto">
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Estatus de la operación</label>
                        <select class="form-control rounded-0" id="estatus" name="estatus">
                          <option value=""></option>
                          <?php
                          for ($j=0; $j < count($rows2); $j++) { 
                            if ($rows2[$j]->idStatus == $_GET['id_status']) {
                              echo '<option selected value="'.$rows2[$j]->idStatus.'">'.$rows2[$j]->statusDescription.'</option>'; 
                            }else{
                              echo '<option value="'.$rows2[$j]->idStatus.'">'.$rows2[$j]->statusDescription.'</option>';            
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Número de autorización</label>
                        <input class="form-control rounded-0" value="<?php echo $_GET['auth_number']?>" type="text" name="num_auto" id="num_auto">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-lg-4 col-md-4" <?php //echo $retVal2;?>>
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Entidad</label>
                        <select class="searchFil form-control rounded-0" id="idEntidad" name="idEntidad">
                          <option value="0"></option>
                          <?php
                          var_dump($combo);
                          for ($iC=0; $iC < count($combo) ; $iC++) { 
                            $saldoSes = ($_GET['id_context'] == $combo[$iC]->bundle) ? 'selected' : '' ;
                            echo '<option '.$saldoSes.' value="'.$combo[$iC]->bundle.'">'.$combo[$iC]->bundle.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input value="<?php echo $_GET['email'] ?>" class="form-control rounded-0" type="email" name="email" id="email">
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-4">
                      <div class="form-group">
                        <label for="tel">Telefóno</label>
                        <input maxlength="10" value="<?php echo $_GET['telephoneNumber'] ?>" class="form-control rounded-0" type="tel" name="tel" id="tel">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-lg-3 col-md-3"></div>
                    <div class="col-sm-12 col-lg-3 col-md-3">
                      <a id="search" style="margin-top: 30px;" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> 
                      Buscar</a>
                    </div>
                    <div class="col-sm-12 col-lg-3 col-md-3">
                      <a id="btnLimpiar" style="margin-top: 30px;" class="btn btn-danger btn-block btn-flat"><i class="far fa-trash-alt"></i>
                      Limpiar</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="panel panel-visible" id="spy2">
            <?php
            $pageURL = $_GET['page']-1;

            $curl = curl_init();

            if (session('idRol') == 2) {
              $urlServices = URL_SERVICES.'/AldebaranServices/getOperations?type_operation='.$_GET['type_operation'].'&id_status='.$_GET['id_status'].'&sirioId='.$_GET['id_context'].'&amount='.$_GET['amount'].'&auth_number='.$_GET['auth_number'].'&num_cuenta='.$_GET['num_cuenta'].'&init_date='.$_GET['init_date'].'&end_date='.$_GET['end_date'].'&email='.$_GET['email'].'&telephoneNumber='.$_GET['telephoneNumber'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
            }else{
              $urlServices = URL_SERVICES.'/AldebaranServices/getOperations?type_operation='.$_GET['type_operation'].'&id_status='.$_GET['id_status'].'&sirioId='.$_GET['id_context'].'&amount='.$_GET['amount'].'&auth_number='.$_GET['auth_number'].'&num_cuenta='.$_GET['num_cuenta'].'&init_date='.$_GET['init_date'].'&end_date='.$_GET['end_date'].'&email='.$_GET['email'].'&telephoneNumber='.$_GET['telephoneNumber'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE;
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

            //var_dump($datos['response']->totalElements);

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
          <div class="panel-body table-responsive">
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
            <div class="table-responsive" style=" overflow: auto;">
              <div id="caja21" class="text-center"></div>
              <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">

                <thead class="bg-dark">
                  <tr>
                  <th>IdOperation</th>
                  <th>transactionSecuence</th>
                  <th>idCore</th>
                  <th>OperationType</th>
                  <th>statusDescription</th>
                  <th>counterpartInstitution</th>
                  <th>trakingKey</th>
                  <th>amount</th>
                  <th>concept</th>
                  <th>numericalReference</th>
                  <th>numeroAutorizacion</th>
                  <th>creationDate</th>
                  <th>updateDate</th>
                  <th>comission</th>
                  <th>descriptionRefund</th>
                  <th>merchantName</th>
                  <th>rubroMaster</th>
                  <th>traceMaster</th>
                  <th>dateMposMaster</th>
                  <th>maskedCard</th>
                  <th>responseCodeMaster</th>
                  <th># de Afiliacion</th>
                  <th>Nombre de Afiliacion</th>
                  <!--th>sirioId</th-->
                  <!--th>initialBalance</th>
                  <th>finalBalance</th-->
                  <!--th>isSendMambu</th-->
                  </tr>
                </thead>
                <tbody id="info">
                  <?php   
                  for ($iRow=0; $iRow < count($datos['response']->content); $iRow++) { 
                    if ($datos['response']->content[$iRow]->creationDate != null) {
                        $fechaCreate = explode("T", $datos['response']->content[$iRow]->creationDate);
                    }else{
                        $fechaCreate[0]='';
                    }
                    if ($datos['response']->content[$iRow]->updateDate != null) {
                        $fechaUpdate = explode("T", $datos['response']->content[$iRow]->updateDate);
                    }else{
                        $fechaUpdate[0]='';
                    }
                    echo '<tr>
                            <td>'.$datos['response']->content[$iRow]->idOperation .'</td>
                            <td>'.$datos['response']->content[$iRow]->transactionSecuence.'</td>
                            <td>'.$datos['response']->content[$iRow]->idCoreMambu.'</td>
                            <td>'.$datos['response']->content[$iRow]->operationType.'</td>
                            <td>'.$datos['response']->content[$iRow]->statusDescription.'</td>
                            <td>'.$datos['response']->content[$iRow]->counterpartInstitution  .'</td>
                            <td>'.$datos['response']->content[$iRow]->trakingKey.'</td>
                            <td> $'.number_format($datos['response']->content[$iRow]->amount,2).'</td>
                            <td>'.$datos['response']->content[$iRow]->concept.'</td>
                            <td>'.$datos['response']->content[$iRow]->numericalReference.'</td>
                            <td>'.$datos['response']->content[$iRow]->authNumber.'</td>
                            <td>'.$datos['response']->content[$iRow]->creationDate.'</td>
                            <td>'.$datos['response']->content[$iRow]->updateDate.'</td>
                            <td>'.$datos['response']->content[$iRow]->comission.'</td>
                            <td>'.$datos['response']->content[$iRow]->descriptionRefund.'</td>
                            <td>'.$datos['response']->content[$iRow]->merchantName.'</td>
                            <td>'.$datos['response']->content[$iRow]->rubroMaster.'</td>
                            <td>'.$datos['response']->content[$iRow]->traceMaster.'</td>
                            <td>'.$datos['response']->content[$iRow]->dateMposMaster.'</td>
                            <td>'.$datos['response']->content[$iRow]->maskedCard.'</td>
                            <td>'.$datos['response']->content[$iRow]->responseCodeMaster.'</td>
                            <td>'.$datos['response']->content[$iRow]->affiliationId.'</td>
                            <td>'.$datos['response']->content[$iRow]->affiliationName.'</td>                           
                          </tr>';

                          /*<!--td>'.$datos['response']->content[$iRow]->sirioId.'</td-->
                            <!--td>'.$datos['response']->content[$iRow]->initialBalance.'</td-->
                            <!--td>'.$datos['response']->content[$iRow]->finalBalance.'</td-->
                            <td>'.$datos['response']->content[$iRow]->isSendMambu.'</td>*/
                  }
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
                echo '<li class="page-item"><a class="page-link" href="transacciones?type_operation='.$_GET['type_operation'].'&id_status='.$_GET['id_status'].'&id_context='.$_GET['id_context'].'&amount='.$_GET['amount'].'&auth_number='.$_GET['auth_number'].'&num_cuenta='.$_GET['num_cuenta'].'&init_date='.$_GET['init_date'].'&end_date='.$_GET['end_date'].'&email='.$_GET['email'].'&telephoneNumber='.$_GET['telephoneNumber'].'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
              }

              for ($i=1;$i<=$total_pages;$i++) {
                if ($page == $i) {
                    echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="transacciones?type_operation='.$_GET['type_operation'].'&id_status='.$_GET['id_status'].'&id_context='.$_GET['id_context'].'&amount='.$_GET['amount'].'&auth_number='.$_GET['auth_number'].'&num_cuenta='.$_GET['num_cuenta'].'&init_date='.$_GET['init_date'].'&end_date='.$_GET['end_date'].'&email='.$_GET['email'].'&telephoneNumber='.$_GET['telephoneNumber'].'&page='.$i.'">'.$i.'</a></li>';
                }
              }

              if ($page != $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="transacciones?type_operation='.$_GET['type_operation'].'&id_status='.$_GET['id_status'].'&id_context='.$_GET['id_context'].'&amount='.$_GET['amount'].'&auth_number='.$_GET['auth_number'].'&num_cuenta='.$_GET['num_cuenta'].'&init_date='.$_GET['init_date'].'&end_date='.$_GET['end_date'].'&email='.$_GET['email'].'&telephoneNumber='.$_GET['telephoneNumber'].'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
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
<div id="divName"></div>
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
<?php 

function archivoExternoExiste($url) {
  //echo 'Entrando a fincion '.$url.'<br>';
  $headers = @get_headers($url);
  return $headers && strpos($headers[0], '200') !== false;
}

?>

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

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

<!-- -------------- DateTime JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>

<!-- -------------- BS Colorpicker JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- -------------- MaskedInput JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/jquerymask/jquery.maskedinput.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-additional-inputs.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/transaccionesEmi.js"></script>
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
      }/*,
      "buttons": [
            {
                extend: 'excelHtml5',
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            ["print", "colvis"]
        ]*/
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  $(".botonExcel").click(function(event) {
    document.location = base_url+'/public/assets/exportar/exportarTransacciones.php?urlRep='+urlRep+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&operacion'+$('#operacion').val()+'=&edoTransaccion='+$('#edoTransaccion').val()+'&monto='+$('#monto').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&numTarjeta='+$('#numTarjeta').val()+'&bin='+$('#bin').val()+'&fechaIni='+$('#datetimepicker1').val()+'&fechaFin='+$('#datetimepicker2').val()+'&rolId=<?php echo session('idRol')?>&type='+type+'&mood='+mood+'&size=<?php echo $num_total_rows?>';
  });

  $(".botonPDF").click(function(event) {
    document.location = base_url+'/public/assets/php/exportar_pdf.php?urlRep='+urlRep+'&subafiliado='+$('#subafiliado').val()+'&entidad='+$('#entidad').val()+'&sucursal='+$('#sucursal').val()+'&caja='+$('#caja').val()+'&operacion'+$('#operacion').val()+'=&edoTransaccion='+$('#edoTransaccion').val()+'&monto='+$('#monto').val()+'&referencia='+$('#referencia').val()+'&autorizacion='+$('#autorizacion').val()+'&numTarjeta='+$('#numTarjeta').val()+'&bin='+$('#bin').val()+'&fechaIni='+$('#datetimepicker1').val()+'&fechaFin='+$('#datetimepicker2').val()+'&rolId=<?php echo session('idRol')?>&type='+type+'&mood='+mood+'&size=<?php echo $num_total_rows?>';
  });
$(".ver_tiket_modal1").click(function(event) {
    var url_ticket =  $(this).data("url"); 
    var msg = '<div>'+
               '<iframe src="http://docs.google.com/gview?url='+url_ticket+'&embedded=true" style="width:500px; height:500px;" frameborder="0"></iframe>'+
             '</div>';
        
        bootbox.dialog({
        title: "Ticket",
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-primary',
                callback: function(){
                  var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                 document_html.document.write( "<html>"+msg+"</html>" );
                 document_html.document.write( printContents );
                 document_html.document.write( "</body></html>" );
                 //setTimeout(function () {
                       document_html.print();
                  // }, 3000);
                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            },
            cancel: {
                label: 'Ok',
                className: 'btn-success',
                callback: function(){
                     bootbox.hideAll();
                     //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            }
        }
    });
  });
  $(".ver_tiket_modal_dev").click(function(event) {
    $('#divName').html('');
    var msg = "<div>"+
                "<div style='font-family:Courier;'>"+
                 " <font face='Courier'>"+ 
                      "<center>"+
                          "<br>"+
                          "<table  border='0'>"+
                              "<tr>"+ 
                                  "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                              "</tr>"+          
                              "<tr > "+
                               "<td colspan='2' align='center' >"+
                                  "<font style='font-size:9px;'>"+$(this).data("entityname")+"  &nbsp;</font>  "+
                               "</td>   "+
                              "</tr>"+
                              " <tr style='font-size:9px;'>"+
                                  "<td>FECHA:</td><td align='right'>"+$(this).data("authorizationdate")+"</td> "+
                              "</tr>"+
                              "<tr>"+
                                  '<td>&nbsp;</td>'+
                              "</tr>"+
                              "<tr>"+
                                  "<td>&nbsp;</td>"+
                              "</tr>"+
                          "</table> "+
                          "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                              "<tr style='font-size:11px;'>"+
                                  "<td colspan='3' align='center' style='font-weight:bold'><center>DEVOLUCION</center></td> "+ 
                              "</tr> "+
                              "<tr style='font-size:9px;'>"+ 
                                  "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+$(this).data("card")+"</td>"+  
                              "</tr> "+
                             "<tr style='font-size:9px;'> "+
                                  "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                  "<td align='right'>$"+$(this).data("amount")+"</td> "+   
                              "</tr>  "+ 
                              "<tr style='font-size:9px;'>  "+                      
                                  "<td colspan=3 style='font-weight:bold'>APROBACION No :"+$(this).data("authorizationdrcext")+"</b></td>"+   
                              "</tr>"+           
                              "<tr >"+
                                  "<td colspan=3> "+
                                      "<table border=0 style='font-size:9px;' width=248>  "+     
                                          "<tr> "+      
                                              "<td>LOTE:</td><td>000000</td>"+
                                              "<td>&nbsp;</td>"+     
                                              "<td>&nbsp;</td>  "+      
                                              "<td align='right' colspan=4>FOLIO: :"+$(this).data('authorizationnumber')+"</td> "+      
                                         " </tr> "+      
                                          "<tr>"+        
                                              "<td>AID:</td>"+          
                                              "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                          "</tr>"+       
                                          "<tr>"+        
                                              "<td>ARQC:</td>"+
                                              "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                          "</tr>"+  
                                          "<tr>"+        
                                              "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                          "</tr>"+             
                                      "</table>"+   
                                  "</td>"+       
                              "</tr>"+  
                              "<tr style='font-size:9px;'> "+
                                  "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                  "<td align='right'>&nbsp;</td>  "+  
                              "</tr>"+     
                          "</table> "+
                          "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                              "<tr>"+ 
                                  "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                     " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                      "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                      "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                      "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                      "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                      "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                      "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                              "</tr>"+
                                 "<tr>"+ 
                                  "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                  "</td>"+
                              "</tr>"+
                              
                          '</table>'+ 
                      '</center>'+  
                  '</font>'+
              '</div>'+
             '</div>';
    $('#divName').html(msg);
    bootbox.dialog({
        title: "Ticket",
        message: msg,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: 'Imprimir',
                className: 'btn-primary',
                callback: function(){
                  $('#divName').html('');
                  var printContents = document.getElementById("divName").innerHTML;
                  var document_html = window.open("");
                  document_html.document.write( "<html>"+msg+"</html>" );
                  document_html.document.write( printContents );
                  document_html.document.write( "</body></html>" );
                  //setTimeout(function () {
                       document_html.print();
                  printDiv('divName');
                  
                }
            },
            cancel: {
                label: 'Ok',
                className: 'btn-success',
                callback: function(){
                     bootbox.hideAll();
                     //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                }
            }
        }
    });
  });  
  var entityname, authorizationdate, card, amount, authorizationdrcext, authorizationnumber;

  $(".cambiarMonto").click(function(event) {
    entityname = $(this).data("entityname");
    authorizationdate = $(this).data("authorizationdate");
    card = $(this).data("card");
    amount = $(this).data("amount");
    authorizationdrcext = $(this).data("authorizationdrcext");
    authorizationnumber = $(this).data("authorizationnumber");
    
    bootbox.dialog({
        message: "Desea modificar el monto del ticket?",
        buttons: {
           buttonName: {
              label: "Si",
              className: "btn-primary",
              callback: function () {
                console.log('hi cambiarMonto');
                //event.preventDefault(); 
                exportar(event,amount);
              }
                  
            },
            cancel: {
                label: 'No',
                className: 'btn-dark',
                callback: function () {                  
                  $('#divName').html('');
                  var msg = "<div>"+
                              "<div style='font-family:Courier;'>"+
                              " <font face='Courier'>"+ 
                                    "<center>"+
                                        "<br>"+
                                        "<table  border='0'>"+
                                            "<tr>"+ 
                                                "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                                            "</tr>"+          
                                            "<tr > "+
                                            "<td colspan='2' align='center' >"+
                                                "<font style='font-size:9px;'>"+entityname+"  &nbsp;</font>  "+
                                            "</td>   "+
                                            "</tr>"+
                                            " <tr style='font-size:9px;'>"+
                                                "<td>FECHA:</td><td align='right'>"+authorizationdate+"</td> "+
                                            "</tr>"+
                                            "<tr>"+
                                                '<td>&nbsp;</td>'+
                                            "</tr>"+
                                            "<tr>"+
                                                "<td>&nbsp;</td>"+
                                            "</tr>"+
                                        "</table> "+
                                        "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                                            "<tr style='font-size:11px;'>"+
                                                "<td colspan='3' align='center' style='font-weight:bold'><center>VENTA</center></td> "+ 
                                            "</tr> "+
                                            "<tr style='font-size:9px;'>"+ 
                                                "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+card+"</td>"+  
                                            "</tr> "+
                                          "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                                "<td align='right'>$"+amount+"</td> "+   
                                            "</tr>  "+ 
                                            "<tr style='font-size:9px;'>  "+                      
                                                "<td colspan=3 style='font-weight:bold'>APROBACION No :"+authorizationdrcext+"</b></td>"+   
                                            "</tr>"+           
                                            "<tr >"+
                                                "<td colspan=3> "+
                                                    "<table border=0 style='font-size:9px;' width=248>  "+     
                                                        "<tr> "+      
                                                            "<td>LOTE:</td><td>000000</td>"+
                                                            "<td>&nbsp;</td>"+     
                                                            "<td>&nbsp;</td>  "+      
                                                            "<td align='right' colspan=4>FOLIO: :"+authorizationnumber+"</td> "+      
                                                      " </tr> "+      
                                                        "<tr>"+        
                                                            "<td>AID:</td>"+          
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                                        "</tr>"+       
                                                        "<tr>"+        
                                                            "<td>ARQC:</td>"+
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+  
                                                        "<tr>"+        
                                                            "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+             
                                                    "</table>"+   
                                                "</td>"+       
                                            "</tr>"+  
                                            "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                                "<td align='right'>&nbsp;</td>  "+  
                                            "</tr>"+     
                                        "</table> "+
                                        "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                                            "<tr>"+ 
                                                "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                                  " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                                    "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                                    "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                                    "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                                    "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                                    "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                                    "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                                            "</tr>"+
                                              "<tr>"+ 
                                                "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                                "</td>"+
                                            "</tr>"+
                                            
                                        '</table>'+ 
                                    '</center>'+  
                                '</font>'+
                            '</div>'+
                          '</div>';
                  $('#divName').html(msg);
                  bootbox.dialog({
                      title: "Ticket",
                      message: msg,
                      onEscape: true,
                      backdrop: true,
                      buttons: {
                          confirm: {
                              label: 'Imprimir',
                              className: 'btn-primary',
                              callback: function(){
                                $('#divName').html('');
                                var printContents = document.getElementById("divName").innerHTML;
                                var document_html = window.open("");
                                document_html.document.write( "<html>"+msg+"</html>" );
                                document_html.document.write( printContents );
                                document_html.document.write( "</body></html>" );
                                //setTimeout(function () {
                                    document_html.print();
                                printDiv('divName');
                                
                              }
                          },
                          cancel: {
                              label: 'Ok',
                              className: 'btn-success',
                              callback: function(){
                                  bootbox.hideAll();
                                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                              }
                          }
                      }
                  });
                }
            }
        }
      });
  });

function exportar(event,amount){
  console.log('hi exportar');
  $('#message').html('');
  var numError = 0;
  var frm_str = '<form id="some-form">'
                      +'<div id="message"></div>'
                      + '<div class="row" >'
                        + '<div class="form-group" style="width:100%;">'
                          +' <div class="col-md-12 section">'
                              + '<label for="date">Monto Actual</label>'    
                              + '<input value="'+amount+'" id="montoOld"class="form-control" disabled type="email">'
                              +'<h2 id="result1"></h2>'
                            + '</div>'
                            +' <div class="col-md-12 section">'
                              + '<label for="date">Nuevo Monto</label>'
                              +'<input id="montoNew" class="form-control monto" type="text">'
                              +'<h2 id="result2"></h2>'
                            + '</div>'
                          + '</div>'
                        + '</div>'
                  + '</form>';

  
   bootbox.dialog({
        message: frm_str,
        title: "Actualizar monto",
        buttons: {
           buttonName: {
              label: "Guardar",
              className: "btn-primary",
              callback: function () {
                event.preventDefault();    
                //new_string = original_string.replace('a', '')  
                console.log('exportar callback ');              
                var montoNew = parseFloat($('#montoNew').val().replace(",", "" ));              
                var montoOld = parseFloat($('#montoOld').val().replace(",", "" ));
                console.log('montoNew = '+montoNew);              
                console.log('montoOld = '+montoOld);              
                var porcentaje = (montoOld*0.30);
                console.log('porcentaje = '+porcentaje); 
                console.log (montoNew +'>='+ porcentaje +'&&'+ montoNew +'<'+ montoOld);            

                if (montoNew >= porcentaje && montoNew < montoOld) {
                  $('#divName').html('');
                  var msg = "<div>"+
                              "<div style='font-family:Courier;'>"+
                              " <font face='Courier'>"+ 
                                    "<center>"+
                                        "<br>"+
                                        "<table  border='0'>"+
                                            "<tr>"+ 
                                                "<td colspan='2' align='center' style='height:70px;background:#000; padding: 0px'><img src='https://portal-antares.kashplataforma.com/public/assets/img/logo_kashpay_sobra.png'  height='50' align='center'></td>"+
                                            "</tr>"+          
                                            "<tr > "+
                                            "<td colspan='2' align='center' >"+
                                                "<font style='font-size:9px;'>"+entityname+"  &nbsp;</font>  "+
                                            "</td>   "+
                                            "</tr>"+
                                            " <tr style='font-size:9px;'>"+
                                                "<td>FECHA:</td><td align='right'>"+authorizationdate+"</td> "+
                                            "</tr>"+
                                            "<tr>"+
                                                '<td>&nbsp;</td>'+
                                            "</tr>"+
                                            "<tr>"+
                                                "<td>&nbsp;</td>"+
                                            "</tr>"+
                                        "</table> "+
                                        "<table width=248  border='0' cellspacing='0' cellpadding='0'> "+            
                                            "<tr style='font-size:11px;'>"+
                                                "<td colspan='3' align='center' style='font-weight:bold'><center>VENTA</center></td> "+ 
                                            "</tr> "+
                                            "<tr style='font-size:9px;'>"+ 
                                                "<td colspan=2>NUMERO DE TARJETA/CTA</td><td align='right' style='font-weight:bold'>XXXX-XXXX-XXXX-"+card+"</td>"+  
                                            "</tr> "+
                                          "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>IMPORTE</td>  "+ 
                                                "<td align='right'>$"+montoNew+"</td> "+   
                                            "</tr>  "+ 
                                            "<tr style='font-size:9px;'>  "+                      
                                                "<td colspan=3 style='font-weight:bold'>APROBACION No :"+authorizationdrcext+"</b></td>"+   
                                            "</tr>"+           
                                            "<tr >"+
                                                "<td colspan=3> "+
                                                    "<table border=0 style='font-size:9px;' width=248>  "+     
                                                        "<tr> "+      
                                                            "<td>LOTE:</td><td>000000</td>"+
                                                            "<td>&nbsp;</td>"+     
                                                            "<td>&nbsp;</td>  "+      
                                                            "<td align='right' colspan=4>FOLIO: :"+authorizationnumber+"</td> "+      
                                                      " </tr> "+      
                                                        "<tr>"+        
                                                            "<td>AID:</td>"+          
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+
                                                        "</tr>"+       
                                                        "<tr>"+        
                                                            "<td>ARQC:</td>"+
                                                            "<td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+  
                                                        "<tr>"+        
                                                            "<td></td><td colspan=3>&nbsp;</td><td></td><td></td><td></td><td></td>"+     
                                                        "</tr>"+             
                                                    "</table>"+   
                                                "</td>"+       
                                            "</tr>"+  
                                            "<tr style='font-size:9px;'> "+
                                                "<td colspan=2 style='font-weight:bold'>&nbsp;</td>  " +
                                                "<td align='right'>&nbsp;</td>  "+  
                                            "</tr>"+     
                                        "</table> "+
                                        "<table width=248 style='font-size:9px; ' border='0' cellspacing='0' cellpadding='0'> "+  
                                            "<tr>"+ 
                                                "<td colspan=3 style='font-size:9px; text-align: justify;  text-justify: inter-word;' >Por este pagar&eacute; prometo y me obligo"+
                                                  " incondicionalmente a pagar la orden de la instituci&oacute;n emisora de la   "+
                                                    "tarjeta correspondiente el importe de la operaci&oacute;n cuyos datos de identificaci&oacute;n se muestran en este"+ 
                                                    "documento bajo los t&eacute;rminos y condiciones establecidos en el contrato celebrado con dicha instituci&oacute;n"+
                                                    "para el uso de la citada tarjeta.<br><br>Asi mismo reconozco, que el presente comprobante de operaci&oacute;n correspondiente a los datos e importes"+        
                                                    "indicados en el mismo, teniendo pleno valor probatorio y fuerza legal en virtud de que dicha operaci&oacute;n "+     
                                                    "fue firmada a nombre propio de forma aut&oacute;grafa o electr&oacute;nica siendo el suscrito el &uacute;nico responsable,"+     
                                                    "estando conforme con el cargo realizado en este momento a mi tarjeta.<br><br>El presente documento es negociable s&oacute;lo en instituciones de Cr&eacute;dito. </td> "+    
                                            "</tr>"+
                                              "<tr>"+ 
                                                "<td colspan=3 align='center' Style='text-align: center;'> "  +
                                                "</td>"+
                                            "</tr>"+
                                            
                                        '</table>'+ 
                                    '</center>'+  
                                '</font>'+
                            '</div>'+
                          '</div>';
                  $('#divName').html(msg);
                  bootbox.dialog({
                      title: "Ticket",
                      message: msg,
                      onEscape: true,
                      backdrop: true,
                      buttons: {
                          confirm: {
                              label: 'Imprimir',
                              className: 'btn-primary',
                              callback: function(){
                                $('#divName').html('');
                                var printContents = document.getElementById("divName").innerHTML;
                                var document_html = window.open("");
                                document_html.document.write( "<html>"+msg+"</html>" );
                                document_html.document.write( printContents );
                                document_html.document.write( "</body></html>" );
                                //setTimeout(function () {
                                    document_html.print();
                                printDiv('divName');
                                
                              }
                          },
                          cancel: {
                              label: 'Ok',
                              className: 'btn-success',
                              callback: function(){
                                  bootbox.hideAll();
                                  //setTimeout("window.location.href = '"+base_url+"/spei'", 3000);
                              }
                          }
                      }
                  });
                } else {
                  bootbox.alert({
					          message: '<div style="text-align:center;">El monto capturado debe ser mayor o igual al 30% del monto original y menor al monto original del ticket</div>'
                  });
                  
                }
              }
                  
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-dark'
            }
        }
      });
}
function expolrtar(event){
}
</script>
</body>

</html>

<?=$this->endsection()?>
