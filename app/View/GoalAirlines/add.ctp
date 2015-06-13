<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Meta</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Metas por Aerolíneas'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
        
		<?php echo $this->Html->link(__('Lista de Metas por Aerolínea'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('controller' => 'airlines', 'action' => 'index'),array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Aerolínea'), array('controller' => 'airlines', 'action' => 'add'),array('class'=>'btn btn-primary')); ?> 
	
</div>

<div class="goalAirlines form">
<?php echo $this->Form->create('GoalAirline',array('class'=>'form')); ?>
	
	<?php
            echo '<br>';
            echo '<div class="form-group">';
		echo $this->Form->input('airline_id',array('label'=>'Aerolínea',
                                        'class'=>'form-control'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('periodo_bsp',array('label'=>'Período BSP',
                                        'class'=>'form-control'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('fecha_inicio',array('label'=>'Fecha de inicio',
                                        'type'=>'text',
                                        'class'=>'fecha form-control'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('fecha_fin',array('label'=>'Fecha de fin',
                                        'type'=>'text',
                                        'class'=>'fecha form-control'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('meta_bsp',array('label'=>'Meta BSP',
                                        'class'=>'form-control'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('comision',array('label'=>'Comision por Meta (%)',
                                        'class'=>'form-control'));
            echo '</div>';         
	?>

<?php echo $this->Form->end( (array('label'=>'Guardar Meta',
                            'class'=>'btn btn-primary'))); ?>
</div>


