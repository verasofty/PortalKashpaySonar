<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
/*$mes_anterior = date('m', strtotime('-1 month'));
$numberDay = cal_days_in_month(CAL_GREGORIAN, $mes_anterior, 2003);
$anioActual = date("Y");
$mes_Actual = date("m");
$ayer  = date("Y-m-d",strtotime("-1 day", strtotime(date('Y-m-d'))) );
$actual  = date('Y-m-d');
$semanas12 = date('m', strtotime('-3 month'));

$today_hora = date("Y-m-d H:i"); 


$previous_week = strtotime("-1 week +1 day");
$start_week = strtotime("last sunday midnight",$previous_week);
$end_week = strtotime("next saturday",$start_week);
$start_week = date("Y-m-d",$start_week);
$end_week = date("Y-m-d",$end_week);

$lastWeek =  $start_week.' 00:00 / '.$end_week.' 23:59' ;
 
$diaSemana = date("w");
$tiempoDeInicioDeSemana = strtotime("-" . $diaSemana . " days");
$fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);
$tiempoDeFinDeSemana = strtotime("+" . $diaSemana . " days", $tiempoDeInicioDeSemana);
$fechaFinSemana = date("Y-m-d", $tiempoDeFinDeSemana);*/

//echo $semanas12;

$hrefT = 'transacciones?rango=&estatus=00&subafiliado='.session('idContext').'&entidad='.session('idEntity').'&sucursal='.session('idTerminal').'&caja='.session('idTerminalUser').'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&type=1&mood=0';

$hrefTR = 'transacciones?rango=&estatus=&subafiliado='.session('idContext').'&entidad='.session('idEntity').'&sucursal='.session('idTerminal').'&caja='.session('idTerminalUser').'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&type=-1&mood=0';

?>
<script type="text/javascript">

  var subAfiliado = '<?php echo session('idContext')?>';
  var entidad = '<?php echo session('idEntity')?>';
  var sucursal = '<?php echo session('idTerminal')?>';
  var caja = '<?php echo session('idTerminalUser')?>';
  <?php if (isset($rows->dashboardResponse)) { ?>
  

  if(<?php echo json_encode($rows->dashboardResponse->doughnutSettings->percentages);?> != null){
    var porcentajes = [] = <?php echo json_encode($rows->dashboardResponse->doughnutSettings->percentages);?>;
  }
  var marcas = [] = <?php echo json_encode($rows->dashboardResponse->doughnutSettings->brands);?>;
  var pastel = [];
  for (var i = 0; i < porcentajes.length; i++) {
    pastel.push( [marcas[i],  porcentajes[i]]);
  }
  //barras
  if(<?php echo json_encode($rows->dashboardResponse->weekly->ok);?> != null){
    var weeklyok = [] = <?php echo json_encode($rows->dashboardResponse->weekly->ok);?>;
  }else{
    var weeklyok = [] = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->weekly->fail);?> != null){
    var weeklyfail = [] = <?php echo json_encode($rows->dashboardResponse->weekly->fail);?>;
  }else{
    var weeklyfail = [] = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->weekly->date);?> != null){
    var weeklydate = [] = <?php echo json_encode($rows->dashboardResponse->weekly->date);?>;
  }else{
    var weeklydate = [] = <?php echo json_encode('0')?>;
  }

  if(<?php echo json_encode($rows->dashboardResponse->montly->ok);?> != null){
    var montlyok = [] = <?php echo json_encode($rows->dashboardResponse->montly->ok);?>;
  }else{
    var montlyok = [] = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->montly->fail);?> != null){
    var montlyfail = [] = <?php echo json_encode($rows->dashboardResponse->montly->fail);?>;
  }else{
    var montlyfail = [] = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->montly->date);?> != null){
    var montlydate = [] = <?php echo json_encode($rows->dashboardResponse->montly->date);?>;
  }else{
    var montlydate = [] = <?php echo json_encode('0')?>;
  }

  if(<?php echo json_encode($rows->dashboardResponse->yearly->ok);?> != null){
    var yearlyok = [] = <?php echo json_encode($rows->dashboardResponse->yearly->ok);?>;
  }else{
    var yearlyok = [] = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->yearly->fail);?> != null){
    var yearlyfail = [] = <?php echo json_encode($rows->dashboardResponse->yearly->fail);?>;
  }else{
    var yearlyfail = []  = <?php echo json_encode('0')?>;
  }
  if(<?php echo json_encode($rows->dashboardResponse->yearly->date);?> != null){
    var yearlydate = [] = <?php echo json_encode($rows->dashboardResponse->yearly->date);?>;
  }else{
    var yearlydate = [] = <?php echo json_encode('0')?>;
  }
  var barrasAnualok = [];
  var barrasAnualfail = [];
  var barrasAnualdate = [];

  var barrasSemanalok = [];
  var barrasSemanalfail = [];
  var barrasSemanaldate = [];

  var barrasMensualok = [];
  var barrasMensualfail = [];
  var barrasMensualdate = [];

  for (var iAnu = 0; iAnu < yearlyok.length; iAnu++) {
    barrasAnualok.push( yearlyok[iAnu] );
    barrasAnualfail.push( yearlyfail[iAnu] );
    barrasAnualdate.push( yearlydate[iAnu] );
  }

  for (var iMen = 0; iMen < montlyok.length; iMen++) {
    barrasMensualok.push( montlyok[iMen] );
    barrasMensualfail.push( montlyfail[iMen] );
    barrasMensualdate.push( montlydate[iMen] );
  }

  for (var iSem = 0; iSem < weeklyok.length; iSem++) {
    barrasSemanalok.push( weeklyok[iSem] );
    barrasSemanalfail.push( weeklyfail[iSem] );
    barrasSemanaldate.push( weeklydate[iSem] );
  }
