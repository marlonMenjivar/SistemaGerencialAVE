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
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'goal_branch_office_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'fecha_inicio' => array('type' => 'date', 'null' => true, 'default' => null),
		'fecha_fin' => array('type' => 'date', 'null' => true, 'default' => null),
		'cantidad_boletos' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'total_boletos' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'faltante_boletos' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'porcentaje_boletos' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'cantidad_servicios' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'total_servicios' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'faltante_servicios' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'porcentaje_servicios' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_reference_19' => array('column' => 'goal_branch_office_id', 'unique' => 0)
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
			'goal_branch_office_id' => 1,
			'fecha_inicio' => '2015-06-14',
			'fecha_fin' => '2015-06-14',
			'cantidad_boletos' => 1,
			'total_boletos' => 1,
			'faltante_boletos' => 1,
			'porcentaje_boletos' => 1,
			'cantidad_servicios' => 1,
			'total_servicios' => 1,
			'faltante_servicios' => 1,
			'porcentaje_servicios' => 1
		),
	);

}
