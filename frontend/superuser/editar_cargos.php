<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Cargos</title>
</head>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="number" name="rango" id="rango" value="<?php echo $rango ?>">
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
        <input type="hidden" name="id" value="<?php echo $data['cargo_id'] ?>">
        <button type="submit" >Editar</button>        
    </form>


    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'editar_cargo',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok"){
                        location.href = "../cargos"
                    } else {
                        alert(response)
                    }
                }
            });
        });
    </script>    
</body>
</html>