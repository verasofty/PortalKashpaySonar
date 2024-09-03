<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
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
        <a href="dashboard">Tarjeta</a>
      </li>
      <li class="breadcrumb-link">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-current-item">Tarjeta</li>
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
  $retVal = (session('idRol') == 1) ? 'col-sm-12 col-lg-3 col-md-3' : 'col-sm-12 col-lg-4 col-md-4' ; 
  $retVal2 = (session('idRol') == 1) ? '' : 'style="display: none;"' ; 
  ?>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
      <!-- -------------- Column Center -------------- -->
      <div class="chute chute-center">
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form theme-primary">
            <div class=" panel">
              <form id="fom_filter_card" name="fom_filter_card" method="post">
                <div id="message"></div>
                <div class="row">
                  <div class="col-sm-12 col-lg-4 col-md-4" <?php //echo $retVal2?>>
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Entidad</label>
                      <select class="searchFil form-control custom-select rounded-0" id="idContext" name="idContext">
                        <option value=""></option>
                      <?php
                      for ($iC=0; $iC < count($combo) ; $iC++) { 
                        $saldoSes = (session('entitySonID')== $combo[$iC]->bundle) ? 'selected' : '' ;
                        echo '<option '.$saldoSes.' value="'.$combo[$iC]->bundle.'">'.$combo[$iC]->bussinesName.'</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 col-md-4">
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Tarjeta / Telefóno / Correo Electrónico</label>
                      <input class="form-control" value="" type="text" name="tarjeta" id="tarjeta">
                    </div>
                  </div>
                  <!--div class="col-sm-12 col-lg-4 col-md-4">
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Estatus de la tarjeta</label>
                      <select class="custom-select rounded-0" id="exampleSelectRounded0">
                        <option></option>
                      <option>Operativa</option>
                      <option>Bloqueada</option>
                      </select>
                    </div>
                  </div-->
                  <div class="col-sm-12 col-lg-4 col-md-4">
                    <a id="searchCard" style="margin-top: 20px;" class="btn btn-block btn-azul"><i class="fas fa-search"></i> 
                    Buscar</a>
                  </div>
                </div>
              </form>
            </div>
            <div class=" panel">
              <div class="row" id="info_card">
                <div class="col-md-6 col-lg-6 col-xs-6">
                  <p>Número de cuenta: <span class="datos_info" id="num_account"></span></p>
                  <p>Número de tarjeta: <span class="datos_info" id="num_card"></span> 
                    <a href="#" class="ver_card"><i class="far fa-eye"></i></a></p>
                  <p>Vigencia: <span class="datos_info" id="vig"></span></p>
                </div>

                <div class="col-md-6 col-lg-6 col-xs-6">
                  <p>Nombre: <span class="datos_info" id="name_user"></span></p>
                  <p>Número de Documento: <span class="datos_info" id="num_doc"></span></p>
                  <p>
                    <a href="#" class="masInfo">Ver mas</a>
                  </p>
                </div>
                
              </div>

              <div class="row" style="border-top:1px solid rgba(0, 0, 0, 0.125); padding-top: 10px;" id="mas_info">

                <div class="col-md-6 col-lg-6 col-xs-6">
                  <div class="form-group">
                    <label for="exampleSelectRounded0">Saldo de la tarjeta</label>
                    <div class="input-group mb-3">
                      <input id="saldo" type="text" disabled class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleSelectRounded0">Estatus de la tarjeta</label>
                    <select class="form-control rounded-0" id="status_card">
                      <option></option>
                    <option selected>Operativa</option>
                    <option>Bloqueada</option>
                    </select>
                  </div>

                  <!--div class="form-group">
                    <label for="exampleSelectRounded0">Actividad</label>
                    <p>Ultima transaccion aprobada: <span class="datos_info" id="trans_apro"></span></p>
                    <p>Ultima transaccion rechazada: <span class="datos_info" id="trans_rech"></span></p>
                  </div-->
                  
                </div>

                <div class="col-md-6 col-lg-6 col-xs-6">
                  <div class="form-group">
                    <label for="exampleSelectRounded0">Marcas</label>
                  
                    <div class="col-lg-12 ">
                      <div class="switch switch-primary switch-inline">
                        <input id="exterior" type="checkbox" checked="">
                        <label for="exterior">Exterior</label>
                      </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 10px;">
                      <div class="switch switch-primary switch-inline">
                        <input id="atm" type="checkbox" checked="">
                        <label for="exterior">ATM</label>
                      </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 10px;">
                      <div class="switch switch-primary switch-inline">
                        <input id="transfer" type="checkbox" checked="">
                        <label for="exterior">Transfrencias</label>
                      </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 10px;">
                      <div class="switch switch-primary switch-inline">
                        <input id="comercio" type="checkbox" checked="">
                        <label for="exterior">Comercio</label>
                      </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 10px;">
                      <div class="switch switch-primary switch-inline">
                        <input id="retiro" type="checkbox" checked="">
                        <label for="exterior">Retiro</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="btn-group pull-right">
                    <button type="button" disabled class="btn btn-azul">Cancelar</button>
                    <button type="button" disabled class="btn btn-primary">Guardar</button>
                  </div>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/tarjetas.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/pagoDistancia.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script>
  function copyClipboard(element) {
    console.log('copy');
    var co_link = $('#copy_link').text();
    console.log('co_link = '+co_link);
    var $bridge = $("<input>")
    $("body").append($bridge);
    //$bridge.val(co_link);
    document.execCommand("copy");
    $bridge.remove();
  }
  function verModal(operation, event){
    event.preventDefault();
    console.log('hi '+operation);
    var idcopy = "'#copy_link'";
    var listaLinks = '<div class="">'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8">'+
                            '<p>De clic en la url generada o comparta el link para concluir el proceso de pago.</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 panel">'+
                            '<p style="text-align:justify" id="copy_link">'+$("#"+operation).data("link")+'</p>'+
                            '<!--a type="button" class=" pull-right btn btn-primary" data-note-stack="stack_bottom_right" id="copytext" onclick="copyClipboard('+idcopy+')">'+
                              '<i class="far fa-copy"></i>'+
                            '</a-->'+ 
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                            var estatus = '';
                            switch ($("#"+operation).data("estatuss")) {
                              case 'PAGADA':
                                estatus = '<p class="text-green">Pagada</p>';
                                break;
                              case 'CREADA':
                                estatus = '<p class="text-dorado">Pendiente de Pago</p>';
                                  break;
                              case 'EXPIRADA':
                                estatus = '<p class="text-grey">Expirada</p>';
                                    break;
                              case 'CANCELADA':
                                estatus = '<p class="text-red">Cancelada</p>';
                                    break;
                              default:
                                break;
                            }
                            listaLinks += estatus;
                listaLinks += '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">';
                          if ($("#"+operation).data("estatuss") != 'PAGADA') {
                            var fecha = $("#"+operation).data("fechaa").split(' ');                                      
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }else{
                            var fecha = $("#"+operation).data("fechamod").split(' ');                                      
                            
                listaLinks +=   '<div class="pull-right"><p>'+fecha[0]+' '+fecha[1]+' '+fecha[2]+' '+fecha[3]+'</p>'+
                            '<p>'+fecha[4]+' '+fecha[5]+'</p></div>';
                          }
              listaLinks +='</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Monto</p>'+
                            '<p class="">$'+$("#"+operation).data("amount")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<p class="negritas">Concepto</p>'+
                            '<p class="">'+$("#"+operation).data("description")+'</p>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div class="col-md-2"></div>'+
                          '<div class="col-md-8 ">'+
                            '<button class="btn btn-default">Cancelar</button>'+
                          '</div>'+
                          '<div class="col-md-2"></div>'+
                        '</div>'+
                        '<div class="row">'+
                          '<div style="height:30px;"></div>'+
                        '</div>'+
                      '</div>';
                    
    bootbox.alert({
      message: listaLinks
    });

  }
</script>
</body>

</html>

<?=$this->endsection()?>