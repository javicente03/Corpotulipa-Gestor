<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Inventario</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
            
    ?>
    
    <table>
        <thead>
            <th>Departamento</th>
            <th>Catalogo</th>
            <th>Nombre</th>
            <th>Sede</th>
            <th>Responsable</th>
            <th></th>
        </thead>
        <tbody>
            <?php
                while ($bien = $bienes->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $bien["siglas"] ?></td>
                <td><?php echo $bien["catalogo"] ?></td>
                <td><?php echo $bien["nombre_bien"] ?></td>
                <td><?php echo $bien["sede"] ?></td>
                <td><?php echo $bien["nombre"]." ".$bien["apellido"] ?></td>
                <td><a href="desincorporar_bienes/<?php echo $bien["id_bien"] ?>">Desincorporar</a></td>
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