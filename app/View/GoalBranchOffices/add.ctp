<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Meta por Sucursal</h1>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>

		<?php echo $this->Html->link(__('Lista de metas por sucursales'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de sucursales'), array('controller' => 'branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva sucursal'), array('controller' => 'branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?>

</div>
<div class="goalBranchOffices form">
<?php echo $this->Form->create('GoalBranchOffice',array('class'=>'form')); ?>
	<?php
            echo '<div class="form-group">';
		echo $this->Form->input('branch_office_id',array('label'=>'Nombre de Sucursal',
                                                    'class'=>'form-control'));
            echo '</div>';    
            echo '<div class="form-group">';
		echo $this->Form->input('MES',array('label'=>'Mes',
                                                    'type'=>'text',
                                                    'class'=>'mes form-control'));
            echo '</div>';    
            echo '<div class="form-group">';
		echo $this->Form->input('META_BOLETOS',array('label'=>'Meta de Boletos',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese meta de boletos'));
            echo '</div>';    
            echo '<div class="form-group">';
		echo $this->Form->input('META_SERVICIOS',array('label'=>'Meta de Servicios',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese meta de servicios'));
            echo '</div>';
	?>
<?php echo $this->Form->end((array('label'=>'Guardar Aerolínea',
                                    'class'=>'btn btn-primary'))); ?>
</div>

