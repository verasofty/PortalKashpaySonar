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
                  <a href="dashboard">SubAfiliado</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Listar SubAfiliado</li>
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
                        <label for="rfc">RFC</label>
                        <input type="text" class="form-control rfc" id="rfc" name="rfc">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="rSocial">Razón Social</label>
                        <input type="text" class="form-control" id="rSocial" name="rSocial">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tel">Núm. Teléfono</label>
                        <input maxlength="10" type="tel" class="form-control soloNum" id="tel" name="tel">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email">
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
                  <table id="example1" class="table table-bordered table-striped text-center" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="va-m">NameCommerce</th>
                        <th class="va-m">businessName</th>
                        <th class="va-m">RFC</th>
                        <th class="va-m">Email</th>
                        <th class="va-m">Regimen Fiscal</th>
                        <th class="va-m">Teléfono</th>
                        <th class="va-m">Fecha</th>
                        <th class="va-m">Acciones</th>
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/listSubAfiliado.js"></script>
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
                title: 'SubAfiliados-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'SubAfiliados-<?php echo $today_hora?>'
            },
            ["print"]
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

</body>

</html>

<?=$this->endsection()?>