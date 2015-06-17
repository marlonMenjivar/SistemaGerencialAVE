<div class="login-form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <div class="form-text">
        <?php echo $this->Form->input('username',array('label'=>'',
                                                        'class'=>'inputText',
                                                        'value'=>'USUARIO',
                                                        'onfocus'=>"this.value = '';",
                                                        'onblur'=>"if (this.value == '') {this.value = 'USUARIO';}"
            ));
        echo $this->Form->input('password',array('label'=>'',
                                                'class'=>'inputPass',
                                                 'value'=>'Password',
                                                 'onfocus'=>"this.value = '';",
                                                 'onblur'=>"if (this.value == '') {this.value = 'Password';}"
            ));
    ?>
    </div>
    <div class="form-text">
        <?php echo $this->Form->end(__('Ingresar'));
            $this->layout='login_default';
        ?>
    </div>
</div>