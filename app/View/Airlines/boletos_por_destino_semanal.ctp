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
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
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
                                //Select de aerolíneas, lo llena el AirlinesController
                                echo $this->Form->input('airline_id',array('label'=>'Aerolínea',
                                                        'class'=>'form-control'));
                                //El usuario lo tiene que seleccionar
                                echo $this->Form->input('fecha_inicio',array('label'=>'Desde',
                                                            'type'=>'text',
                                                            'class'=>'fecha form-control', 
                                                            'required' => true)); 
                            //Se selecciona automaticamente 
                                echo $this->Form->input('fecha_fin',array('label'=>'Hasta',
                                                            'type'=>'text',
                                                            'class'=>'fecha form-control', 
                                                            'readonly'=>'true',
                                                            'required' => true)); 
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
        <!-- Generear Reportes -->
        <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px">
            <?php
            if (!empty($consultaDestinos)):
                echo $this->Form->create('TicketDestiny', array('url' => array('controller' => 'airlines', 'action' => 'boletosPorDestinoSemanalReporteExcel')));
                echo $this->Form->input('airline_id', array('value' => $airline_id, 'type' => 'hidden'));
                echo $this->Form->input('fecha_inicio', array('value' => $fechainicio, 'type' => 'hidden'));
                echo $this->Form->input('fecha_fin', array('value' => $fechafin, 'type' => 'hidden'));
                echo $this->Form->end(array('label' => 'Generar Reporte Excel', 'class' => 'btn btn-primary'));
            endif;
            ?>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px; display:none;">
        
            <?php
            if (!empty($consultaDestinos)):
                echo $this->Form->create('TicketDestiny', array('url' => array('controller' => 'airlines', 'action' => 'boletosPorDestinoSemanalReportePdf')));
                echo $this->Form->input('airline_id', array('value' => $airline_id, 'type' => 'hidden'));
                echo $this->Form->input('fecha_inicio', array('value' => $fechainicio, 'type' => 'hidden'));
                echo $this->Form->input('fecha_fin', array('value' => $fechafin, 'type' => 'hidden'));
                echo $this->Form->end(array('label' => 'Generar Reporte PDF', 'class' => 'btn btn-primary'));
            endif;
            ?>
        </div><!-- ./col --> 
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <?php
                        
                        if(empty($consultaDestinos)):
                            //No muestra el boton de guardar
                        else:
                            echo $this->Form->create('guarda_destinos', array('url' => array('controller' => 'airlines', 'action' => 'guardarDestinos')));
                            echo $this->Form->input('airline_id', array('value' => $this->request->data['TicketDestiny']['airline_id'], 'type' => 'hidden'));
                            echo $this->Form->input('fecha_inicio', array('value' => $this->request->data['TicketDestiny']['fecha_inicio'], 'type' => 'hidden'));
                            echo $this->Form->input('fecha_fin', array('value' => $this->request->data['TicketDestiny']['fecha_fin'], 'type' => 'hidden'));
                            echo $this->Form->input('boletos_destino', array('value' => $boletos_destino, 'type' => 'hidden'));
                            echo $this->Form->input('total_destino', array('value' => $total_destino, 'type' => 'hidden'));
                            echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
                            echo $this->Form->end();
                        endif;
                ?>
        </div><!-- ./col -->
			<div class="col-xs-6" style="margin-bottom: 20px">
				<?php
				if (!empty($consultaDestinos)) {
					echo $this->Form->create('imprimir', array('url' => array('controller' => 'airlines', 'action' => 'imprimir'), 'target' => '_blank'));
					echo $this->Form->input('airline_id', array('value' => @$this->request->data['TicketDestiny']['airline_id'], 'type' => 'hidden'));
					echo $this->Form->input('aereolinea', array('value' => trim(@$airlines[@$this->request->data['TicketDestiny']['airline_id']]), 'type' => 'hidden'));
					echo $this->Form->input('fecha_inicio', array('value' => @$this->request->data['TicketDestiny']['fecha_inicio'], 'type' => 'hidden'));
					echo $this->Form->input('fecha_fin', array('value' => @$this->request->data['TicketDestiny']['fecha_fin'], 'type' => 'hidden'));
					echo $this->Form->input('boletos_destino', array('value' => @$boletos_destino, 'type' => 'hidden'));
					echo $this->Form->input('total_destino', array('value' => @$total_destino, 'type' => 'hidden'));
					echo $this->Form->button(__('<i class="fa fa-print"></i> Imprimir'), array('class' => 'btn btn-warning', 'escape' => false));
					echo $this->Form->end();
				}
				?>
			</div>
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
                    <th>Boletos destino</th>
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

<?= $this->Html->script(array('jQuery-2.1.4.min.js', 'bootstrap-datepicker', 'bootstrap-datepicker.es.min')); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.fecha').datepicker( {
			format: "yyyy/mm/dd",
			todayHighlight: true,
			autoclose: true,
			language: "es"
		});
		
		$('.mes').datepicker( {
			format: "yyyy/mm/dd",
			startView: "months", 
			minViewMode: "months",
			autoclose: true,
			language: 'es'
		});

		$("#TicketDestinyFechaInicio").change(function() {
			$("#TicketDestinyFechaFin").val(suma_fecha(6, $("#TicketDestinyFechaInicio").val()));
		});
	});

	function suma_fecha(p_dias, p_fecha) {
		var fecha = new Date();
		var fecha_string = p_fecha || (fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());
		var separador = fecha_string.toString().indexOf('/') != -1 ? '/' : '-'; 
		var fecha_array = fecha_string.toString().split(separador);
		var p_fecha = fecha_array[0] + '/' + fecha_array[1] + '/' + fecha_array[2];
		p_fecha= new Date(p_fecha);
		p_fecha.setDate(p_fecha.getDate() + parseInt(p_dias));
		var anio = p_fecha.getFullYear();
		var mes = p_fecha.getMonth() + 1;
		var dia = p_fecha.getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		var fecha_final = anio + separador + mes + separador + dia;
		return fecha_final;
	}
</script>