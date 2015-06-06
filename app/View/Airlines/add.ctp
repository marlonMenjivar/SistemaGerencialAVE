<h1>Ingresar Aerolínea</h1>
<div class="actions">
	<h3><?php echo __('Opciones'); ?></h3>

		<?php echo $this->Html->link(__('Lista de Aerolíneas'), 
                        array('action' => 'index'),
                        array('class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link(__('Lista de Metas por Aerolíneas'), array('controller' => 'goal_airlines', 'action' => 'index'),
                        array('class'=>'btn btn-primary')); ?> 
		<?php echo $this->Html->link(__('Nueva Meta por Aerolínea'), array('controller' => 'goal_airlines', 'action' => 'add'),
                        array('class'=>'btn btn-primary')); ?> 

</div>
<br>
<div class="airlines form">
<?php echo $this->Form->create('Airline',array('class'=>'form')); 
	echo '<div class="form-group">';	
		echo $this->Form->input('name',array('label'=>'Nombre de Aerolínea',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese nombre de aerolínea'));
	echo '</div>';
?>

<?php echo $this->Form->end((array('label'=>'Guardar Aerolínea',
                                    'class'=>'btn btn-primary'))); ?>
</div>

