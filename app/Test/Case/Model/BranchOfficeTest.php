<?php
App::uses('BranchOffice', 'Model');

/**
 * BranchOffice Test Case
 *
 */
class BranchOfficeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.branch_office'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BranchOffice = ClassRegistry::init('BranchOffice');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BranchOffice);

		parent::tearDown();
	}

}
