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
		'SUCURSAL' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'MES' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'IDSUCURSAL' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'SUCURSAL_C' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'MES_CUMPLIMIENTO' => array('type' => 'date', 'null' => true, 'default' => null),
		'META_BOLETOS' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'META_SERVICIOS' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => array('SUCURSAL', 'MES'), 'unique' => 1)
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
			'SUCURSAL' => 'Lorem ipsum d',
			'MES' => '2015-06-03',
			'IDSUCURSAL' => 1,
			'SUCURSAL_C' => 1,
			'MES_CUMPLIMIENTO' => '2015-06-03',
			'META_BOLETOS' => 1,
			'META_SERVICIOS' => 1
		),
	);

}
