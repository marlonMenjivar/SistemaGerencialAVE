<?php
App::uses('AppController', 'Controller');

class ReportsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session');
	
	public function show($opcion = null) {
		switch ($opcion) {
			case 6:
				$this->set(array('reporte_encontrado' => true, 'nombre_reporte' => 'Semi-Resumen Venta de Servicios Terrestres por Tipo de Servicio Semanal', 'opcion' => 6));
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
						SELECT tipo_servicio, count(id) as cantidad_por_tipo, sum(tarifa) as total_por_tipo, sum(iva) as iva_por_tipo
						FROM invoiced_services
						WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
						
						if (empty($query)) {
							$this->set('tipo_mensaje', 2);
							$this->Session->setFlash(__('<i class="fa fa-times-circle"></i> No se encontraron ventas.'), 'default', array('class' => 'error-message'));
						}
						else {
							$this->set(array('query' => $query, 'tipo_mensaje' => 2));
							$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Resultado.'), 'default', array('class' => 'success'));
						}
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
					SELECT ".$services_sales_type_id." as services_sales_type_id, tipo_servicio, count(id) as cantidad_por_tipo, sum(tarifa) as total_por_tipo
					FROM invoiced_services
					WHERE fecha BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY tipo_servicio ORDER BY tipo_servicio");
					
					$this->Session->setFlash(__('<i class="fa fa-info-circle"></i> Venta guardada.'), 'default', array('class' => 'success'));
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
		$fecha1 = empty($fecha1) ? '0000-00-00' : $fecha1;
		$fecha2 = empty($fecha2) ? '0000-00-00' : $fecha2;
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
}
