<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Meta</h1>';
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
		echo $this->Form->input('FECHA_INICIO_D',array('label'=>'Fecha de inicio',
                                        'type'=>'text',
                                        'class'=>'fecha form-control',
                                        'placeholder'=>'Seleccione la fecha de inicio de meta'));
            echo '</div>';
            
            echo '<div class="form-group">';
		echo $this->Form->input('FECHA_FIN',array('label'=>'Fecha de fin',
                                        'type'=>'text',
                                        'class'=>'fecha form-control',
                                        'placeholder'=>'Seleccione la fecha de fin de meta'));
            echo '</div>';
            
            echo '<div class="form-group">';
		echo $this->Form->input('META_BSP',array('label'=>'Meta BSP',
                                        'class'=>'form-control',
                                        'placeholder'=>'Ingrese la meta BSP'));
            echo '</div>';
            echo '<div class="form-group">';
		echo $this->Form->input('VENTA',array('label'=>'Venta',
                                        'class'=>'form-control',
                                        'placeholder'=>'Ingrese el monto de venta'));
            echo '</div>';
            
            echo '<div class="form-group">';
		echo $this->Form->input('FALTANTE',array('label'=>'Faltante',
                                        'class'=>'form-control',
                                        'palceholder'=>'Ingrese el monto faltante'));
            echo '</div>';
            
            echo '<div class="form-group">';
		echo $this->Form->input('PORCENTAJE',array('label'=>'Porcentaje',
                                        'class'=>'form-control',
                                        'placeholder'=>'Porcentaje'));
            echo '</div>';
	?>

<?php echo $this->Form->end( (array('label'=>'Guardar Meta',
                            'class'=>'btn btn-primary'))); ?>
</div>


