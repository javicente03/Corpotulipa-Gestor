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
        <h4>Nombre: <?php echo $bien["nombre_bien"] ?></h4>
        <h4>Código: <?php echo $bien["codigo"] ?></h4>

        <?php
        if($bien["tipo"] =="Mueble"){ ?>
        <input type="password" name="clave" id="clave" placeholder="Ingrese su clave de seguridad">
        <textarea name="descripcion" placeholder="Ingrese el motivo"></textarea>
        <label for="robo">Robo</label>
        <input type="radio" name="motivo" value="Robo" id="robo">
        <label for="hurto">Hurto</label>
        <input type="radio" name="motivo" value="Hurto" id="hurto" >
        <label for="extravio">Extravío</label>
        <input type="radio" name="motivo" value="Extravío" id="extravio">
        <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
        <button type="submit">Enviar</button>
        <?php } ?>
    </form>
    
   
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'mis_bienes',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>"){
                        location.href = "../mis_bienes";
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>
</body>
</html>