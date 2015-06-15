<?php
    $this->start('pageHeader');
    echo '<h1>Semi-resumen venta de boletos por líneas aéreas por destino semanal</h1>';
    $this->end();
    setlocale(LC_MONETARY, 'en_US');
    //Se calculan recorriendo $consultaDestinos que manda el controlador.
    $airline_id=0;
    $fecha_inicio='0000/00/00';
    $fecha_final='000/00/00';
    //$arrayConsultaDestinos="";
    $boletos_destino=0;
    $total_destino=0;

?>
<?php 
    if(empty($consultaDestinos)):
            
    else:
        foreach ($consultaDestinos as $k=>$nivel0):
            $boletos_destino=$boletos_destino+$nivel0['0']['boletos_destino'];
            $total_destino=$total_destino+$nivel0['0']['total_destino'];  
        endforeach;

        $airline_id=$this->request->data["TicketDestiny"]['airline_id'];
            $fecha_inicio = $this->request->data["TicketDestiny"]['fecha_inicio'];
            $fecha_final = $this->request->data["TicketDestiny"]['fecha_fin'];
        $arrayConsultaDestinos = $consultaDestinos;
    endif;
?>

<!--Formulario para generar reporte, busca una meta por aerolínea y periodo y 
los boletos vendidos en ese periodo por esa aerolínea-->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                              <h3 class="box-title">Seleccione Aerolínea y semana</h3>
                </div><!-- /.box-header -->

                    <?php  echo $this->Form->create('TicketDestiny',array('role'=>'form')); ?>
                        <div class="box-body">
                            <?php
                                //Select de aerolíneas, lo llena el GoalAirlinesController
                                echo $this->Form->input('airline_id',array('label'=>'Aerolínea',
                                                        'class'=>'form-control'));
                                //El usuario lo tiene que seleccionar
                                echo $this->Form->input('fecha_inicio',array('label'=>'Desde',
                                                            'type'=>'text',
                                                            'class'=>'fecha form-control')); 
                            //Se selecciona automaticamente 
                                echo $this->Form->input('fecha_fin',array('label'=>'Hasta',
                                                            'type'=>'text',
                                                            'class'=>'fecha form-control')); 
                            ?>
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
                    <h3><?php echo $boletos_destino?></h3>
                    <p><strong>Boletos vendidos en la semana</strong></p>
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
                  <h3><sup style="font-size: 20px">$</sup><?php echo number_format($total_destino, 2)?></h3>
                  <p><strong>Ventas Totales de la semana</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
            </div><!-- ./col -->
        
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php
                    echo $this->Form->postlink('Guardar',array('action'=>'guardardestinos',
                        $airline_id,
                        $fecha_inicio,
                        $fecha_final,
                        $boletos_destino,
                        $total_destino),
                        //$arrayConsultaDestinos),
                        array('class'=>'btn btn-primary'));
                    ?>
            </div><!-- ./col -->
        
    </div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Boletos Facturados por destino</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="tablitaBonita" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Destino</th>
                    <th>Ciudad destino</th>
                    <th>País destino</th>
                    <th>Boletos por destino</th>
                    <th>Total destino ($)</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(empty($consultaDestinos)):
                    
                else:
                    foreach ($consultaDestinos as $k=>$nivel0):
                            echo '<tr>';
                            echo '<td>';
                                echo $nivel0['it']['destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['ciudad_destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['pais_destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['0']['boletos_destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['0']['total_destino'];
                            echo '</td>';
                            echo '</tr>'; 
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