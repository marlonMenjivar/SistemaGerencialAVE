<h2><?php echo __('Aerolínea'); ?></h2>
<div class="airlines view">
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>

		<?php echo $this->Html->link(__('Editar Aerolínea'), array('action' => 'edit', $airline['Airline']['id']),
                        array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Form->postLink(__('Eliminar Aerolínea'), array('action' => 'delete', $airline['Airline']['id']), array('class'=>'btn btn-primary'), __('Está seguro de eliminar la aerolínea  %s?', $airline['Airline']['name'])); ?>
		<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('action' => 'index'),
                        array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Aerolínea'), array('action' => 'add'),
                        array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Lista de Metas por Aerolíneas'), array('controller' => 'goal_airlines', 'action' => 'index'),
                        array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva Meta por Aerolínea'), array('controller' => 'goal_airlines', 'action' => 'add'),
                        array('class'=>'btn btn-primary')); ?>

</div>
	<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Aerolínea</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo h($airline['Airline']['id']); ?>
			&nbsp;</td>
                    <td><?php echo h($airline['Airline']['name']); ?>
			&nbsp;</td>
                </tr>
            </tbody>
	</table>
</div>

<div class="related">
	<h3><?php echo __('Metas de Aerolínea'); ?></h3>
        <div class="actions">
			<?php echo $this->Html->link(__('Nueva Meta'), array('controller' => 'goal_airlines', 'action' => 'add'),
                                array('class'=>'btn btn-primary')); ?> 
	</div>
	<?php if (!empty($airline['GoalAirline'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('ID'); ?></th>
		<th><?php echo __('FECHA INICIO'); ?></th>
		<th><?php echo __('FECHA FIN'); ?></th>
		<th><?php echo __('META BSP'); ?></th>
		<th><?php echo __('VENTA'); ?></th>
		<th><?php echo __('FALTANTE'); ?></th>
		<th><?php echo __('PORCENTAJE'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($airline['GoalAirline'] as $goalAirline): ?>
		<tr>
			<td><?php echo $goalAirline['id']; ?></td>
			<td><?php echo $goalAirline['FECHA_INICIO_D']; ?></td>
			<td><?php echo $goalAirline['FECHA_FIN']; ?></td>
			<td><?php echo $goalAirline['META_BSP']; ?></td>
			<td><?php echo $goalAirline['VENTA']; ?></td>
			<td><?php echo $goalAirline['FALTANTE']; ?></td>
			<td><?php echo $goalAirline['PORCENTAJE']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'goal_airlines', 'action' => 'view', $goalAirline['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'goal_airlines', 'action' => 'edit', $goalAirline['id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'goal_airlines', 'action' => 'delete', $goalAirline['id']), array(), __('Está seguro de eliminar la Meta # %s?', $goalAirline['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
