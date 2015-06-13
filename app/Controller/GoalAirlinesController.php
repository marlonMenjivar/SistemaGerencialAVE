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
        public function comparativoMetasAerolinea() {
                //Lee la lista de aerolíneas
                $airlines = $this->GoalAirline->Airline->find('list');
		//manda lista a vista
                $this->set(compact('airlines'));
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {
                    
                    //Saca el id del request
                    $id=$this->request->data["GoalAirline"]['airline_id'];
                    
                    //Saca la fecha del request
                    $fecha=$this->request->data["GoalAirline"]['fecha_inicio'];
                  
                    //ejecuta consulta de metas para aerolínea y por fecha
                    $queryConsultaMetas="SELECT * FROM `goal_airlines` as GoalAirline "
                            . "WHERE `fecha_inicio`<='".$fecha."' and `fecha_fin`>='".$fecha."' and airline_id=".$id;
                    $consultaMetas=$this->GoalAirline->query($queryConsultaMetas);
                    
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                    else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                    
                        //Manda el array consultaMetas a la vista
                        $this->set('consultaMetas',$consultaMetas[0]);
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Sacando fechas de inicio y fin de resultado de query de metas para consulta
                        $fecha_inicio=$consultaMetas[0]['GoalAirline']['fecha_inicio'];
                        $fecha_fin=$consultaMetas[0]['GoalAirline']['fecha_fin'];
                        
                        //Si encuentra meta ejecuta consulta de boletos por aerolínea y por fecha
                        $consultaBoletos=""
                            . " SELECT * from invoiced_tickets"
                            . " WHERE airline_id=".$id." and "
                                . "fecha between '".$fecha_inicio."' and '".$fecha_fin."'";
                        //Carga modelo
                        $this->loadModel('InvoicedTicket');
                        
                        $consultaBoletos=$this->InvoicedTicket->query($consultaBoletos);

                        $this->set('consultaBoletos',$consultaBoletos);
                    endif;                    
		}
	}
}
