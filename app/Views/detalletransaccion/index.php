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
  var validate = '<?php echo $_GET['validate']?>';
  var rolId = '<?php echo session('idRol')?>';
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
                  <a href="#">Detalle Transacción</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Detalle Transacción</li>
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
                        <th class="va-m">Comisión3</th>
                        <th class="va-m">Entity OperationId</th>
                        <th class="va-m">Transaction Builder</th>
                        <th class="va-m">Id Liquidacion</th>
                        <th class="va-m">Estatus Sirio</th>
                        <th class="va-m">Venta Neta</th>
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
  $(function(){
    var table = $('#example1').DataTable();
        table.clear().draw();
    $.ajax({ 
        async:false,
        dataType: "json", 
        url: base_url+"/detalletransaccion/getDetalle/"+validate,
        success: function(data1){
          $('#example1').show();
          $('#rowsTrasnsacciones').html('');
          $("#caja21").html('');
          if(data1.rows.totalElements > 0){
              
            var rows = '';
            var data = Array();
            for (var i=0; i < data1.rows.content.length ; i++) {
                var btn_imp = '';
                var com1 = 0;
                var com2 = 0;
                var com3 = 0;
                var iva = 0;
                var transactionType = 0.00;
                var transactionSubType = 0.00;
                var transactionID = 0.00;
                var timestamp = 0.00;
                var systemTraceAudit = 0.00;
                var settleAmount = 0.00;

                if (data1.rows.content[i].operationSirio != null) {
                    if (data1.rows.content[i].operationSirio.acquiringOperation.systemSource != null) {
                        iva = data1.rows.content[i].operationSirio.acquiringOperation.systemSource;
                    }
                    if (data1.rows.content[i].operationSirio.acquiringOperation.transactionType != null) {
                        transactionType = data1.rows.content[i].operationSirio.acquiringOperation.transactionType;
                    }
                    if (data1.rows.content[i].operationSirio.acquiringOperation.transactionSubType != null) {
                        transactionSubType = data1.rows.content[i].operationSirio.acquiringOperation.transactionSubType;
                    } 
                    if (data1.rows.content[i].operationSirio.acquiringOperation.transactionID != null) {
                        transactionID = data1.rows.content[i].operationSirio.acquiringOperation.transactionID;
                    }
                    if (data1.rows.content[i].operationSirio.acquiringOperation.timestamp != null) {
                        timestamp = data1.rows.content[i].operationSirio.acquiringOperation.timestamp;
                    }
                    if (data1.rows.content[i].operationSirio.acquiringOperation.systemTraceAuditNumber != null) {
                        systemTraceAudit = data1.rows.content[i].operationSirio.acquiringOperation.systemTraceAuditNumber;
                    }
                    if (data1.rows.content[i].operationSirio.acquiringOperation.settleAmount != null) {
                        settleAmount = data1.rows.content[i].operationSirio.acquiringOperation.settleAmount;
                    }
                }
                
                if (data1.rows.content[i].status == 'Aprobada') {
                    btn_imp +='<div class="btn-group">'+
                                '<a target="_blank" href="http://sdbx-antares.kashplataforma.com:7071/resources/vouchers/'+data1.rows.content[i].authorizationRrcext+data1.rows.content[i].authorizationNumber+'.pdf" class="btn btn-primary">'+
                                    '<i class="fas fa-print"></i>'+
                                '</a>'+
                               '</div>';    
                }else{
                    btn_imp +='<div class="btn-group">'+
                               '</div>';    
                }

                switch(rolId) {
                    //admin
                    case '2':
                        com1 = 0;
                        com2 = 0;
                        com3 = 0;
                        break;
                    //suba
                    case '3':
                        com1 = (parseFloat(transactionType) + parseFloat(transactionSubType));
                        com2 = transactionID;
                        com3 = (parseFloat(timestamp) + parseFloat(systemTraceAudit));
                        break;
                    //enti
                    case '4':
                        com1 = (transactionType + transactionSubType + transactionID);
                        com2 = timestamp;
                        com3 = systemTraceAudit;
                        break;
                    //sucu
                    case '5':
                        com1 = (transactionType + transactionSubType + transactionID + timestamp);
                        com2 = systemTraceAudit;
                        com3 = 0;
                        break;
                    //caja
                    case '6':
                        com1 = settleAmount;
                        com2 = 0;
                        com3 = 0;
                        break;
                }

                var datadni = [
                        //data1.rows.operations[i].idOperation,
                        data1.rows.content[i].amount.toFixed(2),
                        data1.rows.content[i].authorizationNumber,
                        data1.rows.content[i].card,
                        data1.rows.content[i].authorizationRrcext,
                        data1.rows.content[i].authorizationDate,
                        data1.rows.content[i].status,
                        data1.rows.content[i].institution,
                        data1.rows.content[i].brand,
                        data1.rows.content[i].nature,
                        data1.rows.content[i].entityName,
                        data1.rows.content[i].terminalName,
                        data1.rows.content[i].transactiontype,
                        data1.rows.content[i].entryMode,
                        data1.rows.content[i].feeAmount.toFixed(2),
                        data1.rows.content[i].responseDescription,
                        data1.rows.content[i].qtPay,
                        data1.rows.content[i].planId,
                        data1.rows.content[i].graceNumber,
                        data1.rows.content[i].concept,
                        data1.rows.content[i].bin,
                        data1.rows.content[i].sendSirio,
                        iva,
                        com1,
                        com2,
                        com3,
                        data1.rows.content[i].entityOperationId,
                        data1.rows.content[i].transactionBuilder,
                        data1.rows.content[i].liquidation_id,
                        data1.rows.content[i].statusSirio,
                        data1.rows.content[i].processingCode,
                        btn_imp
                    ];
                data.push (datadni); 
            }
            table.rows.add(data).draw();                    
          }else{
            bootbox.alert({
                message: respuesta.rows.error.message,
                locale: 'mx'
            });
          }
        }
    });
    //setInterval("checkprodNuevo()",55000);
        
    
});
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
                title: 'DetalleTransacciones-<?php echo $today_hora?>'
            }
            /*{
                extend: 'pdfHtml5',
                title: 'DetalleTransacciones-<?php echo $today_hora?>'
            },
            ["print"]*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
</body>

</html>

<?=$this->endsection()?>