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
