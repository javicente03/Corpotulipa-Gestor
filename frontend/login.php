<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/materialize.min.css">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>CORPOTULIPA - Iniciar Sesión</title>
</head>

<body>
    <?php
    if (!isset($router))
        header("Location: 404.php");
    ?>

    <nav>
        <div class="nav-wrapper indigo darken-4">
            <div class="container">
                <a href="#!" class="brand-logo">CORPOTULIPA</a>
            </div>
        </div>
    </nav>

    <!-- <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
    </ul> -->

    <div class="section container contenedor">
        <div class="cont-login">
            <form id="form">
                <h4 class="title">Inicio de Sesión</h4>
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="username" id="username">
                    <label for="username">Ingrese su usuario</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix" onclick="visualizar()" id="icon-password" style="cursor: pointer;">visibility</i>
                    <input type="password" name="password" id="password">
                    <label for="password">Ingrese su contraseña</label>
                </div>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
                <button type="submit" class="btn-entrar" id="crear">Ingresar</button>
                <a href="olvido_password" class="enlace">¿Olvidó su contraseña?</a>
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
                url: 'login',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok") {
                        M.toast({
                            html: 'Bienvenido',
                            classes: 'rounded green'
                        })
                        setTimeout(() => {
                            location.href = "sesion"
                        }, 3000);
                    } else{
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                        $("#progress").css("display", "none")
                    }
                }
            });
        });

        function visualizar() {
            var pass = document.getElementById("password");
            var icon = document.getElementById("icon-password");

            if (pass.getAttribute("type", "password") == "password") {
                pass.setAttribute("type", "text")
                icon.innerHTML = "visibility_off"
            } else {
                pass.setAttribute("type", "password")
                icon.innerHTML = "visibility"
            }
        }
    </script>
</body>

</html>