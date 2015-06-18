<?php
App::uses('GoalBranchOffice', 'Model');

/**
 * GoalBranchOffice Test Case
 *
 */
class GoalBranchOfficeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.goal_branch_office',
		'app.branch_office'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GoalBranchOffice = ClassRegistry::init('GoalBranchOffice');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GoalBranchOffice);

		parent::tearDown();
	}

}
