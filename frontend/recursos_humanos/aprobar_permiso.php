<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>
<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row">
                <h5 class="title">Información</h5>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Solicitante: <?php echo $permiso["nombre"] . " " . $permiso["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de la solicitud: <?php echo $permiso["fecha_solicitud"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de Inicio: <?php echo $permiso["fecha_inicio"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de Fin: <?php echo $permiso["fecha_fin"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Motivo: <?php echo $permiso["motivo"] ?></b></h6>
                </div>
                <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Descripción: <?php echo $permiso["descripcion"] ?></b></h6>
                </div>
            </div>

            <div class="row cont-crear">
                <h5 class="title">Aprobar Permiso Laboral</h5>
                <form id="form">
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" id="aprobar" name="respuesta" value="Aprobar">
                                        <span>Aprobar</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" id="rechazar" name="respuesta" value="Rechazar">
                                        <span>Rechazar</span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" id="remunerado" name="remuneracion" value="si">
                                        <span>Remunerado</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" id="noremunerado" name="remuneracion" value="no">
                                        <span>No Remunerado</span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <textarea name="observacion" class="materialize-textarea" id="observacion"></textarea>
                        <label for="observacion">Observación</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" name="clave" id="clave" required>
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn-entrar">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                    <input type="hidden" name="permiso" value="<?php echo $permiso["id_solicitud_permiso"] ?>">
                </form>
            </div>
        </div>
    </div>
</div>


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
            url: 'solicitud_permiso',
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
<?php
include("frontend/modularizacion/cierre_html.php");
?>