<?php 
$this->start('pageHeader');
    echo '<h1>Comparativo de Metas de Servicios Terrestres por Sucursal</h1>';
$this->end();
?>
<?php
    $servicios_periodo_sucursal=0;
    $total_periodo=0;
    
    
    $faltante=0;
    $porcentajeFaltante=100;
    $id=0;
    
    //Si no se encontró meta para esa aerolínea y periodo
    if(empty($queryConsultaMetas)):
        //no hace nada.
        $porcentajeFaltante=0;
    else:
        $id=$queryConsultaMetas['GoalBranchOffice']['id'];
        $metaServicios=$queryConsultaMetas['GoalBranchOffice']['meta_servicios'];
        if(empty($consultaServicios)):
            $porcentajeFaltante=100;
            $faltante=$metaServicios;
        else:
            //Con los cálculos hechos antes
            foreach ($consultaServicios as $k=>$nivel0):
                foreach($nivel0 as $p=>$boleto):
                    $servicios_periodo_sucursal++;
                    $total_periodo=$total_periodo+$boleto['tarifa'];
                endforeach;   
            endforeach;
            if($total_periodo<$metaServicios):
                $faltante=$metaServicios-$total_periodo;
                $porcentajeFaltante=round(($faltante/$metaServicios)*100,2);
            else:
                $porcentajeFaltante=0;
            endif;
        endif;
    endif;
?>

<!--Formulario para generar reporte, busca una meta por sucursal y periodo y 
los boletos vendidos en ese periodo por esa aerolínea-->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                              <h3 class="box-title">Seleccione Sucursal y mes</h3>
                </div><!-- /.box-header -->

                    <?php  echo $this->Form->create('GoalBranchOffice',array('role'=>'form')); ?>
                        <div class="box-body">
                            <?php
                                //Select de aerolíneas, lo llena el GoalAirlinesController
                                echo $this->Form->input('branch_office_id',array('label'=>'Sucursal',
                                                        'class'=>'form-control'));
                                //El usuario lo tiene que seleccionar
                                echo $this->Form->input('mes',array('label'=>'Mes',
                                                            'type'=>'text',
                                                            'class'=>'mes form-control')); 
                                //Lo llena el controlador después de ejecutar consulta
                                echo $this->Form->input('meta_servicios',array(
                                                        'label'=>'Meta de Servicios Terrestres',
                                                        'disabled'=>'disabled',
                                                        'class'=>'form-control'
                                                        ));?>
                            <!--fin del box-body-->
                        </div>
                        <?php
                        echo '<div class="box-footer">';
                                echo $this->Form->end( (array('label'=>'Generar',
                                                'class'=>'btn btn-primary'))); 
                        echo '</div>';
                        ?>
            </div><!--fin del box-boxprimary-->
        </div><!--fin del col-md-6-->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $servicios_periodo_sucursal?></h3>
                    <p><strong>Servicios vendidos</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-paper-airplane"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup><?php echo number_format($total_periodo, 2)?></h3>
                  <p><strong>Ventas Totales</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup><?php echo number_format($faltante, 2)?></h3>
                  <p><strong>Faltante para llegar a la meta</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-arrow-graph-down-right"></i>
                </div>
            </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                      <h3><?php echo $porcentajeFaltante?><sup style="font-size: 20px">%</sup></h3>
                      <p><strong>Porcentaje de incumplimiento</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                        if(empty($mes)):
                            
                        else:
                            echo $this->Form->postlink('Guardar',array('action'=>'editar2',
                                $id,
                                $servicios_periodo_sucursal,
                                $total_periodo,
                                $faltante,
                                $porcentajeFaltante,
                                $mes,
                                $idSucursal),
                                array('class'=>'btn btn-primary'));
                        endif;
                    ?>
            </div>
    </div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Boletos Facturados</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="tablitaBonita" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo de servicio</th>
                    <th>Proveedor de servicio</th>
                    <th>Tarifa</th>
                    <th>IVA</th>
                    <th>Pasajero</th>
                    <th>Descripción</th> 
                    <th>Correlativo de Comprobante</th>
                    <th>Tipo de documento</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(empty($consultaServicios)):
 
                else:
                    foreach ($consultaServicios as $k=>$nivel0):
                        foreach($nivel0 as $p=>$boleto):
                            echo '<tr>';
                                echo '<td>';
                                    echo $boleto['fecha'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['tipo_servicio'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['proveedor_servicio'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['tarifa'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['iva'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['pasajero'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['descripcion'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['correlativo_comprobante'];
                                echo '</td>';
                                echo '<td>';
                                    echo $boleto['tipo_documento'];
                                echo '</td>';
                            echo '</tr>';
                    endforeach;   
                endforeach;
                endif;
             ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->