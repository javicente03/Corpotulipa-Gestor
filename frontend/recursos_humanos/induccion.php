<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");

if ($induccion["fecha_respuesta"] == null) {
?>

    <div class="container section">
        <div class="row cont-crear">
            <h5 class="title">Por favor complete el siguiente cuestionario</h5>
            <form id="form">
                <h6 class="title">Marque que material le fue brindado en la charla</h6>
                <div class="col s12 m6 input-field">
                    <p><label>
                            <input type="checkbox" class="filled-in" name="cuadernillo" id="cuadernillo">
                            <span>Cuadernillo de bienvenida</span>
                        </label></p>
                </div>
                <div class="col s12 m6 input-field">
                    <p><label>
                            <input type="checkbox" class="filled-in" name="descripcion" id="descripcion">
                            <span>Descripción del cargo</span>
                        </label></p>
                </div>
                <div class="col s12 m6 input-field">
                    <p><label>
                            <input type="checkbox" name="politica" id="politica" class="filled-in">
                            <span>Política de Cálidad</span>
                        </label></p>
                </div>
                <div class="col s12 m6 input-field">
                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                    <input type="password" id="clave" name="clave">
                    <label for="clave">Ingrese su clave de seguridad</label>
                </div>
                <div class="col s12 input-field">
                    <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
} else
    echo "<h4 class='title'>Ya este test fue respondido</h4>";
?>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>

<script>
    function visualizar() {
        var pass = document.getElementById("clave");
        var icon = document.getElementById("icon");

        if (pass.getAttribute("type", "password") == "password") {
            pass.setAttribute("type", "text")
            icon.innerHTML = "visibility_off"
        } else {
            pass.setAttribute("type", "password")
            icon.innerHTML = "visibility"
        }
    }

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'charla_induccion',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../sesion";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop('disabled', false)
                    $("#btn-submit").css('background', '#1a237e')
                }
            }
        });
    });
</script>
</body>

</html>