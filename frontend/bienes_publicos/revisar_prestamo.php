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
    <form id="form">
        <input type="hidden" name="prestamo" value="<?php echo $prestamo["id_prestamo_bien"] ?>">
        <input type="hidden" name="solicitante" value="<?php echo $prestamo["solicitante"] ?>">
        <input type="hidden" name="nombre_bien" value="<?php echo $prestamo["nombre_bien"] ?>">
        <h4><?php echo $prestamo["nombre_bien"] ?></h4>
        <h4><?php echo $prestamo["descripcion"] ?></h4>
        <h4><?php echo $prestamo["nombre"]." ".$prestamo["apellido"] ?></h4>
        <h4><?php echo $prestamo["siglas"] ?></h4>
        <h4><?php echo $prestamo["motivo"] ?></h4>
        <h4><?php echo $prestamo["duracion"] ?></h4>
        <label for="aprobar">Aprobar</label>
        <input type="radio" name="accion" value="aprobar" id="aprobar">
        <label for="rechazar">Rechazar</label>
        <input type="radio" name="accion" value="rechazar" id="rechazar">
        <textarea name="motivo"placeholder="Motivo del rechazo"></textarea>
        <button type="submit">Enviar</button>
    </form>
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'revisar_prestamo_bien',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
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