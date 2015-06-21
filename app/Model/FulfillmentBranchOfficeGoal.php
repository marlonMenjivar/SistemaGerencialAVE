<?php
App::uses('AppModel', 'Model');

class FulfillmentBranchOfficeGoal extends AppModel {
	public $displayField = 'id';
	
	public $belongsTo = array(
		'GoalBranchOffice' => array(
			'className' => 'GoalBranchOffice',
			'foreignKey' => 'goal_branch_office_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'InvoicedService' => array(
			'className' => 'InvoicedService',
			'foreignKey' => 'fulfillment_branch_office_goal_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'InvoicedTicket' => array(
			'className' => 'InvoicedTicket',
			'foreignKey' => 'fulfillment_branch_office_goal_id',
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
