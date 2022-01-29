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
                <h5 class="title">Tramitar prestamo de bienes</h5>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Nombre: <?php echo $responsable["nombre_bien"] ?></b></h6>
                </div>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Responsable</b></h6>
                </div>
                <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $responsable["nombre"] . " " . $responsable["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $responsable["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $responsable["siglas"] ?></b></h6>
                </div>
                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Solicitante</b></h6>
                </div>
                <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $prestamo["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m1 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $prestamo["siglas"] ?></b></h6>
                </div>
                <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha de la solicitud: <?php echo $prestamo["fecha_prestamo"] ?></b></h6>
                </div>
                <div class="col s12 m4  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Duración: <?php echo $prestamo["duracion"] ?> Días</b></h6>
                </div>
                <div class="col s12 m4  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Fecha final: <?php echo $prestamo["DATE_ADD(fecha_prestamo, INTERVAL duracion DAY)"] ?></b></h6>
                </div>
                <div class="col s12  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Motivo: <?php echo $prestamo["motivo"] ?></b></h6>
                </div>
            </div>

            <div class="row cont-crear">
                <form id="form">
                    <input type="hidden" name="tramite" value="<?php echo $prestamo["id_prestamo_bien"] ?>">

                    <div class="input-field col s12 m6">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" name="clave" id="clave">
                        <label for="clave">Ingrese su clave de seguridad</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <textarea name="observacion" class="materialize-textarea validate" data-length="5000" id="observacion"></textarea>
                        <label for="observacion">¿Tiene alguna observación?</label>
                        <span class="helper-text" data-error="Este dato no debe exceder los 5000 caracteres" data-success=""></span>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
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
    $(document).ready(function() {
        $('#observacion').characterCounter();
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
            url: 'movimiento_bienes',
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
<?php
include("frontend/modularizacion/cierre_html.php");
?>