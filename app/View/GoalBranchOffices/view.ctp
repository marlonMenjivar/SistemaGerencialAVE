<?php
    $this->start('pageHeader');
    echo '<h1>Meta por Sucursal</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Metas por Sucursales'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
		<?php echo $this->Html->link(__('Editar meta por sucursal'), array('action' => 'edit', $goalBranchOffice['GoalBranchOffice']['id']),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Form->postLink(__('Eliminar meta por sucursal'), array('action' => 'delete', $goalBranchOffice['GoalBranchOffice']['id']), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la meta # %s?', $goalBranchOffice['GoalBranchOffice']['id'])); ?>
		<?php echo $this->Html->link(__('Lista de meta por sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva meta por sucursal'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de sucursales'), array('controller' => 'branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva sucursal'), array('controller' => 'branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?>
</div>
<div class="goalBranchOffices view">
    <table>
        <thead>
            <tr>
                <th>
                    <?php echo __('ID'); ?>
                </th>
                <th>
                    <?php echo __('Sucursal'); ?>
                </th>
                <th>
                    <?php echo __('Mes'); ?>
                </th>
                <th>
                    <?php echo __('Meta de boletos'); ?>
                </th>
                <th>
                    <?php echo __('Meta de servicios'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo h($goalBranchOffice['GoalBranchOffice']['id']); ?>
			&nbsp;</td>
                <td><?php echo $this->Html->link($goalBranchOffice['BranchOffice']['name'], array('controller' => 'branch_offices', 'action' => 'view', $goalBranchOffice['BranchOffice']['id'])); ?>
			&nbsp;</td>
                <td><?php echo h($goalBranchOffice['GoalBranchOffice']['mes']); ?>
			&nbsp;</td>
                <td><?php echo h($goalBranchOffice['GoalBranchOffice']['meta_boletos']); ?>
			&nbsp;</td>
                <td><?php echo h($goalBranchOffice['GoalBranchOffice']['meta_servicios']); ?>
			&nbsp;</td>
            </tr>
        </tbody>
    </table>
</div>
