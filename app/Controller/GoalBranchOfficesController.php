<?php
App::uses('AppController', 'Controller');
/**
 * GoalBranchOffices Controller
 *
 * @property GoalBranchOffice $GoalBranchOffice
 * @property PaginatorComponent $Paginator
 */
class GoalBranchOfficesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GoalBranchOffice->recursive = 0;
		$this->set('goalBranchOffices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GoalBranchOffice->exists($id)) {
			throw new NotFoundException(__('Invalid goal branch office'));
		}
		$options = array('conditions' => array('GoalBranchOffice.' . $this->GoalBranchOffice->primaryKey => $id));
		$this->set('goalBranchOffice', $this->GoalBranchOffice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GoalBranchOffice->create();
			if ($this->GoalBranchOffice->save($this->request->data)) {
				$this->Session->setFlash(__('The goal branch office has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal branch office could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GoalBranchOffice->exists($id)) {
			throw new NotFoundException(__('Invalid goal branch office'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GoalBranchOffice->save($this->request->data)) {
				$this->Session->setFlash(__('The goal branch office has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal branch office could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GoalBranchOffice.' . $this->GoalBranchOffice->primaryKey => $id));
			$this->request->data = $this->GoalBranchOffice->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GoalBranchOffice->id = $id;
		if (!$this->GoalBranchOffice->exists()) {
			throw new NotFoundException(__('Invalid goal branch office'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->GoalBranchOffice->delete()) {
			$this->Session->setFlash(__('The goal branch office has been deleted.'));
		} else {
			$this->Session->setFlash(__('The goal branch office could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
