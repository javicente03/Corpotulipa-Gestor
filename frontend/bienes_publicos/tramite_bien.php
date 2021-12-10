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
        <input type="hidden" name="tramite" value="<?php echo $prestamo["id_prestamo_bien"] ?>">
        
        <h4>Nombre del bien: <?php echo $prestamo["nombre_bien"] ?></h4>
        <h4>Motivo: <?php echo $prestamo["motivo"] ?></h4>
        <h4>Duración: <?php echo $prestamo["duracion"] ?></h4>

        
        <input type="password" name="clave" placeholder="Ingrese su clave de seguridad">
        <textarea name="observacion" placeholder="Observación"></textarea>
        <button type="submit">Enviar</button>
    </form>
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'movimiento_bienes',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../sesion";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>