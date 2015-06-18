<?php
App::uses('AppController', 'Controller');

class ReportsController extends AppController {
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session');
	
	public function show($opcion = null) {
		switch ($opcion) {
			case 6:
				$this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Tipo de Servicio Semanal', 'opcion' => 6));
				if ($this->request->is(array('post', 'put'))) {
					$fecha1 = $this->request->data['show_reporte_6']['fecha1'];
					$fecha2 = $this->request->data['show_reporte_6']['fecha2'];
					
					$validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
					if ($validacion_fechas != '') {
						$this->set('tipo_mensaje', 1);
						$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
					}
					else {
						$this->loadModel('InvoicedService');
						$query = $this->InvoicedService->query("
						SELECT tipo_servicio, COUNT(id) cantidad_por_tipo, SUM(tarifa) total_por_tipo, SUM(iva) iva_por_tipo FROM invoiced_services
						WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
						
						if (empty($query)) {
							$this->set('tipo_mensaje', 2);
							$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
						}
						else {
							$this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1', $fecha1);
              $this->set('fecha2', $fecha2);
							$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
						}
					}
				}
				break;
			case 7:
				$this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Proveedor Semanal', 'opcion' => 7));
				if ($this->request->is(array('post', 'put'))) {
					$fecha1 = $this->request->data['show_reporte_7']['fecha1'];
					$fecha2 = $this->request->data['show_reporte_7']['fecha2'];
					
					$validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
					if ($validacion_fechas != '') {
						$this->set('tipo_mensaje', 1);
						$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
					}
					else {
						$this->loadModel('InvoicedService');
						$query = $this->InvoicedService->query("
						SELECT proveedor_servicio, COUNT(id) cantidad_por_proveedor, SUM(tarifa) total_por_proveedor, SUM(iva) iva_por_proveedor
						FROM invoiced_services
						WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY proveedor_servicio ORDER BY proveedor_servicio;");
						
						if (empty($query)) {
							$this->set('tipo_mensaje', 2);
							$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
						}
						else {
							$this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1',$fecha1);
              $this->set('fecha2',$fecha2);
							$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
						}
					}
				}
				break;
			case 8:
				$this->loadModel('Airline');
				$this->set(array('aereolineas' => $this->Airline->find('list', array('fields' => 'Airline.id, Airline.name')), 'reporte_encontrado' => true, 'nombre_reporte' => 'Total de Venta de Boletos Aéreos por Línea Aérea por Periodo BSP', 'opcion' => 8));
				
				if ($this->request->is(array('post', 'put'))) {
					$airline_id = $this->request->data['show_reporte_8']['airline_id'];
					
					$this->loadModel('GoalAirline');
					$query = $this->GoalAirline->query("
					SELECT periodo_bsp, fecha_inicio, fecha_fin, meta_bsp, boletos_periodo, total_periodo, faltante, porcentaje, comision, ingreso_comision
					FROM goal_airlines WHERE airline_id = ".$airline_id." AND boletos_periodo <> 0 ORDER BY fecha_inicio");
					
					if (empty($query)) {
						$this->set('tipo_mensaje', 2);
						$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron metas.'), 'default', array('class' => 'error-message'));
					}
					else {
						$this->set(array('query' => $query, 'tipo_mensaje' => 2));
            $this->set('airline_id', $airline_id);
						$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
					}
				}
				break;
			default:
				$this->set('reporte_encontrado', false);
				$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> Reporte no encontrado.'), 'default', array('class' => 'error-message'));
				break;
		}
	}
	//Reportes excel
  public function showReporteExcel($opcion = null) {
    switch ($opcion) {
      case 6:
        $this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Tipo de Servicio Semanal', 'opcion' => 6));
        if ($this->request->is(array('post', 'put'))) {
          $fecha1 = $this->request->data['show_reporte_6']['fecha1'];
          $fecha2 = $this->request->data['show_reporte_6']['fecha2'];
          
          $validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
          if ($validacion_fechas != '') {
            $this->set('tipo_mensaje', 1);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
          }
          else {
            $this->loadModel('InvoicedService');
            $query = $this->InvoicedService->query("
            SELECT tipo_servicio, COUNT(id) cantidad_por_tipo, SUM(tarifa) total_por_tipo, SUM(iva) iva_por_tipo FROM invoiced_services
            WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
            
            if (empty($query)) {
              $this->set('tipo_mensaje', 2);
              $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
            }
            else {
              $this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1', $fecha1);
              $this->set('fecha2', $fecha2);
              $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
            }
          }
        }
        break;
      case 7:
        $this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Proveedor Semanal', 'opcion' => 7));
        if ($this->request->is(array('post', 'put'))) {
          $fecha1 = $this->request->data['show_reporte_7']['fecha1'];
          $fecha2 = $this->request->data['show_reporte_7']['fecha2'];
          
          $validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
          if ($validacion_fechas != '') {
            $this->set('tipo_mensaje', 1);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
          }
          else {
            $this->loadModel('InvoicedService');
            $query = $this->InvoicedService->query("
            SELECT proveedor_servicio, COUNT(id) cantidad_por_proveedor, SUM(tarifa) total_por_proveedor, SUM(iva) iva_por_proveedor
            FROM invoiced_services
            WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY proveedor_servicio ORDER BY proveedor_servicio;");
            
            if (empty($query)) {
              $this->set('tipo_mensaje', 2);
              $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
            }
            else {
              $this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1', $fecha1);
              $this->set('fecha2', $fecha2);
              $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
            }
          }
        }
        break;
      case 8:
        $this->loadModel('Airline');
        $this->set(array('aereolineas' => $this->Airline->find('list', array('fields' => 'Airline.id, Airline.name')), 'reporte_encontrado' => true, 'nombre_reporte' => 'Total de Venta de Boletos Aéreos por Línea Aérea por Periodo BSP', 'opcion' => 8));
        
        if ($this->request->is(array('post', 'put'))) {
          $airline_id = $this->request->data['show_reporte_8']['airline_id'];
          
          $this->loadModel('GoalAirline');
          $query = $this->GoalAirline->query("
          SELECT periodo_bsp, fecha_inicio, fecha_fin, meta_bsp, boletos_periodo, total_periodo, faltante, porcentaje, comision, ingreso_comision
          FROM goal_airlines WHERE airline_id = ".$airline_id." AND boletos_periodo <> 0 ORDER BY fecha_inicio");
          
          if (empty($query)) {
            $this->set('tipo_mensaje', 2);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron metas.'), 'default', array('class' => 'error-message'));
          }
          else {
            $this->set(array('query' => $query, 'tipo_mensaje' => 2));
            $this->set('airline_id', $airline_id);
            $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
          }
        }
        break;
      default:
        $this->set('reporte_encontrado', false);
        $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> Reporte no encontrado.'), 'default', array('class' => 'error-message'));
        break;
    }
  }
//Reportes PDF
  public function showReportePdf($opcion = null) {
    switch ($opcion) {
      case 6:
        $this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Tipo de Servicio Semanal', 'opcion' => 6));
        if ($this->request->is(array('post', 'put'))) {
          $fecha1 = $this->request->data['show_reporte_6']['fecha1'];
          $fecha2 = $this->request->data['show_reporte_6']['fecha2'];
          
          $validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
          if ($validacion_fechas != '') {
            $this->set('tipo_mensaje', 1);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
          }
          else {
            $this->loadModel('InvoicedService');
            $query = $this->InvoicedService->query("
            SELECT tipo_servicio, COUNT(id) cantidad_por_tipo, SUM(tarifa) total_por_tipo, SUM(iva) iva_por_tipo FROM invoiced_services
            WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
            
            if (empty($query)) {
              $this->set('tipo_mensaje', 2);
              $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
            }
            else {
              $this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1', $fecha1);
              $this->set('fecha2', $fecha2);
              $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
            }
          }
        }
        break;
      case 7:
        $this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen de Venta de Servicios Terrestres por Proveedor Semanal', 'opcion' => 7));
        if ($this->request->is(array('post', 'put'))) {
          $fecha1 = $this->request->data['show_reporte_7']['fecha1'];
          $fecha2 = $this->request->data['show_reporte_7']['fecha2'];
          
          $validacion_fechas = $this->_validar_fechas($fecha1, $fecha2);
          if ($validacion_fechas != '') {
            $this->set('tipo_mensaje', 1);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> %s', $validacion_fechas), 'default', array('class' => 'error-message'));
          }
          else {
            $this->loadModel('InvoicedService');
            $query = $this->InvoicedService->query("
            SELECT proveedor_servicio, COUNT(id) cantidad_por_proveedor, SUM(tarifa) total_por_proveedor, SUM(iva) iva_por_proveedor
            FROM invoiced_services
            WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY proveedor_servicio ORDER BY proveedor_servicio;");
            
            if (empty($query)) {
              $this->set('tipo_mensaje', 2);
              $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
            }
            else {
              $this->set(array('query' => $query, 'tipo_mensaje' => 2));
              $this->set('fecha1', $fecha1);
              $this->set('fecha2', $fecha2);
              $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
            }
          }
        }
        break;
      case 8:
        $this->loadModel('Airline');
        $this->set(array('aereolineas' => $this->Airline->find('list', array('fields' => 'Airline.id, Airline.name')), 'reporte_encontrado' => true, 'nombre_reporte' => 'Total de Venta de Boletos Aéreos por Línea Aérea por Periodo BSP', 'opcion' => 8));
        
        if ($this->request->is(array('post', 'put'))) {
          $airline_id = $this->request->data['show_reporte_8']['airline_id'];
          
          $this->loadModel('GoalAirline');
          $query = $this->GoalAirline->query("
          SELECT periodo_bsp, fecha_inicio, fecha_fin, meta_bsp, boletos_periodo, total_periodo, faltante, porcentaje, comision, ingreso_comision
          FROM goal_airlines WHERE airline_id = ".$airline_id." AND boletos_periodo <> 0 ORDER BY fecha_inicio");
          
          if (empty($query)) {
            $this->set('tipo_mensaje', 2);
            $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron metas.'), 'default', array('class' => 'error-message'));
          }
          else {
            $this->set(array('query' => $query, 'tipo_mensaje' => 2));
            $this->set('airline_id', $airline_id);
            $this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
          }
        }
        break;
      default:
        $this->set('reporte_encontrado', false);
        $this->Session->setFlash(__('<i class="fa fa-times-circle"></i> Reporte no encontrado.'), 'default', array('class' => 'error-message'));
        break;
    }
  }

	public function save($opcion) {
		switch ($opcion) {
			case 6:
				if ($this->request->is(array('post', 'put'))) {
					$fecha1 = $this->request->data['save_reporte_6']['fecha1'];
					$fecha2 = $this->request->data['save_reporte_6']['fecha2'];
					
					// Guarda los datos resultantes del reporte en la tabla venta de servicios por tipo
					$this->loadModel('ServicesSalesType');
					if (!$this->ServicesSalesType->save(array('ServicesSalesType' => array('fecha_inicio_tipo' => $fecha1, 'fecha_fin_tipo' => $fecha2)))) {
						$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se pudo guardar el tipo de servicios de ventas.'), 'default', array('class' => 'error-message'));
					}
					
					// Obtiene el correlativo del código de los datos guardados en la tabla venta de servicios por tipo
					$query = $this->ServicesSalesType->find('all', array('fields' => 'MAX(ServicesSalesType.id) id'));
					$services_sales_type_id = $query[0][0]['id'];
					
					// Guarda los datos totales de los servicios por tipo
					$this->loadModel('Type');
					$query = $this->Type->query("
					INSERT INTO types(services_sales_type_id, tipo_servicio, cantidad_servicios_tipo, total_servicios_tipo)
					SELECT ".$services_sales_type_id." services_sales_type_id, tipo_servicio, COUNT(id) cantidad_por_tipo, SUM(tarifa) total_por_tipo
					FROM invoiced_services
					WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
					
					// Actualiza el código de venta de servicios por tipo en la tabla de servicios facturados
					$this->loadModel('InvoicedService');
					$query = $this->InvoicedService->query("
					SELECT tipo_servicio, COUNT(id) cantidad_por_tipo, SUM(tarifa) total_por_tipo, SUM(iva) iva_por_tipo
					FROM invoiced_services
					WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
					
					$i = 0;
					foreach ($query as $row) $tipos_servicios[$i++] = $row['invoiced_services']['tipo_servicio'];
					
					$tipos_servicios_string = '';
					for ($i = 0; $i < count($tipos_servicios); $i++) {
						$tipos_servicios_string .= "'".$tipos_servicios[$i]."'";
						if ($i < count($tipos_servicios) - 1) {
							$tipos_servicios_string .= ", ";
						}
					}
					
					$query = $this->InvoicedService->query("UPDATE invoiced_services SET services_sales_type_id = ".$services_sales_type_id." WHERE tipo_servicio IN(".$tipos_servicios_string.") AND fecha BETWEEN '".$fecha1."' AND '".$fecha2."'");
					
					$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Reporte guardado.'), 'default', array('class' => 'success'));
				}
				else {
					$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> <strong>Error:</strong> No se pudo guardar la venta.'), 'default', array('class' => 'error-message'));
				}
				return $this->redirect(array('controller' => 'reports', 'action' => 'show', $opcion));
				break;
			case 7:
				if ($this->request->is(array('post', 'put'))) {
					$fecha1 = $this->request->data['save_reporte_7']['fecha1'];
					$fecha2 = $this->request->data['save_reporte_7']['fecha2'];
					
					// Guarda los datos resultantes del reporte en la tabla venta de servicios por proveedor
					$this->loadModel('ServicesSalesProvider');
					if (!$this->ServicesSalesProvider->save(array('ServicesSalesProvider' => array('fecha_inicio_proveedor' => $fecha1, 'fecha_fin_proveedor' => $fecha2)))) {
						$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se pudo guardar el tipo de servicios de proveedor.'), 'default', array('class' => 'error-message'));
					}
					
					// Obtiene el correlativo del código de los datos guardados en la tabla venta de servicios por proveedor
					$query = $this->ServicesSalesProvider->find('all', array('fields' => 'MAX(ServicesSalesProvider.id) id'));
					$services_sales_provider_id = $query[0][0]['id'];
					
					// Guarda los datos totales de los servicios por tipo
					$this->loadModel('Provider');
					$query = $this->Provider->query("
					INSERT INTO providers(services_sales_provider_id, proveedor_servicio, cantidad_servicios_proveedor, total_servicios_proveedor)
					SELECT ".$services_sales_provider_id." services_sales_provider_id, proveedor_servicio, COUNT(id) cantidad_por_proveedor, SUM(tarifa) total_por_proveedor
					FROM invoiced_services
					WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY proveedor_servicio ORDER BY proveedor_servicio");
					
					// Actualiza el código de venta de servicios por proveedor en la tabla de servicios facturados
					$this->loadModel('InvoicedService');
					$query = $this->InvoicedService->query("UPDATE invoiced_services SET services_sales_provider_id = ".$services_sales_provider_id." WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."'");
					
					$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Reporte guardado.'), 'default', array('class' => 'success'));
				}
				else {
					$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> <strong>Error:</strong> No se pudo guardar la venta.'), 'default', array('class' => 'error-message'));
				}
				return $this->redirect(array('controller' => 'reports', 'action' => 'show', $opcion));
				break;
			default:
				$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> Reporte no encontrado.'), 'default', array('class' => 'error-message'));
				return $this->redirect(array('controller' => 'reports', 'action' => 'show', $opcion));
				break;
		}
	}
	
	private function _validar_fechas($fecha1, $fecha2) {
		$fecha1 = empty($fecha1) ? '0000/00/00' : $fecha1;
		$fecha2 = empty($fecha2) ? '0000/00/00' : $fecha2;
		$valores_fecha1 = explode('/', $fecha1);
		$valores_fecha2 = explode('/', $fecha2);
		$dia1 = $valores_fecha1[2];
		$mes1 = $valores_fecha1[1];
		$anyo1 = $valores_fecha1[0];
		$dia2 = $valores_fecha2[2];
		$mes2 = $valores_fecha2[1];
		$anyo2 = $valores_fecha2[0];
		$dias_fecha1 = gregoriantojd($mes1, $dia1, $anyo1);
		$dias_fecha2 = gregoriantojd($mes2, $dia2, $anyo2);
		if ($dias_fecha1 == $dias_fecha2) {
			return 'La fecha inicial y la fecha final no deben de ser iguales.';
		}
		elseif ($dias_fecha1 > $dias_fecha2) {
			return 'La fecha inicial no puede ser mayor a la fecha final.';
		}
		else {
			return '';
		}
	}

        // Salida 10
        public function ventaServicioTerrestreTipoServicioMensual() { //Acumulado venta de servicios terrestres por tipo de servicio mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["services_sales_types"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["services_sales_types"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["services_sales_types"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["services_sales_types"]['fecha_fin'];
                    
                    $this->loadModel('ServicesSalesType');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServiciosTipo="SELECT  services_sales_types.id, types.tipo_servicio, types.cantidad_servicios_tipo, types.total_servicios_tipo, services_sales_types.fecha_inicio_tipo, services_sales_types.fecha_fin_tipo "
                            . "FROM services_sales_types inner join types ON services_sales_types.id = types.services_sales_type_id  "
                            . "WHERE  fecha_inicio_tipo >= '". $fechaInicio . "' AND fecha_inicio_tipo <= '". $fechaFin . "' ORDER BY tipo_servicio;";
                    $consultaServiciosTipo=$this->ServicesSalesType->query($queryConsultaServiciosTipo);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServiciosTipo)):
                        $this->Session->setFlash(__('No se encontro registros servicios terrestres vendidos por tipo de servicio para este mes. '));
                    
                    else:
                        $this->set('consultaServiciosTipo',$consultaServiciosTipo);
                        $this->set('fechaInicio',$fechaInicio);
                        $this->set('fechaFin',$fechaFin);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
		}
        }

         // Salida 10 para reporte en excel
        public function ventaServicioTerrestreTipoServicioMensualReporteExcel() { //Acumulado venta de servicios terrestres por tipo de servicio mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["reporte_excel"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["reporte_excel"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["reporte_excel"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["reporte_excel"]['fecha_fin'];
                    
                    $this->loadModel('ServicesSalesType');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServiciosTipo="SELECT  services_sales_types.id, types.tipo_servicio, types.cantidad_servicios_tipo, types.total_servicios_tipo, services_sales_types.fecha_inicio_tipo, services_sales_types.fecha_fin_tipo "
                            . "FROM services_sales_types inner join types ON services_sales_types.id = types.services_sales_type_id  "
                            . "WHERE  fecha_inicio_tipo >= '". $fechaInicio . "' AND fecha_inicio_tipo <= '". $fechaFin . "' ORDER BY tipo_servicio;";
                    $consultaServiciosTipo=$this->ServicesSalesType->query($queryConsultaServiciosTipo);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServiciosTipo)):
                        $this->Session->setFlash(__('No encontro registros servicios terrestres vendidos por tipo de servicio para este mes. '));
                    
                    else:
                        $this->set('consultaServiciosTipo',$consultaServiciosTipo);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
    }
        }      // Salida 10 para reporte en pdf
        public function ventaServicioTerrestreTipoServicioMensualReportePdf() { //Acumulado venta de servicios terrestres por tipo de servicio mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["reporte_pdf"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["reporte_pdf"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["reporte_pdf"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["reporte_pdf"]['fecha_fin'];
                    
                    $this->loadModel('ServicesSalesType');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServiciosTipo="SELECT  services_sales_types.id, types.tipo_servicio, types.cantidad_servicios_tipo, types.total_servicios_tipo, services_sales_types.fecha_inicio_tipo, services_sales_types.fecha_fin_tipo "
                            . "FROM services_sales_types inner join types ON services_sales_types.id = types.services_sales_type_id  "
                            . "WHERE  fecha_inicio_tipo >= '". $fechaInicio . "' AND fecha_inicio_tipo <= '". $fechaFin . "' ORDER BY tipo_servicio;";
                    $consultaServiciosTipo=$this->ServicesSalesType->query($queryConsultaServiciosTipo);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServiciosTipo)):
                        $this->Session->setFlash(__('No encontro registros servicios terrestres vendidos por tipo de servicio para este mes. '));
                    
                    else:
                        $this->set('consultaServiciosTipo',$consultaServiciosTipo);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
    }
        }

        // Salida 11 
        public function ventaProveedorServicioTerrestreMensual() { //Acumulado de venta por proveedor de servicios terrestres mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["ServicesSalesProvider"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["ServicesSalesProvider"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["ServicesSalesProvider"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["ServicesSalesProvider"]['fecha_fin'];
                    
                    $this->loadModel('Providers');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServicios="SELECT services_sales_providers.id, proveedor_servicio, cantidad_servicios_proveedor, total_servicios_proveedor, fecha_inicio_proveedor, fecha_fin_proveedor "
                            . "FROM services_sales_providers inner join providers ON providers.services_sales_provider_id = services_sales_providers.id "
                            . "WHERE fecha_inicio_proveedor >= '". $fechaInicio . "' AND fecha_inicio_proveedor <= '". $fechaFin . "' ORDER BY proveedor_servicio;";
                    $consultaServicios=$this->Providers->query($queryConsultaServicios);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServicios)):
                        $this->Session->setFlash(__('No se encontro registros servicios terrestres vendidos de proveerdor para este mes. '));
                    
                    else:
                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('fechaInicio',$fechaInicio);
                        $this->set('fechaFin',$fechaFin);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
		}
       
        }   

        // Salida 11 para reporte excel
        public function ventaProveedorServicioTerrestreMensualReporteExcel() { //Acumulado de venta por proveedor de servicios terrestres mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["reporte_excel"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["reporte_excel"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["reporte_excel"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["reporte_excel"]['fecha_fin'];
                    
                    $this->loadModel('Providers');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServicios="SELECT services_sales_providers.id, proveedor_servicio, cantidad_servicios_proveedor, total_servicios_proveedor, fecha_inicio_proveedor, fecha_fin_proveedor "
                            . "FROM services_sales_providers inner join providers ON providers.services_sales_provider_id = services_sales_providers.id "
                            . "WHERE fecha_inicio_proveedor >= '". $fechaInicio . "' AND fecha_inicio_proveedor <= '". $fechaFin . "' ORDER BY proveedor_servicio;";
                    $consultaServicios=$this->Providers->query($queryConsultaServicios);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServicios)):
                        $this->Session->setFlash(__('No encontro registros servicios terrestres vendidos de proveerdor para este mes. '));
                    
