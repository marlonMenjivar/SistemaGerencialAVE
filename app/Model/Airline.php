<?php
App::uses('AppModel', 'Model');
/**
 * Airline Model
 *
 */
class Airline extends AppModel {
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre de aerolínea requerido'
            )
        ));
}
