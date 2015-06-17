<?php
    $this->start('pageHeader');
    echo '<h1>Gestión de Metas por Aerolíneas</h1>';
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
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
		<?php echo $this->Html->link(__('Nueva Meta'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('controller' => 'airlines', 'action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva Aerolínea'), array('controller' => 'airlines', 'action' => 'add'),array('class'=>'btn btn-primary')); ?>
</div>
<div class="goalAirlines index">
	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('airline_id','Aerolínea'); ?></th>
			<th><?php echo $this->Paginator->sort('periodo_bsp','Periodo BSP'); ?></th>
                        <th><?php echo $this->Paginator->sort('fecha_inicio','Fecha de Inicio'); ?></th>
                        <th><?php echo $this->Paginator->sort('fecha_fin','Fecha de Fin'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_bsp','Meta BSP'); ?></th>
                        <th><?php echo $this->Paginator->sort('comision','Comisión por Meta (%)'); ?></th>
                        <th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($goalAirlines as $goalAirline): ?>
	<tr>
		<td><?php echo h($goalAirline['GoalAirline']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($goalAirline['Airline']['name'], array('controller' => 'airlines', 'action' => 'view', $goalAirline['Airline']['id'])); ?>
		</td>
		<td><?php echo h($goalAirline['GoalAirline']['periodo_bsp']); ?>&nbsp;</td>
                <td><?php echo h($goalAirline['GoalAirline']['fecha_inicio']); ?>&nbsp;</td>
                <td><?php echo h($goalAirline['GoalAirline']['fecha_fin']); ?>&nbsp;</td>
                <td><?php echo h($goalAirline['GoalAirline']['meta_bsp']); ?>&nbsp;</td>
                <td><?php echo h($goalAirline['GoalAirline']['comision']); ?>&nbsp;</td>
                <td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $goalAirline['GoalAirline']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $goalAirline['GoalAirline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $goalAirline['GoalAirline']['id']), array('confirm' => __('Está seguro de eliminar la meta # %s?', $goalAirline['GoalAirline']['id']))); ?>
		</td>
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

