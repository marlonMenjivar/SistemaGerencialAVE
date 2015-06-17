<?php
App::uses('AppModel', 'Model');
/**
 * GoalAirline Model
 *
 * @property Airline $Airline
 */
class GoalAirline extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
*/
        public $validate=array(
            'fecha_inicio'=>array(
                'rule'=>'notEmpty',
                'message'=>'Por favor seleccione una fecha'
            ),
            'fecha_fin'=>array(
                'rule'=>'notEmpty',
                'message'=>'Por favor seleccione una fecha'
            ),
            'periodo_bsp' => array(
            'number' => array(
                'rule' => array('range',1,12),
                'required' => true,
                'message' => 'Por favor ingrese un número entre 1 y 12.'
            )
            ),
            'meta_bsp'=>array(
                'money'=>array(
                    'rule'=>array('money','left'),
                    'required'=>'true',
                    'message'=>'Ingrese un monto válido.'
                )
            ),
            'comision'=>array(
                'number' => array(
                'rule' => array('range',1,100),
                'required' => true,
                'message' => 'Por favor ingrese un porcentaje válido (1-100).'
            ))
        );
	public $belongsTo = array(
		'Airline' => array(
			'className' => 'Airline',
			'foreignKey' => 'airline_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
