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
        public function comparativoMetas() {
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);

                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para aerolínea y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaBoletos=""
                            . " SELECT * from invoiced_tickets"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedTicket');
                        
                        $consultaBoletos=$this->InvoicedTicket->query($consultaBoletos);

                        $this->set('consultaBoletos',$consultaBoletos);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);

                endif;
            }
        }

        //Reporte excel
  public function comparativoMetasReporteExcel() {
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);
                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para aerolínea y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaBoletos=""
                            . " SELECT * from invoiced_tickets"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedTicket');
                        
                        $consultaBoletos=$this->InvoicedTicket->query($consultaBoletos);

                        $this->set('consultaBoletos',$consultaBoletos);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);


                endif;
            }
        }
       
            //Reporte pdf
          public function comparativoMetasReportePdf() {
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);
                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para aerolínea y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaBoletos=""
                            . " SELECT * from invoiced_tickets"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedTicket');
                        
                        $consultaBoletos=$this->InvoicedTicket->query($consultaBoletos);

                        $this->set('consultaBoletos',$consultaBoletos);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);
                endif;
            }
        }

        public function editar($id=null,
                        $boletos_periodo=null,
                        $total_periodo=null,
                        $faltante=null,
                        $porcentajeFaltante=null,
                        $mes=null,
                        $idSucursal=null) {
            //El id que se recibe acá es el id de la meta
            //Sucursal -> Meta -> Cumplimiento de meta
            $this->loadModel('FulfillmentBranchOfficeGoal');
		if ($this->request->is(array('post'))):
			$query="UPDATE `fulfillment_branch_office_goals` 
                                SET `total_boletos`= ".$total_periodo.",".
                                    "`faltante_boletos`= ".$faltante.",".
                                    "`cantidad_boletos`= ".$boletos_periodo.",".
                                    "`porcentaje_boletos`= ".$porcentajeFaltante." "
                                    . "WHERE goal_branch_office_id= ".$id." and "
                                . "EXTRACT(MONTH from fecha_inicio) = '".$mes."';";
                        
                        $this->FulfillmentBranchOfficeGoal->query($query);
                        
                        //Consulta el id de el cumplimiento de meta actualizado
                        $query2="SELECT id from fulfillment_branch_office_goals as FulfillmentBranchOfficeGoal"
                                . " where goal_branch_office_id= ".$id." and "
                                . "EXTRACT(MONTH from fecha_inicio) = '".$mes."';";
                        $consulta_id=$this->FulfillmentBranchOfficeGoal->query($query2);
                        
                        //Acá extrae el id de el cumplimiento de meta actualizado
                        $idCumplimiento=$consulta_id[0]['FulfillmentBranchOfficeGoal']['id'];
                        
                        $query3="UPDATE invoiced_tickets 
                            SET fulfillment_branch_office_goal_id = ".$idCumplimiento." 
                            WHERE sucursal = ".$idSucursal." 
                            and EXTRACT(MONTH from fecha) = '".$mes."';";
                        
                        //Cargando modelo de boletos facturados
                        $this->loadModel('InvoicedTicket');
                        $this->InvoicedTicket->query($query3);
                        $this->set('idCumplimiento',$idCumplimiento);
                        $this->set('idSucursal',$idSucursal);
                        $this->set('query3',$query3);
                        $this->Session->setFlash('Cumplimiento de Meta Actualizada.');
                        return $this->redirect(array('action' => 'comparativoMetas'));
		
                else:
                    $this->Session->setFlash('Método no soportado.');
                endif;
	}
        public function comparativoMetasTerrestres(){
            //Llena combobox con sucursales
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);
                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para sucursal y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaServicios=""
                            . " SELECT * from invoiced_services"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedService');
                        
                        $consultaServicios=$this->InvoicedService->query($consultaServicios);

                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);
                endif;
            }
        }
//Reporte excel
          public function comparativoMetasTerrestresReporteExcel(){
            //Llena combobox con sucursales
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);
                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para sucursal y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaServicios=""
                            . " SELECT * from invoiced_services"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedService');
                        
                        $consultaServicios=$this->InvoicedService->query($consultaServicios);

                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);
                endif;
            }
        }
