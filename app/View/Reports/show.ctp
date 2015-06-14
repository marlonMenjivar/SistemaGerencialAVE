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
									<table class="tablitaBonita" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Tipo de Servicio</th>
												<th>Cantidad</th>
												<th>Total</th>
												<th>IVA</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($query as $row): ?>
											<tr>
												<td><?= $row['invoiced_services']['tipo_servicio']; ?></td>
												<td><?= $row[0]['cantidad_por_tipo']; ?></td>
												<td><?= $row[0]['total_por_tipo']; ?></td>
												<td><?= $row[0]['iva_por_tipo']; ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
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
	}
endif;
?>
