<div class="goalAirlines view">
<h2><?php echo __('Goal Airline'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IDLINEA'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['IDLINEA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FECHA INICIO D'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['FECHA_INICIO_D']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FECHA FIN'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['FECHA_FIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('META BSP'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['META_BSP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VENTA'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['VENTA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FALTANTE'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['FALTANTE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PORCENTAJE'); ?></dt>
		<dd>
			<?php echo h($goalAirline['GoalAirline']['PORCENTAJE']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Goal Airline'), array('action' => 'edit', $goalAirline['GoalAirline']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Goal Airline'), array('action' => 'delete', $goalAirline['GoalAirline']['id']), array(), __('Are you sure you want to delete # %s?', $goalAirline['GoalAirline']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Goal Airlines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal Airline'), array('action' => 'add')); ?> </li>
	</ul>
</div>
