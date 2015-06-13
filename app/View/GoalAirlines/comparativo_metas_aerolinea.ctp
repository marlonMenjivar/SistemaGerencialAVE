<?php
    $this->start('pageHeader');
    echo '<h1>Comparativo de Metas por Aerolínea</h1>';
    $this->end();
    //var_dump($id);
    //var_dump($fecha);
    //print_r($consultaMetas);
    //var_dump($fecha_inicio);
    //var_dump($fecha_fin);
    setlocale(LC_MONETARY, 'en_US');
    //Se calculan recorriendo $consultaBoletos que manda el controlador.
    $boletos_periodo=0;
    $total_periodo=0;
    
    
    $faltante=0;
    $comision=0;
    $porcentajeFaltante=100;
    $ingresoPorComision=0;
?>
<?php 
    if(empty($consultaBoletos)):
 
    else:
        foreach ($consultaBoletos as $k=>$nivel0):
            foreach($nivel0 as $p=>$boleto):
                $boletos_periodo++;
                $total_periodo=$total_periodo+$boleto['tarifa'];
            endforeach;   
        endforeach;
    endif;
?>
<?php 
    //Si no se encontró meta para esa aerolínea y periodo
    if(empty($consultaMetas)):
        //no hace nada.
        $porcentajeFaltante=0;
    else:
        $metaBSP=$consultaMetas['GoalAirline']['meta_bsp'];
        $comision=$consultaMetas['GoalAirline']['comision'];
        if(empty($consultaBoletos)):
            $porcentajeFaltante=100;
            $faltante=$metaBSP;
        else:
            //Con los cálculos hechos antes
            
            if($total_periodo<$metaBSP):
                $faltante=$metaBSP-$total_periodo;
                $porcentajeFaltante=round(($faltante/$metaBSP)*100,2);
            else:
                $porcentajeFaltante=0;
                $ingresoPorComision=$total_periodo*($comision/100);
            endif;
        endif;
    endif;
?>

<!--Formulario para generar reporte, busca una meta por aerolínea y periodo y 
los boletos vendidos en ese periodo por esa aerolínea-->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                              <h3 class="box-title">Seleccione Aerolínea y mes</h3>
                </div><!-- /.box-header -->

                    <?php  echo $this->Form->create('GoalAirline',array('role'=>'form')); ?>
                        <div class="box-body">
                            <?php
                                //Select de aerolíneas, lo llena el GoalAirlinesController
                                echo $this->Form->input('airline_id',array('label'=>'Aerolínea',
                                                        'class'=>'form-control'));
                                //El usuario lo tiene que seleccionar
                                echo $this->Form->input('fecha_inicio',array('label'=>'Mes',
                                                            'type'=>'text',
                                                            'class'=>'mes form-control')); 
                                //Lo llena el controlador después de ejecutar consulta
                                echo $this->Form->input('meta_bsp',array(
                                                        'label'=>'Meta BSP',
                                                        'disabled'=>'disabled',
                                                        'class'=>'form-control'
                                                        ));
                                //Lo llena el controlador después de ejecutar consulta
                                echo $this->Form->input('comision',array(
                                                        'label'=>'Comisión',
                                                        'disabled'=>'disabled',
                                                        'class'=>'form-control'));?>
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
                    <h3><?php echo $boletos_periodo?></h3>
                    <p><strong>Boletos vendidos en el periodo</strong></p>
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
                <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3><sup style="font-size: 20px">$</sup><?php echo number_format($ingresoPorComision,2)?></h3>
                      <p><strong>Ingreso por comisión</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div><!-- ./col -->
        <!--<div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Resultados</h3>
                </div><!-- /.box-header 
                <div class="form-horizontal">   
                    <div role="form">
                    <div class="box-body">
                        
                        <div class="form-control"><?php //echo '<strong>Boletos del periodo:</strong> '.$boletos_periodo?></div>
                        <div class="form-control"><?php //echo '<strong>Total del periodo:</strong> $'.$total_periodo?></div>
                        <div class="form-control"><?php //echo '<strong>Faltante:</strong> $'.$faltante?></div>
                        <div class="form-control"><?php //echo '<strong>Porcentaje faltante de meta:</strong> '.$porcentajeFaltante."%"?></div>
                        <div class="form-control"><?php //echo '<strong>Ingreso por comisión:</strong> $'.$ingresoPorComision?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Boletos Facturados</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="tablitaBonita" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Boleto</th>
                    <th>Fecha</th>
                    <th>Ruta</th>
                    <th>Destino</th>
                    <th>Pasajero</th>
                    <th>Tarifa</th> 
                </tr>
            </thead>
            <tbody>
            <?php 
                if(empty($consultaBoletos)):
 
                else:
                    foreach ($consultaBoletos as $k=>$nivel0):
                        foreach($nivel0 as $p=>$boleto):
                            echo '<tr>';
                            echo '<td>';
                                echo $boleto['boleto'];
                            echo '</td>';
                            echo '<td>';
                                echo $boleto['fecha'];
                            echo '</td>';
                            echo '<td>';
                                echo $boleto['ruta'];
                            echo '</td>';
                            echo '<td>';
                                echo $boleto['destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $boleto['pasajero'];
                            echo '</td>';
                            echo '<td>';
                                echo $boleto['tarifa'];
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
<!-- Small boxes (Stat box) -->
          <div class="row">
            
          </div><!-- /.row -->