<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu.php");

if (!$ultimo["aprobado"] && !$ultimo["rechazado"]) {
?>

    <div class="container section">
        <div class="row">
            <h5 class="title">Aprobar levantamiento de Inventario</h5>
            <form id="form">
                <div class="input-field col s12 m6">
                    <div class="row">
                        <div class="col s12 m6">
                            <p><label>
                                    <input type="radio" class="with-gap" name="accion" id="aprobar" value="Aprobar">
                                    <span>Aprobar</span>
                                </label></p>
                        </div>
                        <div class="col s12 m6">
                            <p><label>
                                    <input type="radio" class="with-gap" name="accion" id="rechazar" value="Rechazar">
                                    <span>Rechazar</span>
                                </label></p>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 m6">
                    <textarea name="motivo" id="motivo" disabled class="materialize-textarea validate" data-length="5000"></textarea>
                    <label for="motivo">Indique el motivo del rechazo</label>
                    <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 5000 caracteres" data-success=""></span>
                </div>
                <div class="input-field col s12 m6">
                    <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                    <input type="password" name="clave" id="clave">
                    <label for="clave">Ingrese su clave de seguridad</label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn-entrar" id="btn-submit">Enviar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </form>
        </div>
        <p class="parrafo"><i class="material-icons left">error</i>
            El motivo es obligatorio de ser rechazada la solicitud</p>
    </div>
<?php } else
    echo "<h5 class='title'>No hay ninguna toma de inventario pendiente</h5>";

?>

<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script src="frontend/js/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#motivo').characterCounter();
    });

    $("#aprobar").click(function(e) {
        $('#motivo').prop("required", false)
        $('#motivo').prop("disabled", true)
        $('#motivo').prop("class", "materialize-textarea validate")
    })

    $("#rechazar").click(function(e) {
        $('#motivo').prop("required", true)
        $('#motivo').prop("disabled", false)
    })

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
            url: 'aprobar_inventario',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "";
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