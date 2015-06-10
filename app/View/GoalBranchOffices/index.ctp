<?php
    $this->start('pageHeader');
    echo '<h1>Metas por Sucursales</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
<fieldset>
    <legend><h3><?php echo __('Opciones'); ?></h3></legend>
<div class="actions">
	<?php echo $this->Html->link(__('Nueva meta por sucursal'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?>
	<?php echo $this->Html->link(__('Lista de sucursales'), array('controller' => 'branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?> 
	<?php echo $this->Html->link(__('Nueva Sucursal'), array('controller' => 'branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?>
</div>
</fieldset>
<div class="goalBranchOffices index">
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('branch_office_id','Sucursal'); ?></th>
			<th><?php echo $this->Paginator->sort('mes','Mes'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_boletos','Meta de boletos'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_servicios','Meta de servicios'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($goalBranchOffices as $goalBranchOffice): ?>
	<tr>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($goalBranchOffice['BranchOffice']['name'], array('controller' => 'branch_offices', 'action' => 'view', $goalBranchOffice['BranchOffice']['id'])); ?>
		</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['mes']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['meta_boletos']); ?>&nbsp;</td>
		<td><?php echo h($goalBranchOffice['GoalBranchOffice']['meta_servicios']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $goalBranchOffice['GoalBranchOffice']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $goalBranchOffice['GoalBranchOffice']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $goalBranchOffice['GoalBranchOffice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $goalBranchOffice['GoalBranchOffice']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array('format'=>'Página {:page} de {:pages}, mostrando {:current} registros de {:count}'));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>