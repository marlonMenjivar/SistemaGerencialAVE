<?php

    // Importamos la clase PHPExcel
    App::import('Vendor', 'Classes/PHPExcel');

    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load("..\Template\Reporte4.xlsx");

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
        $metaBoletos=$queryConsultaMetas['GoalBranchOffice']['meta_boletos'];
        if(empty($consultaBoletos)):
            $porcentajeFaltante=100;
            $faltante=$metaBoletos;
        else:
            //Con los cálculos hechos antes
            foreach ($consultaBoletos as $k=>$nivel0):
                foreach($nivel0 as $p=>$boleto):
                    $servicios_periodo_sucursal++;
                    $total_periodo=$total_periodo+$boleto['tarifa'];
                endforeach;   
            endforeach;
            if($total_periodo<$metaBoletos):
                $faltante=$metaBoletos-$total_periodo;
                $porcentajeFaltante=round(($faltante/$metaBoletos)*100,2);
            else:
                $porcentajeFaltante=0;
            endif;
        endif;
    endif;

    $objPHPExcel->getActiveSheet()->setCellValue('B6', $name);
    $objPHPExcel->getActiveSheet()->setCellValue('B9', $fecha);
    $objPHPExcel->getActiveSheet()->setCellValue('B12','$ '.$metaBoletos);
    $objPHPExcel->getActiveSheet()->setCellValue('D6',     $servicios_periodo_sucursal);
    $objPHPExcel->getActiveSheet()->setCellValue('E6', '$ '.$total_periodo);
    $objPHPExcel->getActiveSheet()->setCellValue('D9', '$ '.$faltante);
    $objPHPExcel->getActiveSheet()->setCellValue('E9',      $porcentajeFaltante. ' %');
   

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ComparativoMetasVentaBoletosSucursalReporteExcel.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
?>