<table align="center">
	<tr>
		<td align="center">
			<table>
				<tr>
					<th align="left">Sucursal</th><td><?= $sucursal; ?></td>
					<th align="left">Mes</th><td><?= $mes; ?></td>
				</tr>
				<tr>
					<th align="left">Meta <?= $tipo == 'tickets' ? 'Boletos' : 'Servicios'; ?></th><td>$ <?= number_format($meta, 2, '.', ','); ?></td>
				</tr>
				<tr>
					<th align="left"><h3><?= $tipo == 'tickets' ? 'Boletos' : 'Servicios'; ?> Vendidos</h3></th><td><h4><?= number_format($servicios_periodo_sucursal, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales</h3></th><td><h4>$ <?= number_format($total_periodo, 2, '.', ','); ?></h4></td>
				</tr>
				<tr>
					<th align="left"><h3>Faltante para Llegar a la Meta</h3></th><td><h4>$ <?= number_format($faltante, 2, '.', ','); ?></h4></td>
					<th align="left"><h3>Porcentaje de Incumplimiento</h3></th><td><h4><?= number_format($porcentaje_faltante, 2, '.', ','); ?> %</h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h1><?= $tipo == 'tickets' ? 'Boletos' : 'Servicios'; ?> Facturados</h1></caption>
				<thead>
					<tr>
						<th><?= $tipo == 'tickets' ? 'Boleto' : 'Tipo Servicio'; ?></th>
						<th>Fecha</th>
						<?php if ($tipo == 'tickets') { ?>
						<th>Ruta</th>
						<th>Destino</th>
						<?php } ?>
						<th>Pasajero</th>
						<th>Tarifa ($)</th>
						<?php if ($tipo == 'services') { ?>
						<th>IVA($)</th>
						<th>Proveedor de Servicio</th>
						<th>Descripción</th>
						<th>Correlativo de Comprobante</th>
						<th>Tipo de Documento</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($consulta as $registros) { ?>
					<tr>
						<td><?= $registros['invoiced_'.$tipo][$tipo == 'tickets' ? 'boleto' : 'tipo_servicio']; ?></td>
						<td><?= $this->Time->format('d/m/Y', $registros['invoiced_'.$tipo]['fecha']); ?></td>
						<?php if ($tipo == 'tickets') { ?>
						<td><?= $registros['invoiced_'.$tipo]['ruta']; ?></td>
						<td><?= $registros['invoiced_'.$tipo]['destino']; ?></td>
						<?php } ?>
						<td><?= $registros['invoiced_'.$tipo]['pasajero']; ?></td>
						<td><?= number_format($registros['invoiced_'.$tipo]['tarifa'], 2, '.', ','); ?></td>
						<?php if ($tipo == 'services') { ?>
						<td><?= number_format($registros['invoiced_'.$tipo]['iva'], 2, '.', ','); ?></td>
						<td><?= $registros['invoiced_'.$tipo]['proveedor_servicio']; ?></td>
						<td><?= $registros['invoiced_'.$tipo]['descripcion']; ?></td>
						<td><?= $registros['invoiced_'.$tipo]['correlativo_comprobante']; ?></td>
						<td><?= $registros['invoiced_'.$tipo]['tipo_documento']; ?></td>
						<?php } ?>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
