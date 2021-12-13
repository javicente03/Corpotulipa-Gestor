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
            <th></th>
        </thead>
        <tbody>
        <?php
            while ($bien = $bienes->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $bien["nombre_bien"] ?></td>
                <td><?php echo $bien["codigo"] ?></td>
                <td><a href="mis_bienes/<?php echo $bien["id_bien"] ?>">Incorporar</a></td>
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