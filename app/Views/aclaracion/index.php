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
                  <a href="dashboard">Aclaración</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Aclaración</li>
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
  <?php
  $mostrar = (session('idRol') == 2 ) ? 'style="display:inline-block"' : 'style="display:none"' ;
  $mostrarAc = (session('idRol') == 2 ) ? '' : 'style="display:none"' ;
  $mostrarEvi = (session('idRol') == 2 ) ? '' : 'style="display:none"' ;
  $mostrarEs = (session('idRol') == 2 ) ? 'style="display:inline-block;  margin-right: 15px;"' : '' ;

  if(session('idRol') == 2){
    $urlServer = WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/getTransactionById?id='.$_GET['validate'];
  }else{
    $urlServer = WS_KASPAYSERVICES.'/portalKashPayServices/api/v1/operations/getTransactionById?id='.$_GET['validate'].'&idContext='.session('idContext');
  }

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $urlServer,
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
  $datos= array('response'=>json_decode($response));

  //var_dump($datos['response'][0]);

  curl_close($curl);
if (!empty($datos['response'])) {
  
  if (isset($datos['response'][0]->chargeback)) {
  $mostrarEviSa = ($datos['response'][0]->chargeback->statusDescription == 'CREADA' || $datos['response'][0]->chargeback->statusDescription == 'ESPERANDO_DOCUMENTACIÓN') ? '' : 'style="display:none"' ;
    
  } else {
  $mostrarEviSa = '';
  }
  

  //$mostrarEviSa = ($datos['response'][0]->chargeback->statusDescription == 'CREADA' || $datos['response'][0]->chargeback->statusDescription == 'ESPERANDO_DOCUMENTACIÓN') ? '' : 'style="display:none"' ;

  ?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <script type="text/javascript">
        var montoAcla = '<?php echo number_format($datos['response'][0]->amount,2)?>';
        var userVal ='<?php echo session('mail')?>';
        var validateAc ='<?php echo $_GET['validate']?>';
      </script>
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class="panel panel-visible" id="spy2">
              <?php 
              if (!isset($datos['response'][0]->chargeback)) {
              ?>
              <div class="panel-body pn">
                <form id="form_aclaracion" name="form_aclaracion" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Generar aclaración</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-primary pastel alert-dismissable">
                          <i class="fa fa-info pr10"></i>
                          <strong>La devolución se va a generar en la tarjeta con la siguiente terminación</strong> <code class="ml5"><?php echo $datos['response'][0]->card?></code>
                      </div>
                    </div>
                    <div style="height: 30px;"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="tipo">Selecciona una las siguientes opciones*</label>
                        <div class="section mt30 mb15">
                            <div class="option-group field">
                                <label class="block mt15 option option-primary">
                                    <input class="tipoAclaracion" id="devTotal" type="radio" value="D" name="tipo" >
                                    <span class="radio"></span>Devolución Total <code>$<?php echo number_format($datos['response'][0]->amount,2)?></code></label>
                                <label class="block mt15 option option-primary">
                                    <input class="tipoAclaracion" id="devParcial" type="radio" value="DP" name="tipo">
                                    <span class="radio"></span>Devolución Parcial </label> 
                                <label <?php echo $mostrar?> class="block mt15 option option-primary">
                                    <input type="radio" class="tipoAclaracion" id="devcontracargo" value="CC" name="tipo">
                                    <span class="radio"></span>Contracargo</label>
                            </div>
                        </div>
                        
                      </div>
                      <div class="form-group mt30 mb15 montoParcialVista">
                        <label for="monto">Monto*</label>
                        <input type="text" placeholder="Monto" maxlength="13" class="form-control monto" id="monto" name="monto" aria-describedby="montoHelp">
                        <small id="montoHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="motivo">Motivo*</label>
                        <select  class="form-control" name="motivo" id="motivo">
                          <option value=""></option>
                        </select>
                        <small id="motivoHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                  </div>
                  

                  <div <?php echo $mostrar?> style="display:none;" class="row vistaCC">
                    <div class="col-md-8">
                      <div class="section">
                        <label for="datetimepicker1">Fecha del reporte</label>
                        <input value="" type="text" class="form-control" id="datetimepicker1" name="datetimepicker1">
                      </div>
                      <div class="section">
                        <div class="form-group">
                          <label for="motivo">Observaciones*</label>
                          <label class="field prepend-icon">
                            <textarea class="gui-textarea" id="observaciones" name="observaciones" ></textarea>
                              <label for="observaciones" class="field-icon">
                                  <i class="fa fa-list"></i>
                              </label>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="divEvii" <?php echo $mostrarEvi;?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Evidencias</label>
                          <input type="file" class="form-control fileE" id="evidencia" name="evidencia[]" aria-describedby="ineHelp">
                          <small id="ineHelp" class="error form-text text-muted"></small>
                        </div>
                      </div> 
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <input type="file" class="form-control fileE" id="evidencia" name="evidencia[]" aria-describedby="ineHelp">
                          <small id="ineHelp" class="error form-text text-muted"></small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <button class="btn btn-primary masEvi"><i class="fas fa-plus-square"></i></button>
                        </div>
                      </div>
                    </div>
                    <div id="divEvi" class="row">
                    </div>
                  </div>
                  <div class="row vistaFinal">
                    <div class="col-md-8">
                      
                      <div class="form-group">
                        <input type="hidden" value="<?php echo $datos['response'][0]->idOperation?>" class="form-control" id="idOperation" name="idOperation" >
                        <input type="hidden" value="<?php echo $datos['response'][0]->tuuser?>" class="form-control" id="tuuser" name="tuuser">
                        <input type="hidden" class="form-control" id="montoHidden" name="montoHidden">
                        <input type="hidden" value="<?php echo $datos['response'][0]->amount?>" class="form-control" id="montoHiddenR" name="montoHiddenR">
                        <input type="hidden" value="<?php echo $datos['response'][0]->card?>" class="form-control " id="card" name="card">
                        <input type="hidden" value="<?php echo $datos['response'][0]->authorizationNumber?>" class="form-control" id="authorizationNumber" name="authorizationNumber">
                        <input type="hidden" value="<?php echo $datos['response'][0]->authorizationRrcext?>" class="form-control" id="authorizationRrcext" name="authorizationRrcext">

                        <small id="rfcHelp" class="error form-text text-muted"></small>
                      </div>
                    </div>
                    
                  </div>
                  
                  <div class="row">
                    <div class="col-md-8">
                      <div class="section mt30 mb15">
                        <div class="option-group field">
                            <label class="block mt15 option option-primary">
                                <input id="tyc1" name="tyc1" type="checkbox" >
                                <span class="checkbox"></span>Entiendo que dependiendo de las políticas de reembolso y plazos del banco emisor de la tarjeta del cliente, la devolución puede tardar en verse reflejada en la cuenta </label>
                            <small id="tyc1Help" class="error form-text text-muted"></small>
                        
                            <label class="block mt15 option option-primary">
                                <input id="tyc2" name="tyc2" type="checkbox">
                                <span class="checkbox"></span>Entiendo en caso de cualquier aclaración , el tarjetahabiente debe acudir a su banco emisor</label>
                            <small id="tyc2Help" class="error form-text text-muted"></small>

                        </div>
                      </div>
                      <div class="section mv15">
                        <p>Aprende mas sobre devoluciones <a>aquí</a></p>
                      </div>
                    </div>
                    
                  </div>                  
                  
                  <div class="row">
                    <div class="col-md-6">
                      <button type="button" id="btn-add" class="btn btn-primary btn-block save">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
              <?php
              } else {
              ?>
              <div class="panel-body pn">
                <div class="row">
                  <div class="col-md-12">
                    <h5>Información del contracargo</h5>
                  </div>
                  <div class="col-md-6">
                    <p><b>Numero de Autorizacion:</b> <span><?php echo $datos['response'][0]->authorizationNumber?></span></p>
                    <p><b>Tarjeta:</b> <span><?php echo $datos['response'][0]->card?></span></p>
                    <p><b>Monto:</b> <span>$<?php echo number_format($datos['response'][0]->amount,2)?></span></p>
                    <p><b>Fecha:</b> <span><?php echo $datos['response'][0]->authorizationDate?></span></p>
                  </div>
                  <div class="col-md-6">
                    <p><b>Motivo:</b> <span><?php echo $datos['response'][0]->chargeback->clarificationDescription?></span></p>
                    <p><b>Estatus:</b> <span><?php echo $datos['response'][0]->chargeback->statusDescription?></span></p> 
                    
                    <p <?php echo $mostrarEs?>><b>Estado del Fallo:</b></p>
                    <select class="form-controll" <?php echo $mostrar?>>
                      <option>Estado del fallo</option>
                      <option>Ganado</option>
                      <option>Perdido</option>
                    </select> 
                    <p><b>Observaciones:</b> <span><?php echo $datos['response'][0]->chargeback->observations?></span></p>
                  </div>
                </div>
                <hr>
                <?php
                if (count($datos['response'][0]->chargeback->files) > 0){                         
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Mis Evidencias</h5>
                    <?php
                    if (isset($datos['response'][0]->chargeback->files)) {
                      for ($iFi=0; $iFi < count($datos['response'][0]->chargeback->files);  $iFi++) {                      
                    ?>
                    <div class="col-md-3">
                      <a target="_blank" href="<?php echo $datos['response'][0]->chargeback->files[$iFi]?>">
                        <img style="width: 30%;" src="<?php echo base_url().'/public/assets/img/pdf_icon.png'?>">
                      </a>
                    </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
                <div style="height: 30px;"></div>  

                <hr>
                <?php } ?>
                <div id="divEviSaa" <?php echo $mostrarEviSa;?>>
                  <div style="height: 30px;"></div>  
                  <div class="row">
                    <div class="col-md-12">
                      <h5>Agrega la evidencia necesaria para evaluar tu contracargo</h5>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <form id="form_evidencia" name="form_evidencia" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Evidencias</label>
                            <input onchange="return fileValidationn()" type="file" class="form-control fileE" id="evidenciaSa" name="evidenciaSa[]" aria-describedby="ineHelp">
                            <small id="ineHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">&nbsp;</label>
                            <input onchange="return fileValidationn()" type="file" class="form-control fileE" id="evidenciaSa" name="evidenciaSa[]" aria-describedby="ineHelp">
                            <small id="ineHelp" class="error form-text text-muted"></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="hidden" value="<?php echo $datos['response'][0]->chargeback->idClarification?>" class="form-control" id="idClarification" name="idClarification" >
                            <input type="hidden" value="<?php echo $datos['response'][0]->idOperation?>" class="form-control" id="idOperation" name="idOperation" >
                            <button class="btn btn-primary masEviSa"><i class="fas fa-plus-square"></i></button>
                          </div>
                        </div>
                      </div>
                      <div id="divEviSa" class="row">
                      </div>
                      <div style="height: 30px;"></div>
                      <div class="row">
                        <div class="col-md-4">
                          <button type="button" id="btn-add" class="btn btn-primary btn-block saveE">Guardar</button>
                        </div>
                      </div>
                      <div style="height: 30px;"></div>
                    </form>
                  </div>
                </div>
                <hr  <?php echo $mostrarEviSa;?>>

                <!-- -------------- Timeline -------------- -->
                <?php
                $timelineCreada = '';
                $timelineEspDoc = '';
                $timelineDocAne = '';
                $timelineEspFal = '';
                $timelineFallo = '';

                switch ($datos['response'][0]->chargeback->statusDescription) {
                  case 'CREADA':
                    $timelineCreada = 'success';
                    $timelineEspDoc = 'text-success';
                    $timelineDocAne = 'text-success';
                    $timelineEspFal = 'text-success';
                    $timelineFallo = 'text-success';                          
                    break;
                  case 'ESPERANDO_DOCUMENTACIÓN':
                    $timelineCreada = 'success';
                    $timelineEspDoc = 'success';
                    $timelineDocAne = 'text-success';
                    $timelineEspFal = 'text-success';
                    $timelineFallo = 'text-success';
                    break;
                  case 'DOCUMENTACIÓN_ANEXADA':
                    $timelineCreada = 'success';
                    $timelineEspDoc = 'success';
                    $timelineDocAne = 'success';
                    $timelineEspFal = 'text-success';
                    $timelineFallo = 'text-success';
                    break;
                  case 'EN_ESPERA_DE_FALLO':
                    $timelineCreada = 'success';
                    $timelineEspDoc = 'success';
                    $timelineDocAne = 'success';
                    $timelineEspFal = 'success';
                    $timelineFallo = 'text-success';
                    break;
                  case 'ATENDIDO':
                    $timelineCreada = 'success';
                    $timelineEspDoc = 'success';
                    $timelineDocAne = 'success';
                    $timelineEspFal = 'success';
                    $timelineFallo = 'success';
                    break;
                  default:
                    // code...
                    break;
                }


                ?>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Estatus del contracargo</h5>
                  </div>
                  <div class="col-md-12">
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                    <ul class="timeline timeline-horizontal">
                      <li class="timeline-item">
                        <div class="timeline-badge <?php echo $timelineCreada?>"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">CREADO</h4>
                          </div>
                          <div class="timeline-body">
                            <p>El contracargo fue creado exitosamente</p>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <div class="timeline-badge <?php echo $timelineEspDoc?>"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title">ESPERANDO DOCUMENTACIÓN</h6>
                          </div>
                          <div class="timeline-body">
                            <p>Se espera recibir las evidencias necesarias para poder atender el contracargo</p>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <div class="timeline-badge <?php echo $timelineDocAne?>"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">DOCUMENTACIÓN ANEXADA</h4>
                          </div>
                          <div class="timeline-body">
                            <p>Se ha agregado la evidencia suficiente para que el contracargo sea atendido</p>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <div class="timeline-badge <?php echo $timelineEspFal?>"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">ESPERANDO FALLO</h4>
                          </div>
                          <div class="timeline-body">
                            <p> Se espera la respuesta del fallo del contracargo</p>
                          </div>
                        </div>
                      </li>
                      <li class="timeline-item">
                        <div class="timeline-badge <?php echo $timelineFallo?>"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">ATENDIDO</h4>
                          </div>
                          <div class="timeline-body">
                            <p>El resultado del fallo es <span id="infoFallo" class="text-warning">En espera</span></p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
            


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

<?php 
}else{
?>
<script>
setTimeout("window.location.href = '"+base_url+"'", 1000);

</script>
<?php
}
?>

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
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

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
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>

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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/aclaracion.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>

</body>

</html>

<?=$this->endsection()?>