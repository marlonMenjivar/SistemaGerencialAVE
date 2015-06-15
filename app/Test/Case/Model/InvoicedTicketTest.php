<?php
App::uses('InvoicedTicket', 'Model');

/**
 * InvoicedTicket Test Case
 *
 */
class InvoicedTicketTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invoiced_ticket'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvoicedTicket = ClassRegistry::init('InvoicedTicket');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvoicedTicket);

		parent::tearDown();
	}

}
