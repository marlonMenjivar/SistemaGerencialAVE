<?php

    // Importamos la clase PHPExcel
    App::import('Vendor', 'Classes/PHPExcel');
     App::import('Vendor', 'Classes/MPDF54');

    $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
    $rendererLibraryPath = '..\Vendor\Classes\MPDF54' ;

    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load("..\Template\Reporte5.xlsx");

      $servicios_periodo_sucursal=0;
    $total_periodo=0;
    
    
    $faltante=0;
    $porcentajeFaltante=100;
    $id=0;
    
    //Si no se encontró meta para esa aerolínea y periodo
    if(empty($queryConsultaMetas)):
        //no hace nada.
        $porcentajeFaltante=0;
    else:
        $id=$queryConsultaMetas['GoalBranchOffice']['id'];
        $metaServicios=$queryConsultaMetas['GoalBranchOffice']['meta_servicios'];
        if(empty($consultaServicios)):
            $porcentajeFaltante=100;
            $faltante=$metaServicios;
        else:
            //Con los cálculos hechos antes
            foreach ($consultaServicios as $k=>$nivel0):
                foreach($nivel0 as $p=>$boleto):
                    $servicios_periodo_sucursal++;
                    $total_periodo=$total_periodo+$boleto['tarifa'];
                endforeach;   
            endforeach;
            if($total_periodo<$metaServicios):
                $faltante=$metaServicios-$total_periodo;
                $porcentajeFaltante=round(($faltante/$metaServicios)*100,2);
            else:
                $porcentajeFaltante=0;
            endif;
        endif;
    endif;


    $objPHPExcel->getActiveSheet()->setCellValue('B6', $name);
    $objPHPExcel->getActiveSheet()->setCellValue('B9', $fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B12','$ '.$metaServicios);
    $objPHPExcel->getActiveSheet()->setCellValue('D6',     $servicios_periodo_sucursal);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', '$ '.$total_periodo);
    $objPHPExcel->getActiveSheet()->setCellValue('D9', '$ '.$faltante);
    $objPHPExcel->getActiveSheet()->setCellValue('E9',      $porcentajeFaltante. ' %');
   
   if (!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)) {
        die(
                'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                '<br />' .
                'at the top of this script as appropriate for your directory structure'
        );
}

     // Redirect output to a client’s web browser (PDF)
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="ComparativoMetasServiciosTerrestresSucursalReportePdf.pdf');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
    $objWriter->save('php://output');
    exit;
?>