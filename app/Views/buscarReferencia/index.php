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
<style type="text/css">
  a {text-decoration: none !important;}
  .result-info span{ color:#555555;  }
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
                    <a href="dashboard">Referencia</a>
                </li>
                <li class="breadcrumb-link">
                    <a href="dashboard">Home</a>
                </li>
                <li class="breadcrumb-current-item">Buscar Referencia</li>
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
    <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <!-- -------------- Search Results -------------- -->
                <div class="panel">
                    <!--div class="panel-heading">
                        <span class="panel-title text-muted hidden-xs">45 results found (0.01 seconds)</span>
                    </div-->
                    

                    <div class="panel-menu mt20">
                        <form class="input-group" method="post" name="form_filtro" id="form_filtro">
                          
                          <input type="text" id="referencia" name="referencia" class="form-control"placeholder="Número de Referencia">
                          <span class="input-group-addon buscar" style="background: #c7924b;color: #fff;">
                            Buscar <i class="fa fa-search"></i>
                          </span>
                          <input type="hidden" name="token" id="token" value="<?php echo $auth_token->authenticationResponse->token ?>">
                        </form>
                        
                    </div>
                    <div class="panel-body pn" id="referencias">

                        <!-- -------------- Search Block Header -------------- -->
                        <!--h3>Displaying <b class="text-primary">15</b> of total 45 results for 'Alliance'</h3>
                        <hr class=""-->

                        <!-- -------------- Search Results -------------- -->
                        
                    </div>

                </div>

            </div>
            <!-- -------------- /Column Center -------------- -->


        </section>
   
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
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/searchReferencia.js"></script>
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
                title: 'ListLinkPago-<?php echo $today_hora?>'
            },
            {
                extend: 'pdfHtml5',
                title: 'ListLinkPago-<?php echo $today_hora?>'
            },
            ["print"]
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
</body>


</html>

<?=$this->endsection()?>