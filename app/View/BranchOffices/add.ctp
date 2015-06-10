<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Sucursal</h1>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
	

		<?php echo $this->Html->link(__('Lista de Sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Metas por Sucursales'), array('controller' => 'goal_branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Meta por Sucursal'), array('controller' => 'goal_branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> 
	
</div>
<br>
<div class="branchOffices form">
<?php echo $this->Form->create('BranchOffice',array('class'=>'form')); ?>

	<?php
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
<?php echo $this->Form->end(array('label'=>'Guardar Sucursal',
                                    'class'=>'btn btn-primary')); ?>
</div>

