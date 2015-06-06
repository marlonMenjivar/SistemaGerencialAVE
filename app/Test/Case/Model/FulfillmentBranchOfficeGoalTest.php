<?php
App::uses('FulfillmentBranchOfficeGoal', 'Model');

/**
 * FulfillmentBranchOfficeGoal Test Case
 *
 */
class FulfillmentBranchOfficeGoalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fulfillment_branch_office_goal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FulfillmentBranchOfficeGoal = ClassRegistry::init('FulfillmentBranchOfficeGoal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FulfillmentBranchOfficeGoal);

		parent::tearDown();
	}

}