<?php } else {
  
}?>
/*}else{
  alert('holi');
}*/
</script>
    <!-- -------------- Topbar -------------- -->
    <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
              <li class="breadcrumb-icon">
                  <a href="dashboard">
                      <span class="fa fa-home"></span>
                  </a>
              </li>
              <li class="breadcrumb-active">
                  <a href="dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Dashboard</li>
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

        <div class="panel">
          <div class="table-responsive">
            <form id="filtros" method="post" name="filtros">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="rango">Rango</label>
                    <select id="rango" name="rango" class="form-control">
                      <option value="0" selected="">Today</option>
                      <option value="-1">Yesterday</option>
                      <option value="-2">This Week</option>
                      <option value="-3">Last Week</option>
                      <option value="-4">Last 12 Weeks</option>
                      <option value="-5">This Month</option>
                      <option value="-6">Last Month</option>
                      <option value="-7">Last 12 Month</option>
                      <option value="-8">Last 60 Days</option>
                      <option value="-9">Last 90 Days</option>
                      <option value="-10">This Year</option>
                      <option value="-11">Custom</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3" id="fechaInicio">
                  <label for="fechaIni">Fecha Inicio</label>
                  <div class="section" id="">
                    <label for="fechaI" class="field prepend-icon">
                      <input type="text" id="fechaI" name="fechaI" class="form-control">
                        <label class="field-icon">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </label>
                  </div>
                </div>
                <div class="col-md-3" id="fechaFin">
                  <label for="fechaF">Fecha Fin</label>
                  <div class="section" id="">
                    <label for="fechaF" class="field prepend-icon">
                      <input type="text" id="fechaF" name="fechaF" class="form-control">
                        <label class="field-icon">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </label>
                  </div>
                </div>
                <div class="col-md-3" id="btn-buscar">
                  <label for=""><br></label>
                  <div class="form-group">
                    <a class="btn-primary btn" id="buscar">Buscar</a>
                  </div>
                </div>
              </div>
            </form>
            <table class="table table-striped">
              <thead class="bg-dark">
                <tr>
                  <th class="br-t-n pl30">Transacciones Aprobadas</th>
                  <th class="br-t-n ">Transacciones Rechazadas</th>
                  <th class="br-t-n">Porcentaje de Aceptación</th>
                  <th class="br-t-n">Monto Acumulado</th>
                </tr>
              </thead>
              <tbody>
              <?php if (isset($rows->dashboardResponse)) { ?>

                <tr id="rowsInfo">
                  <td class="pl30" id="approvedTransactions">
                    <a style="color: #626262;" href="<?php echo $hrefT?>" > 
                      <span class="imoon imoon-thumbs-up"></span> <?php echo $rows->dashboardResponse->approvedTransactions ?>
                    </a>
                  </td>
                  <td class="" id="failTransactions"> 
                    <a style="color: #626262;" href="<?php echo $hrefTR?>" >
                      <span class="imoon imoon-thumbs-up2"></span> <?php echo $rows->dashboardResponse->failTransactions ?>
                    </a>
                  </td>
                  <td id="acceptancePercentage"><?php echo $rows->dashboardResponse->acceptancePercentage ?> <span class="fas fa-percentage"></span></td>
                  <td id="accumulatedAmount"><i class="fas fa-dollar-sign"></i> <?php echo number_format($rows->dashboardResponse->accumulatedAmount,2) ?> <span class="fas fa-file-invoice-dollar"></span> </td>
                </tr>
              <?php }else{?>
                <tr id="rowsInfo">
                  <td class="pl30" id="approvedTransactions">
                    <a style="color: #626262;" href="<?php echo $hrefT?>" > 
                      <span class="imoon imoon-thumbs-up"></span> <?php echo '0' ?>
                    </a>
                  </td>
                  <td class="" id="failTransactions"> 
                    <a style="color: #626262;" href="<?php echo $hrefTR?>" >
                      <span class="imoon imoon-thumbs-up2"></span> <?php echo '0' ?>
                    </a>
                  </td>
                  <td id="acceptancePercentage"><?php echo '0' ?> <span class="fas fa-percentage"></span></td>
                  <td id="accumulatedAmount"><i class="fas fa-dollar-sign"></i> <?php echo number_format(0,2) ?> <span class="fas fa-file-invoice-dollar"></span> </td>
                </tr>
              <?php }?>
              
              </tbody>
            </table>
          </div>
        </div>

        <!-- -------------- Graficas Info -------------- -->
        <div class="panel" id="pchart4">
          <div class="panel-heading">
            <span class="panel-title">Porcentaje de aceptación (%)</span>
          </div>
          <div class="panel-body bg-light dark">
            <div id="donut-chart" style="height: 350px; width: 100%;"></div>
          </div>
        </div>

        <!--div class="panel" id="pchart22">
          <div class="panel-heading">
            <span class="panel-title">Transacciones</span>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="col-md-4">
                  <button class="btn btn-primary">Anual</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary">Mensual</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary">Semanal</button>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>
          <div class="panel-body bg-light dark">
            <div id="timeseries-chart-semanal" style="height: 350px; width: 100%;"></div>
            <div id="timeseries-chart-mensual" style="height: 350px; width: 100%;"></div>
            <div id="timeseries-chart-anual" style="height: 350px; width: 100%;"></div>
          </div>
          Pariss1991
        </div-->


        <div class="panel" id="pchart2">
          <div class="table-responsive">
            <div class="panel-heading">
              <span class="panel-title">Transacciones</span>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="col-md-4">
                    <button id="chart-anual" class="btn btn-primary">Anual</button>
                  </div>
                  <div class="col-md-4">
                    <button id="chart-mensual" class="btn btn-primary">Mensual</button>
                  </div>
                  <div class="col-md-4">
                    <button id="chart-semanal" class="btn btn-primary">Semanal</button>
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div>
            </div>
            <div class="panel-body bg-light dark" style="width: 100%;">
              <div id="high-line-anual" style="width: 100%; height: 275px; margin: 0 auto"></div>
              <div id="high-line-mensual" style="width: 100%; height: 275px; margin: 0 auto"></div>
              <div id="high-line-semanal" style="width: 100%; height: 275px; margin: 0 auto"></div>
            </div>
          </div>
        </div>
      
      <!-- -------------- /Column Center -------------- -->
    </section>
    <!-- -------------- /Content -------------- -->
    <!-- -------------- Page Footer -------------- -->
   
    <!-- -------------- /Page Footer -------------- -->

  </section>
    <!-- -------------- /Main Wrapper -------------- -->
</div>
<!-- -------------- /Body Wrap  -------------- -->

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