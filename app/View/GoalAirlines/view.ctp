<?php
    $this->start('pageHeader');
    echo '<h1>Meta por Aerolínea</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Metas por Aerolíneas'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
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
                <th><?php echo __('ID'); ?></th>
                <th><?php echo __('Aerolínea'); ?></th>
                <th><?php echo __('Periodo BSP'); ?></th>
                <th><?php echo __('Fecha de inicio'); ?></th>
                <th><?php echo __('Fecha de fin'); ?></th>
                <th><?php echo __('Boletos de Periodo'); ?></th>
                <th><?php echo __('Total de Periodo'); ?></th>
                <th><?php echo __('Meta BSP'); ?></th>
                <th><?php echo __('Faltante'); ?></th>
                <th><?php echo __('Porcentaje'); ?></th>
                <th><?php echo __('Comisión por Meta (%)'); ?></th>
                <th><?php echo __('Ingreso por Comisión'); ?></th>
                <th><?php echo __('Ultima Modificación'); ?></th>
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
                    <?php echo h($goalAirline['GoalAirline']['periodo_bsp']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['fecha_inicio']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['fecha_fin']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['boletos_periodo']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['total_periodo']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['meta_bsp']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['faltante']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['porcentaje']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['comision']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['ingreso_comision']); ?>
			&nbsp;
                </td>
                <td>
                    <?php echo h($goalAirline['GoalAirline']['modified']); ?>
			&nbsp;
                </td>
            </tr>
        </tbody>
    </table>
</div>
