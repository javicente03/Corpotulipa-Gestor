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
        <h4>Existencia: <?php echo $bien["existencia"] ?></h4>
        <input type="number" placeholder="Nuevas Incorporaciones" name="cantidad">
        <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
        <button type="submit">Enviar</button>
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