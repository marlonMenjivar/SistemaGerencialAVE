<?php

    // Importamos la clase PHPExcel
    App::import('Vendor', 'Classes/PHPExcel');

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
    $objPHPExcel->getActiveSheet()->setCellValue('B12','$ '.number_format($metaServicios, 2, '.', ','));
    $objPHPExcel->getActiveSheet()->setCellValue('D6',     $servicios_periodo_sucursal);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', '$ '.number_format($total_periodo, 2, '.', ','));
    $objPHPExcel->getActiveSheet()->setCellValue('D9', '$ '.number_format($faltante, 2, '.', ','));
    $objPHPExcel->getActiveSheet()->setCellValue('E9', number_format($porcentajeFaltante, 2, '.', ','). ' %');
   

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ComparativoMetasServiciosTerrestresSucursalReporteExcel.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
?>