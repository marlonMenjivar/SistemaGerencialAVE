<?php
    $this->start('pageHeader');
    echo '<h1>Editar Sucursal</h1>';
    $this->end();
?>
<fieldset>
    <legend>Opciones</legend>
<div class="actions">
	<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('BranchOffice.id')), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la sucursal # %s?', $this->Form->value('BranchOffice.id')),array('class'=>'btn btn-primary')); ?>
	<?php echo $this->Html->link(__('Lista de Sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
	<?php echo $this->Html->link(__('Lista de Metas Por Sucursales'), array('controller' => 'goal_branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?> 
        <?php echo $this->Html->link(__('Nueva Meta por Sucursal'), array('controller' => 'goal_branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> 

</div>
</fieldset>
<div class="branchOffices form">
<?php echo $this->Form->create('BranchOffice',array('class'=>'form')); ?>
	<?php
            
		echo $this->Form->input('id');
            echo '<div class="form-group">';
                echo $this->Form->input('name',array('label'=>'Nombre de Sucursal',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese nombre de la sucursal'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('abrevia',array('label'=>'Abreviatura',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese la abreviatura de la sucursal'));
            echo '</div>';
	?>
<?php echo $this->Form->end(array('label'=>'Guardar Cambios',
                                    'class'=>'btn btn-primary')); ?>
</div>

