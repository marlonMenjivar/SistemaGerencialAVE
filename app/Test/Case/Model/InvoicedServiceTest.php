<?php
App::uses('InvoicedService', 'Model');

/**
 * InvoicedService Test Case
 *
 */
class InvoicedServiceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invoiced_service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvoicedService = ClassRegistry::init('InvoicedService');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvoicedService);

		parent::tearDown();
	}

}
