<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Editar UT Caja Chica</title>
</heads>
<body>
    <?php
        if(!isset($router))
            header("Location: ../../404");
        
    ?>
    <form id="form">
        <input type="number" name="ut" id="ut" value="<?php echo $data['ut'] ?>">
        <input type="number" name="cambio" id="cambio" value="<?php echo $data['cambio_ut'] ?>">
        <input type="number" name="maximo_cc" id="maximo_cc" value="<?php echo $data1['fondo_maximo'] ?>">
        <button type="submit">Enviar</button>     
    </form>
    <p>Actual: <?php echo $data1['fondo_actual'] ?></p>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'editar_ut',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response=="ok" || response.substring(0, 15) == "<!DOCTYPE html>")
                        location.href = ""
                    else 
                        alert(response)
                }
            });
        });

    </script>    
</body>
</html>