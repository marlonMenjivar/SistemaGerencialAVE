<?php
/**
 * FulfillmentBranchOfficeGoalFixture
 *
 */
class FulfillmentBranchOfficeGoalFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'SUCURSAL_C' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'MES_CUMPLIMIENTO' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ID_SERVICIO' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'SUCURSAL' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'MES' => array('type' => 'date', 'null' => true, 'default' => null),
		'META_BOLETOS' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'CANTIDAD_BOLETOS' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'VENTA_BOLETOS' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'PORCENTAJE_BOLETOS' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'CANTIDAD_SERVICIOS' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'META_SERVICIOS' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'VENTA_SERVICIOS' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'PORCENTAJE_SERVICIOS' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => array('SUCURSAL_C', 'MES_CUMPLIMIENTO'), 'unique' => 1)
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
			'SUCURSAL_C' => 1,
			'MES_CUMPLIMIENTO' => '2015-06-03',
			'ID_SERVICIO' => 1,
			'SUCURSAL' => 'Lorem ipsum d',
			'MES' => '2015-06-03',
			'META_BOLETOS' => 1,
			'CANTIDAD_BOLETOS' => 1,
			'VENTA_BOLETOS' => 1,
			'PORCENTAJE_BOLETOS' => 1,
			'CANTIDAD_SERVICIOS' => 1,
			'META_SERVICIOS' => 1,
			'VENTA_SERVICIOS' => 1,
			'PORCENTAJE_SERVICIOS' => 1
		),
	);

}
