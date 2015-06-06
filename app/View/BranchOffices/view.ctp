<div class="branchOffices view">
<h2><?php echo __('Sucursal'); ?></h2>
    <div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
		<?php echo $this->Html->link(__('Editar Sucursal'), array('action' => 'edit', $branchOffice['BranchOffice']['id']),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Form->postLink(__('Eliminar Sucursal'), array('action' => 'delete', $branchOffice['BranchOffice']['id']), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la sucursal %s?', $branchOffice['BranchOffice']['name'])); ?>
		<?php echo $this->Html->link(__('Lista de Sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Sucursal'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?> 
    </div>
	<table>
            <thead>
                <tr>
                   <th><?php echo __('ID'); ?></th> 
                   <th><dt><?php echo __('Nombre'); ?></dt></th>
                </tr>   
            </thead>
            <tbody>
                <tr>
                    <td><?php echo h($branchOffice['BranchOffice']['id']); ?>
			&nbsp;
                    </td>
                    <td>
                        <?php echo h($branchOffice['BranchOffice']['name']); ?>
			&nbsp;
                    </td>
                </tr>    
            </tbody>
	</table>
</div>