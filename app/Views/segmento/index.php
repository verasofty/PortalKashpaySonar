<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<?php
$today = date("Y-m-d");
?>
<script type="text/javascript">
  var hoy = '<?php echo $today?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<header id="topbar" class="alt">
  <div class="topbar-left">
    <ol class="breadcrumb">
      <li class="breadcrumb-icon">
        <a href="dashboard">
          <span class="fa fa-home"></span>
        </a>
      </li>
      <li class="breadcrumb-active">
        <a href="dashboard">Segmento</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Segmento</li>
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
<?php
?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class=" panel">
            <?php
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => URL_SERVICES.'/AldebaranServices/getEntityLevels?fatherId='.$_GET['validate'].'&level=7',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            
            $response = curl_exec($curl);
            
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);
            $num_total_rows = 0;
            if ($httpcode == 200) {               
              $datos= array('response'=>json_decode($response));
              //var_dump($datos);
              $numCajas = count($datos['response']);
            ?>
              <div class="panel-body pn" id="formulario">
                <div class="row">
                  <div class="col-md-6">
                    <form id="form_caja" name="form_caja" method="post">
                      <input type="hidden" value="<?php echo $_GET['name'].' SEGMENTO '.($numCajas+1) ;?>" name="bussinesName" >
                      <input type="hidden" value="<?php echo $_GET['validate'].'_seg'.($numCajas+1) ;?>" name="bussinesNameShort" >
                      <input type="hidden" value="<?php echo $_GET['validate'].'.seg'.($numCajas+1) ;?>" name="applicationBundle" >
                      <input type="hidden" value="<?php echo $_GET['validate']?>" name="fatherId" >
                      <input type="hidden" value="<?php echo $numCajas ?>" name="num" >
                      <input type="hidden" value="7" name="type" >   
                      <input type="hidden" value="false" name="assignClabeAccount" > 
                    </form>
                    <button id="crearSegmento" class="btn btn-primary">NUEVO SEGMENTO</button>
                  </div>  
                </div>
                <div class="row">
                  <div style="height:30px;"></div>
                </div>
                <?php
                
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <table id="listaSegmentos" class="table table-striped">
                      <thead class="bg-dark">
                        <th>Nombre</th>
                        <th>Bundle</th>
                        <th>AffiliationId</th>
                      </thead>
                      <?php
                      for($i=0; $i<count($datos['response']); $i++){
                      ?>
                      <tr class="">
                        <td><?php echo $datos['response'][$i]->bussinesName ?></td>
                        <td><?php echo $datos['response'][$i]->bundle ?></td>
                        <td><?php echo $datos['response'][$i]->affiliationId ?></td>
                      </tr>
                      <?php
                      }
                      ?>
                      
                    </table>
                  </div>
                </div>
                
              </div>
              <?php
              }else{
              ?>
              <div class="row">
                <div class="col-md-12">
                  <p>Intente más tarde</p>
                </div>
              </div>
              <?php
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/segmento.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
</body>

</html>

<?=$this->endsection()?>