//Reporte pdf
          public function comparativoMetasTerrestresReportePdf(){
            //Llena combobox con sucursales
            $branchOffices = $this->GoalBranchOffice->BranchOffice->find('list');
            $this->set(compact('branchOffices'));
            if ($this->request->is(array('post', 'put'))) {
                //Saca el id de la sucursal del request
                $id=$this->request->data["GoalBranchOffice"]['branch_office_id'];
                $this->set('idSucursal',$id);
                //Saca el del request
                $fecha=$this->request->data["GoalBranchOffice"]['mes'];
                $mes=  date('m',strtotime($fecha));
                $this->set('mes',$mes);
                
                //ejecuta consulta de metas para sucursal y por fecha
                $queryConsultaMetas="SELECT * FROM goal_branch_offices as GoalBranchOffice "
                            . "WHERE EXTRACT(MONTH from mes)= '".$mes."' and branch_office_id= ".$id;   
                $consultaMetas=$this->GoalBranchOffice->query($queryConsultaMetas);
                
                
                if(empty($consultaMetas)):
                        $this->Session->setFlash(__('Meta no encontrada para este mes.'));
                    //Si encuentra la meta
                else:
                        //Esta línea hace que el resultado de la consulta se ponga en el form
                        $this->request->data=$consultaMetas[0];
                        
                        $this->set('queryConsultaMetas',$consultaMetas[0]); 
                        $this->Session->setFlash(__('Datos leídos.'));
                        
                        //Si encuentra meta ejecuta consulta de boletos por sucursal y por mes
                        $consultaServicios=""
                            . " SELECT * from invoiced_services"
                            . " WHERE sucursal=".$id." and "
                                . "EXTRACT(MONTH from fecha) = '".$mes."';";
                        //Carga modelo
                        $this->loadModel('InvoicedService');
                        
                        $consultaServicios=$this->InvoicedService->query($consultaServicios);

                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('idSucursal',$id);
                        $this->set('fecha',$fecha);
                        $this->set('name',$branchOffices[$id]);
                endif;
            }
        }

        public function editar2($id=null,
                        $servicios_periodo_sucursal=null,
                        $total_periodo=null,
                        $faltante=null,
                        $porcentajeFaltante=null,
                        $mes=null,
                        $idSucursal=null) {
            //El id que se recibe acá es el id de la meta
            //Sucursal -> Meta -> Cumplimiento de meta
            $this->loadModel('FulfillmentBranchOfficeGoal');
		if ($this->request->is(array('post'))):
			$query="UPDATE `fulfillment_branch_office_goals` 
                                SET `total_servicios`= ".$total_periodo.",".
                                    "`faltante_servicios`= ".$faltante.",".
                                    "`cantidad_servicios`= ".$servicios_periodo_sucursal.",".
                                    "`porcentaje_servicios`= ".$porcentajeFaltante." "
                                    . "WHERE goal_branch_office_id= ".$id." and "
                                . "EXTRACT(MONTH from fecha_inicio) = '".$mes."';";
                        
                        $this->FulfillmentBranchOfficeGoal->query($query);
                        
                        //Consulta el id de el cumplimiento de meta actualizado
                        $query2="SELECT id from fulfillment_branch_office_goals as FulfillmentBranchOfficeGoal"
                                . " where goal_branch_office_id= ".$id." and "
                                . "EXTRACT(MONTH from fecha_inicio) = '".$mes."';";
                        $consulta_id=$this->FulfillmentBranchOfficeGoal->query($query2);
                        
                        //Acá extrae el id de el cumplimiento de meta actualizado
                        $idCumplimiento=$consulta_id[0]['FulfillmentBranchOfficeGoal']['id'];
                        
                        $query3="UPDATE invoiced_services 
                            SET fulfillment_branch_office_goal_id = ".$idCumplimiento." 
                            WHERE sucursal = ".$idSucursal." 
                            and EXTRACT(MONTH from fecha) = '".$mes."';";
                        
                        //Cargando modelo de boletos facturados
                        $this->loadModel('InvoicedService');
                        $this->InvoicedService->query($query3);
                        $this->set('idCumplimiento',$idCumplimiento);
                        $this->set('idSucursal',$idSucursal);
                        $this->set('query3',$query3);
                        $this->Session->setFlash('Cumplimiento de Meta Actualizada.');
                        return $this->redirect(array('action' => 'comparativoMetasTerrestres'));
		
                else:
                    $this->Session->setFlash('Método no soportado.');
                endif;
	}
	
	public function imprimir($tipo = '') {
		$this->layout = 'imprimir';
		$query = 'SELECT * FROM invoiced_'.$tipo.' WHERE sucursal = ? AND  EXTRACT(MONTH FROM fecha) = ?';
		$parametros = array($this->request->data['imprimir']['branch_office_id'], $this->request->data['imprimir']['mes']);
		if ($tipo == 'tickets') {
			$this->loadModel('InvoicedTicket');
			$consulta = $this->InvoicedTicket->query($query, $parametros);
		}
		elseif ($tipo == 'services') {
			$this->loadModel('InvoicedService');
			$consulta = $this->InvoicedService->query($query, $parametros);
		}
		$this->set(array(
			'sucursal' => $this->request->data['imprimir']['sucursal'],
			'mes' => $this->_mes($this->request->data['imprimir']['mes']),
			'meta' => $this->request->data['imprimir']['meta_'.($tipo == 'tickets' ? 'boletos' : 'servicios')],
			'servicios_periodo_sucursal' => $this->request->data['imprimir']['servicios_periodo_sucursal'],
			'total_periodo' => $this->request->data['imprimir']['total_periodo'],
			'faltante' => $this->request->data['imprimir']['faltante'],
			'porcentaje_faltante' => $this->request->data['imprimir']['porcentaje_faltante'],
			'consulta' => $consulta,
			'nombre_reporte' => 'COMPARATIVO DE CUMPLIMIENTO DE VENTA '.($tipo == 'tickets' ? 'DE BOLETOS AÉREOS' : ($tipo == 'services' ? 'DE SERVICIOS TERRESTRES' : '')).' POR SUCURSAL',
			'tipo' => $tipo
		));
	}
	
	protected function _mes($mes) {
		$meses = array(
			'01' => 'Enero',
			'02' => 'Febrero',
			'03' => 'Marzo',
			'04' => 'Abril',
			'05' => 'Mayo',
			'06' => 'Junio',
			'07' => 'Julio',
			'08' => 'Agosto',
			'09' => 'Septiembre',
			'10' => 'Octubre',
			'11' => 'Noviembre',
			'12' => 'Diciembre'
		);
		return $meses[$mes];
	}
}
