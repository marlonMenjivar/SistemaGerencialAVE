<?php
    $this->start('pageHeader');
    echo '<h1>Semi-resumen venta de boletos por líneas aéreas por ruta semanal</h1>';
    $this->end();
    setlocale(LC_MONETARY, 'en_US');
    //Se calculan recorriendo $consultaRutas que manda el controlador.
    $airline_id=0;
    $fecha_inicio='0000/00/00';
    $fecha_final='000/00/00';
    $boletos_ruta=0;
    $total_ruta=0;

?>
<?php 
    if(empty($consultaRutas)):
            //Si esta vacio, nada
    else:
        foreach ($consultaRutas as $k=>$nivel0):
            $boletos_ruta=$boletos_ruta+$nivel0['0']['boletos_ruta'];
            $total_ruta=$total_ruta+$nivel0['0']['total_ruta'];  
        endforeach;

        $airline_id=$this->request->data["TicketRoute"]['airline_id'];
            $fecha_inicio = $this->request->data["TicketRoute"]['fecha_inicio'];
            $fecha_final = $this->request->data["TicketRoute"]['fecha_fin'];
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

                    <?php  echo $this->Form->create('TicketRoute',array('role'=>'form')); ?>
                        <div class="box-body">
                            <?php
                                //Select de aerolíneas, lo llena el controlador
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
        
    <!-- Boxes de contenido calculado -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $boletos_ruta?></h3>
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
                  <h3><sup style="font-size: 20px">$</sup><?php echo number_format($total_ruta, 2)?></h3>
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
                            
                            if(empty($consultaRutas)):
                                //No muestra el boton de guardar
                            else:
                                echo $this->Form->create('guarda_rutas', array('url' => array('controller' => 'airlines', 'action' => 'guardarRutas')));
                                echo $this->Form->input('airline_id', array('value' => $this->request->data['TicketRoute']['airline_id'], 'type' => 'hidden'));
                                echo $this->Form->input('fecha_inicio', array('value' => $this->request->data['TicketRoute']['fecha_inicio'], 'type' => 'hidden'));
                                echo $this->Form->input('fecha_fin', array('value' => $this->request->data['TicketRoute']['fecha_fin'], 'type' => 'hidden'));
                                echo $this->Form->input('boletos_ruta', array('value' => $boletos_ruta, 'type' => 'hidden'));
                                echo $this->Form->input('total_ruta', array('value' => $total_ruta, 'type' => 'hidden'));
                                echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
                                echo $this->Form->end();
                            endif;
                    ?>
            </div><!-- ./col -->
        
    </div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Boletos Facturados por ruta</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="tablitaBonita" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ruta</th>
                    <th>Ciudad origen</th>
                    <th>País origen</th>
                    <th>Ciudad destino</th>
                    <th>País destino</th>
                    <th>Boletos ruta</th>
                    <th>Total ruta ($)</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(empty($consultaRutas)):
                    
                else:
                    foreach ($consultaRutas as $k=>$nivel0):
                            echo '<tr>';
                            echo '<td>';
                                echo $nivel0['it']['ruta'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['ciudad_origen'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['pais_origen'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['ciudad_destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['iit']['pais_destino'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['0']['boletos_ruta'];
                            echo '</td>';
                            echo '<td>';
                                echo $nivel0['0']['total_ruta'];
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