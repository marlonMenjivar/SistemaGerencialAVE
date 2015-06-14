<?php
/**
 * InvoicedServiceFixture
 *
 */
class InvoicedServiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'services_sales_provider_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'services_sales_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'fulfillment_branch_office_goal_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'numero' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => null),
		'tipo_servicio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'proveedor_servicio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tarifa' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'iva' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'pasajero' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'descripcion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'correlativo_comprobante' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipo_documento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sucursal' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_reference_17' => array('column' => 'services_sales_provider_id', 'unique' => 0),
			'fk_reference_18' => array('column' => 'services_sales_type_id', 'unique' => 0),
			'fk_reference_21' => array('column' => 'fulfillment_branch_office_goal_id', 'unique' => 0)
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
			'services_sales_provider_id' => 1,
			'services_sales_type_id' => 1,
			'fulfillment_branch_office_goal_id' => 1,
			'numero' => 1,
			'fecha' => '2015-06-15',
			'tipo_servicio' => 'Lorem ipsum dolor sit amet',
			'proveedor_servicio' => 'Lorem ipsum dolor sit amet',
			'tarifa' => 1,
			'iva' => 1,
			'pasajero' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'correlativo_comprobante' => 1,
			'tipo_documento' => 'Lorem ipsum dolor sit amet',
			'sucursal' => 'Lorem ipsum d'
		),
	);

}
