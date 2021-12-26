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
        if(isset($inventarios)){
            
    ?>
    
    <table>
        <thead>
            <th>Departamento</th>
            <th>Fecha de Toma</th>
            <th></th>
        </thead>
        <tbody>
            <?php
                while ($i = $inventarios->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $i["siglas"] ?></td>
                <td><?php echo $i["fecha_inventario_dep"] ?></td>
                <td><a href="inventario_data/<?php echo $i["id_inventario_departamento"] ?>">Revisar</a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    
    <?php
        } else
            echo "No hay inventarios pendientes";
    ?>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        
    </script>
</body>
</html>