<?php
App::uses('AppController', 'Controller');
/**
 * BranchOffices Controller
 *
 * @property BranchOffice $BranchOffice
 * @property PaginatorComponent $Paginator
 */
class BranchOfficesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	//public $components = array('Paginator');
    public $paginate=array(
        'limit'=>10,
        'order'=>array('User.id'=>'asc')
    );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BranchOffice->recursive = 0;
		$this->set('branchOffices', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BranchOffice->exists($id)) {
			throw new NotFoundException(__('Sucursal Inválida'));
		}
		$options = array('conditions' => array('BranchOffice.' . $this->BranchOffice->primaryKey => $id));
		$this->set('branchOffice', $this->BranchOffice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BranchOffice->create();
			if ($this->BranchOffice->save($this->request->data)) {
				$this->Session->setFlash(__('La sucursal fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La sucursal no fue guardad. Por favor intente de nuevo.'));
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
		if (!$this->BranchOffice->exists($id)) {
			throw new NotFoundException(__('Sucursal Inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BranchOffice->save($this->request->data)) {
				$this->Session->setFlash(__('La sucursal fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La sucursal no pudo ser guardad. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('BranchOffice.' . $this->BranchOffice->primaryKey => $id));
			$this->request->data = $this->BranchOffice->find('first', $options);
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
		$this->BranchOffice->id = $id;
		if (!$this->BranchOffice->exists()) {
			throw new NotFoundException(__('Sucursal Inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BranchOffice->delete()) {
			$this->Session->setFlash(__('La sucursal fue eliminada.'));
		} else {
			$this->Session->setFlash(__('La sucursal no fue eliminada. Porfavor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
