<?php
    $this->start('pageHeader');
    echo '<h1>Sucursal</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Sucursales'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
	
		<?php echo $this->Html->link(__('Editar Sucursal'), array('action' => 'edit', $branchOffice['BranchOffice']['id']),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Form->postLink(__('Eliminar Sucursal'), array('action' => 'delete', $branchOffice['BranchOffice']['id']), array('class'=>'btn btn-primary'), __('Estás seguro de eliminar la sucurusal # %s?', $branchOffice['BranchOffice']['id'])); ?> 
		<?php echo $this->Html->link(__('Lista de Sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Sucursal'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Lista de Metas por Sucursal'), array('controller' => 'goal_branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Meta por Sucursal'), array('controller' => 'goal_branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> 

</div>
<div class="branchOffices view">
	<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Abreviatura</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo h($branchOffice['BranchOffice']['id']); ?>
			&nbsp;</td>
                    <td><?php echo h($branchOffice['BranchOffice']['name']); ?>
			&nbsp;</td>
                    <td><?php echo h($branchOffice['BranchOffice']['abrevia']); ?>
			&nbsp;</td>
                </tr>
            </tbody>
	</table>
</div>

<div class="related">
	<h3><?php echo __('Metas de Sucursal'); ?></h3>
            <div class="actions">
                    
                <?php echo $this->Html->link(__('Nueva Meta por Sucursal'), array('controller' => 'goal_branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> </li>
                    
            </div>
        </div>
	<?php if (!empty($branchOffice['GoalBranchOffice'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mes'); ?></th>
		<th><?php echo __('Meta de Boletos'); ?></th>
		<th><?php echo __('Meta de Servicios'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($branchOffice['GoalBranchOffice'] as $goalBranchOffice): ?>
		<tr>
			<td><?php echo $goalBranchOffice['id']; ?></td>
			<td><?php echo $goalBranchOffice['mes']; ?></td>
			<td><?php echo $goalBranchOffice['meta_boletos']; ?></td>
			<td><?php echo $goalBranchOffice['meta_servicios']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'goal_branch_offices', 'action' => 'view', $goalBranchOffice['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'goal_branch_offices', 'action' => 'edit', $goalBranchOffice['id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'goal_branch_offices', 'action' => 'delete', $goalBranchOffice['id']), array(), __('Are you sure you want to delete # %s?', $goalBranchOffice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
