<?php
$this->start('pageHeader');
echo '<h1>Acumulado venta de servicios terrestres por tipo de servicio mensual</h1>';
$this->end();

setlocale(LC_MONETARY, 'en_US');

$cantidad_servicios=0;
$total_servicios=0;

if (!empty($consultaServiciosTipo)):
    foreach ($consultaServiciosTipo as $k => $ServicioTipo):
        $cantidad_servicios = $cantidad_servicios + $ServicioTipo['types']['cantidad_servicios_tipo'];
        $total_servicios = $total_servicios + $ServicioTipo['types']['total_servicios_tipo'];
    endforeach;
endif;

?>

<!--Formulario para generar reporte, busca una meta por aerolínea y periodo y 
los boletos vendidos en ese periodo por esa aerolínea-->
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Seleccione Año y Mes</h3>
            </div><!-- /.box-header -->

            <?php echo $this->Form->create('services_sales_types', array('role' => 'form')); ?>
            <div class="box-body">
                <?php
                //Seleccionar el año
                echo $this->Form->input('fecha_anio', array('label' => 'Año',
                    'type' => 'text',
                    'class' => 'anio form-control'));
                //Seleccionar el mes
                echo $this->Form->input('fecha_mes', array('label' => 'Mes',
                    'type' => 'text',
                    'class' => 'meses form-control'));
                //Fecha inicio
                echo "<div style='display: none;'>" . $this->Form->input('fecha_inicio', array('label' => 'Fecha inicio',
                    'type' => 'text',
                    'class' => 'fecha form-control')) . "</div>";
                //Fecha fin
                echo "<div style='display: none;'>" . $this->Form->input('fecha_fin', array('label' => 'Fecha fin',
                    'type' => 'text',
                    'class' => 'fecha form-control')) . "</div>";
                ?>
                <!--fin del box-body-->
            </div>

            <?php
            echo '<div class="box-footer">';
            echo $this->Form->end((array('label' => 'Generar',
                'class' => 'btn btn-primary')));
            echo '</div>';
            ?>
        </div><!--fin del box-boxprimary-->
    </div><!--fin del col-md-6-->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo $cantidad_servicios?></h3>
                <p><strong>Servicios vendidos en el periodo</strong></p>
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
                <h3><sup style="font-size: 20px">$</sup><?php echo number_format($total_servicios, 2)?></h3>
                <p><strong>Ventas Totales</strong></p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div><!-- ./col -->
    
    <!-- Generear Reportes -->
    <div class="col-lg-3 col-xs-6">
        <?php
        if (!empty($consultaServiciosTipo)):
            echo $this->Form->create('reporte_excel', array('url' => array('controller' => 'Reports', 'action' => 'ventaServicioTerrestreTipoServicioMensualReporteExcel')));
            echo $this->Form->input('fecha_anio', array('value' => $fechaAnio, 'type' => 'hidden'));
            echo $this->Form->input('fecha_mes', array('value' => $fechaMes, 'type' => 'hidden'));
            echo $this->Form->input('fecha_inicio', array('value' => $fechaInicio, 'type' => 'hidden'));
            echo $this->Form->input('fecha_fin', array('value' => $fechaFin, 'type' => 'hidden'));
            echo $this->Form->end(array('label' => 'Generar Reporte Excel', 'class' => 'btn btn-primary'));
        endif;
        ?>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    
        <?php
        if (!empty($consultaServiciosTipo)):
            echo $this->Form->create('reporte_pdf', array('url' => array('controller' => 'Reports', 'action' => 'ventaServicioTerrestreTipoServicioMensualReportePdf')));
            echo $this->Form->input('fecha_anio', array('value' => $fechaAnio, 'type' => 'hidden'));
            echo $this->Form->input('fecha_mes', array('value' => $fechaMes, 'type' => 'hidden'));
            echo $this->Form->input('fecha_inicio', array('value' => $fechaInicio, 'type' => 'hidden'));
            echo $this->Form->input('fecha_fin', array('value' => $fechaFin, 'type' => 'hidden'));
            echo $this->Form->end(array('label' => 'Generar Reporte PDF', 'class' => 'btn btn-primary'));
        endif;
        ?>
    </div><!-- ./col -->
    
