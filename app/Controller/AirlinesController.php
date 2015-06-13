<?php
App::uses('AppController', 'Controller');
/**
 * Airlines Controller
 *
 * @property Airline $Airline
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AirlinesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');
        public $paginate=array(
            'limit'=>10,
            'order'=>array('Airline.id'=>'asc')
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Airline->recursive = 0;
		$this->set('airlines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Airline->exists($id)) {
			throw new NotFoundException(__('Aerolínea Inválida'));
		}
		$options = array('conditions' => array('Airline.' . $this->Airline->primaryKey => $id));
		$this->set('airline', $this->Airline->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Airline->create();
			if ($this->Airline->save($this->request->data)) {
				$this->Session->setFlash(__('La aerolínea fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La aerolínea no pudo ser guardada. Por Favor, intente de nuevo.'));
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
		if (!$this->Airline->exists($id)) {
			throw new NotFoundException(__('Aerolínea Inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Airline->save($this->request->data)) {
				$this->Session->setFlash(__('La aerolínea fue guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La aerolínea no pudo ser guardada. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Airline.' . $this->Airline->primaryKey => $id));
			$this->request->data = $this->Airline->find('first', $options);
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
		$this->Airline->id = $id;
		if (!$this->Airline->exists()) {
			throw new NotFoundException(__('Aerolínea Inválida'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Airline->delete()) {
			$this->Session->setFlash(__('La aerolínea fue eliminada.'));
		} else {
			$this->Session->setFlash(__('La aerolínea no pudo ser eliminada. Por favor, intenten de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function nombres(){
            $airlines = $this->Airline->find('list');
            if($this->request->is('requested')):
                return $airlines;
            endif;
        }
}