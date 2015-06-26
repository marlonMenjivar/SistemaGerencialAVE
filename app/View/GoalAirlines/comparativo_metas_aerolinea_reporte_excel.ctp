<?php

    // Importamos la clase PHPExcel
    App::import('Vendor', 'Classes/PHPExcel');

    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load("..\Template\Reporte1.xlsx");

    $servicios_periodo_sucursal=0;
    $total_periodo=0;
    
    
    $faltante=0;
    $comision=0;
    $porcentajeFaltante=100;
    $ingresoPorComision=0;
    $id=0;
    if(empty($consultaBoletos)):
 
    else:
        foreach ($consultaBoletos as $k=>$nivel0):
            foreach($nivel0 as $p=>$boleto):
                $servicios_periodo_sucursal++;
                $total_periodo=$total_periodo+$boleto['tarifa'];
            endforeach;   
        endforeach;
    endif;
    //Si no se encontró meta para esa aerolínea y periodo
    if(empty($consultaMetas)):
        //no hace nada.
        $porcentajeFaltante=0;
    else:
        $id=$consultaMetas['GoalAirline']['id'];
        //var_dump($id);
        $metaBSP=$consultaMetas['GoalAirline']['meta_bsp'];
        $comision=$consultaMetas['GoalAirline']['comision'];
        if(empty($consultaBoletos)):
            $porcentajeFaltante=100;
            $faltante=$metaBSP;
        else:
            //Con los cálculos hechos antes
            
            if($total_periodo<$metaBSP):
                $faltante=$metaBSP-$total_periodo;
                $porcentajeFaltante=round(($faltante/$metaBSP)*100,2);
            else:
                $porcentajeFaltante=0;
                $ingresoPorComision=$total_periodo*($comision/100);
            endif;
        endif;
    endif;

$objPHPExcel->getActiveSheet()->setCellValue('B6', $airlineaNombre);
$objPHPExcel->getActiveSheet()->setCellValue('B9', $fecha);
$objPHPExcel->getActiveSheet()->setCellValue('B12', '$ '.number_format($metaBSP, 2, '.', ','));
$objPHPExcel->getActiveSheet()->setCellValue('B15', '$ '.number_format($comision, 2, '.', ','));
$objPHPExcel->getActiveSheet()->setCellValue('D6', $servicios_periodo_sucursal);
$objPHPExcel->getActiveSheet()->setCellValue('E6', '$ '.number_format($total_periodo, 2, '.', ','));
$objPHPExcel->getActiveSheet()->setCellValue('D9', '$ '.number_format($faltante, 2, '.', ','));
$objPHPExcel->getActiveSheet()->setCellValue('E9', number_format($porcentajeFaltante, 2, '.', ',').' %');
 $objPHPExcel->getActiveSheet()->setCellValue('D12', '$ '.number_format($ingresoPorComision, 2, '.', ','));

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ComparativoMetasAerolíneaReporteExcel.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
?>