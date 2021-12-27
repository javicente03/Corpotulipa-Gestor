<?php
if(!isset($router)){
    header("Location: ../404");
} else{
    require('fpdf/fpdf.php');

    $pdf=new FPDF('L','mm','Letter');
    $pdf->SetMargins(20, 20 , 20);
    $pdf->AddPage();
    $pdf->Image('frontend/img/resources/encabezado inventario.png' , 40,10, 200 , 25,'png');
    $pdf->setFont('Arial', '', 11);
    $pdf->Cell(240,60,'Fecha: '.$inventario["fecha_inventario_dep"],0, true,'R');

    // INICIO
    $pdf->Cell(50,-25,'',0,1);
    $pdf->setFont('Arial', 'B', 7);
    $pdf->SetFillColor(203, 206, 208);
    $pdf->Cell(240,5,utf8_decode('DENOMINACIÓN'),1, true,'C',true);
    $pdf->Cell(200,5,utf8_decode('DEPENDENCIA O UNIDAD DE TRABAJO: '.$inventario["departamento"]),1,0,'L',0);
    $pdf->Cell(40,5,utf8_decode('CÓDIGO: '.$inventario["siglas"]),1,0,'L',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(240,5,utf8_decode('UBICACIÓN'),1, true,'C',true);
    $pdf->Cell(60,5,utf8_decode('ADMINISTRATIVA: Oficina '.$inventario["sede"]),1,0,'L',0);
    $pdf->Cell(180,5,utf8_decode('GEOGRÁFICA: '),1,0,'L',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(1,3,'',0, true,'C');

    // TABLA
    $pdf->Cell(240,5,utf8_decode('BIENES'),1, true,'C',true);
    $pdf->setFont('Arial', 'B', 8);
    $pdf->Cell(45,7,utf8_decode('CÓDIGO DEL CATÁLOGO'),1,0,'C',0);
    $pdf->Cell(45,7,utf8_decode('NÚMERO DE IDENTIFICACIÓN'),1,0,'C',0);
    $pdf->Cell(120,7,utf8_decode('NOMBRE DE LOS BIENES'),1,0,'C',0);
    $pdf->Cell(30,7,utf8_decode('VALOR UNITARIO'),1,0,'C',0);
    $pdf->Cell(1,7,'',0, true,'C');
    $pdf->setFont('Arial', 'B', 7);
    while ($d = $data->fetch_assoc()) {
        $pdf->Cell(45,5,utf8_decode($d["catalogo"]),1,0,'C',0);
        $pdf->Cell(45,5,utf8_decode($d["codigo"]),1,0,'C',0);
        $pdf->Cell(120,5,utf8_decode($d["nombre_bien"]),1,0,'C',0);
        $pdf->Cell(30,5,utf8_decode($d["valor"]),1,0,'C',0);
        $pdf->Cell(1,5,'',0, true,'C');
    }
    $pdf->setFont('Arial', 'B', 8);
    $pdf->Cell(210,5,utf8_decode("BIENES DE LA GERENCIA POR UN MONTO DE UN"),1,0,'C',0);
    $pdf->Cell(30,5,'',1,0,'L',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(210,5,utf8_decode("TOTAL GENERAL EN Bs"),1,0,'C',0);
    $pdf->Cell(30,5,$inventario["valor_total"],1,0,'L',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(1,5,'',0, true,'C');
    // FIRMAS
    $pdf->setFont('Arial', 'B', 8);
    $pdf->Cell(60,6,utf8_decode("Gerencia de Adscripción del Bien"),1,0,'C',0);
    $pdf->Cell(180,6,utf8_decode("Oficina de Administración y Finanzas"),1,0,'C',0);
    $pdf->Cell(1,6,'',0, true,'C');
    $pdf->setFont('Arial', 'B', 7);
    $pdf->Cell(60,5,utf8_decode("CONFORMACIÓN"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("PREPARACIÓN"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("CONFORMACIÓN"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("APROBACIÓN"),1,0,'C',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(60,5,utf8_decode("GERENTE DE LA UNIDAD"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("ANALISTA DE INVENTARIO I"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("COORDINADOR DE BIENES Y SERVICIOS"),1,0,'C',0);
    $pdf->Cell(60,5,utf8_decode("RESPONSABLE PATRIMONIAL"),1,0,'C',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(60,5,'',1,0,'C',0);
    $pdf->Cell(60,5,'',1,0,'C',0);
    $pdf->Cell(60,5,'',1,0,'C',0);
    $pdf->Cell(60,5,'',1,0,'C',0);
    $pdf->Cell(1,5,'',0, true,'C');
    $pdf->Cell(35,15,'FIRMA',1,0,'L',0);
    $pdf->Cell(25,15,'SELLO',1,0,'L',0);
    $pdf->Cell(60,15,'FIRMA',1,0,'L',0);
    $pdf->Cell(60,15,'FIRMA',1,0,'L',0);
    $pdf->Cell(35,15,'FIRMA',1,0,'L',0);
    $pdf->Cell(25,15,'SELLO',1,0,'L',0);

    
    $pdf->Output();

}