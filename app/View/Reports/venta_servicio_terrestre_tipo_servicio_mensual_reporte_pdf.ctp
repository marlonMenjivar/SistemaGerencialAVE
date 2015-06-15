<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');
App::import('Vendor', 'Classes/MPDF54');
$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererLibraryPath = '..\Vendor\Classes\MPDF54' ;

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte10.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('C2', $fechaMes);
$objPHPExcel->getActiveSheet()->setCellValue('C4', $fechaAnio);
$cantidad_servicios=0;
$total_servicios=0;
$row = 0;
if (!empty($consultaServiciosTipo)):
    $baseRow = 16;
    foreach ($consultaServiciosTipo as $r => $ServicioTipo) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $ServicioTipo['services_sales_types']['id'])
                                    ->setCellValue('C'.$row, $ServicioTipo['types']['tipo_servicio'])
                                    ->setCellValue('D'.$row, $ServicioTipo['types']['cantidad_servicios_tipo'])
                                    ->setCellValue('E'.$row, $ServicioTipo['types']['total_servicios_tipo'])
                                    ->setCellValue('F'.$row, $ServicioTipo['services_sales_types']['fecha_inicio_tipo'])
                                    ->setCellValue('G'.$row, $ServicioTipo['services_sales_types']['fecha_fin_tipo']);
    
      $cantidad_servicios = $cantidad_servicios + $ServicioTipo['types']['cantidad_servicios_tipo'];
      $total_servicios = $total_servicios + $ServicioTipo['types']['total_servicios_tipo'];
    }
    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
endif;
$row = $row + 6;
$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $cantidad_servicios);
$row = $row + 3;
$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $total_servicios);

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
header('Content-Disposition: attachment;filename="ventaTipoDeServiciosMensualReportePDF.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>