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
					<th align="left"><h3>Boletos Vendidos en la Semana</h3></th><td><h4><?= number_format($boletos_destino, 0, '.', ','); ?></h4></td>
					<th align="left"><h3>Ventas Totales de la Semana</h3></th><td><h4>$ <?= number_format($total_destino, 2, '.', ','); ?></h4></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="1">
				<caption><h1>Boletos Facturados por Destino</h1></caption>
				<thead>
					<tr>
						<th>Destino</th>
						<th>Ciudad Destino</th>
						<th>País Destino</th>
						<th>Boletos Destino</th>
						<th>Total Destino ($)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($consulta_destinos as $destinos) { ?>
					<tr>
						<td><?= $destinos['it']['destino']; ?></td>
						<td><?= $destinos['iit']['ciudad_destino']; ?></td>
						<td><?= $destinos['iit']['pais_destino']; ?></td>
						<td><?= $destinos['0']['boletos_destino']; ?></td>
						<td><?= number_format($destinos['0']['total_destino'], 2, '.', ','); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
