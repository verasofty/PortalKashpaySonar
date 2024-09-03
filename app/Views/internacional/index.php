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
                  <a href="dashboard">Otros Paises</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Otros Paises</li>
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
                        <i class="fa fa-user pr5"></i> Beneficiario
                    </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-12">
                          <h3 id="textInfo" class="text-dorado">Elige Cuenta Origen</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group" id="infoOrg">
                            <select class="custom-select form-control rounded-0 wizard-required" id="cuentaOr" name="cuentaOr">
                              <option value=""></option>
                              <?php
                              //var_dump($cuentas);
                                for ($iC=0; $iC < count($cuentas) ; $iC++) { 
                                  /*if ($cuentas[$iC]->type == 3 || $cuentas[$iC]->type == 4) {
                                    $saldoSes = (session('entitySonID') == $cuentas[$iC]->idSirio) ? 'selected' : '' ;

                                    echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$cuentas[$iC]->name.'</option>';

                                  }else if($cuentas[$iC]->type == 6 && $cuentas[$iC]->active == true){*/
                                    $saldoSes = (session('entitySonID') == $cuentas[$iC]->idSirio) ? 'selected' : '' ;

                                    echo '<option '.$saldoSes.' value="'.$cuentas[$iC]->idSirio.'">'.$cuentas[$iC]->name.'</option>';

                                  //}
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
                          <h3 class="text-dorado" id="textInfo text-dorado">¿A quien envias?</h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <button type="button" class="btn btn-azul btn-block btn_addCuenta_usa">Nuevo Beneficiario</button>
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
                                      <th colspan="2" class="br-t-n pl30">Mis Cuentas</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    for ($i_usa=0; $i_usa < count($contactosUsa) ; $i_usa++) {    
                                     //var_dump($contactosUsa);    
                                     if( $contactosUsa[$i_usa]->aditionalData != null){
                                      $data_adiRef = 'data-refadi="'.$contactosUsa[$i_usa]->aditionalData->aditionalReferences[0].'-'.$contactosUsa[$i_usa]->aditionalData->aditionalReferences[1].'-'.$contactosUsa[$i_usa]->aditionalData->aditionalReferences[2].'"';
                                      $data_calleB = 'data-calleb="'.$contactosUsa[$i_usa]->aditionalData->addressBank->street.'"';
                                      $data_numExB = 'data-numextb="'.$contactosUsa[$i_usa]->aditionalData->addressBank->exteriorNumber.'"';
                                      $data_numIntB = 'data-numintb="'.$contactosUsa[$i_usa]->aditionalData->addressBank->interiorNumber.'"';
                                      $data_cpB = 'data-cpb="'.$contactosUsa[$i_usa]->aditionalData->addressBank->postalCode.'"';
                                      $data_ciudadB = 'data-ciudadb="'.$contactosUsa[$i_usa]->aditionalData->addressBank->city.'"';
                                      $data_estadoB = 'data-estadob="'.$contactosUsa[$i_usa]->aditionalData->addressBank->state.'"';
                                      $data_bancoInter = 'data-bancointer="'.$contactosUsa[$i_usa]->aditionalData->intermediaryBank.'"';
                                      $data_paisDes = 'data-paisdes="'.$contactosUsa[$i_usa]->aditionalData->destinationCountry.'"';
                                     }else{
                                      $data_adiRef = 'data-refadi=""';
                                      $data_calleB = 'data-calleb=""';
                                      $data_numExB = 'data-numextb=""';
                                      $data_numIntB = 'data-numintb=""';
                                      $data_cpB = 'data-cpb=""';
                                      $data_ciudadB = 'data-ciudadb=""';
                                      $data_estadoB = 'data-estadob=""';
                                      $data_bancoInter = 'data-bancointer=""';
                                      $data_paisDes = 'data-paisdes=""';
                                     }          
                                    ?>
                                    <tr class="rowsContact_usa" data-swift="<?php echo $contactosUsa[$i_usa]->intenationalCode ?>" <?php echo $data_bancoInter.' '.$data_paisDes.' '.$data_adiRef.' '.$data_calleB.' '.$data_ciudadB.' '.$data_cpB.' '.$data_estadoB.' '.$data_numExB.' '.$data_numIntB ?> data-accountnumber="<?php echo $contactosUsa[$i_usa]->accountNumber?>" data-cuentas="<?php echo $contactosUsa[$i_usa]->cardNumberMask?>" data-alias="<?php echo $contactosUsa[$i_usa]->nameAlias?>" data-name="<?php echo $contactosUsa[$i_usa]->fullName?>" data-nameInst="<?php echo $contactosUsa[$i_usa]->nameInstitution?>" data-idins="<?php echo $contactosUsa[$i_usa]->intenationalCode?>" data-cp="<?php echo $contactosUsa[$i_usa]->postalCode?>" data-calle="<?php echo $contactosUsa[$i_usa]->street?>" data-numext="<?php echo $contactosUsa[$i_usa]->exteriorNumber?>" data-numint="<?php echo $contactosUsa[$i_usa]->interiorNumber?>" data-estado="<?php echo $contactosUsa[$i_usa]->state?>" data-ciudad="<?php echo $contactosUsa[$i_usa]->city?>">
                                      <td class="pl30" >                                        
                                        <p><?php echo $contactosUsa[$i_usa]->fullName?></p>
                                        <p><?php echo $contactosUsa[$i_usa]->nameAlias?> </p>
                                        <p><?php echo $contactosUsa[$i_usa]->nameInstitution?></p>
                                      </td>
                                      <td class="pl30" >                                        
                                        <p><?php echo '******'.substr($contactosUsa[$i_usa]->cardNumberMask, -4)?></p>
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
                        <i class="fa fa-user-secret pr5"></i> Metodo de entrega </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div id="infoCambio" class="form-group entrega_usa">
                            
                          </div>
                          
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </section>

                    <!-- -------------- step 3 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-user-secret pr5"></i> Transacción </h4>
                    <section class="wizard-section">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div id="infoCambio" class="form-group monto_usa">
                            
                          </div>
                          <div class="form-group monto_mx">
                            
                          </div>
                          <div class="form-group">
                            <label for="concepto">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto">
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </section>

                    <!-- -------------- step 3 -------------- -->
                    <h4 class="wizard-section-title">
                        <i class="fa fa-file-text pr5"></i> Resumen</h4>
                    <section class="wizard-section">

                       <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <table class="table ">
                            <tr>
                              <td>
                                <p class="text-16">Desde que cuenta envías</p>
                                <p><b>Mi cuenta</b></p>
                                <p class="text-dorado text-16 negritas">ONSIGNA KASH</p>
                              </td>
                              <td>
                                <p class="text-16 cuentaSession negritas"><?php echo  '**** '.substr($_SESSION['cuentaSession'], -4)?></p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <p class="text-16">A quien envías</p>
                                <p id="nBene" class="negritas text-16"></p>
                                <p id="instDestino" class="text-dorado negritas instDestino">ONSIGNA KASH</p>
                              </td>
                              <td>
                                <p id="cuentaDestino" class="negritas text-16 cuentaDestino"></p>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <div class="usadiv">

                                </div>
                                <div class="section mt30 mb15">
                                  <div class="option-group field">
                                    <label class="block mt15 option option-primary">
                                        <input id="tyc1" name="tyc1" type="checkbox" >
                                        <span class="checkbox"></span>He leído y estoy deacuerdo con el Aviso de Privacidad </label>
                                    <small id="tyc1Help" class="error form-text text-muted"></small>
                                    <label class="block mt15 option option-primary">
                                        <input id="tyc2" name="tyc2" type="checkbox">
                                        <span class="checkbox"></span>He leído y estoy deacuerdo con los Términos y Condiciones</label>
                                    <small id="tyc2Help" class="error form-text text-muted"></small>
                                  </div>
                                </div>
                                
                              </td>
                            </tr>
                            
                          </table>
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
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.validate-internacional.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.steps-internacional.min.js"></script>

<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.spectrum.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/allcp/forms/js/jquery.stepper.min.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/forms-wizard-internacional.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/internacional.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script>
$( document ).ready(function() {
  //saldo
  console.log('saldo hi ');
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
  //Métodos 
  this.formato = numFormat;
  this.ponValor = ponValor;
  //Definición de los métodos
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