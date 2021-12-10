<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Resetee su contraseña</title>
</heads>
<body>
    <?php
        if(!isset($router))
            header("Location: ../404");
    ?>
    <form id="form">
        <input type="text" name="token" id="token">
        <input type="password" name="password" id="password">
        <input type="password" name="confirm" id="confirm">
        <button type="submit">Enviar</button>     
    </form>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'resetear_password',
                data: $(this).serialize(),
                enctype:'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response == "ok"){
                        alert("Su contraseña ha sido reestablecida")
                        location.href = "login"
                    } else 
                        alert(response)
                }
            });
        });

    </script>    
</body>
</html>