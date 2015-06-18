<?php
if ($reporte_encontrado):
	$this->start('pageHeader');
	echo __('<h1>%s</h1>', $nombre_reporte);
	$this->end();
	switch ($opcion) {
		case 6:
			if (@$tipo_mensaje == '1') echo $this->Session->flash();
			$sumatorias = array('cantidad_por_tipo' => 0, 'total_por_tipo' => 0, 'iva_por_tipo' => 0);
			if (!empty($query)) {
				foreach ($query as $row) {
					$sumatorias['cantidad_por_tipo'] += $row[0]['cantidad_por_tipo'];
					$sumatorias['total_por_tipo'] += $row[0]['total_por_tipo'];
					$sumatorias['iva_por_tipo'] += $row[0]['iva_por_tipo'];
				}
			} ?>
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Rango de Fecha</h3>
						</div>
						<?= $this->Form->create('show_reporte_6', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->input('fecha1', array('label' => 'Desde', 'type' => 'text', 'class' => 'fecha form-control', 'required' => true, 'autocomplete' => 'off')); ?>
								</div>
								<div class="col-md-12">
									<?= $this->Form->input('fecha2', array('label' => 'Hasta', 'type' => 'text', 'class' => 'form-control', 'required' => true, 'readonly' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
<!--									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 6), array('class' => 'btn btn-warning', 'escape' => false)); ?>-->
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= number_format($sumatorias['cantidad_por_tipo'], 0, '.', ','); ?></h3>
							<p><strong>Servicios Vendidos</strong></p>
						</div>
						<div class="icon">
							<i class="ion ion-paper-airplane"></i>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><sup style="font-size: 20px;">$</sup> <?= number_format($sumatorias['total_por_tipo'], 2, '.', ','); ?></h3>
							<p><strong>Ventas Totales</strong></p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
					</div>
				</div>
  			<!-- Generear Reportes -->
   			<div class="col-md-3" style="margin-bottom: 20px;">
		        <?php
		        if (!empty($query)):
		            echo $this->Form->create('show_reporte_6', array('url' => array('controller' => 'Reports', 'action' => 'showReporteExcel',6)));
		            echo $this->Form->input('fecha1', array('value' => $fecha1, 'type' => 'hidden'));
		            echo $this->Form->input('fecha2', array('value' => $fecha2, 'type' => 'hidden'));
		            echo $this->Form->end(array('label' => 'Generar Reporte Excel', 'class' => 'btn btn-primary'));
		        endif;
		        ?>
		   	</div><!-- ./col -->
		   	
		   	<div class="col-md-3" style="margin-bottom: 20px;">
		        <?php
		        if (!empty($query)):
		            echo $this->Form->create('show_reporte_6', array('url' => array('controller' => 'Reports', 'action' => 'showReportePdf',6)));
		            echo $this->Form->input('fecha1', array('value' => $fecha1, 'type' => 'hidden'));
		            echo $this->Form->input('fecha2', array('value' => $fecha2, 'type' => 'hidden'));
		            echo $this->Form->end(array('label' => 'Generar Reporte PDF', 'class' => 'btn btn-primary'));
		        endif;
		        ?>
		    </div><!-- ./col --> 
				<div class="col-md-3">
					<?php
					if (!empty($query)) {
						echo $this->Form->create('save_reporte_6', array('url' => array('controller' => 'reports', 'action' => 'save', 6)));
						echo $this->Form->input('fecha1', array('value' => $this->request->data['show_reporte_6']['fecha1'], 'type' => 'hidden'));
						echo $this->Form->input('fecha2', array('value' => $this->request->data['show_reporte_6']['fecha2'], 'type' => 'hidden'));
						echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
						echo $this->Form->end();
					}
					?>
				</div>
			</div>
			<?php if (!empty($query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Servicios Terrestres por Tipo de Servicio</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="tablitaBonita table table-bordered table-striped">
										<thead>
											<tr>
												<th>Tipo de Servicio</th>
												<th>Cantidad</th>
												<th>Total ($)</th>
												<th>IVA ($)</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($query as $row): ?>
											<tr>
												<td><?= $row['invoiced_services']['tipo_servicio']; ?></td>
												<td><?= number_format($row[0]['cantidad_por_tipo'], 0, '.', ','); ?></td>
												<td><?= number_format($row[0]['total_por_tipo'], 2, '.', ','); ?></td>
												<td><?= number_format($row[0]['iva_por_tipo'], 2, '.', ','); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Total</th>
												<th><?= number_format($sumatorias['cantidad_por_tipo'], 0, '.', ','); ?></th>
												<th><?= number_format($sumatorias['total_por_tipo'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['iva_por_tipo'], 2, '.', ','); ?></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
				</div>
			</div>
			<?php }
			break;
		case 7:
			if (@$tipo_mensaje == '1') echo $this->Session->flash();
			$sumatorias = array('cantidad_por_proveedor' => 0, 'total_por_proveedor' => 0, 'iva_por_proveedor' => 0);
			if (!empty($query)) {
				foreach ($query as $row) {
					$sumatorias['cantidad_por_proveedor'] += $row[0]['cantidad_por_proveedor'];
					$sumatorias['total_por_proveedor'] += $row[0]['total_por_proveedor'];
					$sumatorias['iva_por_proveedor'] += $row[0]['iva_por_proveedor'];
				}
			}
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Rango de Fecha</h3>
						</div>
						<?= $this->Form->create('show_reporte_7', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->input('fecha1', array('label' => 'Desde', 'type' => 'text', 'class' => 'fecha form-control', 'required' => true, 'autocomplete' => 'off')); ?>
								</div>
								<div class="col-md-12">
									<?= $this->Form->input('fecha2', array('label' => 'Hasta', 'type' => 'text', 'class' => 'form-control', 'required' => true, 'readonly' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
<!--									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 7), array('class' => 'btn btn-warning', 'escape' => false)); ?>-->
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= number_format($sumatorias['cantidad_por_proveedor'], 0, '.', ','); ?></h3>
							<p><strong>Servicios Vendidos</strong></p>
						</div>
						<div class="icon">
							<i class="ion ion-paper-airplane"></i>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><sup style="font-size: 20px;">$</sup> <?= number_format($sumatorias['total_por_proveedor'], 2, '.', ','); ?></h3>
							<p><strong>Ventas Totales</strong></p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
					</div>
				</div>
  			<!-- Generear Reportes -->
   			<div class="col-md-3" style="margin-bottom: 20px;">
		        <?php
		        if (!empty($query)):
		            echo $this->Form->create('show_reporte_7', array('url' => array('controller' => 'Reports', 'action' => 'showReporteExcel',7)));
		            echo $this->Form->input('fecha1', array('value' => $fecha1, 'type' => 'hidden'));
		            echo $this->Form->input('fecha2', array('value' => $fecha2, 'type' => 'hidden'));
		            echo $this->Form->end(array('label' => 'Generar Reporte Excel', 'class' => 'btn btn-primary'));
		        endif;
		        ?>
		   	</div><!-- ./col -->
		   	
		   	<div class="col-md-3" style="margin-bottom: 20px;">
		        <?php
		        if (!empty($query)):
		            echo $this->Form->create('show_reporte_7', array('url' => array('controller' => 'Reports', 'action' => 'showReportePdf',7)));
		            echo $this->Form->input('fecha1', array('value' => $fecha1, 'type' => 'hidden'));
		            echo $this->Form->input('fecha2', array('value' => $fecha2, 'type' => 'hidden'));
		            echo $this->Form->end(array('label' => 'Generar Reporte PDF', 'class' => 'btn btn-primary'));
		        endif;
		        ?>
		    </div><!-- ./col --> 
				<div class="col-md-3">
					<?php
					if (!empty($query)) {
						echo $this->Form->create('save_reporte_7', array('url' => array('controller' => 'reports', 'action' => 'save', 7)));
						echo $this->Form->input('fecha1', array('value' => $this->request->data['show_reporte_7']['fecha1'], 'type' => 'hidden'));
						echo $this->Form->input('fecha2', array('value' => $this->request->data['show_reporte_7']['fecha2'], 'type' => 'hidden'));
						echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
						echo $this->Form->end();
					}
					?>
				</div>
			</div>
			<?php if (!empty($query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Servicios Terrestres por Proovedor</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="tablitaBonita table table-bordered table-striped">
										<thead>
											<tr>
												<th>Proovedor</th>
												<th>Cantidad</th>
												<th>Total ($)</th>
												<th>IVA ($)</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($query as $row): ?>
											<tr>
												<td><?= $row['invoiced_services']['proveedor_servicio']; ?></td>
												<td><?= number_format($row[0]['cantidad_por_proveedor'], 0, '.', ','); ?></td>
												<td><?= number_format($row[0]['total_por_proveedor'], 2, '.', ','); ?></td>
												<td><?= number_format($row[0]['iva_por_proveedor'], 2, '.', ','); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Total</th>
												<th><?= number_format($sumatorias['cantidad_por_proveedor'], 0, '.', ','); ?></th>
												<th><?= number_format($sumatorias['total_por_proveedor'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['iva_por_proveedor'], 2, '.', ','); ?></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
				</div>
			</div>
			<?php }
			break;
		case 8:
			if (@$tipo_mensaje == '1') echo $this->Session->flash();
			$sumatorias = array('meta_bsp' => 0, 'boletos_periodo' => 0, 'total_periodo' => 0, 'faltante' => 0, 'porcentaje' => 0, 'comision' => 0, 'ingreso_comision' => 0);
			if (!empty($query)) {
				foreach ($query as $row) {
					$sumatorias['meta_bsp'] += $row['goal_airlines']['meta_bsp'];
					$sumatorias['boletos_periodo'] += $row['goal_airlines']['boletos_periodo'];
					$sumatorias['total_periodo'] += $row['goal_airlines']['total_periodo'];
					$sumatorias['faltante'] += $row['goal_airlines']['faltante'];
					$sumatorias['porcentaje'] += $row['goal_airlines']['porcentaje'];
					$sumatorias['comision'] += $row['goal_airlines']['comision'];
					$sumatorias['ingreso_comision'] += $row['goal_airlines']['ingreso_comision'];
				}
			}
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Línea <?= trim($aereolineas[$airline_id]);?>Aérea </h3>
						</div>
						<?= $this->Form->create('show_reporte_8', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->label('L&iacute;nea A&eacute;rea'); ?>
									<?= $this->Form->select('airline_id', $aereolineas, array('class' => 'form-control', 'required' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
<!--									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 8), array('class' => 'btn btn-warning', 'escape' => false)); ?>-->
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6" style="padding-left: 0px; padding-right: 0px; margin-bottom: 20px">
					<div class="col-md-6">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?= number_format($sumatorias['boletos_periodo'], 0, '.', ','); ?></h3>
								<p><strong>Boletos Vendidos</strong></p>
							</div>
							<div class="icon">
								<i class="ion ion-paper-airplane"></i>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="small-box bg-green">
							<div class="inner">
								<h3><sup style="font-size: 20px;">$</sup> <?= number_format($sumatorias['total_periodo'], 2, '.', ','); ?></h3>
								<p><strong>Ventas Totales</strong></p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><sup style="font-size: 20px;">$</sup> <?= number_format($sumatorias['meta_bsp'], 2, '.', ','); ?></h3>
								<p><strong>Meta BSP</strong></p>
							</div>
							<div class="icon">
								<i class="ion ion-arrow-graph-down-right"></i>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="small-box bg-red">
							<div class="inner">
								<h3><?= number_format($sumatorias['porcentaje'], 2, '.', ','); ?> <sup style="font-size: 20px">%</sup></h3>
								<p><strong>Porcentaje de Incumplimiento</strong></p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
						</div>
					</div>
	  			<!-- Generear Reportes -->
	   			<div class="col-md-6">
			        <?php
			        if (!empty($query)):
			            echo $this->Form->create('show_reporte_8', array('url' => array('controller' => 'Reports', 'action' => 'showReporteExcel',8)));
			            echo $this->Form->input('airline_id', array('value' => $airline_id, 'type' => 'hidden'));
			            echo $this->Form->end(array('label' => 'Generar Reporte Excel', 'class' => 'btn btn-primary'));
			        endif;
			        ?>
			   	</div><!-- ./col -->
			   	
			   	<div class="col-md-6">
			        <?php
			        if (!empty($query)):
			            echo $this->Form->create('show_reporte_8', array('url' => array('controller' => 'Reports', 'action' => 'showReportePdf',8)));
			            echo $this->Form->input('airline_id', array('value' => $airline_id, 'type' => 'hidden'));
			            echo $this->Form->end(array('label' => 'Generar Reporte PDF', 'class' => 'btn btn-primary'));
			        endif;
			        ?>
			    </div><!-- ./col --> 
				</div>
			</div>
			<?php if (!empty($query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Boletos Aéreos por Línea Aérea</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="tablitaBonita table table-bordered table-striped">
										<thead>
											<tr>
												<th>Periodo BSP</th>
												<th>Fecha Inicio</th>
												<th>Fecha Fin</th>
												<th>Meta BSP ($)</th>
												<th>Boletos Periodo</th>
												<th>Total Periodo ($)</th>
												<th>Faltante ($)</th>
												<th>Porcentaje (%)</th>
												<th>Comisión (%)</th>
												<th>Ingreso por Comisión ($)</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($query as $row): ?>
											<tr>
												<td><?= $row['goal_airlines']['periodo_bsp']; ?></td>
												<td><?= $this->Time->format('d/m/Y', $row['goal_airlines']['fecha_inicio']); ?></td>
												<td><?= $this->Time->format('d/m/Y', $row['goal_airlines']['fecha_fin']); ?></td>
												<td><?= number_format($row['goal_airlines']['meta_bsp'], 2, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['boletos_periodo'], 0, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['total_periodo'], 2, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['faltante'], 2, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['porcentaje'], 2, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['comision'], 2, '.', ','); ?></td>
												<td><?= number_format($row['goal_airlines']['ingreso_comision'], 2, '.', ','); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th>Total</th>
												<th><?= number_format($sumatorias['meta_bsp'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['boletos_periodo'], 0, '.', ','); ?></th>
												<th><?= number_format($sumatorias['total_periodo'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['faltante'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['porcentaje'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['comision'], 2, '.', ','); ?></th>
												<th><?= number_format($sumatorias['ingreso_comision'], 2, '.', ','); ?></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
				</div>
			</div>
			<?php }
			break;
	}
endif;
?>

 <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
    <?php echo $this->Html->script('jQuery-2.1.4.min.js') ?>

    <?php
    echo $this->Html->script(array('bootstrap-datepicker','bootstrap-datepicker.es.min'));
    ?>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('.fecha').datepicker({
                    language: "es",
                    format: "yyyy/mm/dd",
                    todayHighlight: true,
                    autoclose:true
                }); 
                $('.mes').datepicker({
                    format: "yyyy/mm/dd",
                    startView: "months", 
                    minViewMode: "months",
                    autoclose:true,
                    language:"es"
                });
                
                    $("#show_reporte_<?= $opcion; ?>Fecha1").change(function() {
					   $("#show_reporte_<?= $opcion; ?>Fecha2").val(suma_fecha(6, $("#show_reporte_<?= $opcion; ?>Fecha1").val()));
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
