<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/materialize.min.css">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>CORPOTULIPA - Resetee su contraseña</title>
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
                <h5 class="title">Resetee su contraseña</h5>
                <div class="input-field">
                    <i class="material-icons prefix">key</i>
                    <input type="text" name="token" id="token">
                    <label for="token">Ingrese el token enviado al correo</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix" onclick="visualizar()" id="icon-password" style="cursor: pointer;">visibility</i>
                    <input type="password" name="password" id="password" >
                    <label for="password">Ingrese su nueva contraseña</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix" onclick="visualizar()" id="icon-password2" style="cursor: pointer;">visibility</i>
                    <input type="password" name="confirm" id="confirm">
                    <label for="confirm">Confirme su contraseña</label>
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
                url: 'resetear_password',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok") {
                        M.toast({
                            html: 'Su contraseña ha sido reestablecida',
                            classes: 'rounded green'
                        })
                        setTimeout(() => {
                            location.href = "login"                            
                        }, 3000);
                    } else {
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
            var pass2 = document.getElementById("confirm");
            var icon2 = document.getElementById("icon-password2");

            if (pass.getAttribute("type", "password") == "password") {
                pass.setAttribute("type", "text")
                icon.innerHTML = "visibility_off"
                pass2.setAttribute("type", "text")
                icon2.innerHTML = "visibility_off"
            } else {
                pass.setAttribute("type", "password")
                icon.innerHTML = "visibility"
                pass2.setAttribute("type", "password")
                icon2.innerHTML = "visibility"
            }
        }

        function patron(){
            alert("AAA")
        }
    </script>
</body>

</html>