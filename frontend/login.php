<?php
include("frontend/modularizacion/encabezado_html.php");

if (!isset($router))
    header("Location: ../404");
?>

<nav>
    <div class="nav-wrapper indigo darken-4">
        <div class="container">
            <a href="login" class="brand-logo"><img src="frontend/img/resources/logo.jpg" class="img-logo" alt=""></a>
        </div>
    </div>
</nav>

<div class="section container contenedor">
    <div class="cont-login">
        <form id="form">
            <h4 class="title">Inicio de Sesión</h4>
            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input type="text" name="email" id="email">
                <label for="email">Ingrese su correo</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix" onclick="visualizar()" id="icon-password" style="cursor: pointer;">visibility</i>
                <input type="password" name="password" id="password">
                <label for="password">Ingrese su contraseña</label>
            </div>
            <div class="progress indigo darken-4" id="progress" style="display: none;">
                <div class="indeterminate"></div>
            </div>
            <button type="submit" class="btn-entrar" id="btn-submit">Ingresar</button>
            <a href="olvido_password" class="enlace">¿Olvidó su contraseña?</a>
        </form>
    </div>
</div>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script>
    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").css("background-color", "gray")
        $("#btn-submit").prop("disabled", true)
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
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").css("background-color", "#1a237e")
                    $("#btn-submit").prop("disabled", false)
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
<?php
include("frontend/modularizacion/cierre_html.php");
?>