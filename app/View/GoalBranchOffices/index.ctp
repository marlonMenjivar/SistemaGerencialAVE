<div class="goalBranchOffices index">
	<h2><?php echo __('Goal Branch Offices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('SUCURSAL'); ?></th>
			<th><?php echo $this->Paginator->sort('MES'); ?></th>
			<th><?php echo $this->Paginator->sort('IDSUCURSAL'); ?></th>
			<th><?php echo $this->Paginator->sort('SUCURSAL_C'); ?></th>
			<th><?php echo $this->Paginator->sort('MES_CUMPLIMIENTO'); ?></th>
			<th><?php echo $this->Paginator->sort('META_BOLETOS'); ?></th>
			<th><?php echo $this->Paginator->sort('META_SERVICIOS'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($goalBranchOffices as $goalBranchOffice): ?>
	<tr>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['SUCURSAL']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['MES']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['IDSUCURSAL']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['SUCURSAL_C']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['MES_CUMPLIMIENTO']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['META_BOLETOS']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['META_SERVICIOS']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $goalBranchOffice['GoalBranchOffice']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $goalBranchOffice['GoalBranchOffice']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $goalBranchOffice['GoalBranchOffice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $goalBranchOffice['GoalBranchOffice']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Goal Branch Office'), array('action' => 'add')); ?></li>
	</ul>
</div>
