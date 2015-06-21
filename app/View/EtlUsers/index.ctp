<?php
    $this->start('pageHeader');
    echo '<h1>Historial de Carga de datos</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>


<div class="airlines index">
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('fecha','Fecha y hora'); ?></th>
			<th><?php echo $this->Paginator->sort('username','Usuario'); ?></th>
            <th><?php echo $this->Paginator->sort('ingreso_desde','Desde'); ?></th>
            <th><?php echo $this->Paginator->sort('ingreso_hasta','Hasta'); ?></th>
            <th><?php echo $this->Paginator->sort('cantidad_boletos','Cantidad boletos'); ?></th>
            <th><?php echo $this->Paginator->sort('total_boletos','Total boletos ($) '); ?></th>
            <th><?php echo $this->Paginator->sort('cantidad_servicios','Cantidad servicios'); ?></th>
            <th><?php echo $this->Paginator->sort('total_servicios','Total servicios ($)'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($etluser as $etluser): ?>
	<tr>
        <td><?php echo h($etluser['EtlUser']['fecha']); ?>&nbsp;</td>
		<td><?php echo h($etluser['EtlUser']['username']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['ingreso_desde']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['ingreso_hasta']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['cantidad_boletos']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['total_boletos']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['cantidad_servicios']); ?>&nbsp;</td>
        <td><?php echo h($etluser['EtlUser']['total_servicios']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array('format'=>'Página {:page} de {:pages}, mostrando {:current} registros de {:count}'));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
