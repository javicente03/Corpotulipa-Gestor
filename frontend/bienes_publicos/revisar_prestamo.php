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
                <h5 class="title">Revisar solicitud de prestamo</h5>

                <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
                    <h6><b>Nombre: <?php echo $prestamo["nombre_bien"] ?></b></h6>
                </div>
                <div class="col s12  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Descripción: <?php echo $prestamo["descripcion"] ?></b></h6>
                </div>
                <div class="col s12  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Solicitante: <?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?></b></h6>
                </div>
                <div class="col s12 m9 blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Departamento: <?php echo $_SESSION["departamento"] ?></b></h6>
                </div>
                <div class="col s12 m3 blue lighten-5" style="border: 2px solid black;">
                    <h6><b><?php echo $_SESSION["siglas"] ?></b></h6>
                </div>
                <div class="col s12  blue lighten-5" style="border: 2px solid black;">
                    <h6><b>Motivo: <?php echo $prestamo["motivo"] ?></b></h6>
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
            </div>
            <div class="row cont-crear">
                <form id="form">
                    <input type="hidden" name="prestamo" value="<?php echo $prestamo["id_prestamo_bien"] ?>">
                    <input type="hidden" name="solicitante" value="<?php echo $prestamo["solicitante"] ?>">
                    <input type="hidden" name="nombre_bien" value="<?php echo $prestamo["nombre_bien"] ?>">
                    <div class="input-field col s12 m6">
                        <div class="row">
                            <div class="col s12 m6">
                                <p><label style="font-weight: bold;color: black;">
                                        <input type="radio" name="accion" value="aprobar" id="aprobar">
                                        <span>Aprobar</span>
                                    </label></p>
                            </div>
                            <div class="col s12 m6">
                                <p><label style="font-weight: bold;color: black;">
                                        <input type="radio" name="accion" value="rechazar" id="rechazar">
                                        <span>Rechazar</span>
                                    </label></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 input-field">
                        <textarea name="motivo" data-length="250" class="materialize-textarea validate" id="motivo" disabled></textarea>
                        <label for="motivo">Motivo del rechazo</label>
                        <span class="helper-text" data-error="Este dato es obligatorio y no debe exceder los 250 caracteres" data-success=""></span>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </form>
            </div>
            <p class="parrafo"><i class="material-icons left">error</i>
                El motivo es obligatorio de ser rechazada la solicitud</p>
        </div>
    </div>
</div>


<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>

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

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'revisar_prestamo_bien',
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