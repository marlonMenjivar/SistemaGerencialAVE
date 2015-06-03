<h1>Editar Cuenta</h1>
<?php
    echo $this->Form->create('User', array('action'=>'edit',
                                            'class'=>'form'));
    echo '<div class="form-group">';
            echo $this->Form->input('name',array('label'=>'Nombres',
                                                      'class'=>'form-control',
                                'placeholder'=>'Edite los nombres'));
    echo '</div>';
    echo '<div class="form-group">';
            echo $this->Form->input('last_name',array('label'=>'Apellidos',
                                                      'class'=>'form-control',
                                'placeholder'=>'Edite los nombres'));
    echo '</div>';
    echo '<div class="form-group">';
            echo $this->Form->input('username',array('type'=>'hidden'));
    echo '</div>';
    echo '<div class="form-group">';
            echo $this->Form->input('password',array('label'=>'Contraseña',
                                                     'class'=>'form-control',
                                'placeholder'=>'Ingrese su nueva contraseña'));
    echo '</div>';
    echo $this->Form->input('role',array('type'=>'hidden'));
    echo $this->Form->input('id',array('type'=>'hidden'));
    echo $this->Form->end(array('label'=>'Guardar Cambios',
                                'class'=>'btn btn-primary'));
?>