</div>




<div class="box">
    <div class="box-header">
        <h3 class="box-title">Servicios terrestres vendidos por tipo de servicios</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="tablitaBonita" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo de Servicio</th>
                    <th>Servicios</th>
                    <th>Total de Servicios ($)</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($consultaServiciosTipo)):
                    foreach ($consultaServiciosTipo as $k => $ServicioTipo):
                        echo '<tr>';
                        echo '<td>';
                        echo $ServicioTipo['services_sales_types']['id'];
                        echo '</td>';
                        echo '<td>';
                        echo $ServicioTipo['types']['tipo_servicio'];
                        echo '</td>';
                        echo '<td>';
                        echo $ServicioTipo['types']['cantidad_servicios_tipo'];
                        echo '</td>';
                        echo '<td>';
                        echo $ServicioTipo['types']['total_servicios_tipo'];
                        echo '</td>';
                        echo '<td>';
                        echo $ServicioTipo['services_sales_types']['fecha_inicio_tipo'];
                        echo '</td>';
                        echo '<td>';
                        echo $ServicioTipo['services_sales_types']['fecha_fin_tipo'];
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

<!-- Datepiker personalizado -->
<?php
    $this->start('scriptReady');
        echo "$('.meses').datepicker({\n"
            ."format: 'MM',\n"
            ."startView: 'months',\n"
            ."minViewMode: 'months',\n"
            ."autoclose:true,\n"
            ."language:'es',\n"
            ."defaultViewDate: { year: parseInt($('#GoalAirlineFechaAnio').val()) , month: 01, day: 01 }\n"
        ."}).on('changeDate', function(e){\n"
                . " if($('.anio').datepicker('getDate') && $('.meses').datepicker('getDate').getTime() != $('.anio').datepicker('getDate').getTime()) {\n"
                . "     $('.anio').datepicker('setDate',new Date($('.meses').datepicker('getDate')));\n"
                . " } else if(! $('.anio').datepicker('getDate')) {\n"
                . "     $('.anio').datepicker('setDate',new Date($('.meses').datepicker('getDate')));\n"
                . " }\n"
                . "$('#services_sales_typesFechaInicio').datepicker('setDate',new Date($('.meses').datepicker('getDate')));\n"
                . "$('#GoalAirlineFechaFin').datepicker('setDate',new Date($('.meses').datepicker('getDate').getFullYear(),$('.meses').datepicker('getDate').getMonth()+1,0));\n"
                . "});\n";
        echo "$('.anio').datepicker({\n"
            ."format: 'yyyy',\n"
            ."startView: 'years',\n"
            ."minViewMode: 'years',\n"
            ."autoclose:true,\n"
            ."language:'es',\n"
        ."}).on('changeDate', function(e){\n"
                . " if($('.meses').datepicker('getDate') && $('.meses').datepicker('getDate').getTime() != $('.anio').datepicker('getDate').getTime()) {\n"
                . "     $('.meses').datepicker('setDate',new Date($('.anio').datepicker('getDate').setMonth($('.meses').datepicker('getDate').getMonth())));\n"
                . " } else if(! $('.meses').datepicker('getDate')) {\n"
                . "     $('.meses').datepicker('setDate',new Date($('.anio').datepicker('getDate')));\n"
                . " }\n"
                . "$('#services_sales_typesFechaInicio').datepicker('setDate',new Date($('.anio').datepicker('getDate')));\n"
                . "$('#services_sales_typesFechaFin').datepicker('setDate',new Date($('.anio').datepicker('getDate').getFullYear(),$('.anio').datepicker('getDate').getMonth()+1,0));\n"
                . "});\n";
    $this->end();
?>
<!-- fin -->