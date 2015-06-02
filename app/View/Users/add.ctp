<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Ingresar Usuario'); ?></legend>
        <?php echo $this->Form->input('username',array('label'=>'Usuario'));
        echo $this->Form->input('password',array('label'=>'Contraseña'));
        echo $this->Form->input('role',array(
            'options' => array('strategic'=>'Estratégico', 'tactic' => 'Táctico','admin' => 'Administrador'),
            'label'=>'Rol'           
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>