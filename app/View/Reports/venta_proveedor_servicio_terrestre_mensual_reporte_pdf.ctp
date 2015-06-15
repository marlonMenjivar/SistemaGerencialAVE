<?php
// Importamos la clase PHPExcel
App::import('Vendor', 'Classes/PHPExcel');
App::import('Vendor', 'Classes/MPDF54');
$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererLibraryPath = '..\Vendor\Classes\MPDF54' ;

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("..\Template\Reporte11.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('C2', $fechaMes);
$objPHPExcel->getActiveSheet()->setCellValue('C4', $fechaAnio);

$cantidad_servicios=0;
$total_servicios=0;
$row = 0;

if (!empty($consultaServicios)):
    $baseRow = 14;
    foreach ($consultaServicios as $r => $ServicioProveedor) {
      $row = $baseRow + $r;
      $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
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

$row = $row + 7;
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
header('Content-Disposition: attachment;filename="ventaProveedorDeServiciosTerrestresMensualReportePDF.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>