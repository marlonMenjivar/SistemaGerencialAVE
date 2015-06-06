<?php
App::uses('GoalAirline', 'Model');

/**
 * GoalAirline Test Case
 *
 */
class GoalAirlineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.goal_airline'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GoalAirline = ClassRegistry::init('GoalAirline');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GoalAirline);

		parent::tearDown();
	}

}
