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
                  <a href="#">Transacciones</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Listar Transacciones</li>
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
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subafiliado">SubAfiliado</label>
                        <select <?php echo $retValSA = (session('idRol')!=2) ? 'disabled' : '' ; ?> class="form-control" id="subafiliado" name="subafiliado">
                          <option></option>
                
                          <script type="text/javascript">
                            subAfSelect = '<?php echo session('idContext') ?>';
                            entidadSelect = '<?php echo session('idEntity')?>';
                            sucursalSelect = '<?php echo session('idTerminal')?>';
                            cajaSelect = '<?php echo session('idTerminalUser')?>';
                          </script>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="entidad">Entidad</label>
                        <select <?php echo $retValE = ( (session('idRol') == 2) || (session('idRol') == 3) ) ? '' : 'disabled' ; ?> class="form-control" id="entidad" name="entidad">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select <?php echo $retValS =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) ) ? '' : 'disabled' ; ?> class="form-control" id="sucursal" name="sucursal">
                          <option></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="caja">Caja</label>
                        <select <?php echo $retValC =  ( (session('idRol') == 2) || (session('idRol') == 3) || (session('idRol') == 4) || (session('idRol') == 5) ) ? '' : 'disabled' ; ?> class="form-control" id="caja" name="caja">
                          <option></option>
                        </select>
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
                        <?php 
                        if ( ($retValC != '') ) {
                        ?>
                        <input type="hidden" value="<?php echo session('idTerminalUser')?>" name="caja">
                        <?php 
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="operacion">Operación</label>
                        <select class="form-control" id="operacion" name="operacion">
                          <option></option>
                        
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="edoTransaccion">Estado de la Transacción</label>
                        <select class="form-control" id="edoTransaccion" name="edoTransaccion">
                          <option></option>
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="text" class="form-control" id="monto" name="monto">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="referencia">Núm. Referencia</label>
                        <input type="text" class="form-control" id="referencia" name="referencia">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="autorizacion">Núm. Autorización</label>
                        <input type="text" class="form-control" id="autorizacion" name="autorizacion">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="numTarjeta">Núm. Tarjeta</label>
                        <input type="text" maxlength="16" class="form-control" id="numTarjeta" name="numTarjeta">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="bin">Bin</label>
                        <input type="text" class="form-control" id="bin" name="bin">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section">
                        <label for="fechaInicio">Fecha Inicio</label>
                        <label for="fechaInicio" class="field prepend-icon">
                          <input type="text" id="fechaInicio" name="fechaInicio" class="gui-input">
                          <label class="field-icon">
                            <i class="fa fa-calendar"></i>
                          </label>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="section">
                        <label for="fechaFin">Fecha Fin</label>
                        <label for="fechaFin" class="field prepend-icon">
                          <input type="text" id="fechaFin" name="fechaFin" class="gui-input">
                          <label class="field-icon">
                            <i class="fa fa-calendar"></i>
                          </label>
                        </label>
                      </div>
                    </div>
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
            <div class="panel panel-visible" id="spy2">
              <div class="panel-body pn">
                <div class="table-responsive" style=" overflow: auto;">
                  <div id="caja21" class="text-center"></div>
                  <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="va-m">Monto</th>
                        <th class="va-m">Núm. de Autorización</th>
                        <th class="va-m">Tarjeta</th>
                        <th class="va-m">Referencia</th>
                        <th class="va-m">Fecha de Autorizacion</th>
                        <th class="va-m">Estatus</th>
                        <th class="va-m">Institución</th>
                        <th class="va-m">Marca</th>
                        <th class="va-m">Naturaleza</th>
                        <th class="va-m">Entidad</th>
                        <th class="va-m">Terminal</th>
                        <th class="va-m">Tipo de Transacción</th>
                        <th class="va-m">EntryMode</th>
                        <th class="va-m">Monto Adicional</th>
                        <th class="va-m">ResponseDescription</th>
                        <th class="va-m">QtPay</th>
                        <th class="va-m">PlanId</th>
                        <th class="va-m">GraceNumber</th>
                        <th class="va-m">Concepto</th>
                        <th class="va-m">Bin</th>
                        <th class="va-m">Send_Sirio</th>
                        <th class="va-m">IVA</th>
                        <th class="va-m">Comisión1</th>
                        <th class="va-m">Comisión2</th>
                        <th class="va-m">Entity OperationId</th>
                        <th class="va-m">Transaction Builder</th>
                        <th class="va-m">Ticket</th>
                      </tr>
                    </thead>
                    <tbody id="rowsTrasnsacciones">
                      
                    </tbody>
                  </table>
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
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'Transacciones-<?php echo $today_hora?>'
            },
            ["print"]
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
</body>

</html>

<?=$this->endsection()?>