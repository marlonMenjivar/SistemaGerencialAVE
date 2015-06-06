<div class="airlines view">
<h2><?php echo __('Aerolínea'); ?></h2>

        <div class="actions">
                <h3><?php echo __('Opciones'); ?></h3>
                        <?php echo $this->Html->link(__('Editar Aerolínea'), array('action' => 'edit', $airline['Airline']['id']),array('class'=>'btn btn-primary')); ?>
                        <?php echo $this->Form->postLink(__('Eliminar Aerolínea'), array('action' => 'delete', $airline['Airline']['id']), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la Aerolínea %s?', $airline['Airline']['name'])); ?>
                        <?php echo $this->Html->link(__('Lista de Aerolíneas'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
                        <?php echo $this->Html->link(__('Nueva Aerolínea'), array('action' => 'add'),array('class'=>'btn btn-primary')); ?>
        </div>
	<table>
            <thead>
                <tr>
                    <th>
                        <?php echo __('ID'); ?>
                    </th>
                    <th>
                        <?php echo __('Nombre'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo h($airline['Airline']['id']); ?>
			&nbsp;
                    </td>
                    <td>
                        <?php echo h($airline['Airline']['name']); ?>
			&nbsp;
                    </td>
                </tr>
            </tbody>
	</table>
</div>
