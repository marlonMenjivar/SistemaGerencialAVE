<?php
    $this->start('pageHeader');
    echo '<h1>Meta por Aerolínea</h1>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
	
		<?php echo $this->Html->link(__('Editar Meta'), array('action' => 'edit', $goalAirline['GoalAirline']['id']), array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Form->postLink(__('Eliminar Meta'), array('action' => 'delete', $goalAirline['GoalAirline']['id']), array('class'=>'btn btn-primary'), __('Está seguro de eliminar la meta # %s?', $goalAirline['GoalAirline']['id'])); ?> 
		<?php echo $this->Html->link(__('Lista de Metas por Aerolínea'), array('action' => 'index'), array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Meta por Aerolínea'), array('action' => 'add'), array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('controller' => 'airlines', 'action' => 'index'), array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Aerolínea'), array('controller' => 'airlines', 'action' => 'add'), array('class'=>'btn btn-primary')); ?> 

</div>

<div class="goalAirlines view">
    <table>
        <thead>
            <tr>   
                <th>
                    <?php echo __('ID'); ?>
                </th>
                <th>
                    <?php echo __('Aerolínea'); ?>
                </th>
                <th>
                    <?php echo __('Fecha de Inicio'); ?>
                </th>
                <th>
                    <?php echo __('Fecha de Fin'); ?>
                </th>
                <th>
                    <?php echo __('Meta BSP'); ?>
                </th>
                <th>
                    <?php echo __('Venta'); ?>
                </th>
                <th>
                    <?php echo __('Faltante'); ?>
                </th>
                <th>
                    <?php echo __('Porcentaje'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['id']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo $this->Html->link($goalAirline['Airline']['name'], array('controller' => 'airlines', 'action' => 'view', $goalAirline['Airline']['id'])); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['FECHA_INICIO_D']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['FECHA_FIN']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['META_BSP']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['VENTA']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['FALTANTE']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['PORCENTAJE']); ?>
			&nbsp;
                </td>
            </tr>
        </tbody>
    </table>
</div>
