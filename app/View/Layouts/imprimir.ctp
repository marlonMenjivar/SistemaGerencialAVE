<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Sistema Gerencial AVE</title>
	</head>
	<body onload="window.print();">
		<table align="center">
			<tr><td align="center"><?= $this->Html->image('logo-small.png');?></td></tr>
			<tr><th align="center"><h1>AGENCIA DE VIAJES ESCAMILLA</h1></th></tr>
			<tr><th align="center"><h2>REPORTE DE <?= $nombre_reporte; ?></h2></th></tr>
		</table>
		<?= $this->fetch('content'); ?>
	</body>
</html>
