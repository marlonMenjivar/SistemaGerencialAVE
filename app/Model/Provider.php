<?php
App::uses('AppModel', 'Model');

class Provider extends AppModel {
	public $displayField = 'id';
	
	public $belongsTo = array(
		'ServicesSalesProvider' => array(
			'className' => 'ServicesSalesProvider',
			'foreignKey' => 'services_sales_provider_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
