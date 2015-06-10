<?php
App::uses('AppModel', 'Model');
/**
 * BranchOffice Model
 *
 * @property GoalBranchOffice $GoalBranchOffice
 */
class BranchOffice extends AppModel {

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
	public $hasMany = array(
		'GoalBranchOffice' => array(
			'className' => 'GoalBranchOffice',
			'foreignKey' => 'branch_office_id',
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
