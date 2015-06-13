<?php
    $this->start('pageHeader');
    echo '<h1>Ingresar Usuario</h1>';
    $this->end();
?>
<?php
    $this->start('pagePath');
    echo '<ol class="breadcrumb">';
    echo '<li><i class="ion-home"> </i>'.$this->Html->link(__('Inicio'), array('controller'=>'pages','action' => 'home')).'</li>';
    echo '<li>'.$this->Html->link(__('Usuarios'), array('action' => 'index')).'</li>';
    echo  '<li class="active">Aquí</li>
          </ol>';
    $this->end();
?>
    <?php  
            echo $this->Form->create('User', array('class'=>'form'));
            
            echo '<div class="form-group">';
                echo $this->Form->input('name',array('label'=>'Nombres',
                                        'class'=>'form-control',
                                'placeholder'=>'Ingrese nombres'                
                    ));
            echo '</div>';
            
            echo '<div class="form-group">';
                echo $this->Form->input('last_name',array('label'=>'Apellidos',
                                                          'class'=>'form-control',
                                  'placeholder'=>'Ingrese apellidos'
                    ));
            echo '</div>';
            
            echo '<div class="form-group">';
            echo $this->Form->input('username',array('label'=>'Usuario',
                                                          'class'=>'form-control',
                                  'placeholder'=>'Ingrese nombre de usuario'));
            echo '</div>';
            
            echo '<div class="form-group">';
            echo $this->Form->input('password',array('label'=>'Contraseña',
                                                          'class'=>'form-control',
                                  'placeholder'=>'Ingrese contraseña'));
            echo '</div>';
            
            echo $this->Form->input('role',array(
                    'options' => array('strategic'=>'Estratégico', 'tactic' => 'Táctico','admin' => 'Administrador'),
                    'label'=>'Rol',
                    'class'=>'multiple form-control'
            ));
    ?>
<?php       echo '<br>';
            echo $this->Form->end(array('label'=>'Guardar usuario',
                            'class'=>'btn btn-primary'));