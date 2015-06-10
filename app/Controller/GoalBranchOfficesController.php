<?php
App::uses('AppController', 'Controller');
/**
 * GoalBranchOffices Controller
 *
 * @property GoalBranchOffice $GoalBranchOffice
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GoalBranchOfficesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');
        public $paginate=array(
            'limit'=>10,
            'order'=>array('GoalBranchOfficesController.id'=>'asc')
        );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GoalBranchOffice->recursive = 0;
		$this->set('goalBranchOffices', $this->paginate());
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
			throw new NotFoundException(__('Meta por sucursal Inválida'));
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
				$this->Session->setFlash(__('La meta por sucursal fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La meta por sucursal no se guardó. Por favor, intente de nuevo.'));
			}
		}
		$branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
		$this->set(compact('branchOffices'));
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
			throw new NotFoundException(__('Meta por sucursal inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GoalBranchOffice->save($this->request->data)) {
				$this->Session->setFlash(__('La meta por sucursal fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La meta por sucursal no se guardó. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('GoalBranchOffice.' . $this->GoalBranchOffice->primaryKey => $id));
			$this->request->data = $this->GoalBranchOffice->find('first', $options);
		}
		$branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
		$this->set(compact('branchOffices'));
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
			throw new NotFoundException(__('Meta por sucursal inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->GoalBranchOffice->delete()) {
			$this->Session->setFlash(__('La meta por sucursal fue eliminada.'));
		} else {
			$this->Session->setFlash(__('La meta por sucursal no pudo ser eliminada. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
