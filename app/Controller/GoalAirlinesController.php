<?php
App::uses('AppController', 'Controller');
/**
 * GoalAirlines Controller
 *
 * @property GoalAirline $GoalAirline
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GoalAirlinesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');

         public $paginate=array(
            'limit'=>10,
            'order'=>array('GoalAirline.id'=>'asc')
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GoalAirline->recursive = 0;
		$this->set('goalAirlines', $this->paginate());
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
			throw new NotFoundException(__('Meta Inválida'));
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
				$this->Session->setFlash(__('La meta fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La meta no pudo ser guardada. Por favor, intente de nuevo.'));
			}
		}
		$airlines = $this->GoalAirline->Airline->find('list');
		$this->set(compact('airlines'));
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
			throw new NotFoundException(__('Meta Inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GoalAirline->save($this->request->data)) {
				$this->Session->setFlash(__('La meta fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La meta no pudo ser guardada. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('GoalAirline.' . $this->GoalAirline->primaryKey => $id));
			$this->request->data = $this->GoalAirline->find('first', $options);
		}
		$airlines = $this->GoalAirline->Airline->find('list');
		$this->set(compact('airlines'));
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
			throw new NotFoundException(__('Meta Inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->GoalAirline->delete()) {
			$this->Session->setFlash(__('La meta fue eliminada.'));
		} else {
			$this->Session->setFlash(__('La meta no pudo ser eliminada. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
