<?php
    $this->start('pageHeader');
    echo '<h1>Sistema de Información Gerencial Agencia de Viajes Escamilla</h1>';
    $this->end();
?>

<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>1</h3>
                  <p>Cumplimiento de metas por línea aérea por periodo BSP</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                  <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'GoalAirlines','action'=>'comparativoMetasAerolinea'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>2</h3>
                  <p>Venta de boletos de líneas aéreas por destino semanal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'Airlines','action'=>'boletosPorDestinoSemanal'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>3</h3>
                  <p>Venta de boletos de líneas aéreas por rutas semanal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'Airlines','action'=>'boletosPorRutaSemanal'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>4</h3>
                  <p>Cumplimiento de venta de boletos aéreos por sucursal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'GoalBranchOffices','action'=>'comparativoMetas'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>5</h3>
                  <p>Cumplimiento venta de servicios terrestres por sucursal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'GoalBranchOffices','action'=>'comparativoMetasTerrestres'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>6</h3>
                  <p>Venta de servicios terrestres por tipo de servicio semanal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller' => 'reports', 'action' => 'show', 6), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>7</h3>
                  <p>Venta de servicios terrestres por proveedor semanal</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller' => 'reports', 'action' => 'show', 7), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>8</h3>
                  <p>Venta de boletos aéreos por línea aérea por periodo BSP</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller' => 'reports', 'action' => 'show', 8), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>9</h3>
                  <p>Venta de boletos aéreos por líneas aéreas mensual</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'GoalAirlines','action'=>'ventaBoletoAereosMensual'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>10</h3>
                  <p>Venta de servicios terrestres por tipo de servicio mensual</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'Reports','action'=>'ventaServicioTerrestreTipoServicioMensual'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>11</h3>
                  <p>Venta de servicios terrestres por proveedor mensual</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'Reports','action'=>'ventaProveedorServicioTerrestreMensual'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3>-></h3>
                  <p>Historial de carga de datos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i>'), array('controller'=>'EtlUsers','action'=>'index'), array('class' => 'small-box-footer','escape' => false));?>
              </div>
</div><!-- ./col -->