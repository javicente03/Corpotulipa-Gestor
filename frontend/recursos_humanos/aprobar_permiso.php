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
    <h4>Motivo: <?php echo $permiso["motivo"] ?></h4>
    <h4>Nombre del Responsable: <?php echo $permiso["nombre"]." ".$permiso["apellido"] ?></h4>
    <h4>Fecha de la solicitud: <?php echo $permiso["fecha_solicitud"] ?></h4>
    <h4>Fecha de Inicio: <?php echo $permiso["fecha_inicio"] ?></h4>
    <h4>Fecha de Fin: <?php echo $permiso["fecha_fin"] ?></h4>
    <h4>Descripción: <?php echo $permiso["descripcion"] ?></h4>
    <form id="form">
        <input type="text" placeholder="Clave" name="clave" required>
        <label for="aprobar">Aprobar</label>
        <input type="radio" id="aprobar" name="respuesta" value="Aprobar">
        <label for="rechazar">Rechazar</label>
        <input type="radio" id="rechazar" name="respuesta" value="Rechazar">
        <label for="remunerado">Remunerado</label>
        <input type="radio" id="remunerado" name="remuneracion" value="si">
        <label for="noremunerado">No Remunerado</label>
        <input type="radio" id="noremunerado" name="remuneracion" value="no">
        <textarea name="observacion" id="" placeholder="Observacion"></textarea>
        <input type="hidden" name="permiso" value="<?php echo $permiso["id_solicitud_permiso"] ?>">
        <button type="submit">Enviar</button>
    </form>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'solicitud_permiso',
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