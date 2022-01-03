<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Recursos Humanos</title>
</head>

<body>
    <?php
    if (!isset($router))
        header("Location: ../404");
    ?>
    <table>
        <thead>
            <th>Unidad Solicitante</th>
            <th>Gerente</th>
            <th>Fecha Pautada</th>
            <th>Método</th>
            <th>Denominación</th>
            <th>Número de Participantes</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            while($s = $solicitudes->fetch_assoc()){
                $participantes = ($bd->query("SELECT * FROM participante_adiestramiento 
                                    WHERE id_adiestramiento = ".$s["id_adiestramiento"]))->num_rows;
            ?>
                <tr>
                    <td><?php echo $s["departamento"] ?></td>
                    <td><?php echo $s["nombre"]." ".$s["apellido"] ?></td>
                    <td><?php echo $s["fecha_adiestramiento"] ?></td>
                    <td><?php echo $s["metodo"] ?></td>
                    <td><?php echo $s["denominacion"] ?></td>
                    <td><?php echo $participantes ?></td>
                    <td><a href="aprobar_adiestramiento/<?php echo $s["id_adiestramiento"] ?>">Ir</a></td>
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