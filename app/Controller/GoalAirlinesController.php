<?php
App::uses('AppController', 'Controller');
/**
 * GoalAirlines Controller
 *
 * @property GoalAirline $GoalAirline
 * @property PaginatorComponent $Paginator
 */
class GoalAirlinesController extends AppController {

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
		$this->GoalAirline->recursive = 0;
		$this->set('goalAirlines', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GoalAirline->exists($id)) {
			throw new NotFoundException(__('Invalid goal airline'));
		}
		$options = array('conditions' => array('GoalAirline.' . $this->GoalAirline->primaryKey => $id));
		$this->set('goalAirline', $this->GoalAirline->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GoalAirline->create();
			if ($this->GoalAirline->save($this->request->data)) {
				$this->Session->setFlash(__('The goal airline has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal airline could not be saved. Please, try again.'));
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
		if (!$this->GoalAirline->exists($id)) {
			throw new NotFoundException(__('Invalid goal airline'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GoalAirline->save($this->request->data)) {
				$this->Session->setFlash(__('The goal airline has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal airline could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GoalAirline.' . $this->GoalAirline->primaryKey => $id));
			$this->request->data = $this->GoalAirline->find('first', $options);
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
		$this->GoalAirline->id = $id;
		if (!$this->GoalAirline->exists()) {
			throw new NotFoundException(__('Invalid goal airline'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->GoalAirline->delete()) {
			$this->Session->setFlash(__('The goal airline has been deleted.'));
		} else {
			$this->Session->setFlash(__('The goal airline could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
