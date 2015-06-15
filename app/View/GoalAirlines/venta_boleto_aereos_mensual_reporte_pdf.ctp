<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');
App::import('Vendor', 'Classes/MPDF54');

$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererLibraryPath = '..\Vendor\Classes\MPDF54' ;

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte9.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('C2', $fechaMes);
$objPHPExcel->getActiveSheet()->setCellValue('C4', $fechaAnio);

$boletos_periodo=0;
$total_periodo=0;
$row = 0;
if (!empty($consultaVentas)):
    $baseRow = 13;
    foreach ($consultaVentas as $r => $aerolinea) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
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

$row = $row + 6;
$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $boletos_periodo);

$row = $row + 3;
$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $total_periodo);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->getActiveSheet()->setShowGridLines(false);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


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