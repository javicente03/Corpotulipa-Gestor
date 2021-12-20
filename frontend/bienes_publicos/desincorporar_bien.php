<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Desincorporar Bien</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <h4>Nombre del bien: <?php echo $bien["nombre_bien"] ?></h4>
    <h4>Descripción: <?php echo $bien["descripcion"] ?></h4>
    <h4>Fecha de incorporación: <?php echo $bien["fecha_incorporacion"] ?></h4>
    <h4>Nombre del Responsable: <?php echo $bien["nombre"]." ".$bien["apellido"] ?></h4>
    <h4>Motivo del Reporte: <?php echo $bien["motivo_reporte"] ?></h4>
    <h4>Descripción del Reporte: <?php echo $bien["descripcion_reporte"] ?></h4>
    
    
    <form id="form">
        <input type="text" name="clave" id="clave" placeholder="Ingrese su clave de seguridad">
        <button type="submit">Enviar</button>
        <input type="hidden" name="reporte" value="<?php echo $bien["id_reporte_bien"] ?>">
    </form>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'desincorporacion_bien',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../desincorporacion_bien";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>