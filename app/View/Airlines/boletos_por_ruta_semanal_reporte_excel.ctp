<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte3.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('B7', $airlineaNombre);
$objPHPExcel->getActiveSheet()->setCellValue('C7', $fechainicio);
$objPHPExcel->getActiveSheet()->setCellValue('D7', $fechafin);

$boletos_ruta=0;
$total_ruta=0;
$row = 0;

if (!empty($consultaRutas)):
    $baseRow = 17;
    foreach ($consultaRutas as $r => $nivel0) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $nivel0['it']['ruta'])
                                    ->setCellValue('C'.$row, $nivel0['iit']['ciudad_origen'])
                                    ->setCellValue('D'.$row, $nivel0['iit']['pais_origen'])
                                    ->setCellValue('E'.$row, $nivel0['iit']['ciudad_destino'])
                                    ->setCellValue('F'.$row, $nivel0['iit']['pais_destino'])
                                    ->setCellValue('G'.$row, $nivel0[0]['boletos_ruta'])
                                    ->setCellValue('H'.$row, $nivel0[0]['total_ruta']);
    
      $boletos_ruta = $boletos_ruta+$nivel0[0]['boletos_ruta'];
      $total_ruta = $total_ruta+$nivel0[0]['total_ruta'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('G7', $boletos_ruta);
$objPHPExcel->getActiveSheet()->setCellValue('H7', '$ '.$total_ruta);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventaBoletosLARSemanalReporteExcel.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>