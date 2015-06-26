<?php if ($reporte == 6 || $reporte == 7) { ?>
<table align="center">
	<tr>
		<td align="center">
			<table>
				<tr>
					<th align="left">Desde</th><td><?= $this->Time->format('d/m/Y', $fecha1); ?></td>
					<th align="left">Hasta</th><td><?= $this->Time->format('d/m/Y', $fecha2); ?></td>
				</tr>
				<tr>
					<th align="left"><h3>Servicios Vendidos</h3></th><td><h4><?= number_format($cantidad, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales</h3></th><td><h4>$ <?= number_format($total, 2, '.', ','); ?></h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h3>Venta de Servicios Terrestres por <?= ucwords($servicio); ?> de Servicio</h3></caption>
				<thead>
					<tr>
						<th>Tipo de Servicio</th>
						<th>Cantidad</th>
						<th>Total ($)</th>
						<th>IVA ($)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($consulta as $registros) { ?>
					<tr>
						<td><?= $registros['invoiced_services'][$servicio.'_servicio']; ?></td>
						<td><?= number_format($registros[0]['cantidad_por_'.$servicio], 0, '.', ','); ?></td>
						<td><?= number_format($registros[0]['total_por_'.$servicio], 2, '.', ','); ?></td>
						<td><?= number_format($registros[0]['iva_por_'.$servicio], 2, '.', ','); ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th><?= number_format($cantidad, 0, '.', ','); ?></th>
						<th><?= number_format($total, 2, '.', ','); ?></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</table>
<?php } elseif ($reporte == 8) { ?>
<table align="center">
	<tr>
		<td align="center">
			<table>
				<tr>
					<th align="left">Aereolínea</th><td><?= $aereolinea; ?></td>
				</tr>
				<tr>
					<th align="left"><h3>Boletos Vendidos</h3></th><td><h4><?= number_format($boletos_periodo, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales</h3></th><td><h4>$ <?= number_format($total_periodo, 2, '.', ','); ?></h4></td>
				</tr>
				<tr>
					<th align="left"><h3>Meta BSP</h3></th><td><h4>$ <?= number_format($meta_bsp, 2, '.', ','); ?></h4></td>
					<th align="left"><h3>Porcentaje de Incumplimiento</h3></th><td><h4><?= number_format($porcentaje, 2, '.', ','); ?> %</h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h3>Venta de Boletos Aéreos por Línea Aérea</h3></caption>
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
					<?php foreach ($consulta as $registros) { ?>
					<tr>
						<td><?= $registros['goal_airlines']['periodo_bsp']; ?></td>
						<td><?= $this->Time->format('d/m/Y', $registros['goal_airlines']['fecha_inicio']); ?></td>
						<td><?= $this->Time->format('d/m/Y', $registros['goal_airlines']['fecha_fin']); ?></td>
						<td><?= number_format($registros['goal_airlines']['meta_bsp'], 2, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['boletos_periodo'], 0, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['total_periodo'], 2, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['faltante'], 2, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['porcentaje'], 2, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['comision'], 2, '.', ','); ?></td>
						<td><?= number_format($registros['goal_airlines']['ingreso_comision'], 2, '.', ','); ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th><?= number_format($meta_bsp, 2, '.', ','); ?></th>
						<th><?= number_format($boletos_periodo, 0, '.', ','); ?></th>
						<th><?= number_format($total_periodo, 2, '.', ','); ?></th>
						<th></th>
						<th><?= number_format($porcentaje, 2, '.', ','); ?></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</table>
<?php } ?>
