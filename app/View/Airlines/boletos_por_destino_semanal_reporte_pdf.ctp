<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');
App::import('Vendor', 'Classes/MPDF54');

$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererLibraryPath = '..\Vendor\Classes\MPDF54' ;

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
                                    
    
     $boletos_destino=$boletos_destino+$nivel0['0']['boletos_destino'];;
     $total_destino=$total_destino+$nivel0['0']['total_destino'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;

$objPHPExcel->getActiveSheet()->setCellValue('E7', $boletos_destino);
$objPHPExcel->getActiveSheet()->setCellValue('F7', '$ '.$total_destino);

if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
        die(
                'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                '<br />' .
                'at the top of this script as appropriate for your directory structure'
        );
}

// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="ventaBoletosLADestinoSemanalReporteExcel.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>