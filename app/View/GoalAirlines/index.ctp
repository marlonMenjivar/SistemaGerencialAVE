<div class="goalAirlines index">
	<h2><?php echo __('Goal Airlines'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('IDLINEA'); ?></th>
			<th><?php echo $this->Paginator->sort('FECHA_INICIO_D'); ?></th>
			<th><?php echo $this->Paginator->sort('FECHA_FIN'); ?></th>
			<th><?php echo $this->Paginator->sort('META_BSP'); ?></th>
			<th><?php echo $this->Paginator->sort('VENTA'); ?></th>
			<th><?php echo $this->Paginator->sort('FALTANTE'); ?></th>
			<th><?php echo $this->Paginator->sort('PORCENTAJE'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($goalAirlines as $goalAirline): ?>
	<tr>
		<td><?php echo h($goalAirline['GoalAirline']['id']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['IDLINEA']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['FECHA_INICIO_D']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['FECHA_FIN']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['META_BSP']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['VENTA']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['FALTANTE']); ?>&nbsp;</td>
		<td><?php echo h($goalAirline['GoalAirline']['PORCENTAJE']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $goalAirline['GoalAirline']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $goalAirline['GoalAirline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $goalAirline['GoalAirline']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $goalAirline['GoalAirline']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Goal Airline'), array('action' => 'add')); ?></li>
	</ul>
</div>
