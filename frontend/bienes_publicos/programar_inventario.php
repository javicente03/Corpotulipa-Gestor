<?php
error_reporting(0);
if (empty($router->getParam())) {
    include("frontend/modularizacion/encabezado_html.php");
    if (!isset($router))
        header("Location: ../../404");
    include("frontend/modularizacion/menu.php");
?>
    <div class="row">
        <?php include("frontend/modularizacion/lateral.php") ?>
        <div class="col m12 l9 contenido-principal">
            <?php
            if (($ultimo["aprobado"] && $ultimo["fecha_fin_inventario"] != null) || $ultimo["rechazado"] || !$ultimo) {
            ?>
                <div class="section">
                    <div class="row cont-crear">
                        <h5 class="title">Programar un nuevo levantamiento de inventario</h5>
                        <form id="form">
                            <div class="col s12 m6 input-field">
                                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                                <input type="password" name="clave" id="clave">
                                <label for="clave">Ingrese su clave de seguridad</label>
                            </div>
                            <div class="col s12 m6 input-field">
                                <textarea name="motivo" id="motivo" class="materialize-textarea validate" data-length="5000" required></textarea>
                                <label for="motivo">Indique el motivo</label>
                                <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 5000 caracteres" data-success=""></span>
                            </div>
                            <div class="col s12 input-field">
                                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                                <div class="progress indigo darken-4" id="progress" style="display: none;">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="parrafo"><i class="material-icons left">error</i>
                        Una vez que realice la solicitud deberá esperar confirmación para proceder con el inventario</p>
                </div>

            <?php } else {
            ?>
                <div class="section">
                    <div class="row">
                        <h5 class="title">No puede solicitar un levantamiento de inventario mientras haya uno en proceso</h5>
                        <div class="col s12 blue lighten-3 center" style="border: 2px solid black;">
                            <h6><b>Información del inventario en marcha</b></h6>
                        </div>
                        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Fecha de inicio del inventario actual: <?php echo $ultimo["fecha_inventario"] ?></b></h6>
                        </div>
                        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Solicitante: <?php echo $ultimo["nombre"] . " " . $ultimo["apellido"] ?></b></h6>
                        </div>
                        <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Motivo: <?php echo $ultimo["motivo"] ?></b></h6>
                        </div>
                        <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                            <h6><b>Estatus: <?php $estaAprobado = $ultimo["aprobado"] ? "Aprobado" : "Sin atender";
                                            echo $estaAprobado; ?></b></h6>
                        </div>
                        <div class="col s12" style="margin-top: 10px;" ><button onclick="location.href='inventario_data'" class="btn-entrar">Ver Data Cargada</button></div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="frontend/js/jquery-3.6.0.min.js"></script>
    <script src="frontend/js/materialize.min.js"></script>
    <script src="frontend/js/elementos-materialize.js"></script>
    <script src="frontend/js/notificaciones.js"></script>
    <script src="frontend/js/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#motivo').characterCounter();
        });

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
                url: 'programar_inventario',
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
} else {
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
                    <div class="col s12 blue lighten-3 center" style="border: 2px solid black;">
                        <h6><b>Información del inventario rechazado</b></h6>
                    </div>
                    <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                        <h6><b>Fecha de inicio de la solicitud: <?php echo $inventario["fecha_inventario"] ?></b></h6>
                    </div>
                    <div class="col s12 blue lighten-5" style="border: 2px solid black;">
                        <h6><b>Motivo del rechazo: <?php echo $inventario["razon_rechazo"] ?></b></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../frontend/js/jquery-3.6.0.min.js"></script>
    <script src="../frontend/js/materialize.min.js"></script>
    <script src="../frontend/js/elementos-materialize.js"></script>
    <script src="../frontend/js/notificaciones-page.js"></script>
<?php
}
?>
<?php
include("frontend/modularizacion/cierre_html.php");
?>