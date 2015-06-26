<table align="center">
	<tr>
		<td align="center">
			<table>
				<tr>
					<th align="left">Aerol&iacute;nea</th><td><?= $aereolinea; ?></td>
				</tr>
				<tr>
					<th align="left">Desde</th><td><?= $this->Time->format('d/m/Y', $fecha_inicio); ?></td>
					<th align="left">Hasta</th><td><?= $this->Time->format('d/m/Y', $fecha_fin); ?></td>
				</tr>
				<tr>
					<th align="left"><h3>Boletos Vendidos en la Semana</h3></th><td><h4><?= number_format($boletos, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales de la Semana</h3></th><td><h4>$ <?= number_format($total, 2, '.', ','); ?></h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h1>Boletos Facturados por <?= ucwords($tipo); ?></h1></caption>
				<thead>
					<tr>
						<th><?= ucwords($tipo); ?></th>
						<?php if ($tipo == 'ruta') { ?>
						<th>Ciudad Origen</th>
						<th>País Origen</th>
						<?php } ?>
						<th>Ciudad Destino</th>
						<th>País Destino</th>
						<th>Boletos <?= ucwords($tipo); ?></th>
						<th>Total <?= ucwords($tipo); ?> ($)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($consulta as $registros) { ?>
					<tr>
						<td><?= $registros['it'][$tipo]; ?></td>
						<?php if ($tipo == 'ruta') { ?>
						<td><?= $registros['iit']['ciudad_origen']; ?></td>
						<td><?= $registros['iit']['pais_origen']; ?></td>
						<?php } ?>
						<td><?= $registros['iit']['ciudad_destino']; ?></td>
						<td><?= $registros['iit']['pais_destino']; ?></td>
						<td><?= $registros['0']['boletos_'.$tipo]; ?></td>
						<td><?= number_format($registros['0']['total_'.$tipo], 2, '.', ','); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
