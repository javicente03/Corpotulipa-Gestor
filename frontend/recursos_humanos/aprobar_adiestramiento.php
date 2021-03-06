<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="row">
    <?php include("frontend/modularizacion/lateral_page.php") ?>
    <div class="col m12 l9 contenido-principal">
        <div class="section">
            <div class="row">
                <div class="col m6 blue lighten-4" style="border: 2px solid black;">
                    <h6>Gerente Solicitante: <?php echo $solicitud["nombre"] . " " . $solicitud["apellido"] ?></h6>
                </div>
                <div class="col m6 blue lighten-4" style="border: 2px solid black;">
                    <h6>Departamento: <?php echo $solicitud["departamento"] ?></h6>
                </div>
                <h5 class="title">Participantes</h5>
                <table class="striped responsive-table z-depth-3 centered">
                    <thead class="table-head">
                        <th>Nombre</th>
                        <th>Nivel Actual</th>
                        <th>Nivel Requerido</th>
                        <th>Cargo</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($p = $participantes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $p["nombre"] . " " . $p["apellido"] ?></td>
                                <td><?php echo $p["nivel_actual"] ?></td>
                                <td><?php echo $p["nivel_requerido"] ?></td>
                                <td><?php echo $p["cargo"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row cont-crear">
                <form id="form">
                    <h5 class="title">Dar Respuesta</h5>
                    <div class="input-field col s12 m6">
                        <h6 class="title">Aprobar Adiestramiento</h6>
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" name="respuesta" value="Si" id="si">
                                        <span>Si</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label>
                                        <input type="radio" class="with-gap" name="respuesta" value="No" id="no">
                                        <span>No</span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 input-field">

                    </div>
                    <div class="col s12 m6 input-field">
                        <textarea name="observaciones" class="materialize-textarea" id="observaciones"></textarea>
                        <label for="observaciones">??Tiene alguna observaci??n?</label>
                    </div>
                    <div class="col s12 m6 input-field">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" id="clave" name="clave">
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="col s12 m6 input-field">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                    <input type="hidden" name="solicitud" value="<?php echo $router->getParam() ?>">
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
            url: 'aprobar_adiestramiento',
            data: $(this).serialize(),
            enctype: 'application/x-www-form-urlencoded',
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../aprobar_adiestramiento";
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