<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Aerolínea</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Aerolíneas'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
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
        echo '<div class="form-group">';	
		echo $this->Form->input('abrevia',array('label'=>'Abreviatura',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Ingrese la abreviatura'));
	echo '</div>';
?>

<?php echo $this->Form->end((array('label'=>'Guardar Aerolínea',
                                    'class'=>'btn btn-primary'))); ?>
</div>

