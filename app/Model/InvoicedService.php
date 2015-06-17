<?php
App::uses('AppModel', 'Model');

class InvoicedService extends AppModel {
	public $displayField = 'id';
	
	public $belongsTo = array(
		'ServicesSalesProvider' => array(
			'className' => 'ServicesSalesProvider',
			'foreignKey' => 'services_sales_provider_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ServicesSalesType' => array(
			'className' => 'ServicesSalesType',
			'foreignKey' => 'services_sales_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FulfillmentBranchOfficeGoal' => array(
			'className' => 'FulfillmentBranchOfficeGoal',
			'foreignKey' => 'fulfillment_branch_office_goal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
