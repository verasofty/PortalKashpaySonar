<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d"); 
$today_hora = date("Y-m-d H:i:s"); 
$mesLim = date("Y-m-d",strtotime($today."- 2 month"));   
$porciones_type = explode(",", $_GET['type']);
$porciones_status = explode(",", $_GET['status']);
$porciones_ini = explode(" ", $_GET['dateInit']);
$porciones_fin = explode(" ", $_GET['dateFinish']);
$nameStatus = array();
$statusSelect = array();
$typeSelect = array();
$idStatus = array();
$nameStatusurl = '';
$myStatus;
$mytype;
for ($jStatus = 0; $jStatus<count($porciones_status); $jStatus++) {
  $myStatus = $porciones_status[$jStatus];
  array_push($statusSelect,$myStatus);
}
for ($jtype = 0; $jtype<count($porciones_type); $jtype++) {
  $mytype = $porciones_type[$jtype];
  array_push($typeSelect,$mytype);
}
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
  var mesLim = '<?php echo $mesLim?>';
 
  var fechaIniUrl = '<?php echo $porciones_ini[0].' '.$porciones_ini[1]?>';
  var fechaFinUrl = '<?php echo $porciones_fin[0].' '.$porciones_fin[1]?>';

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
                  <a href="#">Operaciones</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Operaciones Emision</li>
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
          <div class="row">
            
            <div class="panel panel-visible" id="spy2">
                <form id="form_filtro" name="form_filtro" method="post">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="typeOperacion">Tipo de operación</label>
                        <select multiple="multiple" class="form-control select2-multiple" id="typeOperacion" name="typeOperacion">
                          <option value=""></option>
                          <?php 
                          for ($i=0; $i < count($typeOpe->catOperationTypes); $i++) { 
                            if (in_array($typeOpe->catOperationTypes[$i]->idOperationType, $typeSelect)) {
                              echo '<option selected value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->descriptionApp.'</option>';
                            }else{
                                echo '<option value="'.$typeOpe->catOperationTypes[$i]->idOperationType.'">'.$typeOpe->catOperationTypes[$i]->descriptionApp.'</option>';
                            }
                          }
                            //var_dump($typeOpe);
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="edoTransaccion">Estatus de Operación</label>
                        <select multiple="multiple" class="form-control select2-multiple" id="estatus" name="estatus">
                          <option value=""></option>
                          <?php 
                          $statusArray = array ('Procesando', 'Denegado', 'Reversado', 'Cancelado', 'Reversando', 'Devuelto', 'Aprobado', 'Creado', 'Pendiente de envío', 'Enviado', 'Rechazado', 'Confirmado', 'Conciliado', 'Liquidado', 'Cerrado', 'Tarifa dividida');
                          $statusidArray = array ('5','6','7','8','10','11','15','25','26','27','28','29','30','31','32','33');
         
                          for ($iS=0; $iS < count($statusArray) ; $iS++) { 
                            if (in_array( $statusidArray[$iS], $statusSelect)) {
                              echo '<option selected value="'.$statusidArray[$iS].'">'.$statusArray[$iS].'</option>';
                                array_push($nameStatus,$statusArray[$iS]);
                                array_push($idStatus,$statusidArray[$iS]);
                                $nameStatusurl .= $statusArray[$iS].',';
                            }else{
                                echo '<option value="'.$statusidArray[$iS].'">'.$statusArray[$iS].'</option>';
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
                          for ($iC=0; $iC < count($combo) ; $iC++) { 
                            $saldoSes = ($_GET['entidad'] == $combo[$iC]->bundle) ? 'selected' : '' ;
                            echo '<option '.$saldoSes.' value="'.$combo[$iC]->bundle.'">'.$combo[$iC]->bundle.'</option>';     
                          }
                          ?>
                           
                        </select>
                        
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                      <label for="fechaFin">Fecha Inicio</label>
                      <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                        <input type="text" id="datetimepicker1" value="<?php echo $_GET['dateInit']?>" class="datetimepicker1 form-control datetimepicker-input" data-target="#reservationdatetime1"/>
                      </div>
                      <!--div class="section">
                        <label for="fechaInicio">Fecha Inicio</label>
                        <input type="text"  class="form-control" id="datetimepicker1" name="datetimepicker1">
                      </div-->
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="fechaFin">Fecha Fin</label>
                          <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                              <input type="text" id="datetimepicker2" value="<?php echo $_GET['dateFinish']?>" class="datetimepicker2 form-control datetimepicker-input" data-target="#reservationdatetime2"/>
                          </div>
                      </div>
                      <!--div class="section">
                        <label for="fechaFin">Fecha Fin</label>
                        <input type="text"  class="form-control" id="datetimepicker2" name="datetimepicker2">
                      </div-->
                    </div>
                    <div class="col-md-3"></div>
                  </div>                
                  <div class="row">
                    <div class="col-md-3"></div>
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
                    <div class="col-md-3"></div>
                  </div>
                </form>
              </div>
            </div>
            <div style=""></div>
            <div class="panel panel-visible" id="spy2">
              <?php 
              $pageURL = $_GET['page']-1;

              $curl = curl_init();

              $location = curl_escape($curl, $porciones_ini[0].' '.$porciones_ini[1]);
              $location2 = curl_escape($curl, $porciones_fin[0].' '.$porciones_fin[1]);

              if (session('idRol') ==  2) {
                $urlServices =WS_SALDOS.'/Entities/entities/'.$_GET['entidad'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE.'&dateInit='.$location.'&dateFinish='.$location2;
              }else{
                $urlServices =WS_SALDOS.'/Entities/entities/'.$_GET['entidad'].'/getoperationbytypeandstatuscustom?type='.$_GET['type'].'&status='.$_GET['status'].'&page='.$pageURL.'&size='.NUM_ITEMS_BY_PAGE.'&dateInit='.$location.'&dateFinish='.$location2;
              }

             // echo $urlServices;
              //http://44.199.131.117/Entities/entities/SUB165/getoperationbytypeandstatuscustom?type=1&status=3&page=0&size=10&dateInit=2022-07-03%2000%3A00&dateFinish=2022-10-19%2000%3A00

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

              //var_dump($response);

              //curl_close($curl);

              if ($response != null) {
                $num_total_rows = $datos['response']->totalItems;
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
                <div class="row">
                  <div class="col-md-4">
                    <a href="#" class="botonExcel btn ladda-button btn-default">
                      <span class="imoon imoon-file-excel"></span> Exportar a Excel
                    </a>
                  </div>
                </div>
                <div style="height: 30px;"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" style=" overflow: auto;">
                      <div id="caja21" class="text-center"></div>
                      <table id="" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead class="bg-dark">
                          <tr>
                            <th class="va-m">Id</th>
                            <th class="va-m">Tipo</th>
                            <th class="va-m">Monto</th>
                            <th class="va-m">Estatus</th>
                            <th class="va-m">Descripción</th>
                            <th class="va-m">Fecha</th>
                            <th class="va-m">Codigo de Respuesta</th>
                            <th class="va-m">Referencia numerica</th>
                            <th class="va-m">Referencia Alfanumerica</th>
                            <th class="va-m">Nombre del Destinatario</th>
                            <th class="va-m">Id Destinatario</th>
                            <th class="va-m">targetIDCode</th>
                            <th class="va-m">targetEmail</th>
                            <th class="va-m">Referencia Interna</th>
                            <th class="va-m">Referencia Externa</th>
                            <th class="va-m">TransactionBundler</th>
                            <th class="va-m">Observación</th>
                            <th class="va-m">Usuario</th>
                            
                            <th class="va-m">Detalle</th>
                            
                          </tr>
                        </thead>
                        <tbody id="rowsTrasnsacciones">
                          <?php 
                          $html = '';

                          for ($i=0; $i < count($datos['response']->operations) ; $i++) { 
                            //2022-08-31T01:17:56.739+0000
                            $estatusSelect='';
                            $porciones_fecha = explode("T", $datos['response']->operations[$i]->createdAt);
                            $porciones_fecha2 = explode(".", $porciones_fecha[1]);

                            switch ($datos['response']->operations[$i]->status) {
                              case '5':
                                $estatus = 'Procesando';
                                break;
                              case '6':
                                $estatus = 'Denegado';
                                break;
                              case '7':
                                $estatus = 'Reversado';
                                break;
                              case '8':
                                $estatus = 'Cancelado';
                                break;
                              case '10':
                                $estatus = 'Reversando';
                                break;
                              case '11':
                                $estatus = 'Devuelto';
                                break;
                              case '15':
                                $estatus = 'Aprobado';
                                break;
                              case '25':
                                $estatus = 'Creado';
                                break;
                              case '26':
                                $estatus = 'Pendiente de envío';
                                break;
                              case '27':
                                $estatus = 'Enviado';
                                break;
                                case '28':
                                $estatus = 'Rechazado';
                                break;
                              case '29':
                                $estatus = 'Confirmado';
                                break;
                              case '30':
                                $estatus = 'Conciliado';
                                break;
                              case '31':
                                $estatus = 'Liquidado';
                                break;
                              case '32':
                                $estatus = 'Cerrado';
                                break;
                              case '33':
                                $estatus = 'Tarifa dividida';
                                break;                                      
                              default:
                                break;
                            }

                            $html.='<tr>
                                      <td>'.$datos['response']->operations[$i]->id.'</td>
                                      <td>'.$datos['response']->operations[$i]->descriptionType.'</td>
                                      <td>$ '.number_format($datos['response']->operations[$i]->amount,2).'</td>
                                      <td>'.$estatus.'</td>
                                      <td>'.$datos['response']->operations[$i]->description.'</td>
                                      <td>'.$porciones_fecha[0].' '.$porciones_fecha2[0].'</td>
                                      <td>'.$datos['response']->operations[$i]->responseCode.'</td>
                                      <td>'.$datos['response']->operations[$i]->numericReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->alphanumericReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetName.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetID.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetIDCode.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetEmail.'</td>
                                      <td>'.$datos['response']->operations[$i]->internalReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->externalReference.'</td>
                                      <td>'.$datos['response']->operations[$i]->transactionBundler.'</td>
                                      <td>'.$datos['response']->operations[$i]->observation.'</td>
                                      <td>'.$datos['response']->operations[$i]->targetName.'</td>
                                      
                                      <td>';
                                      if ($datos['response']->operations[$i]->type == 10008) {
                                        $html.='<a title="Detalle de Transacción" href="detalletransaccion?validate='.$datos['response']->operations[$i]->numericReference.'&page=1" class="btn btn-primary">'.
                                                  '<i class="fas fa-coins"></i>'.
                                                '</a>';
                                      }else if ($datos['response']->operations[$i]->type == 1) {
                                        $html.='<a title="Comprobante Spei" href="#" class="btn btn-primary comprobante" data-fecha="'.$porciones_fecha[0].' '.$porciones_fecha2[0].'" data-monto="'.number_format($datos['response']->operations[$i]->amount,2).'" data-name="'.$datos['response']->operations[$i]->targetName.'" data-cuenta="" data-banco="" data-concepto="" data-referencia="" data-origen="" data-autorizacion="">'.
                                                  '<i class="fas fa-file-invoice-dollar"></i>'.
                                                '</a>';
                                      }
                              $html.='</td>
                                    </tr>';
                          }
                          echo $html
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
                  if ($page != 1) {
                    echo '<li class="page-item"><a class="page-link" href="operacionesEmision?type='.$_GET['type'].'&entidad='.$_GET['entidad'].'&status='.$_GET['status'].'&page='.($page-1).'&dateInit='.$location.'&dateFinish='.$location2.'"><span aria-hidden="true">&laquo;</span></a></li>';
                  }

                  for ($i=1;$i<=$total_pages;$i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="operacionesEmision?type='.$_GET['type'].'&entidad='.$_GET['entidad'].'&status='.$_GET['status'].'&page='.$i.'&dateInit='.$location.'&dateFinish='.$location2.'">'.$i.'</a></li>';
                    }
                  }

                  if ($page != $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="operacionesEmision?type='.$_GET['type'].'&entidad='.$_GET['entidad'].'&status='.$_GET['status'].'&page='.($page+1).'&dateInit='.$location.'&dateFinish='.$location2.'"><span aria-hidden="true">&raquo;</span></a></li>';
                  }
                }
                echo '</ul>';
                echo '</nav>';
              }else{
                echo '<div class="row"><div class="col-md-12"><h4>No se encontraron datos.</h4></div></div>';
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
<div  id="divName">

</div>


<div id="elementH"></div>
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

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/user-forms-additional-inputs.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/operacionesEmi.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>

function printDiv(nombreDiv) {
  $('#'+nombreDiv).show();

       var contenido= document.getElementById(nombreDiv).innerHTML;
       var contenidoOriginal= document.body.innerHTML;

       document.body.innerHTML = contenido;

       window.print();

       document.body.innerHTML = contenidoOriginal;
     /*var doc = new jsPDF();
                  var elementHTML = $('#divName').html();
                  var specialElementHandlers = {
                      '#elementH': function (element, renderer) {
                          return true;
                      }
                  };
                  doc.fromHTML(elementHTML, 15, 15, {
                      'width': 170,
                      'elementHandlers': specialElementHandlers
                  });

                  // Save the PDF
                  doc.save('sample-document.pdf');*/

    //$('#'+nombreDiv).hide();

  }
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".botonExcel").click(function(event) {
    var type = $('#type').val();
    var status = $('#status').val();
    if (type == undefined) {
      type = '';
    }
    if (status == undefined) {
      status = '';
    }
    console.log('type = '+urlRep);
    document.location = base_url+'/public/dist/exportar/exportar.php?urlRep='+urlRep+'&type=<?php echo $_GET["type"]?>&status=<?php echo $_GET["status"]?>&page=&size=<?php echo $num_total_rows?>&id=<?php echo $_GET["entidad"]?>&dateInit=<?php echo $_GET["dateInit"]?>&dateFinish=<?php echo $_GET["dateFinish"]?>&name=<?php echo $nameStatusurl?>';
  
  });

  $(".comprobante").click(function(event) {
    var fechaSpei = $(this).data("fecha");
  var msg = '<div>'+
              '<div style="background:#c7924b; border-radius:0px; color:#fff;padding: 10px;text-align: center; margin-top:10px;">'+
                  '<h4 style="color:#fff">Envío realizado</h4>'+
                  '<p>'+fechaSpei+'</p>'+
                  '<p><b>$'+$(this).data("monto")+'</b></p>'+
              '</div>'+
              '<div style="text-align: center; background:#000;">'+
                  '<img style="padding: 10px;width: 50%;" src="'+base_url+'/public/dist/img/logo_kashpay_black.png'+'">'+
              '</div>'+
              '<div style="text-align: left;">'+
                  '<p>Envío a cuenta</p>'+
                  '<p>'+'</p>'+
                  '<p>'+'</p>'+
                  '<p>'+'</p>'+
                  '<p>Concepto:'+'</p>'+
                  '<br>'+
                  '<p>Cuenta origen</p>'+
                  '<p>Cuenta Débito Onsigna</p>'+
                  '<p>Autorización:'+'</p>'+
                  '<p>Referencia:'+'</p>'+
                  '<p style="text-align: center;">Verifica el estatus de tu operación <br> www.banxico.org.mx/cep</p>'+
              '</div>'+
           '</div>';
  bootbox.alert({
      message: msg,
      locale: 'mx'
  });
  });
    

});
function comprobante(){
  $(function(){
    
  });
}
</script> 
</body>

</html>
<?=$this->endsection()?>