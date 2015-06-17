<?php
App::uses('AppModel', 'Model');

class ServicesSalesType extends AppModel {
	public $displayField = 'id';
	
	public $hasMany = array(
		'InvoicedService' => array(
			'className' => 'InvoicedService',
			'foreignKey' => 'services_sales_type_id',
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
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'services_sales_type_id',
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
