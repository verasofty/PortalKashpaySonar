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
                  <a href="dashboard">Resumen</a>
              </li>
              <li class="breadcrumb-link">
                  <a href="dashboard">Home</a>
              </li>
              <li class="breadcrumb-current-item">Resumen</li>
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
          <!-- -------------- Spec Form -------------- -->
            <div class="row">
              <div class="col-md-12">
                <!-- -------------- Text List -------------- -->
                <div class="panel">
                    <div class="panel-heading">
                       <span class="panel-title">Mis Saldos</span>
                    </div>
                    <div class="panel panel-info-cafe panel-border top">
                      <?php 
                      if (isset($rows)) { ?>
                      
                        <div class="panel-body">
                          <p class="">Saldo Disponible</p>
                          <p class=""><b>$<?php echo number_format($rows->balance, 2)?></b></p>
                          <hr>
                          <p class="">Saldo Pendiente</p>
                          <p class=""><b>$<?php echo number_format($rows->customerNetworkBalance, 2)?></b></p>
                          <!--hr>
                          <p class="">Saldo Garantia</p>
                          <p class="">$<?php //echo number_format($rows->customerNetworkBalance, 2)?></p-->
                        </div>
                      <?php
                      }else{
                        echo 'No hay datos';
                      }
                      ?>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3>Mis Comisiónes</h3>
              </div>
            </div>
            <?php
                if (isset($comisiones)) { 
                  //var_dump($comisiones); 
                  $visaTPD = 0;
                  $visaED = 0;
                  $visaTPC =0;
                  $visaEC = 0;  

                  $masterTPD = 0;
                  $masterED = 0;
                  $masterTPC = 0;
                  $masterEC = 0;

                  $amexTPD = 0;
                  $amexED = 0;
                  $amexTPC = 0;
                  $amexEC = 0;

                  $valesTPD = 0;
                  $valesED = 0;
                  $valesTPC = 0;
                  $valesEC = 0;
                 

                  $interTPD = 0;
                  $interED = 0;
                  $interTPC = 0;
                  $interEC = 0;
         
                  for ($i=0; $i < count($comisiones) ; $i++) { 
                    //visa
                    if ($comisiones[$i]->operationType == 22) {
                      //tarjeta presente
                      if ($comisiones[$i]->cardCondition == 'CardPresent') {
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $visaTPD = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $visaTPC = number_format(($comisiones[$i]->percentage/100), 2);
                          
                        }
                      //ecommerce
                      }else{
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $visaED =  number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $visaEC =  number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      }
                    }
                    //mc
                    if ($comisiones[$i]->operationType == 27) {
                      //tarjeta presente
                      if ($comisiones[$i]->cardCondition == 'CardPresent') {
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $masterTPD = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $masterTPC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      //ecommerce
                      }else{
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $masterED = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $masterEC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      }
                    }
                    //amex
                    if ($comisiones[$i]->operationType == 23) {
                      //tarjeta presente
                      if ($comisiones[$i]->cardCondition == 'CardPresent') {
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $amexTPD = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $amexTPC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      //ecommerce
                      }else{
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $amexED = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $amexEC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      }                   
                    }
                    //vales
                    if ($comisiones[$i]->operationType == 56) {
                      if ($comisiones[$i]->cardCondition == 'CardPresent') {
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $valesTPD = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $valesTPC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      //ecommerce
                      }else{
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $valesED = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $valesEC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      } 
                    }
                    //inter
                    if ($comisiones[$i]->operationType == 57) {
                      if ($comisiones[$i]->cardCondition == 'CardPresent') {
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $interTPD = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $interTPC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      //ecommerce
                      }else{
                        //debito
                        if ($comisiones[$i]->accountabilityNature == 'Debit') {
                          $interED = number_format(($comisiones[$i]->percentage/100), 2);
                        //credito
                        }else{
                          $interEC = number_format(($comisiones[$i]->percentage/100), 2);
                        }
                      } 
                    }
                  }
                }
                ?>
            <div class="row">
              <div class="col-md-6">
                <!-- -------------- Text List -------------- -->
                <div class="panel">
                    <div class="panel-heading">
                       <span class="panel-title">Tarjeta Presente Débito</span>
                    </div>
                    <div class="panel panel-info-cafe panel-border top">

                      <?php 
                      if (isset($comisiones)) { 
                      ?>
                        <div class="panel-body">
                          <p class="">Venta Visa</p>
                          <p class=""><b><?php echo $visaTPD ?>%</b></p>
                          <hr>
                          <p class="">Venta Mastercard</p>
                          <p class=""><b><?php echo $masterTPD ?>%</b></p>
                          <hr>
                          <p class="">Venta Amex</p>
                          <p class=""><b><?php echo $amexTPD ?>%</b></p>
                          <hr>
                          <p class="">Venta Vales</p>
                          <p class=""><b><?php echo $valesTPD ?>%</b></p>
                          <hr>
                          <p class="">Venta Internacional</p>
                          <p class=""><b><?php echo $interTPD ?>%</b></p>
                        </div>
                      <?php
                      }else{
                        echo 'No hay datos';
                      }
                      ?>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <!-- -------------- Text List -------------- -->
                <div class="panel">
                    <div class="panel-heading">
                       <span class="panel-title">Ecommerce Débito</span>
                    </div>
                    <div class="panel panel-info-cafe panel-border top">
                      <?php 
                      if (isset($comisiones)) { ?>
                        <div class="panel-body">
                          <p class="">Venta Visa</p>
                          <p class=""><b><?php echo $visaED ?>%</b></p>
                          <hr>
                          <p class="">Venta Mastercard</p>
                          <p class=""><b><?php echo $masterED ?>%</b></p>
                          <hr>
                          <p class="">Venta Amex</p>
                          <p class=""><b><?php echo $amexED ?>%</b></p>
                          <hr>
                          <p class="">Venta Vales</p>
                          <p class=""><b><?php echo $valesED ?>%</b></p>
                          <hr>
                          <p class="">Venta Internacional</p>
                          <p class=""><b><?php echo $interED ?>%</b></p>
                        </div>
                      <?php
                      }else{
                        echo 'No hay datos';
                      }
                      ?>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <!-- -------------- Text List -------------- -->
                <div class="panel">
                    <div class="panel-heading">
                       <span class="panel-title">Tarjeta Presente Crédito</span>
                    </div>
                    <div class="panel panel-info-cafe panel-border top">

                      <?php 
                      if (isset($comisiones)) { 
                      ?>
                        <div class="panel-body">
                          <p class="">Venta Visa</p>
                          <p class=""><b><?php echo $visaTPC ?>%</b></p>
                          <hr>
                          <p class="">Venta Mastercard</p>
                          <p class=""><b><?php echo $masterTPC ?>%</b></p>
                          <hr>
                          <p class="">Venta Amex</p>
                          <p class=""><b><?php echo $amexTPC ?>%</b></p>
                          <hr>
                          <p class="">Venta Vales</p>
                          <p class=""><b><?php echo $valesTPC ?>%</b></p>
                          <hr>
                          <p class="">Venta Internacional</p>
                          <p class=""><b><?php echo $interTPC ?>%</b></p>
                        </div>
                      <?php
                      }else{
                        echo 'No hay datos';
                      }
                      ?>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <!-- -------------- Text List -------------- -->
                <div class="panel">
                    <div class="panel-heading">
                       <span class="panel-title">Ecommerce Crédito</span>
                    </div>
                    <div class="panel panel-info-cafe panel-border top">
                      <?php 
                      if (isset($comisiones)) { ?>
                        <div class="panel-body">
                          <p class="">Venta Visa</p>
                          <p class=""><b><?php echo $visaEC ?>%</b></p>
                          <hr>
                          <p class="">Venta Mastercard</p>
                          <p class=""><b><?php echo $masterEC ?>%</b></p>
                          <hr>
                          <p class="">Venta Amex</p>
                          <p class=""><b><?php echo $amexEC ?>%</b></p>
                          <hr>
                          <p class="">Venta Vales</p>
                          <p class=""><b><?php echo $valesEC ?>%</b></p>
                          <hr>
                          <p class="">Venta Internacional</p>
                          <p class=""><b><?php echo $interEC ?>%</b></p>
                        </div>
                      <?php
                      }else{
                        echo 'No hay datos';
                      }
                      ?>
                    </div>
                </div>
              </div>
            </div>
            <?php
            if (session('idRol') != 6) {
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="panel">
                  <div class="panel-heading">
                    <span class="panel-title"> Saldos Adicionales</span>
                  </div>
                  <div class="panel panel-visible" id="spy2">
                    <div class="panel-body pn">
                      <div class="table-responsive" style=" overflow: auto;">
                        <table class="table table-striped table-hover" id="datatableRes" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="va-m">Nombre</th>
                              <th class="va-m">Saldo Pendiente</th>
                              <th class="va-m">Saldo Disponible</th>
                              <th class="va-m">Comision</th>
                              <th class="va-m"></th>
                            </tr>
                          </thead>
                          <tbody id="rowsTrasnsacciones">
                            <?php
                            if (session('idRol') == 2) {
                              for ($i=0; $i < count($subafiliados) ; $i++) { 
                            ?>
                                <tr class="trSalSubAf" id="principal_<?php echo $subafiliados[$i]->id?>">
                                  <td><?php echo $subafiliados[$i]->name?></td>
                                  <td>$<?php echo number_format($subafiliados[$i]->customerNetworkBalance,2)?></td>
                                  <td>$<?php echo number_format($subafiliados[$i]->balance,2)?></td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_comision_<?php echo $subafiliados[$i]->id?>" onclick="verComision('<?php echo $subafiliados[$i]->id?>',event)" data-id="<?php echo $subafiliados[$i]->id?>" href="#" class="btn btn-primary">
                                          <i class="fas fa-hand-holding-usd"></i>
                                      </a>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_mas_<?php echo $subafiliados[$i]->id?>" onclick="vermas('<?php echo $subafiliados[$i]->id?>',event)" data-id="<?php echo $subafiliados[$i]->id?>" href="#" class="btn btn-info">
                                          <i class="fa fa-plus"></i>
                                      </a>
                                    </div>
                                  </td>
                                </tr>

                            <?php
                              }
                            }
                            if (session('idRol') == 3) {
                              for ($i=0; $i < count($entidades) ; $i++) { 
                            ?>
                              <tr class="trSalEnt" id="principal_<?php echo $entidades[$i]->id?>">
                                <td><?php echo $entidades[$i]->name?></td>
                                <td>$<?php echo number_format($entidades[$i]->customerNetworkBalance,2)?></td>
                                  <td>$<?php echo number_format($entidades[$i]->balance,2)?></td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_comision_<?php echo $entidades[$i]->id?>" onclick="verComision('<?php echo $entidades[$i]->id?>',event)" data-id="<?php echo $entidades[$i]->id?>" href="#" class="btn btn-primary">
                                          <i class="fas fa-hand-holding-usd"></i>
                                      </a>
                                    </div>
                                  </td>
                                <td>
                                  <div class="btn-group">
                                    <a id="ver_mas_<?php echo $entidades[$i]->id?>" onclick="vermas('<?php echo $entidades[$i]->id?>',event)" data-id="<?php echo $entidades[$i]->id?>" href="#" class="btn btn-info">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                  </div>
                                </td>
                              </tr>
                            <?php
                              }
                            }
                            ?>
                            <?php
                            if (session('idRol') == 4) {
                              for ($i=0; $i < count($sucursales) ; $i++) { 
                            ?>
                                <tr class="trSalSuc" id="principal_<?php echo $sucursales[$i]->id?>">
                                  <td><?php echo $sucursales[$i]->name?></td>
                                  <td>$<?php echo number_format($sucursales[$i]->customerNetworkBalance,2)?></td>
                                  <td>$<?php echo number_format($sucursales[$i]->balance,2)?></td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_comision_<?php echo $sucursales[$i]->id?>" onclick="verComision('<?php echo $sucursales[$i]->id?>',event)" data-id="<?php echo $sucursales[$i]->id?>" href="#" class="btn btn-primary">
                                          <i class="fas fa-hand-holding-usd"></i>
                                      </a>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_mas_<?php echo $sucursales[$i]->id?>" onclick="vermas('<?php echo $sucursales[$i]->id?>',event)" data-id="<?php echo $sucursales[$i]->id?>" href="#" class="btn btn-info">
                                          <i class="fa fa-plus"></i>
                                      </a>
                                    </div>
                                  </td>
                                </tr>
                            <?php
                              }
                            }
                            ?>

                            <?php
                            if (session('idRol') == 5) {
                              for ($i=0; $i < count($sucursales) ; $i++) { 
                            ?>
                                <tr class="trSalCaja" id="principal_<?php echo $sucursales[$i]->id?>">
                                  <td><?php echo $sucursales[$i]->name?></td>
                                  <td>$<?php echo number_format($sucursales[$i]->customerNetworkBalance,2)?></td>
                                  <td>$<?php echo number_format($sucursales[$i]->balance,2)?></td>
                                  <td>
                                    <div class="btn-group">
                                      <a id="ver_comision_<?php echo $sucursales[$i]->id?>" onclick="verComision('<?php echo $sucursales[$i]->id?>',event)" data-id="<?php echo $sucursales[$i]->id?>" href="#" class="btn btn-primary">
                                          <i class="fas fa-hand-holding-usd"></i>
                                      </a>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="btn-group">
                                      <a class="ver_mas_<?php echo $sucursales[$i]->id?>" onclick="vermas('<?php echo $sucursales[$i]->id?>',event)" data-id="<?php echo $sucursales[$i]->id?>" href="#" class="btn btn-info">
                                          <i class="fa fa-plus"></i>
                                      </a>
                                    </div>
                                  </td>
                                </tr>

                            <?php
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }
            ?>
          <!-- -------------- /Spec Form -------------- -->
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

<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables1/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables1/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables1/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/plugins/datatables1/media/js/dataTables.bootstrap.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/tables-data.js"></script>
<!-- -------------- Page JS -------------- -->
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/resumen.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/validaciones.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/pages/portal/template.js"></script>
<script src="<?php echo base_url()?>/public/assets/js/saldos.js"></script>
</body>

</html>

<?=$this->endsection()?>