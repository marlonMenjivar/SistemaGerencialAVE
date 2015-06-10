<?php
    $this->start('pageHeader');
    echo '<h1>Editar Aerolínea</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Aerolíneas'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>

		<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Airline.id')), array('class'=>'btn btn-primary'), __('Estás seguro de eliminar la aerolínea  %s?', $this->Form->value('Airline.name'))); ?>
		<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Metas por Aerolínea'), array('controller' => 'goal_airlines', 'action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Nueva Meta por Aerolínea'), array('controller' => 'goal_airlines', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> 
</div>
<div class="airlines form">
<?php echo $this->Form->create('Airline',array('class'=>'form')); ?>

	<?php
            echo '<div class="form-group">';
                echo $this->Form->input('id');
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('name',array('label'=>'Nombre de Aerolínea',
                                                      'class'=>'form-control',
                                'placeholder'=>'Edite el nombre'));
            echo '</div>';
            echo '<div class="form-group">';	
		echo $this->Form->input('abrevia',array('label'=>'Abreviatura',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese la abreviatura'));
            echo '</div>';
	?>

<?php echo $this->Form->end(array('label'=>'Guardar Cambios',
                                'class'=>'btn btn-primary')); ?>
</div>

