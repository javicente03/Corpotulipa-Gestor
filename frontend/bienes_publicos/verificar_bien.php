<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Incorporación de Muebles e Inmuebles</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <h3><?php echo $bien["nombre_bien"] ?></h3>
        <h3><?php echo $bien["siglas"] ?></h3>

        <!-- Llenar la pantalla con mas datos -->
        <?php
            if($revision){
                echo "Revisión";
            }
            if($verificacion){
                echo "Verificación";
            }
            if($validacion){
                echo "Validación";
            } 
        ?>
        <input type="hidden" name="incorporacion" value="<?php echo $bien["id_bien"] ?>">
        <input type="text" placeholder="Ingrese su clave para validar" name="clave">
        <button type="submit">Enviar</button>
    </form>

    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'verificar_bien',
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