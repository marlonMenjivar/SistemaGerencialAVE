<?php
    $this->start('pageHeader');
    echo '<h1>Aerolínea</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Aerolíneas'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
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
                    <th>Abreviatura</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo h($airline['Airline']['id']); ?>
			&nbsp;</td>
                    <td><?php echo h($airline['Airline']['name']); ?>
			&nbsp;</td>
                    <td><?php echo h($airline['Airline']['abrevia']); ?>
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
                <th><?php echo __('Periodo BSP'); ?></th>
                <th><?php echo __('Fecha de inicio'); ?></th>
                <th><?php echo __('Fecha de fin'); ?></th>
                <th><?php echo __('Boletos de Periodo'); ?></th>
                <th><?php echo __('Total de Periodo'); ?></th>
                <th><?php echo __('Meta BSP'); ?></th>
                <th><?php echo __('Faltante'); ?></th>
                <th><?php echo __('Porcentaje'); ?></th>
                <th><?php echo __('Comisión'); ?></th>
                <th><?php echo __('Ingreso por Comisión'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($airline['GoalAirline'] as $goalAirline): ?>
		<tr>
			<td><?php echo $goalAirline['id']; ?></td>
			<td><?php echo $goalAirline['periodo_bsp']; ?></td>
			<td><?php echo $goalAirline['fecha_inicio']; ?></td>
			<td><?php echo $goalAirline['fecha_fin']; ?></td>
			<td><?php echo $goalAirline['boletos_periodo']; ?></td>
                        <td><?php echo $goalAirline['total_periodo']; ?></td>
			<td><?php echo $goalAirline['meta_bsp']; ?></td>
                        <td><?php echo $goalAirline['faltante']; ?></td>
                        <td><?php echo $goalAirline['porcentaje']; ?></td>
                        <td><?php echo $goalAirline['comision']; ?></td>
                        <td><?php echo $goalAirline['ingreso_comision']; ?></td>
                        
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
