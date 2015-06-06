<div class="goalAirlines form">
<?php echo $this->Form->create('GoalAirline'); ?>
	<fieldset>
		<legend><?php echo __('Edit Goal Airline'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('IDLINEA');
		echo $this->Form->input('FECHA_INICIO_D');
		echo $this->Form->input('FECHA_FIN');
		echo $this->Form->input('META_BSP');
		echo $this->Form->input('VENTA');
		echo $this->Form->input('FALTANTE');
		echo $this->Form->input('PORCENTAJE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GoalAirline.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('GoalAirline.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Goal Airlines'), array('action' => 'index')); ?></li>
	</ul>
</div>
