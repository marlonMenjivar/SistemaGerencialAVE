<div class="goalBranchOffices view">
<h2><?php echo __('Goal Branch Office'); ?></h2>
	<dl>
		<dt><?php echo __('SUCURSAL'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['SUCURSAL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MES'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['MES']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IDSUCURSAL'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['IDSUCURSAL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SUCURSAL C'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['SUCURSAL_C']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MES CUMPLIMIENTO'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['MES_CUMPLIMIENTO']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('META BOLETOS'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['META_BOLETOS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('META SERVICIOS'); ?></dt>
		<dd>
			<?php echo h($goalBranchOffice['GoalBranchOffice']['META_SERVICIOS']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Goal Branch Office'), array('action' => 'edit', $goalBranchOffice['GoalBranchOffice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Goal Branch Office'), array('action' => 'delete', $goalBranchOffice['GoalBranchOffice']['id']), array(), __('Are you sure you want to delete # %s?', $goalBranchOffice['GoalBranchOffice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Goal Branch Offices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal Branch Office'), array('action' => 'add')); ?> </li>
	</ul>
</div>
