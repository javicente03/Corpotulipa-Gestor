<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row cont-crear">
        <h5 class="title">Solicitar prestamo de: <?php echo $bien["nombre_bien"] ?></h5>
        <form id="form">
            <div class="input-field col s12 m6">
                <p>
                    <label style="color:black;font-weight: bold;">
                        <input type="checkbox" class="filled-in" value="Externo" name="externo">
                        <span>¿La solicitud es externa?</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12 m6">
                <textarea name="motivo" id="motivo" data-length="2000" required class="materialize-textarea validate"></textarea>
                <label for="motivo">Indique su solicitud</label>
                <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 2000 carácteres" data-success=""></span>
            </div>
            <div class="input-field col s12 m6">
                <input type="number" name="duracion" id="duracion" class="validate" required>
                <label for="duracion">Duración, expresela en días</label>
                <span class="helper-text" data-error="Este dato es requerido y es de tipo numérico" data-success=""></span>
            </div>
            <div class="input-field col s12 m6">
                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
            <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
            <input type="hidden" name="nombre_bien" value="<?php echo $bien["nombre_bien"] ?>">
            <input type="hidden" name="responsable" value="<?php echo $bien["responsable"] ?>">
        </form>
    </div>
    <h5 class="title">Información del bien</h5>
    <ul class="collection">
        <li class="collection-item avatar">
            <img src="../<?php echo $bien["img"] ?>" alt="" class="circle">
            <span class="title"><?php echo $bien["nombre_bien"] ?></span>
            <p><b>Responsable:</b> <?php echo $bien["nombre"] . " " . $bien["apellido"] ?><br>
            </p>
            <p><b>Descripción:</b>
                <?php
                echo $bien["descripcion"];
                ?>
            </p>
            <p><b>Tipo:</b>
                <?php
                echo $bien["tipo"];
                ?>
            </p>
            <a href="#!" class="secondary-content"><?php echo $bien["valor"] ?> Bs</a>

        </li>
    </ul>
</div>

<script src="../frontend/js/jquery-3.6.0.min.js"></script>
<script src="../frontend/js/materialize.min.js"></script>
<script src="../frontend/js/elementos-materialize.js"></script>
<script src="../frontend/js/notificaciones-page.js"></script>
<script>
    $(document).ready(function() {
        $('#motivo').characterCounter();
    });

    $('#form').submit(function(e) {
        $("#progress").css("display", "block")
        $("#btn-submit").prop('disabled', true)
        $("#btn-submit").css('background', 'gray')
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'prestamo_bien',
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