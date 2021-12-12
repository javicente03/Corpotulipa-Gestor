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
        <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
        <input type="hidden" name="nombre_bien" value="<?php echo $bien["nombre_bien"] ?>">
        <input type="hidden" name="responsable" value="<?php echo $bien["responsable"] ?>">
        <h4><?php echo $bien["nombre_bien"] ?></h4>
        <h4><?php echo $bien["descripcion"] ?></h4>
        <h4><?php echo $bien["nombre"]." ".$bien["apellido"] ?></h4>
        <h4><?php echo $bien["siglas"] ?></h4>
        <input type="checkbox" value="Externo" name="externo">
        <textarea name="motivo" placeholder="Indique su solicitud"></textarea>
        <input type="number" name="duracion" placeholder="Duración, expresela en días">
        <button type="submit">Enviar</button>
    </form>
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'prestamo_bien',
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