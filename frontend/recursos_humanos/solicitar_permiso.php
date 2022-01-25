<?php
include("frontend/modularizacion/encabezado_html.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu.php");
?>

<div class="container section">
    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Solicitar Permiso Laboral</h5>
            <h6 class="title">Ingrese el tipo de solicitud</h6>
            <div class="input-field col s12 m6">
                <div class="row">
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="academico" value="Académico">
                                <span style="color: black;font-weight:bold;">Académico</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="salud" value="Salud">
                                <span style="color: black;font-weight:bold;">Salud</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="personal" value="Asunto Personal">
                                <span style="color: black;font-weight:bold;">Asunto Personal</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="legal" value="Trámite Legal">
                                <span style="color: black;font-weight:bold;">Trámite Legal</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="familiar" value="Fallecimiento Familiar">
                                <span style="color: black;font-weight:bold;">Fallecimiento Familiar</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="siniestro" value="Siniestro">
                                <span style="color: black;font-weight:bold;">Siniestro</span>
                            </label></p>
                    </div>
                    <div class="col s12 m6">
                        <p><label>
                                <input type="radio" class="with-gap" name="motivo" id="matrimonio" value="Matrimonio">
                                <span style="color: black;font-weight:bold;">Matrimonio</span>
                            </label></p>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6">
                <select name="responsable" id="responsable">
                    <?php
                    while ($r = $responsables->fetch_assoc()) {
                        echo "<option value='" . $r["id"] . "'>" . $r["apellido"] . " " . $r["nombre"] . "</option>";
                    }
                    ?>
                </select>
                <label for="responsable">¿A quien va dirigído?</label>
            </div>
            <div class="input-field col s12 m6">
                <input type="date" name="inicio">
                <label for="inicio">Fecha de inicio</label>
            </div>
            <div class="input-field col s12 m6">
                <input type="date" name="fin">
                <label for="fin">Fecha final</label>
            </div>
            <div class="input-field col s12 m6">
                <textarea name="descripcion" class="materialize-textarea" id="descripcion"></textarea>
                <label for="descripcion">Descripción</label>
            </div>
            <div class="input-field col s12 m6">
                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                <input type="password" id="clave" name="clave">
                <label for="clave">Ingrese su clave de seguridad</label>
            </div>
            <div class="input-field col s12 m6">
                <button type="submit" class="btn-entrar">Solicitar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </form>
    </div>
</div>



<script src="frontend/js/jquery-3.6.0.min.js"></script>
<script src="frontend/js/materialize.min.js"></script>
<script src="frontend/js/elementos-materialize.js"></script>
<script src="frontend/js/notificaciones.js"></script>
<script src="frontend/js/datatables.min.js"></script>
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
        $("#btn-submit").prop("disabled", true)
        $("#btn-submit").css("background-color", "gray")
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'solicitud_permiso',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "sesion";
                } else {
                    M.toast({
                        html: response,
                        classes: 'rounded red'
                    })
                    $("#progress").css("display", "none")
                    $("#btn-submit").prop("disabled", false)
                    $("#btn-submit").css("background-color", "#1a237e")
                }
            }
        });
    });
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>