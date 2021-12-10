<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORPOTULIPA - Iniciar Sesión</title>
</heads>
<body>
    <?php
        if(!isset($router))
            header("Location: 404.php");
    ?>
    <form id="form">
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <button type="submit" id="crear" >Ingresar</button>  
        <a href="olvido_password">¿Olvidó su contraseña?</a>     
    </form>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'login',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response)
                {
                    if(response == "ok")
                        location.href = "sesion"
                    else 
                        alert(response)
                }
            });
        });

    </script>    
</body>
</html>