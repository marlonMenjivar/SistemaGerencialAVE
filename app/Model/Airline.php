<?php
App::uses('AppModel', 'Model');
/**
 * Airline Model
 *
 * @property GoalAirline $GoalAirline
 */
class Airline extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
        public $validate=array(
            'name'=>array(
                'rule'=>'notEmpty'
            ),
            'abrevia'=>array(
               'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Sólo letras y números permitidos'
            ))
        );
	public $hasMany = array(
		'GoalAirline' => array(
			'className' => 'GoalAirline',
			'foreignKey' => 'airline_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
