<?php
/**
 * InvoicedTicketFixture
 *
 */
class InvoicedTicketFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'airline_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'itinerary_invoiced_ticket_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'tickets_sales_destiny_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'tickets_sales_route_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'fulfillment_branch_office_goal_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'boleto' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => null),
		'ruta' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 80, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'destino' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'pasajero' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tarifa' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '12,2', 'unsigned' => false),
		'fee' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'complemento' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'coorrelativo_comprobante' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipo_documento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sucursal' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_reference_14' => array('column' => 'itinerary_invoiced_ticket_id', 'unique' => 0),
			'fk_reference_15' => array('column' => 'tickets_sales_destiny_id', 'unique' => 0),
			'fk_reference_16' => array('column' => 'tickets_sales_route_id', 'unique' => 0),
			'fk_reference_20' => array('column' => 'fulfillment_branch_office_goal_id', 'unique' => 0),
			'fk_reference_8' => array('column' => 'airline_id', 'unique' => 0)
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
			'itinerary_invoiced_ticket_id' => 1,
			'tickets_sales_destiny_id' => 1,
			'tickets_sales_route_id' => 1,
			'fulfillment_branch_office_goal_id' => 1,
			'boleto' => 'Lorem ip',
			'fecha' => '2015-06-13',
			'ruta' => 'Lorem ipsum dolor sit amet',
			'destino' => 'L',
			'pasajero' => 'Lorem ipsum dolor sit amet',
			'tarifa' => '',
			'fee' => 1,
			'complemento' => 1,
			'coorrelativo_comprobante' => 1,
			'tipo_documento' => 'Lorem ipsum dolor sit amet',
			'sucursal' => 'Lorem ipsum d'
		),
	);

}
