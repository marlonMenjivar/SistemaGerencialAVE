<?php
if ($reporte_encontrado):
	$this->start('pageHeader');
	echo __('<h1>%s</h1>', $nombre_reporte);
	$this->end();
	switch ($opcion) {
		case 6:
			if (@$tipo_mensaje == '1') echo $this->Session->flash(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Rango de Fecha</h3>
						</div>
						<?= $this->Form->create('show_reporte_6', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-3 col-lg-offset-3">
									<?= $this->Form->input('fecha1', array('label' => 'Desde', 'type' => 'text', 'class' => 'mes form-control', 'required' => true)); ?>
								</div>
								<div class="col-md-3">
									<?= $this->Form->input('fecha2', array('label' => 'Hasta', 'type' => 'text', 'class' => 'mes form-control', 'required' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-3 col-lg-offset-3">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 6), array('class' => 'btn btn-warning', 'escape' => false)); ?>
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty(@$query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Servicios Terrestres por Tipo de Servicio</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
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
											<?php
											$sumatorias = array('cantidad_por_tipo' => 0, 'total_por_tipo' => 0, 'iva_por_tipo' => 0);
											foreach ($query as $row):
											?>
											<tr>
												<td><?= $row['invoiced_services']['tipo_servicio']; ?></td>
												<td><?= number_format($row[0]['cantidad_por_tipo'], 0, '.', ','); ?></td>
												<td><?= number_format($row[0]['total_por_tipo'], 2, '.', ','); ?></td>
												<td><?= number_format($row[0]['iva_por_tipo'], 2, '.', ','); ?></td>
											</tr>
											<?php
											$sumatorias['cantidad_por_tipo'] += $row[0]['cantidad_por_tipo'];
											$sumatorias['total_por_tipo'] += $row[0]['total_por_tipo'];
											$sumatorias['iva_por_tipo'] += $row[0]['iva_por_tipo'];
											endforeach;
											?>
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
						<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<?php
									echo $this->Form->create('save_reporte_6', array('url' => array('controller' => 'reports', 'action' => 'save', 6)));
									echo $this->Form->input('fecha1', array('value' => $this->request->data['show_reporte_6']['fecha1'], 'type' => 'hidden'));
									echo $this->Form->input('fecha2', array('value' => $this->request->data['show_reporte_6']['fecha2'], 'type' => 'hidden'));
									echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
									echo $this->Form->end();
									?>
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
			if (@$tipo_mensaje == '1') echo $this->Session->flash(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Rango de Fecha</h3>
						</div>
						<?= $this->Form->create('show_reporte_7', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-3 col-lg-offset-3">
									<?= $this->Form->input('fecha1', array('label' => 'Desde', 'type' => 'text', 'class' => 'mes form-control', 'required' => true)); ?>
								</div>
								<div class="col-md-3">
									<?= $this->Form->input('fecha2', array('label' => 'Hasta', 'type' => 'text', 'class' => 'mes form-control', 'required' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-3 col-lg-offset-3">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 7), array('class' => 'btn btn-warning', 'escape' => false)); ?>
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty(@$query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Servicios Terrestres por Proovedor</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
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
											<?php
											$sumatorias = array('cantidad_por_proveedor' => 0, 'total_por_proveedor' => 0, 'iva_por_proveedor' => 0);
											foreach ($query as $row):
											?>
											<tr>
												<td><?= $row['invoiced_services']['proveedor_servicio']; ?></td>
												<td><?= number_format($row[0]['cantidad_por_proveedor'], 0, '.', ','); ?></td>
												<td><?= number_format($row[0]['total_por_proveedor'], 2, '.', ','); ?></td>
												<td><?= number_format($row[0]['iva_por_proveedor'], 2, '.', ','); ?></td>
											</tr>
											<?php
											$sumatorias['cantidad_por_proveedor'] += $row[0]['cantidad_por_proveedor'];
											$sumatorias['total_por_proveedor'] += $row[0]['total_por_proveedor'];
											$sumatorias['iva_por_proveedor'] += $row[0]['iva_por_proveedor'];
											endforeach;
											?>
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
						<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<?php
									echo $this->Form->create('save_reporte_7', array('url' => array('controller' => 'reports', 'action' => 'save', 7)));
									echo $this->Form->input('fecha1', array('value' => $this->request->data['show_reporte_7']['fecha1'], 'type' => 'hidden'));
									echo $this->Form->input('fecha2', array('value' => $this->request->data['show_reporte_7']['fecha2'], 'type' => 'hidden'));
									echo $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false));
									echo $this->Form->end();
									?>
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
			if (@$tipo_mensaje == '1') echo $this->Session->flash(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Seleccione Línea Aérea</h3>
						</div>
						<?= $this->Form->create('show_reporte_8', array('role' => 'form')); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-4 col-lg-offset-4">
									<?= $this->Form->label('L&iacute;nea A&eacute;rea'); ?>
									<?= $this->Form->select('airline_id', $aereolineas, array('class' => 'form-control', 'required' => true)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="row">
								<div class="col-md-4 col-lg-offset-4">
									<?= $this->Form->button(__('<i class="fa fa-table"></i> Generar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false)); ?>
									<?= $this->Html->link(__('<i class="fa fa-eraser"></i> Limpiar'), array('controller' => 'reports', 'action' => 'show', 8), array('class' => 'btn btn-warning', 'escape' => false)); ?>
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty(@$query)) { ?>
			<div class="row">
				<div class="col-md-12">
					<?php if (@$tipo_mensaje == '2') echo $this->Session->flash(); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Venta de Servicios Terrestres por Proovedor</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
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
												<th>Comisión ($)</th>
												<th>Ingreso por Comisión ($)</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sumatorias = array('meta_bsp' => 0, 'boletos_periodo' => 0, 'total_periodo' => 0, 'faltante' => 0, 'porcentaje' => 0, 'comision' => 0, 'ingreso_comision' => 0);
											foreach ($query as $row):
											?>
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
											<?php
											$sumatorias['meta_bsp'] += $row['goal_airlines']['meta_bsp'];
											$sumatorias['boletos_periodo'] += $row['goal_airlines']['boletos_periodo'];
											$sumatorias['total_periodo'] += $row['goal_airlines']['total_periodo'];
											$sumatorias['faltante'] += $row['goal_airlines']['faltante'];
											$sumatorias['porcentaje'] += $row['goal_airlines']['porcentaje'];
											$sumatorias['comision'] += $row['goal_airlines']['comision'];
											$sumatorias['ingreso_comision'] += $row['goal_airlines']['ingreso_comision'];
											endforeach;
											?>
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
