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
	public $helpers = array('Html', 'Form', 'Time');

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
                    $this->Session->setFlash(__('Datos leídos'));
                    
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
                    $this->set('airline_id',$id);
                    $this->set('fecha',$fecha);
                    $this->set('airlineaNombre',$airlines[$id]);
                endif;                    
		}
	}

    public function comparativoMetasAerolineaReporteExcel() {
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
                    $this->Session->setFlash(__('Datos leídos'));
                    
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
                    $this->set('airline_id',$id);
                    $this->set('fecha',$fecha);
                    $this->set('airlineaNombre',$airlines[$id]);
                endif;                    
        }
    }

    public function comparativoMetasAerolineaReportePdf() {
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
                    $this->Session->setFlash(__('Datos leídos'));
                    
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
                    $this->set('fecha',$fecha);
                    $this->set('airlineaNombre',$airlines[$id]);
                endif;                    
        }
    }

        public function editar($id=null,
                        $boletos_periodo=null,
                        $total_periodo=null,
                        $faltante=null,
                        $porcentajeFaltante=null,
                        $ingresoPorComision=null) {
            if (!$this->GoalAirline->exists($id)) {
			throw new NotFoundException(__('Meta Inválida'));
		}
		if ($this->request->is(array('post'))) {
			$query="UPDATE `goal_airlines` 
                                SET `total_periodo`= ".$total_periodo.",".
                                    "`faltante`= ".$faltante.",".
                                    "`boletos_periodo`= ".$boletos_periodo.",".
                                    "`porcentaje`= ".$porcentajeFaltante.",".
                                    "`ingreso_comision`= ".$ingresoPorComision." "
                                    . "where id= ".$id.";";
                        $this->GoalAirline->query($query);
                        $this->Session->setFlash('Meta Actualizada');
                        return $this->redirect(array('action' => 'comparativoMetasAerolinea'));
		}
                else{
                    $this->Session->setFlash('Método no soportado.');
                }
	}

        // Acumulado venta de boletos aéreos por líneas aéreas mensual
        public function ventaBoletoAereosMensual() {
            
            //Si el formulario se envió
            if ($this->request->is(array('post', 'put'))) {
                //Saca la fecha año del request
                $fechaAnio=$this->request->data["GoalAirline"]['fecha_anio'];
                //Saca la fecha mes del request
                $fechaMes=$this->request->data["GoalAirline"]['fecha_mes'];
                //Saca la fecha del request
                $fechaInicio=$this->request->data["GoalAirline"]['fecha_inicio'];
                //Saca la fecha del request
                $fechaFin=$this->request->data["GoalAirline"]['fecha_fin'];
                
                //ejecuta consulta de boletos vendidos para aerolínea por Mes
                $queryConsultaVentas="SELECT airline_id, name, fecha_inicio, fecha_fin, boletos_periodo, total_periodo "
                        . "FROM goal_airlines, airlines WHERE goal_airlines.airline_id = airlines.id AND  fecha_inicio = '". $fechaInicio . "' AND fecha_fin = '". $fechaFin . "'AND goal_airlines.boletos_periodo <> 0 ORDER BY goal_airlines.airline_id;";
                $consultaVentas=$this->GoalAirline->query($queryConsultaVentas);
                
                //Si la consulta retorna vacía
                if(empty($consultaVentas)):
                    $this->Session->setFlash(__('No se encontro registros de boletos vendidos de aerolínea para este mes. '));
                //Si encuentra la meta
                else:
                    $this->set('consultaVentas',$consultaVentas);   
                    $this->set('fechaInicio',$fechaInicio);
                    $this->set('fechaFin',$fechaFin);
                    $this->set('fechaAnio',$fechaAnio);
                    $this->set('fechaMes',$fechaMes);
                endif;                    
            }
        }


        // Acumulado venta de boletos aéreos por líneas aéreas mensual
        public function ventaBoletoAereosMensualReporteExcel() {
            //Lee la lista de aerolíneas
            $airlines = $this->GoalAirline->Airline->find('list');
            //manda lista a vista
            $this->set(compact('airlines'));
            
            //Si el formulario se envió
            if ($this->request->is(array('post', 'put'))) {                    
                //Saca la fecha año del request
                $fechaAnio=$this->request->data["reporte_excel"]['fecha_anio'];
                //Saca la fecha mes del request
                $fechaMes=$this->request->data["reporte_excel"]['fecha_mes'];
                //Saca la fecha inicio del request
                $fechaInicio=$this->request->data["reporte_excel"]['fecha_inicio'];
                //Saca la fecha fin del request
                $fechaFin=$this->request->data["reporte_excel"]['fecha_fin'];
                
                //ejecuta consulta de boletos vendidos para aerolínea por Mes
                $queryConsultaVentas="SELECT name, fecha_inicio, fecha_fin, boletos_periodo, total_periodo "
                        . "FROM goal_airlines, airlines WHERE goal_airlines.airline_id = airlines.id AND fecha_inicio = '". $fechaInicio . "' AND fecha_fin = '". $fechaFin . "' ORDER BY airline_id;";
                $consultaVentas=$this->GoalAirline->query($queryConsultaVentas);
                
                //Si la consulta retorna vacía
                if(empty($consultaVentas)):
                    $this->Session->setFlash(__('No encontrada boletos vendidos de aerolínea para este mes. '));
                //Si encuentra la meta
                else:
                    $this->set('consultaVentas',$consultaVentas);
                    $this->set('fechaAnio',$fechaAnio);
                    $this->set('fechaMes',$fechaMes);
                endif;                    
            }
        }

        // Acumulado venta de boletos aéreos por líneas aéreas mensual
        public function ventaBoletoAereosMensualReportePdf() {
            //Lee la lista de aerolíneas
            $airlines = $this->GoalAirline->Airline->find('list');
            //manda lista a vista
            $this->set(compact('airlines'));
            
            //Si el formulario se envió
            if ($this->request->is(array('post', 'put'))) {                    
                //Saca la fecha año del request
                $fechaAnio=$this->request->data["reporte_pdf"]['fecha_anio'];
                //Saca la fecha mes del request
                $fechaMes=$this->request->data["reporte_pdf"]['fecha_mes'];
                //Saca la fecha inicio del request
                $fechaInicio=$this->request->data["reporte_pdf"]['fecha_inicio'];
                //Saca la fecha fin del request
                $fechaFin=$this->request->data["reporte_pdf"]['fecha_fin'];
                
                //ejecuta consulta de boletos vendidos para aerolínea por Mes
                $queryConsultaVentas="SELECT name, fecha_inicio, fecha_fin, boletos_periodo, total_periodo "
                        . "FROM goal_airlines, airlines WHERE goal_airlines.airline_id = airlines.id AND fecha_inicio = '". $fechaInicio . "' AND fecha_fin = '". $fechaFin . "' ORDER BY airline_id;";
                $consultaVentas=$this->GoalAirline->query($queryConsultaVentas);
                
                //Si la consulta retorna vacía
                if(empty($consultaVentas)):
                    $this->Session->setFlash(__('No encontrada boletos vendidos de aerolínea para este mes. '));
                //Si encuentra la meta
                else:
                    $this->set('consultaVentas',$consultaVentas);
                    $this->set('fechaAnio',$fechaAnio);
                    $this->set('fechaMes',$fechaMes);
                endif;                    
            }
        }


	public function imprimir() {
		$this->layout = 'imprimir';
		$this->loadModel('InvoicedTicket');
		$this->set(array(
			'aereolinea' => $this->request->data['imprimir']['aereolinea'],
			'fecha' => $this->request->data['imprimir']['fecha'],
			'meta_bsp' => $this->request->data['imprimir']['meta_bsp'],
			'comision' => $this->request->data['imprimir']['comision'],
			'servicios_periodo_sucursal' => $this->request->data['imprimir']['servicios_periodo_sucursal'],
			'total_periodo' => $this->request->data['imprimir']['total_periodo'],
			'faltante' => $this->request->data['imprimir']['faltante'],
			'porcentaje_faltante' => $this->request->data['imprimir']['porcentaje_faltante'],
			'ingreso_comision' => $this->request->data['imprimir']['ingreso_comision'],
			'consulta_boletos' => $this->InvoicedTicket->query(	//	método de creación de query para evitar inyección sql
				'SELECT * FROM invoiced_tickets InvoicedTicket WHERE InvoicedTicket.airline_id = ? AND InvoicedTicket.fecha BETWEEN ? AND ?',
				array(
					$this->request->data['imprimir']['airline_id'],
					$this->request->data['imprimir']['fecha_inicio'],
					$this->request->data['imprimir']['fecha_fin']
				)
			),
			'nombre_reporte' => 'COMPARATIVO DE CUMPLIMIENTO DE METAS POR LÍNEA AÉREA POR PERIODO BSP'
		));
	}
}
