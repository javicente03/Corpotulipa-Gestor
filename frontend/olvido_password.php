<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/materialize.min.css">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>CORPOTULIPA - Olvidó su contraseña</title>
    </heads>

<body>
    <?php
    if (!isset($router))
        header("Location: ../404");

    ?>
    <nav>
        <div class="nav-wrapper indigo darken-4">
            <div class="container">
                <a href="#!" class="brand-logo">CORPOTULIPA</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="login"><i class="material-icons left">person</i>Ingresar</a></li>
                </ul>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </div>
    </nav>

    <div class="section container contenedor">
        <div class="cont-login">
            <form id="form">
                <h5 class="title">Olvidó su contraseña</h5>
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input type="email" name="email" id="email">
                    <label for="email">Ingrese su correo electrónico</label>
                </div>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
                <button type="submit" class="btn-entrar">Enviar</button>
            </form>
        </div>
    </div>

    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script>
        $('#form').submit(function(e) {
            $("#progress").css("display", "block")
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'olvido_password',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response.substring(response.length - 2, response.length) == "ok")
                        location.href = "resetear_password"
                    else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                        $("#progress").css("display", "none")
                    }

                }
            });
        });
    </script>
</body>

</html>