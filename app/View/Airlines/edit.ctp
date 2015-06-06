<h1>Editar Aerolínea</h1>
<div class="actions">
            <h3><?php echo __('Opciones'); ?></h3>
                <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Airline.id')), array('class'=>'btn btn-primary'), __('¿Está seguro de eliminar la aerolínea %s?', $this->Form->value('Airline.id'))); ?>
                <?php echo $this->Html->link(__('Lista de Aerolíneas'), array('action' => 'index'),array('class'=>'btn btn-primary')); ?>

</div>
<?php echo $this->Form->create('Airline',array('class'=>'form'));
    
    echo '<div class="form-group">';
		echo $this->Form->input('id');
    echo '</div>'; 
    echo '<div class="form-group">';
		echo $this->Form->input('name',array('label'=>'Nombres',
                                                      'class'=>'form-control',
                                'placeholder'=>'Edite los nombres'));
    echo '</div>'; 
?>
<?php echo $this->Form->end((array('label'=>'Guardar Cambios','class'=>'btn btn-primary')));

