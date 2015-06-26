<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte10.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('B7', $fechaMes.', '.$fechaAnio);

$cantidad_servicios=0;
$total_servicios=0;
$row = 0;

if (!empty($consultaServiciosTipo)):
    $baseRow = 17;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($baseRow,count($consultaServiciosTipo));
    foreach ($consultaServiciosTipo as $r => $ServicioTipo) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $ServicioTipo['services_sales_types']['id'])
                                    ->setCellValue('C'.$row, $ServicioTipo['types']['tipo_servicio'])
                                    ->setCellValue('D'.$row, $ServicioTipo['types']['cantidad_servicios_tipo'])
                                    ->setCellValue('E'.$row, $ServicioTipo['types']['total_servicios_tipo'])
                                    ->setCellValue('F'.$row, $ServicioTipo['services_sales_types']['fecha_inicio_tipo'])
                                    ->setCellValue('G'.$row, $ServicioTipo['services_sales_types']['fecha_fin_tipo']);
    
      $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
      $cantidad_servicios = $cantidad_servicios + $ServicioTipo['types']['cantidad_servicios_tipo'];
      $total_servicios = $total_servicios + $ServicioTipo['types']['total_servicios_tipo'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('F7', $cantidad_servicios);
$objPHPExcel->getActiveSheet()->setCellValue('G7', '$ '.number_format($total_servicios, 2, '.', ','));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventaTipoDeServiciosMensualReporteExcel.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>