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
            <th>Fecha de la solicitud</th>
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
                    <td><?php echo $s["fecha_solicitud"] ?></td>
                    <td><?php echo $s["metodo"] ?></td>
                    <td><?php echo $s["denominacion"] ?></td>
                    <td><?php echo $participantes ?></td>
                    <td><a href="solicitudes_adiestramiento/<?php echo $s["id_adiestramiento"] ?>">Ir</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>

        $('#form').submit(function(e) {
            if (json.length > 0) {
                var formData = new FormData(document.getElementById("form"));
                formData.append('array', JSON.stringify(json));
                $.ajax({
                    type: "POST",
                    url: 'solicitud_adiestramiento',
                    data: formData,
                    enctype: 'application/x-www-form-urlencoded',
                    processData: false, // tell jQuery not to process the data
                    contentType: false,
                    success: function(response) {
                        if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                            location.href = "";
                        } else {
                            alert(response)
                        }
                    }
                });
            } else {
                alert("Debe añadir algún participante")
            }
            e.preventDefault();
        });
    </script>
</body>

</html>