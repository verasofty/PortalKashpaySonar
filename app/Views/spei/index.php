<?=$this->extend('templates/admin_template')?>
<?=$this->section('content')?>
<script type="text/javascript">
  var saldoSession = <?php echo $_SESSION['balance']?>;
  var valorDolar = '';
  var fechaDolar = '';
  var comisionDolar = '';
</script>
<style type="text/css">
  .allcp-form .append-icon .field-icon, .allcp-form .prepend-icon .field-icon {
  width: 60px;
  color: #c7924b;
}
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
                  <a href="dashboard">Spei</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Spei</li>
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
        <div class="mw1000 center-block">
          <!-- -------------- Spec Form -------------- -->
          <div class="allcp-form">

              <form method="post" action="/" id="form-wizard">
                  <div class="wizard steps-bg clearfix steps-left">
                    <!-- -------------- step 1 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user pr5"></i> Cuenta Destino
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-12">
                          <h3 class="text-dorado" id="textInfo">Elige Cuenta Origen</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group" id="infoOrg">
                            <select class="custom-select form-control rounded-0 wizard-required" id="cuentaOr" name="cuentaOr">
                              <option value=""></option>
                              <?php
                              $contexCombo = '';
                              //var_dump($cuentas);
                                if (session('idBusinessModel') == 2) {
                            			$idcontext = 0;
                                  $contexCombo = session('entitySonID');
                            			//$contexCombo = '';
                                  echo '<option selected value="'.$contexCombo.'">'.session('userNAme').'</option>';
                            		}else{
                            			//$idcontext = session('idcontextResponse')[0];
                            			$contexCombo = session('issueId');
                                  for ($iC=0; $iC < count($cuentas) ; $iC++) { 
                                    if(isset($cuentas[$iC]->idSirio)){            
                                      $saldoSes = ($contexCombo == $cuentas[$iC]->idSirio) ? 'selected' : '' ;
                                      $nameSes = ($cuentas[$iC]->idbusinessModel == 1) ? 'Cuenta Emisora' : 'Cuenta Adquirente' ;
                                      echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$nameSes.'</option>';
        
                                    }
                                  }
                            		}
                                
                              ?>
                            </select>
                            
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <p id="saldoEnt"></p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3 class="text-dorado" id="textInfo">Elige una Cuenta Destino</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <button type="button" class="btn btn-primary btn-block btn_addCuenta">Nueva Cuenta</button>
                        </div>
                        <div class="col-md-4">
                          <!--button type="button" class="btn btn-primary btn-block btn_addCuenta_usa">Nueva Cuenta Estados Unidos</button-->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div style="height: 30px;"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="new_cuenta">
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div style="height: 30px;"></div>
                        </div>
                      </div>
                      <div class="row" id="contact_div">
                        <div class="col-md-12">
                          <div class="panel-body pn">
                            <div class="bs-component">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead class="bg-primary br6">
                                  <thead class="bg-dark">
                                    <tr>
                                      <th colspan="2" class="br-t-n pl30">Contactos</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    for ($i=0; $i < count($contactos) ; $i++) {                               
                                    ?>
                                    <tr class="rowsContact" data-accountnumber="<?php echo $contactos[$i]->accountNumber?>" data-cuenta="<?php echo $contactos[$i]->cardNumberMask?>" data-alias="<?php echo $contactos[$i]->nameAlias?>" data-name="<?php echo $contactos[$i]->fullName?>" data-nameInst="<?php echo $contactos[$i]->nameInstitution?>" data-idIns="<?php echo $contactos[$i]->idInstitution?>">
                                      <td class="pl30 " data-accountnumber="<?php echo $contactos[$i]->accountNumber?>" data-cuenta="<?php echo $contactos[$i]->cardNumberMask?>" data-alias="<?php echo $contactos[$i]->nameAlias?>" data-name="<?php echo $contactos[$i]->fullName?>" data-nameInst="<?php echo $contactos[$i]->nameInstitution?>" data-idIns="<?php echo $contactos[$i]->idInstitution?>">
                                        <p><?php echo $contactos[$i]->fullName?></p>
                                        <p><?php echo $contactos[$i]->nameAlias?> </p>
                                        <p><?php echo $contactos[$i]->nameInstitution?></p>
                                      </td>
                                      <td class="pl30 " data-accountnumber="<?php echo $contactos[$i]->accountNumber?>" data-cuenta="<?php echo $contactos[$i]->cardNumberMask?>" data-alias="<?php echo $contactos[$i]->nameAlias?>" data-name="<?php echo $contactos[$i]->fullName?>" data-nameInst="<?php echo $contactos[$i]->nameInstitution?>" data-idIns="<?php echo $contactos[$i]->idInstitution?>">
                                        <p style="color: #c7924b;"><?php echo $typeRegister = ($contactos[$i]->typeRegister != 'TR') ? 'Cta. Estados Unidos' : '' ; ?></p>
                                        <p><?php echo '******'.substr($contactos[$i]->cardNumberMask, -4)?></p>
                                        <p></p>
                                      </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                   </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>

                    <!-- -------------- step 2 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user-secret pr5"></i> Monto y Concepto</h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <p><b>Cuenta Destino.</b></p>
                            <div class="panel" style="padding: 10px;text-align: center;">
                              <p id="showDestino2"></p>
                              <p class="cuentaDestino"></p>
                              <p class="instDestino"></p>
                            </div>
                          </div>
                          <div id="infoCambio" class="form-group monto_usa">
                            
                          </div>
                          <div class="form-group monto_mx">
                            
                          </div>
                          <div class="form-group">
                            <label for="concepto">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto">
                          </div>
                          <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" maxlength="6" class="form-control soloNum" id="referencia" name="referencia">
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </section>

                    <!-- -------------- step 3 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-file-text pr5"></i> Confirmar Datos</h4>
                    <section class="wizard-section">

                       <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <p><b>Cuenta Retiro.</b></p>
                            <div class="panel" style="padding: 10px;text-align: center;">
                              <p class="cuentaSession"><?php echo $_SESSION['cuentaSession']?></p>
                              <p>CITI</p>
                            </div>
                          </div>
                          <div class="form-group">
                            <p><b>Cuenta Destino.</b></p>
                            <div class="panel" style="padding: 10px;text-align: center;">
                              <p class="cuentaDestino">123456789987456321</p>
                              <p class="instDestino">BBVA</p>
                            </div>
                          </div>
                          <div class="info_mx form-group">
                            <label>Monto de la transferencia*</label>
                            <p class="montoEnvio"></p>
                          </div>
                          <div class="info_mx conceptodiv form-group">
                            <label>Concepto</label>
                            <p class="concepto"></p>
                          </div>
                          <div class="info_mx referenciadiv form-group">
                            <label>Referencia</label>
                            <p class="referencia"></p>
                          </div>

                          <div class="usadiv form-group">
                            
                          </div>
                          <div id="divName">
                            
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </section>
                  </div>
                  <!-- -------------- /Wizard -------------- -->

              </form>
              <!-- -------------- /Form -------------- -->

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
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/plugins/highcharts/highcharts.js"></script>

<!-- -------------- Plugins -------------- -->
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-spei.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-spei.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-spei.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/addSpei.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script>
$( document ).ready(function() {


  //saldo
  $.ajax({
    url: base_url+"/transferenciaspei/infoSpei",
    data: $("#form-wizard").serialize(),
    type: "post",
    dataType: "json",
    success: function(respuesta){
      if (respuesta.rows.success) {
          if(respuesta.rows.onsignaEntity.balance == 0){
              bootbox.alert({
                message: 'El saldo de la cuenta origen no permite realizar un spei.',
                locale: 'mx'
              });
          }
          console.log('resp = '+respuesta.rows.onsignaEntity.id);
          idOrigin = respuesta.rows.onsignaEntity.id;
          $('#cuentaOrgid').val(respuesta.rows.onsignaEntity.id);
          var saldoFor = (respuesta.rows.onsignaEntity.balance).toFixed(2);
          var numero = new oNumero(saldoFor);
          $('#saldo').val(respuesta.rows.onsignaEntity.balance);
          $('#saldoEnt').html('Saldo : $'+numero.formato(2, true));
          $('#infoOrg').append('<input type="hidden" value="'+respuesta.rows.onsignaEntity.balance+'" class="form-control wizard-required" id="saldo" name="saldo">');
          if(respuesta.rows.onsignaEntity.clabeAccount != 'ND'){
            $('.cuentaSession').html(respuesta.rows.onsignaEntity.clabeAccount);
          }else{
            $('.cuentaSession').html(respuesta.rows.onsignaEntity.id);
          }
          $('#cuentaOrgid').val(respuesta.rows.onsignaEntity.id);
          
        
      }else{
        bootbox.alert({
            message: 'Consulte al Administrador.',
            locale: 'mx'
        });
        $('#saldoEnt').html('');
        $('.saldo').html('');
        $('.clabe').html('');
        $('.titular').html('');
        $('.virtual').html('');  
        $('.banco').html('');  
      }
    }
  });
  
  $("#cuentaOr").change(function(event){
              $('#saldoEnt').html('');

        $.ajax({
          url: base_url+"/transferenciaspei/infoSpei",
          data: $("#form-wizard").serialize(),
          type: "post",
          dataType: "json",
          success: function(respuesta){
            if (respuesta.rows.success) {
                if(respuesta.rows.onsignaEntity.balance == 0){
                    bootbox.alert({
                      message: 'El saldo de la cuenta origen no permite realizar un spei.',
                      locale: 'mx'
                    });
                }
                idOrigin = respuesta.rows.onsignaEntity.id;
                $('#cuentaOrgid').val(respuesta.rows.onsignaEntity.id);
                var saldoFor = (respuesta.rows.onsignaEntity.balance).toFixed(2);
                var numero = new oNumero(saldoFor);
                $('#saldo').val(respuesta.rows.onsignaEntity.balance);
                $('#saldoEnt').html('Saldo : $'+numero.formato(2, true));
                $('#infoOrg').append('<input type="hidden" value="'+respuesta.rows.onsignaEntity.balance+'" class="form-control wizard-required" id="saldo" name="saldo">');
                if(respuesta.rows.onsignaEntity.clabeAccount != 'ND'){
                  $('.cuentaSession').html(respuesta.rows.onsignaEntity.clabeAccount);
                }else{
                  $('.cuentaSession').html(respuesta.rows.onsignaEntity.id);
                }
                
              
            }else{
              bootbox.alert({
                  message: 'Consulte al Administrador.',
                  locale: 'mx'
              });
              $('#saldoEnt').html('');
              $('.saldo').html('');
              $('.clabe').html('');
              $('.titular').html('');
              $('.virtual').html('');  
              $('.banco').html('');  
            }
          }
        });
      });
  
  
  
  
});
</script>
<script>
//Objeto oNumero
function oNumero(numero){
  //Propiedades 
  this.valor = numero || 0;
  this.dec = -1;
  //M�todos 
  this.formato = numFormat;
  this.ponValor = ponValor;
  //Definici�n de los m�todos
  function ponValor(cad){
    if (cad =='-' || cad=='+') return
    if (cad.length ==0) return
    if (cad.indexOf('.') >=0)
       this.valor = parseFloat(cad);
   else 
       this.valor = parseInt(cad);
  } 
function numFormat(dec, miles){
  var num = this.valor, signo=3, expr;
  var cad = ""+this.valor;
  var ceros = "", pos, pdec, i;
  for (i=0; i < dec; i++){
       ceros += '0';
  }
 pos = cad.indexOf('.')
 if (pos < 0){
    cad = cad+"."+ceros;
  }else{
    pdec = cad.length - pos -1;
    if (pdec <= dec){
        for (i=0; i< (dec-pdec); i++)
            cad += '0';
    }else{
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
    }while (cad.indexOf(',') > signo);
  }
    if (dec<0) cad = cad.replace(/\./,'') 
        return cad;
 }
}//Fin del objeto oNumero:
</script>
</body>

</html>

<?=$this->endsection()?>