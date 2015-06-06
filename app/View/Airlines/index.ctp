<div class="airlines index">
	<h2><?php echo __('Aerolíneas'); ?></h2>
        <div class="actions">
            <h3><?php echo __('Opciones'); ?></h3>
                <?php echo $this->Html->link(__('Nueva Aerolínea'), array("action"=>"add"),
                                                    array('class'=>'btn btn-primary')); ?>
            
        </div>

	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Nombre de Aerolínea'); ?></th>
			<th class="actions"><?php echo 'Acciones'; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($airlines as $airline): ?>
	<tr>
		<td><?php echo h($airline['Airline']['id']); ?>&nbsp;</td>
		<td><?php echo h($airline['Airline']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $airline['Airline']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $airline['Airline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $airline['Airline']['id']), array('confirm' => __('¿Está seguro de eliminar la Aerolínea %s?', $airline['Airline']['name']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
        <p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count}')
	));
	?>	</p>
</div>
