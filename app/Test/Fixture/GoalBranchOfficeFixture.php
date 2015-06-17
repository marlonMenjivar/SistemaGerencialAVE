<?php
/**
 * GoalBranchOfficeFixture
 *
 */
class GoalBranchOfficeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'branch_office_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'MES' => array('type' => 'date', 'null' => false, 'default' => null),
		'META_BOLETOS' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'META_SERVICIOS' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'branch_office_id' => 1,
			'MES' => '2015-06-07',
			'META_BOLETOS' => 1,
			'META_SERVICIOS' => 1
		),
	);

}
