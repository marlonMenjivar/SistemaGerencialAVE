<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte2.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('B7', $airlineaNombre);
$objPHPExcel->getActiveSheet()->setCellValue('C7', $fechainicio);
$objPHPExcel->getActiveSheet()->setCellValue('D7', $fechafin);

$boletos_destino=0;
$total_destino=0;
$row = 0;

if (!empty($consultaDestinos)):
    $baseRow = 17;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($baseRow,count($consultaDestinos));
    foreach ($consultaDestinos as $r => $nivel0) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $nivel0['it']['destino'])
                                    ->setCellValue('C'.$row, $nivel0['iit']['ciudad_destino'])
                                    ->setCellValue('D'.$row, $nivel0['iit']['pais_destino'])
                                    ->setCellValue('E'.$row, $nivel0['0']['boletos_destino'])
                                    ->setCellValue('F'.$row, $nivel0['0']['total_destino']);

      $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
                                    
    
     $boletos_destino=$boletos_destino+$nivel0['0']['boletos_destino'];;
     $total_destino=$total_destino+$nivel0['0']['total_destino'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('E7', $boletos_destino);
$objPHPExcel->getActiveSheet()->setCellValue('F7', '$ '.number_format($total_destino, 2, '.', ','));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventaBoletosLADestinoSemanalReporteExcel.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>