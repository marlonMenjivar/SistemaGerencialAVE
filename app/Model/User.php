<?php
//App:uses('AppModel','Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre de usuario requerido'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Contraseña requerida'
            ),
            'between'=>array(
                'rule' => array('lengthBetween', 8, 255),
                'message' => 'Entre 8 y 255 caracteres'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'strategic','tactic')),
                'message' => 'Por favor ingrese un rol valido',
                'allowEmpty' => false
            )
        )
    );
    //Función que encripta la contraseña
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
