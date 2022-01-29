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
            <div class="row cont-crear">
                <h5 class="title">
                    <?php
                    if ($revision) {
                        echo "Revisar";
                    }
                    if ($verificacion) {
                        echo "Verificar";
                    }
                    if ($validacion) {
                        echo "Validar";
                    }
                    ?> adquisición del bien: <?php echo $bien["nombre_bien"] ?></h5>
                <form id="form">
                    <div class="col s12 m6 input-field">
                        <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                        <input type="password" name="clave" id="clave">
                        <label for="clave">Ingrese su clave para validar</label>
                    </div>
                    <div class="col s12 m6 input-field">
                        <input type="hidden" name="incorporacion" value="<?php echo $bien["id_bien"] ?>">
                        <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                        <div class="progress indigo darken-4" id="progress" style="display: none;">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
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
            url: 'verificar_bien',
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