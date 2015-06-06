<h1>Agregar Aerolínea</h1>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>
	<?php echo $this->Html->link(__('Lista de Aerolíneas'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>
</div>
<br>
<div class="airlines form">
<?php echo $this->Form->create('Airline',array('class'=>'form'));
	
    echo '<div class="form-group">';
	echo $this->Form->input('name',array('label'=>'Nombre de Aerolínea',
                                        'class'=>'form-control',
                                'placeholder'=>'Ingrese el nombre'                
                    ));
    echo '</div>';

    echo $this->Form->end(array('label'=>'Guardar Aerolínea',
                            'class'=>'btn btn-primary')); ?>
</div>

