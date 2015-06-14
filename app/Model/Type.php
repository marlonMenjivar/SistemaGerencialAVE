<?php
App::uses('AppModel', 'Model');

class Type extends AppModel {
	public $displayField = 'id';
	
	public $belongsTo = array(
		'ServicesSalesType' => array(
			'className' => 'ServicesSalesType',
			'foreignKey' => 'services_sales_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
