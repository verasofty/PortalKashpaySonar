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
            <a href="dashboard">Información Spei</a>
          </li>
          <li class="breadcrumb-link">
            <a href="dashboard">Home</a>
          </li>
          <li class="breadcrumb-current-item">Información Spei</li>
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
      <div class="chute chute-center">
        <div class="center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="col-md-12">
            <div class="panel panel-visible" id="spy2">
              <div class="panel-heading">
                <div class="panel-title hidden-xs">
                  Solicitar pago por SPEI
                </div>
              </div>
              <form id="form-wizard" name="form-wizard">
              <div class="panel-body pn">
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group" id="infoOrg">
                        <label for="edoTransaccion">Selecciona cuenta</label>
                        <select class="form-control rounded-0 wizard-required" id="cuenta" name="cuenta">
                          <option value=""></option>
                          <?php
                          for ($iC=0; $iC < count($cuentas) ; $iC++) { 
                            if(isset($cuentas[$iC]->idSirio)){
                                    $saldoSes = ($_GET['entidad'] == $cuentas[$iC]->idSirio) ? 'selected' : '' ;
                                    $nameSes = ($cuentas[$iC]->idbusinessModel == 1) ? 'Cuenta Emisora' : 'Cuenta Adquirente' ;
                                    echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
      
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
                </form>
                <div class="row">
                  <div class="col-md-12">
                    <p>Puedes recibir pagos por transferencia electrónica desde ahora.</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="panel panel-info-cafe panel-border top">
                      <div class="panel-body">
                        <?php
                        if ($rows != NULL) {
                        ?>
                        <p class="">CLABE</p>
                        <p class="clabe"><b><?php echo $retVal = ($rows->clabeAccount != '') ? $rows->clabeAccount : 'ND'?></b></p>
                        <hr>
                        <p class="">CUENTA VIRTUAL</p>
                        <p class="virtual"><b><?php echo $retVal = ($rows->virtualAccount != '') ? $rows->virtualAccount : 'ND' ; ?></b></p>
                        <hr>
                        <p class="">SALDO</p>
                        <p class="saldo"><b>$<?php echo $retVal = ($saldo->onsignaEntity->balance != '') ? $saldo->onsignaEntity->balance : '0.00' ; ?></b></p>
                        <hr>
                        <p class="">BANCO</p>
                        <p class="banco"><b>Citi Banamex</b></p>
                        <hr>
                        <p class="">TITULAR</p>
                        <p class="titular"><b><?php echo($rows->name)?></b></p>
                        <hr>
                        <p class="">NÚMERO DE AFILIACIÓN</p>
                        <p class="affiliationId"><b><?php echo($saldo->onsignaEntity->affiliationId)?></b></p>
                        <?php
                        }else{
                        ?>
                        
                        <p class="">CLABE</p>
                        <p class="clabe"><b>ND</b></p>
                        <hr>
                        <p class="">CUENTA VIRTUAL</p>
                        <p class="virtual"><b>ND</b></p>
                        <hr>
                        <p class="">SALDO</p>
                        <p class="saldo"><b>$0.00</b></p>
                        <hr>
                        <p class="">BANCO</p>
                        <p class="banco"><b>Citi Banamex</b></p>
                        <hr>
                        <p class="">TITULAR</p>
                        <p class="titular"><b>ND</b></p>
                        <hr>
                        <p class="">NÚMERO DE AFILIACIÓN</p>
                        <p class="affiliationId"><b>ND</b></p>
                        <?php
                        }                       
                        ?>
                        <p class="card-text" style="font-size: 11px;font-style: italic;">
                        Proporciona a tus clientes el número de afiliación para que lo ingresen en su registro en la Wallet y puedas consultar su información en el portal.
                      </p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <p>Con estos datos puedes solicitar depósitos desde $100 a tus clientes, se reflejan de inmediato en tu cuenta.</p>

                        <p>Ten en cuenta que el sistema SPEI solo funciona en horario bancario, por lo que dependerá del banco emisor el horario en que puedas recibir pagos.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h5>Corresponsales participantes</h5>
                    <div class="row">
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/banamex.png">
                      </div>
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/ley.png">
                      </div>
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/7eleven.png">
                      </div>
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/farmaciaAhorro.png">
                      </div>
                    </div>
                    <div class="row">
                      
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/alsuper.png">
                      </div>
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/superFarmacia.png">
                      </div>
                      <div class="col-md-3">
                        <img style="width: 100%;" src="<?php echo base_url()?>/public/assets/img/bancos/telecomm.png">
                      </div>
                    </div>
                    <div class="row">
                      
                    </div>
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

<script>
//Objeto oNumero
function oNumero(numero){
//Propiedades 
this.valor = numero || 0;
this.dec = -1;
//Métodos 
this.formato = numFormat;
this.ponValor = ponValor;
//Definición de los métodos
function ponValor(cad)
{
  if (cad =='-' || cad=='+') return
  if (cad.length ==0) return
  if (cad.indexOf('.') >=0)
     this.valor = parseFloat(cad);
 else 
     this.valor = parseInt(cad);
} 
function numFormat(dec, miles)
{
  var num = this.valor, signo=3, expr;
  var cad = ""+this.valor;
  var ceros = "", pos, pdec, i;
  for (i=0; i < dec; i++){
       ceros += '0';
  }
 pos = cad.indexOf('.')
 if (pos < 0){
    cad = cad+"."+ceros;
  }
else
    {
    pdec = cad.length - pos -1;
    if (pdec <= dec)
        {
        for (i=0; i< (dec-pdec); i++)
            cad += '0';
        }
    else
        {
        num = num*Math.pow(10, dec);
        num = Math.round(num);
        num = num/Math.pow(10, dec);
        cad = new String(num);
        }
    }
pos = cad.indexOf('.')
if (pos < 0) pos = cad.lentgh
if (cad.substr(0,1)== '-' || cad.substr(0,1) == '+') 
       signo = 4;
if (miles && pos > signo){
    do{
        expr = /([+-]?\d)(\d{3}[\.\,]\d*)/
        cad.match(expr)
        cad = cad.replace(expr, '$1,$2');
        }
    while (cad.indexOf(',') > signo);
   }
    if (dec<0) cad = cad.replace(/\./,'') 
        return cad;
}
}//Fin del objeto oNumero:
</script>
<script>
$("#cuenta").change(function(event){
  $.ajax({
      url: base_url+"/transferenciaSpei/infoSpeiCuenta",
      data: $("#form-wizard").serialize(),
      type: "post",
      dataType: "json",
      success: function(respuesta){
        if (respuesta.rows.success) {
          var splitString = $('#cuentaOr').val().split("-");
          var saldoFor = (respuesta.rows.onsignaEntity.balance).toFixed(2);
          var numero = new oNumero(saldoFor);
          $('.saldo').html('<b>$ '+numero.formato(2, true)+'</b>');
          $('.clabe').html('<b> '+respuesta.rows.onsignaEntity.clabeAccount+'</b>');
          $('.titular').html('<b> '+respuesta.rows.onsignaEntity.name+'</b>');
          $('.banco').html('<b>Citi Banamex</b>'); 
          $('.affiliationId').html('<b> '+respuesta.rowsSaldo.onsignaEntity.affiliationId+'</b>'); 
          if(respuesta.rows.onsignaEntity.virtualAccount != null){
            $('.virtual').html('<b> '+respuesta.rows.onsignaEntity.virtualAccount+'</b>');  

          }else{
            $('.virtual').html('<b>ND</b>');  

          }
        }else{
          bootbox.alert({
              message: 'Consulte al Administrador.',
              locale: 'mx'
          });
          $('.saldo').html('');
          $('.clabe').html('');
          $('.titular').html('');
          $('.virtual').html('');  
          $('.banco').html('');  
          $('.affiliationId').html(''); 

        }
      }
  });
  $('#cuentaOr').html('<option></option>');
  if($("#cuenta").val() != '' ){
    $.ajax({
        url: base_url+"/transferenciaspei/combo",
        data: $("#form-wizard").serialize(),
        type: "post",
        dataType: "json",
        success: function(respuesta){
        if(respuesta.rows.length > 0){
            console.log('onsignaEntity = '+respuesta.rows.length);
            for (var i = 0; i < respuesta.rows.length; i++) {
                $('#cuentaOr').append($('<option>').val(respuesta.rows[i].bundle).text(respuesta.rows[i].bundle));
            }
        }else{
            $('#cuentaOr').html('<option></option>');
            bootbox.alert({
                title: 'Busqueda sin datos',
                message: 'Cuenta seleccionada no tiene entidades relacionadas.',
                locale: 'mx'
            });
        }
        }
    });
  }
});
$("#cuentaOr").change(function(event){
    $.ajax({
      url: base_url+"/transferenciaSpei/infoSpei",
      data: $("#form-wizard").serialize(),
      type: "post",
      dataType: "json",
      success: function(respuesta){
        if (respuesta.rows.success) {
          var splitString = $('#cuentaOr').val().split("-");
          var saldoFor = (respuesta.rows.onsignaEntity.balance).toFixed(2);
          var numero = new oNumero(saldoFor);
          $('.saldo').html('<b>$ '+numero.formato(2, true)+'</b>');
          $('.clabe').html('<b> '+respuesta.rows.onsignaEntity.clabeAccount+'</b>');
          $('.titular').html('<b> '+respuesta.rows.onsignaEntity.name+'</b>');
          $('.banco').html('<b>Citi Banamex</b>'); 
          $('.affiliationId').html('<b> '+respuesta.rowsSaldo.onsignaEntity.affiliationId+'</b>'); 
          if(respuesta.rows.onsignaEntity.virtualAccount != null){
            $('.virtual').html('<b> '+respuesta.rows.onsignaEntity.virtualAccount+'</b>');  

          }else{
            $('.virtual').html('<b>ND</b>');  

          }
        }else{
          bootbox.alert({
              message: 'Consulte al Administrador.',
              locale: 'mx'
          });
          $('.saldo').html('');
          $('.clabe').html('');
          $('.titular').html('');
          $('.virtual').html('');  
          $('.banco').html('');  
          $('.affiliationId').html(''); 

        }
      }
    });
});
</script>

</body>

</html>

<?=$this->endsection()?>