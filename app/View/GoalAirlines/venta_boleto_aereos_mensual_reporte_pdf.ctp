<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');
App::import('Vendor', 'Classes/tcpdf');

$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
$rendererLibraryPath = '..\Vendor\Classes\tcpdf' ;

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte9.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('B7', $fechaMes.', '.$fechaAnio);

$boletos_periodo=0;
$total_periodo=0;
$row = 0;
if (!empty($consultaVentas)):
    $baseRow = 17;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,count($consultaVentas));
    foreach ($consultaVentas as $r => $aerolinea) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $aerolinea['airlines']['name'])
                                    ->setCellValue('C'.$row, $aerolinea['goal_airlines']['fecha_inicio'])
                                    ->setCellValue('D'.$row, $aerolinea['goal_airlines']['fecha_fin'])
                                    ->setCellValue('E'.$row, $aerolinea['goal_airlines']['boletos_periodo'])
                                    ->setCellValue('F'.$row, $aerolinea['goal_airlines']['total_periodo']);

      $boletos_periodo = $boletos_periodo + $aerolinea['goal_airlines']['boletos_periodo'];
      $total_periodo = $total_periodo + $aerolinea['goal_airlines']['total_periodo'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('E7', $boletos_periodo);
$objPHPExcel->getActiveSheet()->setCellValue('F7', '$ '.$total_periodo);

if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
        die(
                'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                '<br />' .
                'at the top of this script as appropriate for your directory structure'
        );
}

// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="ventaBoletoAereosMensualReportePDF.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>