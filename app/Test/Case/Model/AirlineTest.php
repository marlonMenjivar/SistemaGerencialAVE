<?php
App::uses('Airline', 'Model');

/**
 * Airline Test Case
 *
 */
class AirlineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.airline',
		'app.goal_airline'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Airline = ClassRegistry::init('Airline');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Airline);

		parent::tearDown();
	}

}
