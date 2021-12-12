<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Prestamo de Muebles e Inmuebles</title>
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
            <th>Fecha del Prestamo</th>
            <th>Duración</th>
            <th>Restantes</th>
            <th></th>
        </thead>
        <tbody>
        <?php
            while ($prestamo = $prestamos->fetch_assoc()) {
                $date = date("Y-m-d");
                $tramite = date_create($prestamo["fecha_tramite"]);
                $date = date_create($date);
                $interval = date_diff($tramite, $date);
                $transcurridos = $interval->format('%a');
                $restante = $prestamo["duracion"] - $transcurridos;
        ?>
            <tr>
                <td><?php echo $prestamo["nombre_bien"] ?></td>
                <td><?php echo $prestamo["codigo"] ?></td>
                <td><?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?></td>
                <td><?php echo $prestamo["fecha_tramite"] ?></td>
                <td><?php echo $prestamo["duracion"] ?></td>
                <td><?php echo $restante ?></td>
                <td><a href="bienes_prestados/<?php echo $prestamo["id_tramite_bien"] ?>">Revisar</a></td>
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