                    else:
                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
    }
        }// Salida 11 para reporte pdf
        public function ventaProveedorServicioTerrestreMensualReportePdf() { //Acumulado de venta por proveedor de servicios terrestres mensual
                
                //Si el formulario se envió
                if ($this->request->is(array('post', 'put'))) {                    
                    //Saca la fecha año del request
                    $fechaAnio=$this->request->data["reporte_pdf"]['fecha_anio'];
                    //Saca la fecha mes del request
                    $fechaMes=$this->request->data["reporte_pdf"]['fecha_mes'];
                    //Saca la fecha del request
                    $fechaInicio=$this->request->data["reporte_pdf"]['fecha_inicio'];
                    //Saca la fecha del request
                    $fechaFin=$this->request->data["reporte_pdf"]['fecha_fin'];
                    
                    $this->loadModel('Providers');
                    //ejecuta consulta la venta de servicios terrestres por proveedor por Mes
                    $queryConsultaServicios="SELECT services_sales_providers.id, proveedor_servicio, cantidad_servicios_proveedor, total_servicios_proveedor, fecha_inicio_proveedor, fecha_fin_proveedor "
                            . "FROM services_sales_providers inner join providers ON providers.services_sales_provider_id = services_sales_providers.id "
                            . "WHERE fecha_inicio_proveedor >= '". $fechaInicio . "' AND fecha_inicio_proveedor <= '". $fechaFin . "' ORDER BY proveedor_servicio;";
                    $consultaServicios=$this->Providers->query($queryConsultaServicios);
                    
                    //Si la consulta retorna vacía
                    if(empty($consultaServicios)):
                        $this->Session->setFlash(__('No encontro registros de servicios terrestres vendidos de proveerdor para este mes. '));
                    
                    else:
                        $this->set('consultaServicios',$consultaServicios);
                        $this->set('fechaAnio',$fechaAnio);
                        $this->set('fechaMes',$fechaMes);
                    endif;                    
    }
        }
     
}
