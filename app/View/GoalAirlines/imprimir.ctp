<table align="center">
	<tr>
		<td align="center">
			<table>
				<tr>
					<th align="left">Aerol&iacute;nea</th><td><?= $aereolinea; ?></td>
					<th align="left">Mes</th><td><?= $this->Time->format('d/m/Y', $fecha); ?></td>
				</tr>
				<tr>
					<th align="left">Meta BSP</th><td>$ <?= number_format($meta_bsp, 2, '.', ','); ?></td>
					<th align="left">Comisi&oacute;n</th><td>$ <?= number_format($comision, 2, '.', ','); ?></td>
				</tr>
				<tr>
					<th align="left"><h3>Boletos Vendidos en el Periodo</h3></th><td><h4><?= number_format($servicios_periodo_sucursal, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales</h3></th><td><h4>$ <?= number_format($total_periodo, 2, '.', ','); ?></h4></td>
				</tr>
				<tr>
					<th align="left"><h3>Faltante para Llegar a la Meta</h3></th><td><h4>$ <?= number_format($faltante, 2, '.', ','); ?></h4></td>
					<th align="left"><h3>Porcentaje de Incumplimiento</h3></th><td><h4><?= number_format($porcentaje_faltante, 2, '.', ','); ?> %</h4></td>
				</tr>
				<tr>
					<th align="left"><h3>Ingreso por Comisi&oacute;n</h3></th><td><h4>$ <?= number_format($ingreso_comision, 2, '.', ','); ?></h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h1>Boletos Facturados</h1></caption>
				<thead>
					<tr>
						<th>Boleto</th>
						<th>Fecha</th>
						<th>Ruta</th>
						<th>Destino</th>
						<th>Pasajero</th>
						<th>Tarifa ($)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($consulta_boletos as $boletos) { ?>
					<tr>
						<td><?= $boletos['InvoicedTicket']['boleto']; ?></td>
						<td><?= $this->Time->format('d/m/Y', $boletos['InvoicedTicket']['fecha']); ?></td>
						<td><?= $boletos['InvoicedTicket']['ruta']; ?></td>
						<td><?= $boletos['InvoicedTicket']['destino']; ?></td>
						<td><?= $boletos['InvoicedTicket']['pasajero']; ?></td>
						<td><?= number_format($boletos['InvoicedTicket']['tarifa'], 2, '.', ','); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
