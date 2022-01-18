<?php

if(!isset($router)){
    header("Location: ../404");
} else{

$clave = trim(addslashes($_POST["clave"]));
if($clave != ""){
    include("backend/bd.php");
    $usuario = ($bd->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']))->fetch_assoc();
    if(password_verify($clave, $usuario['password'])){
        $bien = ($bd->query("SELECT * FROM reporte_bien R 
                            LEFT JOIN bienes_publicos B ON R.id_bien = B.id_bien
                            LEFT JOIN usuario U ON B.responsable=U.id 
                            LEFT JOIN perfil P ON U.id=P.id_usuario 
                            INNER JOIN departamento D ON P.departamento_id =D.departamento_id
                            INNER JOIN cargo C ON P.cargo_id=C.cargo_id
                            WHERE id_reporte_bien = ".$_POST["reporte"]))->fetch_assoc();

        if(!$bien)
            header("Location: 404");
        $analista = ($bd->query("SELECT * FROM usuario U LEFT JOIN perfil P ON 
            U.id=P.id_usuario INNER JOIN cargo C ON P.cargo_id=C.cargo_id WHERE id = ".$bien["incorporado_por"]))->fetch_assoc();

        $reportar = $bd->query("UPDATE reporte_bien SET reporte_tramitado = true WHERE id_reporte_bien = ".$_POST["reporte"]);

        require('fpdf/fpdf.php');

        $pdf=new FPDF('P','mm','Letter');

        $pdf->AddPage();

        $pdf->Image('frontend/img/resources/encabezado incorporacion.png' , 0 ,0, 210 , 25,'png', 'http://www.desarrolloweb.com');
        $pdf->setFont('Arial', '', 11);
        $pdf->Cell(50,20,'',0,1);
        $pdf->Cell(180,5,utf8_decode('N°: '.$bien["id_bien"]),0, true,'R');
        $pdf->Cell(180,5,'Fecha: '.$bien["fecha_incorporacion"],0, true,'R');
        $pdf->Cell(50,5,'',0,1);
        $pdf->setFont('Arial', '', 10);
        $pdf->Cell(190,5,'ORGANISMO: '.$bien["organismo"],1, true,'L');
        $pdf->Cell(190,5,utf8_decode('Denominación: '.$bien["denoOrga"]),1, true,'L');
        $pdf->Cell(190,5, utf8_decode('UNIDAD ADMINISTRADORA: '.$bien["departamento"].' ('.$bien["siglas"].')'),1, true,'L');
        $pdf->Cell(40,5,utf8_decode('Código: '.$bien["codigo"]),1,0,'L',0);  // cell with left and right borders
        $pdf->Cell(150,5,utf8_decode('Denominación: '.$bien["denoDepa"]),1,0,'L',0);
        $pdf->Cell(190,5,' ','',0,'L',0);   // empty cell with left,top, and right borders
        $pdf->Cell(190,5,'',1, true,'L');
        $pdf->Cell(190,5,'DEPENDENCIA USUARIA '.$bien["dependencia"],1,0,'L',0);
        $pdf->Cell(40,5,'','LR',1,'C',0);  // cell with left and right borders
        $pdf->Cell(50,5,utf8_decode('Código:'),1,0,'L',0);
        $pdf->Cell(140,5,utf8_decode('Denominación: '.$bien["denoUsu"]),1,0,'L',0);
        $pdf->Cell(40,5,'','LR',1,'C',0);  // cell with left and right borders
        $pdf->Cell(190,5,'RESPONSABLE DEL ALMACEN',1, true,'L');
        $pdf->Cell(40,5,'C.I: '.$analista["cedula"],1,0,'L',0);   // empty cell with left,bottom, and right borders
        $pdf->Cell(100,5,'Nombres y Apellidos: '.$analista["apellido"]." ".$analista["nombre"],1,0,'L',0);   // empty cell with left,bottom, and right borders
        $pdf->Cell(50,5,'Cargo: '.$analista["cargo"],1,0,'L',0);   // empty cell with left,bottom, and right borders

        $pdf->Cell(50,20,'',0,1);

        $pdf->setFont('Arial', '', '8');
        $pdf->Cell(38,10,'Nombre:',1,0,'C');
        $pdf->Cell(38,10,'Cantidad:',1,0,'C');
        $pdf->Cell(38,10,utf8_decode('Código del Catálogo:'),1,0,'C');
        $pdf->Cell(38,10,utf8_decode('Número de Inventario:'),1,0,'C');
        $pdf->Cell(38,10,utf8_decode('Valor:'),1,0,'C');
        $pdf->Cell(50,10,'',0,1);
        $pdf->Cell(38,10,utf8_decode($bien["nombre_bien"]),1,0,'C');
        $pdf->Cell(38,10,'1',1,0,'C');
        $pdf->Cell(38,10,utf8_decode($bien["codigo"]),1,0,'C');
        $pdf->Cell(38,10,utf8_decode($bien["id_bien"]),1,0,'C');
        $pdf->Cell(38,10,utf8_decode($bien["valor"]),1,0,'C');
        $pdf->Cell(50,10,'',0,1);
        $pdf->Cell(50,10,'',0,1);

        $pdf->setFont('Arial', '', '11');
        $pdf->MultiCell(190,10,utf8_decode('Descripción del mueble: '.$bien["descripcion"]));

        $pdf->Cell(190,5,'Responsable Patrimonial Primario',1,0);
        $pdf->Cell(50,5,'',0,1);
        $pdf->Cell(63.3,5,utf8_decode('Cédula de Identidad'),1,0,'C');
        $pdf->Cell(63.3,5,utf8_decode('Apellidos y Nombres'),1,0,'C');
        $pdf->Cell(63.3,5,utf8_decode('Cargo'),1,0,'C');
        $pdf->Cell(50,5,'',0,1);
        $pdf->Cell(63.3,10,utf8_decode($bien["cedula"]),1,0,'C');
        $pdf->Cell(63.3,10,utf8_decode($bien["apellido"]." ".$bien["nombre"]),1,0,'C');
        $pdf->Cell(63.3,10,utf8_decode($bien["cargo"]),1,0,'C');

        $pdf->Output();
    } else
        echo "Clave Inválida";
} else
    echo "Debe ingresar su clave";
}
?>