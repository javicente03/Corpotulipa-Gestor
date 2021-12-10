<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Solicitud de Reposición de Caja Chica</title>
</head>

<body>
    <table>
            <thead>
                <thead>
                    <tr>
                        <th>Número de Reposición</th>
                        <th>Fecha</th>
                        <th>Fondo CC <span>(Para ese momento)</span></th>
                        <th></th>
                    </tr>
                </thead>
            </thead>
            <tbody>
            <?php
                while($data = $solicitudes->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $data['id_solicitud_repo_cc'] ?></td>
                    <td><?php echo $data['fecha'] ?></td>
                    <td><?php echo $data['fondo_momento'] ?></td>
                    <td><a href="../contador_repo_cc/<?php echo $data['id_solicitud_repo_cc'] ?>">Revisar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
        <p>Fondo Actual: <?php echo $cc['fondo_actual'] ?></p>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

    </script>
</body>

</html>