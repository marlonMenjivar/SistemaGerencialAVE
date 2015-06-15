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
		
public function boletosPorDestinoSemanal() {
        //Lee las lista de aerolíneas
        $airlines = $this->Airline->find('list');
        //Manda lista de airlines a la vista
        $this->set(compact('airlines'));
        
        
        //Al darle click al botón generar (envio de formulario)
        if ($this->request->is(array('post', 'put'))) {
            
            //Lee el id de la aerolinea enviado en el request
            $id=$this->request->data["TicketDestiny"]['airline_id'];
            
            //Lee la fecha de inicio enviada en el request
            $fechainicio = $this->request->data["TicketDestiny"]['fecha_inicio'];
            
            //Lee la fecha final enviada en el request
            $fechafin = $this->request->data["TicketDestiny"]['fecha_fin'];
            
            //Ejecuta la consulta de boletos por destino por aerolinea
            $consultaDestino = "SELECT it.destino, count(it.boleto) as boletos_destino, sum(it.tarifa) as total_destino, " 
                . "iit.nombre_ciudad2 as ciudad_destino, iit.pais2 as pais_destino " 
                . "FROM invoiced_tickets it INNER JOIN itinerary_invoiced_tickets iit ON it.itinerary_invoiced_ticket_id = iit.id "
                . "WHERE it.airline_id = ".$id." AND it.fecha BETWEEN '".$fechainicio."' AND '".$fechafin."' GROUP BY destino ORDER BY destino;";
            
            //Carga el modelo de boletos facturados
            $this->loadModel('InvoicedTicket');
            
            $consultaDestinos=$this->InvoicedTicket->query($consultaDestino);
            
            $this->set('consultaDestinos',$consultaDestinos);
        }
	}
    
    //Funcion que guarda el registro del reporte por destino
    public function guardardestinos($airline_id=null,
                        $fecha_inicio=null,
                        $fecha_final=null,
                        $boletos_destinos=null,
                        $total_destino=null,
                        $arrayConsultaDestinos=null) {
		if ($this->request->is(array('post'))) {
			//Guarda en la tabla de boletos por destinos
            $query="INSERT INTO tickets_sales_destinies( linea_aerea_destino, fecha_inicio_destino, fecha_final_destino)"
                . " VALUES (".$airline_id.", '".$fecha_inicio."', '".$fecha_final."');";
                        $this->TicketsSalesDestiny->query($query);
                        $this->Session->setFlash('Reporte registrado');
                        return $this->redirect(array('action' => 'boletosPorDestinoSemanal'));
		}
                else{
                    $this->Session->setFlash('Método no soportado.');
                }
	}
	
}