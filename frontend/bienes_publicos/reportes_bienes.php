<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Incorporación de Muebles e Inmuebles</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <table>
        <thead>
            <th>Nombre del Bien</th>
            <th>Código</th>
            <th>Responsable</th>
            <th>Causa</th>
            <th>Descripción de la falta</th>
            <th></th>
        </thead>
        <tbody>
        <?php
            while ($reporte = $reportes->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $reporte["nombre_bien"] ?></td>
                <td><?php echo $reporte["codigo"] ?></td>
                <td><?php echo $reporte["nombre"]." ".$reporte["apellido"] ?></td>
                <td><?php echo $reporte["motivo_reporte"] ?></td>
                <td><?php echo $reporte["descripcion_reporte"] ?></td>
                <td><a href="bienes_faltantes/<?php echo $reporte["id_reporte_bien"] ?>">Revisar</a></td>
                
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    
   
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
    </script>
</body>
</html>