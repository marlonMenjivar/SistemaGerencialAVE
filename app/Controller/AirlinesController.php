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
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('airline_id',$id);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
	}
    //Reporte Excel
    public function boletosPorDestinoSemanalReporteExcel() {
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
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('airline_id',$id);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
    }
    //Reporte pdf
    public function boletosPorDestinoSemanalReportePdf() {
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
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('airline_id',$id);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
    }
    
    //Funcion que guarda el registro del reporte por destino
    public function guardarDestinos() {
        //Carga los datos del formulario oculto 'guarda_destinos'
		if ($this->request->is(array('post'))):
            $airline_id = $this->request->data['guarda_destinos']['airline_id'];
            $fecha_inicio = $this->request->data['guarda_destinos']['fecha_inicio'];
            $fecha_fin = $this->request->data['guarda_destinos']['fecha_fin'];
            $boletos_destinos = $this->request->data['guarda_destinos']['boletos_destino'];
            $total_destino = $this->request->data['guarda_destinos']['total_destino'];
        
            //Carga el modelo de las ventas por destinos
            $this->loadModel('TicketsSalesDestiny');
        
			//Guarda en la tabla venta de boletos por destinos
            $query="INSERT INTO tickets_sales_destinies( linea_aerea_destino, fecha_inicio_destino, fecha_final_destino)"
                . " VALUES (".$airline_id.", '".$fecha_inicio."', '".$fecha_fin."');";
            $this->TicketsSalesDestiny->query($query);
        
            //Obtiene el correlativo de los datos guardados en la tabla venta de boletos por destinos
            $query = $this->TicketsSalesDestiny->find('all', 
            array('fields' => 'MAX(TicketsSalesDestiny.id) id'));
            $tickets_sales_destiny_id = $query[0][0]['id'];
            
            //Guarda los datos totales de los boletos por destinos en la tabla destinies
            $this->loadModel('Destiny');
            $query = $this->Destiny->query("
            INSERT INTO destinies (tickets_sales_destiny_id, destino, boletos_destino, total_destino)
            SELECT ".$tickets_sales_destiny_id.", destino, count(boleto) boletos_destino, sum(tarifa) total_destino " 
                . "FROM invoiced_tickets "
                . "WHERE airline_id = ".$airline_id." AND fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' group by destino;");
            
            //Actualiza el código de ventas de boletos por destino en la tabla de boeltos facturados
            $this->loadModel('InvoicedTicket');
            $query = $this->InvoicedTicket->query("UPDATE 
            invoiced_tickets set tickets_sales_destiny_id = 
            ".$tickets_sales_destiny_id." WHERE airline_id = ".$airline_id." AND 
            fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");

            $this->Session->setFlash('Reporte de boletos por destino registrado');
            return $this->redirect(array('action' => 'boletosPorDestinoSemanal'));
        else:
            $this->Session->setFlash('Método no soportado.');
        endif;
	}

    public function boletosPorRutaSemanal() {
        //Lee las lista de aerolíneas
        $airlines = $this->Airline->find('list');
        //Manda lista de airlines a la vista
        $this->set(compact('airlines'));
        
        
        //Al darle click al botón generar (envio de formulario)
        if ($this->request->is(array('post', 'put'))) {
            
            //Lee el id de la aerolinea enviado en el request
            $id=$this->request->data["TicketRoute"]['airline_id'];
            
            //Lee la fecha de inicio enviada en el request
            $fechainicio = $this->request->data["TicketRoute"]['fecha_inicio'];
            
            //Lee la fecha final enviada en el request
            $fechafin = $this->request->data["TicketRoute"]['fecha_fin'];
            
            //Ejecuta la consulta de boletos por ruta por aerolinea
            $consultaRuta = "SELECT it.ruta, count(it.boleto) as boletos_ruta, sum(it.tarifa) as total_ruta, " 
                . "iit.nombre_ciudad1 as ciudad_origen, iit.pais1 as pais_origen, "
                . "iit.nombre_ciudad2 as ciudad_destino, iit.pais2 as pais_destino " 
                . "FROM invoiced_tickets it INNER JOIN itinerary_invoiced_tickets iit ON it.itinerary_invoiced_ticket_id = iit.id "
                . "WHERE it.airline_id = ".$id." AND it.fecha BETWEEN '".$fechainicio."' AND '".$fechafin."' GROUP BY ruta ORDER BY ruta;";
            
            //Carga el modelo de boletos facturados
            $this->loadModel('InvoicedTicket');
            
            $consultaRutas=$this->InvoicedTicket->query($consultaRuta);
            
            $this->set('consultaRutas',$consultaRutas);
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('airline_id',$id);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
	}
        //Reporte excel
      public function boletosPorRutaSemanalReporteExcel() {
        //Lee las lista de aerolíneas
        $airlines = $this->Airline->find('list');
        //Manda lista de airlines a la vista
        $this->set(compact('airlines'));
        
        
        //Al darle click al botón generar (envio de formulario)
        if ($this->request->is(array('post', 'put'))) {
            
            //Lee el id de la aerolinea enviado en el request
            $id=$this->request->data["TicketRoute"]['airline_id'];
            
            //Lee la fecha de inicio enviada en el request
            $fechainicio = $this->request->data["TicketRoute"]['fecha_inicio'];
            
            //Lee la fecha final enviada en el request
            $fechafin = $this->request->data["TicketRoute"]['fecha_fin'];
            
            //Ejecuta la consulta de boletos por ruta por aerolinea
            $consultaRuta = "SELECT it.ruta, count(it.boleto) as boletos_ruta, sum(it.tarifa) as total_ruta, " 
                . "iit.nombre_ciudad1 as ciudad_origen, iit.pais1 as pais_origen, "
                . "iit.nombre_ciudad2 as ciudad_destino, iit.pais2 as pais_destino " 
                . "FROM invoiced_tickets it INNER JOIN itinerary_invoiced_tickets iit ON it.itinerary_invoiced_ticket_id = iit.id "
                . "WHERE it.airline_id = ".$id." AND it.fecha BETWEEN '".$fechainicio."' AND '".$fechafin."' GROUP BY ruta ORDER BY ruta;";
            
            //Carga el modelo de boletos facturados
            $this->loadModel('InvoicedTicket');
            
            $consultaRutas=$this->InvoicedTicket->query($consultaRuta);
            
            $this->set('consultaRutas',$consultaRutas);
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('airline_id',$id);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
    }
        //Reporte Pdf
      public function boletosPorRutaSemanalReportePdf() {
        //Lee las lista de aerolíneas
        $airlines = $this->Airline->find('list');
        //Manda lista de airlines a la vista
        $this->set(compact('airlines'));
        
        
        //Al darle click al botón generar (envio de formulario)
        if ($this->request->is(array('post', 'put'))) {
            
            //Lee el id de la aerolinea enviado en el request
            $id=$this->request->data["TicketRoute"]['airline_id'];
            
            //Lee la fecha de inicio enviada en el request
            $fechainicio = $this->request->data["TicketRoute"]['fecha_inicio'];
            
            //Lee la fecha final enviada en el request
            $fechafin = $this->request->data["TicketRoute"]['fecha_fin'];
            
            //Ejecuta la consulta de boletos por ruta por aerolinea
            $consultaRuta = "SELECT it.ruta, count(it.boleto) as boletos_ruta, sum(it.tarifa) as total_ruta, " 
                . "iit.nombre_ciudad1 as ciudad_origen, iit.pais1 as pais_origen, "
                . "iit.nombre_ciudad2 as ciudad_destino, iit.pais2 as pais_destino " 
                . "FROM invoiced_tickets it INNER JOIN itinerary_invoiced_tickets iit ON it.itinerary_invoiced_ticket_id = iit.id "
                . "WHERE it.airline_id = ".$id." AND it.fecha BETWEEN '".$fechainicio."' AND '".$fechafin."' GROUP BY ruta ORDER BY ruta;";
            
            //Carga el modelo de boletos facturados
            $this->loadModel('InvoicedTicket');
            
            $consultaRutas=$this->InvoicedTicket->query($consultaRuta);
            
            $this->set('consultaRutas',$consultaRutas);
            $this->set('airlineaNombre',$airlines[$id]);
            $this->set('fechainicio',$fechainicio);
            $this->set('fechafin',$fechafin);
            $this->Session->setFlash('Datos leidos');
        }
    }
    
    //Funcion que guarda el registro del reporte por ruta
    public function guardarRutas() {
        //Carga los datos del formulario oculto 'guarda_rutas'
		if ($this->request->is(array('post'))):
            $airline_id = $this->request->data['guarda_rutas']['airline_id'];
            $fecha_inicio = $this->request->data['guarda_rutas']['fecha_inicio'];
            $fecha_fin = $this->request->data['guarda_rutas']['fecha_fin'];
            $boletos_rutas = $this->request->data['guarda_rutas']['boletos_ruta'];
            $total_ruta = $this->request->data['guarda_rutas']['total_ruta'];
        
            //Carga el modelo de las ventas por rutas
            $this->loadModel('TicketsSalesRoute');
        
			//Guarda en la tabla venta de boletos por rutas
            $query="INSERT INTO tickets_sales_routes(linea_aerea_ruta, fecha_inicio_ruta, fecha_final_ruta)"
                . " VALUES (".$airline_id.", '".$fecha_inicio."', '".$fecha_fin."');";
            $this->TicketsSalesRoute->query($query);
        
            //Obtiene el correlativo de los datos guardados en la tabla venta de boletos por ruta
            $query = $this->TicketsSalesRoute->find('all', 
            array('fields' => 'MAX(TicketsSalesRoute.id) id'));
            $tickets_sales_route_id = $query[0][0]['id'];
            
            //Guarda los datos totales de los boletos por ruta en la tabla routes
            $this->loadModel('Route');
            $query = $this->Route->query("
            INSERT INTO routes (tickets_sales_route_id, ruta, boletos_ruta, total_ruta)
            SELECT ".$tickets_sales_route_id.", ruta, count(boleto) boletos_ruta, sum(tarifa) total_ruta " 
                . "FROM invoiced_tickets "
                . "WHERE airline_id = ".$airline_id." AND fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' group by ruta;");
            
            //Actualiza el código de ventas de boletos por ruta en la tabla de boletos facturados
            $this->loadModel('InvoicedTicket');
            $query = $this->InvoicedTicket->query("UPDATE 
            invoiced_tickets set tickets_sales_route_id = 
            ".$tickets_sales_route_id." WHERE airline_id = ".$airline_id." AND 
            fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");

            $this->Session->setFlash('Reporte de boletos por ruta registrado');
            return $this->redirect(array('action' => 'boletosPorRutaSemanal'));
        else:
            $this->Session->setFlash('Método no soportado.');
        endif;
	}
    
	public function imprimir() {
		$this->layout = 'imprimir';
		$this->loadModel('InvoicedTicket');
		$this->set(array(
			'aereolinea' => $this->request->data['imprimir']['aereolinea'],
			'fecha_inicio' => $this->request->data['imprimir']['fecha_inicio'],
			'fecha_fin' => $this->request->data['imprimir']['fecha_fin'],
			'boletos_destino' => $this->request->data['imprimir']['boletos_destino'],
			'total_destino' => $this->request->data['imprimir']['total_destino'],
			'consulta_destinos' => $this->InvoicedTicket->query(	//	método de creación de query para evitar inyección sql
				'SELECT it.destino, count(it.boleto) boletos_destino, sum(it.tarifa) total_destino, iit.nombre_ciudad2 ciudad_destino, iit.pais2 pais_destino
				FROM invoiced_tickets it INNER JOIN itinerary_invoiced_tickets iit ON it.itinerary_invoiced_ticket_id = iit.id
				WHERE it.airline_id = ? AND it.fecha BETWEEN ? AND ? GROUP BY destino ORDER BY destino',
				array(
					$this->request->data['imprimir']['airline_id'],
					$this->request->data['imprimir']['fecha_inicio'],
					$this->request->data['imprimir']['fecha_fin']
				)
			),
			'nombre_reporte' => 'SEMI-RESUMEN VENTA DE BOLETOS POR LÍNEAS AÉREAS POR DESTINO SEMANAL'
		));
	}
}