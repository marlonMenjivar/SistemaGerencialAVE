<?php
App::uses('AppModel', 'Model');
/**
 * GoalBranchOffice Model
 *
 * @property BranchOffice $BranchOffice
 */
class GoalBranchOffice extends AppModel {

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
		'BranchOffice' => array(
			'className' => 'BranchOffice',
			'foreignKey' => 'branch_office_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
