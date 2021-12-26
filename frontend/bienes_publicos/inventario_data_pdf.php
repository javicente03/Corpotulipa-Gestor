<?php
if(!isset($router)){
    header("Location: ../404");
} else{
    require('fpdf/fpdf.php');

    $pdf=new FPDF('L','mm','Letter');
    $pdf->AddPage();
    $pdf->Image('frontend/img/resources/encabezado inventario.png' , 40,10, 200 , 25,'png');
    $pdf->setFont('Arial', '', 11);
    $pdf->Cell(230,60,'Fecha: '.$inventario["fecha_inventario_dep"],0, true,'R');

    $pdf->Cell(50,-25,'',0,1);
    $pdf->setFont('Arial', '', 10);
    $pdf->Cell(240,5,'DENOMINACION',1, true,'C');
    $pdf->Output();

}