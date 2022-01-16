<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");

$date = date("Y-m-d");
$tramite = date_create($prestamo["fecha_tramite"]);
$date = date_create($date);
$interval = date_diff($tramite, $date);
$transcurridos = $interval->format('%a');
$restante = $prestamo["duracion"] - $transcurridos;
?>

<div class="container section">
    <div class="row">
        <h5 class="title">
            <a href="../bienes_prestados" class="btn btn-flat" title="Regresar"><i class="material-icons">keyboard_return</i></a>
            Información de prestamo
        </h5>
        <div class="col s12 blue lighten-3 center" style="border: 2px solid black;">
            <h6><b>Nombre: <?php echo $prestamo["nombre_bien"] ?></b><h6>
        </div>
        <div class="col s12 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Motivo: <?php echo $prestamo["motivo"] ?></b><h6>
        </div>
        <div class="col s12 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Concepto: <?php echo $prestamo["concepto"] ?></b><h6>
        </div>
        <div class="col s12 m5 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Nombre del Responsable: <?php echo $prestamo["nombre"] . " " . $prestamo["apellido"] ?></b><h6>
        </div>
        <div class="col s12 m6 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b><?php echo $prestamo["departamento"] ?></b><h6>
        </div>
        <div class="col s12 m1 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b><?php echo $prestamo["siglas"] ?></b><h6>
        </div>
        <div class="col s12 m6 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Fecha del Tramite: <?php echo $prestamo["fecha_tramite"] ?></b><h6>
        </div>
        <div class="col s12 m6 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Duración: <?php echo $prestamo["duracion"] ?> días</b><h6>
        </div>
        <div class="col s12 m6 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Restante: <?php echo $restante ?> días</b><h6>
        </div>
        <div class="col s12 m6 blue lighten-5 centered" style="border: 2px solid black;">
            <h6><b>Fecha final: <?php echo $prestamo["DATE_ADD(fecha_tramite, INTERVAL duracion DAY)"] ?></b><h6>
        </div>
    </div>

    <?php
    if ($restante == 1) {
    ?>
        <div class="row cont-crear">
            <h5 class="title">Solicitar prorroga<h5>
                    <form id="form">
                        <div class="col s12 m6 input-field">
                            <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                            <input type="password" name="clave" id="clave">
                            <label for="clave">Ingrese su clave de seguridad</label>
                        </div>
                        <div class="col s12 m6 input-field">
                            <input type="number" id="duracion" name="duracion" class="validate" required>
                            <label for="duracion">Duración</label>
                            <span class="helper-text" data-error="Este dato es requerido y es de tipo numérico" data-success=""></span>
                        </div>
                        <div class="col s12 m6 input-field">
                            <textarea name="motivo" class="materialize-textarea validate" data-length="2000" required id="motivo"></textarea>
                            <label for="motivo">Indique el motivo</label>
                            <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 2000 caracteres" data-success=""></span>
                        </div>
                        <div class="col s12 m6 input-field">
                            <button type="submit" class="btn-entrar" id="btn-submit">Solicitar</button>
                            <div class="progress indigo darken-4" id="progress" style="display: none;">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                        <input type="hidden" name="tramite" value="<?php echo $prestamo["id_tramite_bien"] ?>">
                        <input type="hidden" name="codigo" value="<?php echo $prestamo["codigo"] ?>">
                        <input type="hidden" name="nombre_bien" value="<?php echo $prestamo["nombre_bien"] ?>">
                        <input type="hidden" name="id_bien" value="<?php echo $prestamo["id_bien"] ?>">
                        <input type="hidden" name="responsable" value="<?php echo $prestamo["responsable"] ?>">
                    </form>
        </div>
    <?php
    }
    ?>
</div>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>
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

    <?php
    if ($restante == 1) {
    ?>
        $('#form').submit(function(e) {
            $("#progress").css("display", "block")
            $("#btn-submit").prop('disabled', true)
            $("#btn-submit").css('background', 'gray')
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'bienes_prestados',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = "../bienes_prestados";
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
    <?php
    }
    ?>
</script>
<?php
include("frontend/modularizacion/cierre_html.php");
?>