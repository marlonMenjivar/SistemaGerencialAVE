<?php
/**
 * GoalAirlineFixture
 *
 */
class GoalAirlineFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'airline_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'FECHA_INICIO_D' => array('type' => 'date', 'null' => true, 'default' => null),
		'FECHA_FIN' => array('type' => 'date', 'null' => true, 'default' => null),
		'META_BSP' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'VENTA' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'FALTANTE' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'PORCENTAJE' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'airline_id' => 1,
			'FECHA_INICIO_D' => '2015-06-06',
			'FECHA_FIN' => '2015-06-06',
			'META_BSP' => 1,
			'VENTA' => 1,
			'FALTANTE' => 1,
			'PORCENTAJE' => 1
		),
	);

}
