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
    <h4>Gerente Solicitante: <?php echo $solicitud["nombre"] . " " . $solicitud["apellido"] ?></h4>
    <h4>Departamento: <?php echo $solicitud["departamento"] ?></h4>
    <table>
        <thead>
            <th>Nombre</th>
            <th>Nivel Actual</th>
            <th>Nivel Requerido</th>
            <th>Cargo</th>
        </thead>
        <tbody>
            <?php
            while ($p = $participantes->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $p["nombre"] . " " . $p["apellido"] ?></td>
                    <td><?php echo $p["nivel_actual"] ?></td>
                    <td><?php echo $p["nivel_requerido"] ?></td>
                    <td><?php echo $p["cargo"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <form id="form">
        <input type="date" name="fecha">
        <input type="text" placeholder="Institución" name="institucion">
        <input type="text" placeholder="Lugar del evento" name="lugar">
        <input type="text" placeholder="Duración" name="duracion">
        <input type="text" placeholder="Costo Unitario" name="costo">
        <input type="text" placeholder="Telf de contacto" name="telf">
        <h6>Disponibilidad Presupuestaria</h6>
        <label for="si">Si</label>
        <input type="radio" name="presupuesto" id="si" value="Si">
        <label for="no">No</label>
        <input type="radio" name="presupuesto" id="no" value="No">
        <input type="text" name="partida" placeholder="Partida Presupuestaria">
        <textarea name="recomendaciones" placeholder="Recomendaciones"></textarea>
        <input type="text" placeholder="Clave" name="clave">
        <input type="hidden" name="solicitud" value="<?php echo $router->getParam() ?>">
        <button type="submit">Enviar</button>
    </form>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitudes_adiestramiento',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = "";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>

</html>