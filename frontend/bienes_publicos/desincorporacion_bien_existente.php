<?php
include("frontend/modularizacion/encabezado_html_page.php");
if (!isset($router))
    header("Location: ../../404");
include("frontend/modularizacion/menu_page.php");
?>

<div class="container section">
    <div class="row">
        <h5 class="title">
            <a href="../mis_bienes" class="btn btn-flat" title="Regresar"><i class="material-icons">keyboard_return</i></a>
            Ficha del bien público
        </h5>
        <div class="col s12 center blue lighten-3" style="border: 2px solid black;">
            <h6><b>Nombre: <?php echo $bien["nombre_bien"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Código: <?php echo $bien["codigo"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Código SUDEBIP: <?php echo $bien["catalogo"] ?></b></h6>
        </div>
        <div class="col s12 m2 blue lighten-3" style="border: 2px solid black;">
            <h6><b><?php echo $bien["tipo"] ?></b></h6>
        </div>
        <div class="col s12 m8 blue lighten-3" style="border: 2px solid black;">
            <h6><b>Departamento: <?php echo $_SESSION["departamento"] ?></b></h6>
        </div>
        <div class="col s12 m2 blue lighten-3" style="border: 2px solid black;">
            <h6><b><?php echo $_SESSION["siglas"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Organismo: <?php echo $bien["organismo"] ?></b></h6>
        </div>
        <div class="col s12 m6 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Dependencia: <?php echo $bien["dependencia"] ?></b></h6>
        </div>
        <div class="col s12 m5 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Fecha de Incorporación: <?php echo $bien["fecha_incorporacion"] ?></b></h6>
        </div>
        <div class="col s12 m3 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Sede: <?php echo $bien["sede"] ?></b></h6>
        </div>
        <div class="col s12 m4 blue lighten-5" style="border: 2px solid black;">
            <h6><b>Valor: <?php echo $bien["valor"] ?> Bs</b></h6>
        </div>
    </div>

    <div class="row cont-crear">
        <form id="form">
            <h5 class="title">Desincorporar Bien Público</h5>
            <div class="col s12 input-field">
                <textarea name="motivo" id="motivo" class="materialize-textarea" data-length="5000" required></textarea>
                <label for="motivo">Indique el motivo</label>
                <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 5000 caracteres" data-success=""></span>
            </div>
            <div class="col s12 m6 input-field file-field">
                <div class="btn indigo darken-4">
                    <span><i class="material-icons">add_a_photo</i></span>
                    <input type="file" name="img1" id="img1">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="col s12 m6 input-field file-field">
                <div class="btn indigo darken-4">
                    <span><i class="material-icons">add_a_photo</i></span>
                    <input type="file" name="img2" id="img2">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="col s12 m6 input-field">
                <i id="icon" class="material-icons prefix" onclick="visualizar()" style="cursor: pointer;">visibility</i>
                <input type="password" name="clave" id="clave">
                <label for="clave">Ingrese su clave de seguridad</label>
            </div>
            <div class="col s12 m6 input-field">
                <button type="submit" class="btn-entrar" id="btn-submit">Enviar</button>
                <div class="progress indigo darken-4" id="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
            </div>
            <input type="hidden" name="bien" value="<?php echo $bien["id_bien"] ?>">
        </form>
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
        var formData = new FormData(document.getElementById("form"));
        formData.append('img1', $('#img1')[0].files[0]);
        formData.append('img2', $('#img2')[0].files[0]);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'desincorporar_bienes',
            data: formData,
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                    location.href = "../desincorporar_bienes";
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