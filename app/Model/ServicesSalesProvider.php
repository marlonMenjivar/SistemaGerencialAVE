<?php
App::uses('AppModel', 'Model');

class ServicesSalesProvider extends AppModel {
	public $displayField = 'id';
	
	public $hasMany = array(
		'InvoicedService' => array(
			'className' => 'InvoicedService',
			'foreignKey' => 'services_sales_provider_id',
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
		'Provider' => array(
			'className' => 'Provider',
			'foreignKey' => 'services_sales_provider_id',
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
