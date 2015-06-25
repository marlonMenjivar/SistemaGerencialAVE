<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte11.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('B7', $fechaMes.', '.$fechaAnio);

$cantidad_servicios=0;
$total_servicios=0;
$row = 0;

if (!empty($consultaServicios)):
    $baseRow = 17;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($baseRow,count($consultaServicios));
    foreach ($consultaServicios as $r => $ServicioProveedor) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $ServicioProveedor['services_sales_providers']['id'])
                                    ->setCellValue('C'.$row, $ServicioProveedor['providers']['proveedor_servicio'])
                                    ->setCellValue('D'.$row, $ServicioProveedor['providers']['cantidad_servicios_proveedor'])
                                    ->setCellValue('E'.$row, $ServicioProveedor['providers']['total_servicios_proveedor'])
                                    ->setCellValue('F'.$row, $ServicioProveedor['services_sales_providers']['fecha_inicio_proveedor'])
                                    ->setCellValue('G'.$row, $ServicioProveedor['services_sales_providers']['fecha_fin_proveedor']);
    
     $cantidad_servicios = $cantidad_servicios + $ServicioProveedor['providers']['cantidad_servicios_proveedor'];
     $total_servicios = $total_servicios + $ServicioProveedor['providers']['total_servicios_proveedor'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('F7', $cantidad_servicios);
$objPHPExcel->getActiveSheet()->setCellValue('G7', '$ '.$total_servicios);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventaProveedorDeServiciosTerrestresMensualReporteExcel.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>