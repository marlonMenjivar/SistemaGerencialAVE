<?php
    $this->start('pageHeader');
    echo '<h1>Gestión de Aerolíneas</h1>';
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
<div class="actions">
        <h3><?php echo __('Opciones'); ?></h3>
		<?php echo $this->Html->link('Agregar Aerolínea', 
                        array('action' => 'add'),
                        array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Metas por Aerolínea'), 
                        array('controller' => 'goal_airlines', 'action' => 'index'),
                        array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Meta por Aerolínea'), 
                        array('controller' => 'goal_airlines', 'action' => 'add'),
                        array('class'=>'btn btn-primary')); ?> 
</div>

<div class="airlines index">
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Nombre de Aerolínea'); ?></th>
                        <th><?php echo $this->Paginator->sort('abrevia','Abreviatura'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($airlines as $airline): ?>
	<tr>
		<td><?php echo h($airline['Airline']['id']); ?>&nbsp;</td>
		<td><?php echo h($airline['Airline']['name']); ?>&nbsp;</td>
                <td><?php echo h($airline['Airline']['abrevia']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $airline['Airline']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $airline['Airline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $airline['Airline']['id']), array('confirm' => __('Está seguro de eliminar %s?', $airline['Airline']['name']))); ?>
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
