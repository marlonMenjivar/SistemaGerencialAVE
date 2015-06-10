<?php
    $this->start('pageHeader');
    echo '<h1>Editar Meta por Sucursal</h1>';
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
            <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('GoalBranchOffice.id')), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la meta # %s?', $this->Form->value('GoalBranchOffice.id'))); ?>
            <?php echo $this->Html->link(__('Lista de metas por sucursal'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
            <?php echo $this->Html->link(__('Lista de sucursales'), array('controller' => 'branch_offices', 'action' => 'index'),array('class'=>'btn btn-primary')); ?>
            <?php echo $this->Html->link(__('Nueva sucursal'), array('controller' => 'branch_offices', 'action' => 'add'),array('class'=>'btn btn-primary')); ?>
</div>

<div class="goalBranchOffices form">
<?php echo $this->Form->create('GoalBranchOffice',array('class'=>'form')); ?>
	<?php
		echo '<div class="form-group">';
                echo $this->Form->input('id');
		echo '</div>';
                echo '<div class="form-group">';
                echo $this->Form->input('branch_office_id',array('label'=>'Nombre de Sucursal',
                                                    'class'=>'form-control'));
		echo '</div>';
                echo '<div class="form-group">';
                echo $this->Form->input('mes',array('label'=>'Mes',
                                                    'type'=>'text',
                                                    'class'=>'mes form-control'));
		echo '</div>';
                echo '<div class="form-group">';
                echo $this->Form->input('meta_boletos',array('label'=>'Meta de Boletos',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese meta de boletos'));
		echo '</div>';
                echo '<div class="form-group">';
                echo $this->Form->input('meta_servicios',array('label'=>'Meta de Servicios',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese meta de servicios'));
                echo '</div>';
	?>
<?php echo $this->Form->end((array('label'=>'Guardar Cambios',
                                    'class'=>'btn btn-primary'))); ?>
</div>